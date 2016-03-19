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
                    $this->success("添加会员成功!",U("member/index"));
                } else {
                    $this->error("添加失败！");
                }
            } else {
                $this->error($this->member_model->getError());
            }
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
                    $this->success("更新成功！", U('member/index'));
                } else {
                    $this->error("更新失败！");
                }
            } else {
                $this->error($this->member_model->getError());
            }
        }
    }

    /**
     * 删除会员
     */
    public function delete() {
        $id = intval(I("get.id"));
//        $role_user_model=M("Member");
        $status = $this->member_model->delete($id);
        if($status !== false){
            $this->success('删除成功！',U('member/index'));
        }else{
            $this->error('删除失败！');
        }
//        $count=$role_user_model->where("id=$id")->count();
//        if($count){
//            $this->error("该角色已经有用户！");
//        }else{
//            $status = $this->role_model->delete($id);
//            if ($status!==false) {
//                $this->success("删除成功！", U('Rbac/index'));
//            } else {
//                $this->error("删除失败！");
//            }
//        }

    }
}