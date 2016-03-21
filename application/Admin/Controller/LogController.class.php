<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2016/3/21
 * Time: 13:11
 */
namespace Admin\Controller;

use Common\Controller\AdminbaseController;

class LogController extends AdminbaseController{
    protected $log_model;

    function _initialize() {
        parent::_initialize();
        $this->log_model = M("log");
    }

    public function index(){
        $count=$this->log_model->count();
        $page = $this->page($count, 20);
        $data = $this->log_model->order(array("id" => "desc"))
            ->limit($page->firstRow . ',' .$page->listRows)
            ->select();
        $this->assign("page", $page->show('Admin'));
        $this->assign("logs", $data);
        $this->display();
    }
}