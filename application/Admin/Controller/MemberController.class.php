<?php
/**
 * 会员管理
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2016/3/19
 * Time: 9:10
 */
namespace Admin\Controller;

use Common\Controller\AdminbaseController;

class MemberController extends AdminbaseController{

    protected $member_model;
    protected $lastID; // 最后插入ID

    function _initialize() {
        parent::_initialize();
        $this->member_model = D("Common/Member");
    }

    /**
     * 会员管理列表
     */
    public function index(){
        $search_type = I('post.search_type');
        $keywords = I('post.keywords');
        if(empty($keywords)){
            $count=$this->member_model->count();
            $page = $this->page($count, 20);
            $data = $this->member_model->order(array("id" => "desc"))
                ->limit($page->firstRow . ',' .$page->listRows)
                ->select();
            $this->assign("page", $page->show('Admin'));
        }else{
            $where[$search_type] = array('like', $keywords);
            $data = $this->member_model->where($where)
                ->order(array("id" => "desc"))->select();
        }

        foreach ($data as $key => $value) {
            $res = $this->getMember($value['pid']);
            $data[$key]['zj_num'] = $this->getZJNum($value['id']);
            $data[$key]['jj_num'] = $this->getJJNum($value['id']);
            $data[$key]['p_member_name'] = $res['member_name'];
        }

        $this->assign("members", $data);
        $this->display();
    }

    /**
     * 会员添加
     */
    public function add() {
        $this->display();
    }

    /**
     * 添加会员数据
     */
    public function add_post() {
        if (IS_POST) {
            if ($this->member_model->create()) {
                $this->member_model->area = I('post.province').','.I('post.city').','.I('post.area');
                if ($this->member_model->add()!==false) {
                    $this->_memberID();
                    $this->_relation();
                    $this->handleLog('添加会员，会员ID：'.$this->lastID.'，状态：成功！');
                    $this->success("添加会员成功!",U("member/index"));
                } else {
                    $this->handleLog('添加会员，状态：失败！');
                    $this->error("添加失败！");
                }
            } else {
                $this->error($this->member_model->getError());
            }
        }
    }

    /**
     * 生成以8开头的8位会员ID
     */
    private function _memberID(){
        $this->lastID = $this->member_model->getLastInsID();
        $data['member_id'] = '8'.str_pad($this->lastID, 7, '0', STR_PAD_LEFT);
        $this->member_model->where('id='.$this->lastID)->save($data);
        return $data['member_id'];
    }

    /**
     * 推荐关系生成
     */
    private function _relation(){
        $member = $this->member_model->where('id='.$this->lastID)->find();
        $data = array();
        if(!empty($member['pid'])){
            $p_member = $this->getMember($member['pid']);
            $data['relation'] = $p_member['relation'].','.$member['id'];
            $this->member_model->where('id='.$member['id'])->save($data);
            $this->_updateRank($p_member['relation']);
        }else{
            $data['relation'] = '0,'.$member['id'];
            $this->member_model->where('id='.$member['id'])->save($data);
        }
    }

    /**
     * 会员升级判断
     * @param $p_relation
     */
    private function _updateRank($p_relation){
        $relation = explode(',', $p_relation);
        array_shift($relation);
        $jianjie_res = array();
        $zhijie_res = array();
        foreach ($relation as $item_id) {
            $zhijie_res[$item_id] = $this->getZJNum($item_id);
            $jianjie_res[$item_id] = $this->getJJNum($item_id);
        }
        foreach($relation as $val){
            $member = $this->getMember($val);
            $data['rank'] = 3;
            if($member['rank'] == 1 && $jianjie_res[$val] >= 65 && $zhijie_res[$val] >= 35){
                $this->member_model->where('id='.$val)->save($data);
                $this->handleLog('会员满足升级条件，会员ID：'.$member['id'].',自动升级成为大咖！');
            }elseif($member['rank'] == 2 && $jianjie_res[$val] >= 40 && $zhijie_res[$val] >= 20){
                $this->member_model->where('id='.$val)->save($data);
                $this->handleLog('会员满足升级条件，会员ID：'.$member['id'].',自动升级成为大咖！');
            }
        }
    }

    /**
     * 获取直接下线数量
     * @param $id
     * @return mixed
     */
    public function getZJNum($id){
        $where['pid'] = array('eq',$id);
        $res = $this->member_model->where($where)->count();
        return $res;
    }

    /**
     * 获取间接下线数量
     * @param $id
     * @return mixed
     */
    public function getJJNum($id){
        $where['relation'] = array('like','%'.$id.',%');
        $zhijie_num = $this->getZJNum($id);
        $res = $this->member_model->where($where)->count();
        return $res - $zhijie_num;
    }

    /**
     * 会员编辑
     */
    public function edit() {
        $id = intval(I("get.id"));
        if ($id == 0) {
            $id = intval(I("post.id"));
        }
        $data = $this->member_model->where(array("id" => $id))->find();
        if (!$data) {
            $this->error("该会员不存在！");
        }
        $area = explode(',', $data['area']);
        $data['province'] = $area[0];
        $data['city'] = $area[1];
        $data['area'] = $area[2];

        $this->assign("data", $data);
        $this->display();
    }

    /**
     * 编辑更新会员数据
     */
    public function edit_post() {
        if (IS_POST) {
            $data = $this->member_model->create();
            if ($data) {
                $data['area'] = I('post.province').','.I('post.city').','.I('post.area');
                if ($this->member_model->save($data)!==false) {
                    $this->_changeRelation($data['id']);

                    $old_pid = I('post.old_pid');
                    $new_pid = I('post.pid');
                    // 判断推荐人ID是否变动
                    if($old_pid != $new_pid){
                        $old_recommend_member = $this->getMember($old_pid);
                        $this->_lowerRank($old_recommend_member['relation']);
                        $member_id = I('post.id');
                        $member = $this->getMember($member_id);
                        $p_member = $this->getMember($member['pid']);
                        $this->_updateRank($p_member['relation']);
                    }
                    $this->handleLog('更新会员信息，会员ID：'.$data['id'].'，状态：成功！');
                    $this->success("更新成功！", U('member/index'));
                } else {
                    $this->handleLog('更新会员信息，状态：失败！');
                    $this->error("更新失败！");
                }
            } else {
                $this->error($this->member_model->getError());
            }
        }
    }

    /**
     * 变更会员推荐关系
     * @param $id
     */
    private function _changeRelation($id){
        $member = $this->getMember($id);
        $data = array();
        if(!empty($member['pid'])){
            $p_member = $this->getMember($member['pid']);
            $p_relation = $p_member['relation'] ? $p_member['relation'] : '0';
            $data['relation'] = $p_relation.','.$member['id'];
            $this->member_model->where('id='.$member['id'])->save($data);
        }
    }

    /**
     * 会员降级判断
     * @param $p_relation
     */
    private function _lowerRank($p_relation){
        $relation = explode(',', $p_relation);
        array_shift($relation);
        $jianjie_res = array();
        $zhijie_res = array();
        foreach ($relation as $item_id) {
            $jianjie_res[$item_id] = $this->getJJNum($item_id);
            $zhijie_res[$item_id] = $this->getZJNum($item_id);
        }

        foreach($relation as $val){
            $member = $this->getMember($val);
            if($member['old_rank'] == 1 && $member['rank'] == 3){
                if($jianjie_res[$val] < 65 || $zhijie_res[$val] < 35){
                    $data['rank'] = 1;
                    $this->member_model->where('id='.$val)->save($data);
                    $this->handleLog('会员推荐关系变动，会员ID：'.$member['id'].',自动降级成为卖咖!');
                }
            }elseif($member['old_rank'] == 2 && $member['rank'] == 3){
                if($jianjie_res[$val] < 40 || $zhijie_res[$val] < 20){
                    $data['rank'] = 2;
                    $this->member_model->where('id='.$val)->save($data);
                    $this->handleLog('会员推荐关系变动，会员ID：'.$member['id'].',自动降级成为资深卖咖!');
                }
            }
        }
    }

    /**
     * 会员详情
     */
    public function info() {
        $id = intval(I("get.id"));
        if ($id == 0) {
            $id = intval(I("post.id"));
        }
        $data = $this->member_model->where(array("id" => $id))->find();
        if (!$data) {
            $this->error("该会员不存在！");
        }

        // 数据关系图
        $floor_3 = array();
        $floor_4 = array();
        $floor_5 = array();

        $floor_2 = $this->member_model->where('pid='.$data['id'])->select();

        foreach($floor_2 as $item_3){
            $res_3 = $this->member_model->where('pid='.$item_3['id'])->find();
            if($res_3){
                $floor_3[] = $res_3;
            }
        }
        foreach($floor_3 as $item_4){
            $res_4 = $this->member_model->where('pid='.$item_4['id'])->find();
            if($res_4){
                $floor_4[] = $res_4;
            }
        }
        foreach($floor_4 as $item_5){
            $res_5 = $this->member_model->where('pid='.$item_5['id'])->find();
            if($res_5){
                $floor_5[] = $res_5;
            }
        }

        $this->assign("data", $data);
        $this->assign('floor_2', $floor_2);
        $this->assign('floor_3', $floor_3);
        $this->assign('floor_4', $floor_4);
        $this->assign('floor_5', $floor_5);
        $this->display();
    }

    /**
     * 支付信息
     */
    public function payment_record(){
        $id = intval(I("get.id"));
        if ($id == 0) {
            $id = intval(I("post.id"));
        }
        $data = $this->member_model->where(array("id" => $id))->find();
        if (!$data) {
            $this->error("该会员不存在！");
        }
        $sx = explode(',', $data['relation']);
        $sx_num = count($sx) - 2;
        $relation['sx'] = $sx_num; // 上线
        $relation['zj'] = $this->getZJNum($id); // 直接下线
        $relation['jj'] = $this->getJJNum($id); // 间接下线
        $this->assign("data", $data);
        $this->assign("relation", $relation);
        $this->display();
    }

    /**
     * 支付记录提交
     */
    public function payment_record_post(){
        if (IS_POST) {
            $data = $this->member_model->create();
            if ($data) {
                $data['rank'] = $data['pay_type'];
                $member = $this->getMember($data['id']);
                if ($this->member_model->save($data)!==false) {

                    // 支付记录
                    $paymentLog['handle_user'] = $_SESSION['name'];
                    $paymentLog['member_id'] = $member['id'];
                    $paymentLog['member_name'] = $member['member_name'];
                    $paymentLog['amount'] = $data['pay_type'] == 2 ? 1599 : 599;
                    $paymentLog['remark'] = $data['remark'];
                    $paymentLog['create_time'] = time();
                    $this->paymentLog($paymentLog);

                    $this->handleLog('添加会员支付记录，会员ID：'.$member['id'].'，状态：成功！');
                    $this->success("添加成功！", U('member/index'));
                } else {
                    $this->handleLog('添加会员支付记录，状态：失败！');
                    $this->error("添加失败！");
                }
            } else {
                $this->error($this->member_model->getError());
            }
        }
    }

    /**
     * 记录支付日志
     * @param $paymentLog
     */
    public function paymentLog($paymentLog){
        $log_model = M('payment_log');
        $data = $paymentLog;
        $data['handle_user'] = $_SESSION['name'];
        $data['create_time'] = time();
        $log_model->add($paymentLog);
    }

    /**
     * 获取会员信息
     * @param $id
     * @return mixed
     */
    public function getMember($id){
        return $member = $this->member_model->where('id='.$id)->find();
    }

    /**
     * 获取AJAX格式会员数据
     */
    public function getAjaxMember(){
        $id = intval(I('get.id'));
        $member = $this->getMember($id);
        if($member['member_name']){
            $data['member_id'] = $member['id'];
            $data['member_name'] = $member['member_name'];
            $data['member_mobile'] = $member['mobile'];
            echo json_encode($data);
            exit;
        }else{
            echo '2';
            exit;
        }
    }

    /**
     * 操作日志
     * @param $log_data
     * @return mixed
     */
    public function handleLog($log_data){
        $log_model = M('log');
        $data['handle_user'] = $_SESSION['name'];
        $data['desc'] = $log_data;
        $data['create_time'] = time();
        $res = $log_model->add($data);
        return $res;
    }
}
