<?php
/**
 * 费用管理（支付相关）
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2016/3/21
 * Time: 13:11
 */
namespace Admin\Controller;

use Common\Controller\AdminbaseController;

class PaymentController extends AdminbaseController{
    protected $payment_log_model;

    function _initialize() {
        parent::_initialize();
        // 支付日志记录
        $this->payment_log_model = M("payment_log");
    }

    /**
     * 支付记录首页列表
     */
    public function index(){
        $count=$this->payment_log_model->count();
        $page = $this->page($count, 20);
        $data = $this->payment_log_model->order(array("id" => "desc"))
            ->limit($page->firstRow . ',' .$page->listRows)
            ->select();
        $this->assign("page", $page->show('Admin'));
        $this->assign("payment_logs", $data);
        $this->display();
    }
}