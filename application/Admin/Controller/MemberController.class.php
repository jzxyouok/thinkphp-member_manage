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
    protected $lastID;

    function _initialize() {
        parent::_initialize();
        $this->member_model = D("Common/Member");
    }

    /**
     * 会员管理
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
                if ($this->member_model->add()!==false) {
                    $member_id = $this->_memberID();
                    $this->_relation();
                    $this->handleLog('添加会员，会员ID：'.$member_id.'，状态：成功！');
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
            $jianjie_res[$item_id] = $this->getJJNum($item_id);
            $zhijie_res[$item_id] = $this->getZJNum($item_id);
        }
        foreach($relation as $val){
            $member = $this->getMember($val);
            $data['rank'] = 3;
            if($member['rank'] == 1 && $jianjie_res[$val] >= 65 && $zhijie_res[$val] >= 35){
                $this->member_model->where('id='.$val)->save($data);
                $this->handleLog('会员满足升级条件，会员ID：'.$member['member_id'].',自动升级成为大咖！');
            }elseif($member['rank'] == 2 && $jianjie_res[$val] >= 40 && $zhijie_res[$val] >= 20){
                $this->member_model->where('id='.$val)->save($data);
                $this->handleLog('会员满足升级条件，会员ID：'.$member['member_id'].',自动升级成为大咖！');
            }
        }
    }

    /**
     * 获取直接下线数量
     * @param $id
     * @return mixed
     */
    public function getZJNum($id){
        $where['rank'] = array('lt',3);
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
        $where['rank'] = array('lt',3);
        $where['relation'] = array('like','%'.$id.',%');
        $res = $this->member_model->where($where)->count();
        return $res;
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
                if ($this->member_model->save($data)!==false) {
                    $member_id = I('post.id');
                    $member = $this->getMember($member_id);
                    $this->handleLog('更新会员信息，会员ID：'.$member['member_id'].'，状态：成功！');
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
        $this->assign("data", $data);
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
        $this->assign("data", $data);
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
                    $this->handleLog('添加会员支付记录，会员ID：'.$member['member_id'].'，状态：成功！');
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
     * 获取会员信息
     * @param $id
     * @return mixed
     */
    public function getMember($id){
        return $member = $this->member_model->where('id='.$id)->find();
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