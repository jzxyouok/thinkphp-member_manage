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
            $where = array($search_type => array('LIKE', $keywords));
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
                    $this->_memberID();
                    $this->_relation();exit;
                    $this->handleLog('添加会员，状态：成功！');
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
    }

    /**
     * 推荐关系生成
     */
    private function _relation(){
        $member = $this->member_model->where('id='.$this->lastID)->find();
        $data = array();
        if(!empty($member['pid'])){
            $p_member = $this->member_model->where('id='.$member['pid'])->find();
            $data['relation'] = $p_member['relation'].','.$member['id'];
            $this->member_model->where('id='.$member['id'])->save($data);
            $this->_updateRank($member['id'], $p_member['relation']);
        }else{
            $data['relation'] = '0,'.$member['id'];
            $this->member_model->where('id='.$member['id'])->save($data);
        }
    }

    private function _updateRank($id, $p_relation){
        $memberModel = M('member');
        $member = $memberModel->find($id);
        $relation = explode(',', $p_relation);
        array_shift($relation);
        if($member['rank'] == 1){
            foreach ($relation as $item) {
                $zj_where['relation'] = array('like', '0,'.$item.',%');
                $zj_where['rank'] = array('lt', 3);
                $zj_res[] = $this->member_model->where($zj_where)->select();
                $jj_where['relation'] = array('like', '%'.$item.'%');
                $jj_where['rank'] = array('lt', 3);
                $jj_res[] = $this->member_model->where($jj_where)->select();
            }
            print_r($zj_res);
            print_r($jj_res);

        }elseif($member['rank'] == 2){

        }

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
                    $this->handleLog('更新会员信息，状态：成功！');
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
                if ($this->member_model->save($data)!==false) {
                    $this->handleLog('添加支付记录，状态：成功！');
                    $this->success("添加成功！", U('member/index'));
                } else {
                    $this->handleLog('添加支付记录，状态：失败！');
                    $this->error("添加失败！");
                }
            } else {
                $this->error($this->member_model->getError());
            }
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