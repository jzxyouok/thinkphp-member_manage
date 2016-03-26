<?php
namespace Common\Model;
use Common\Model\CommonModel;
class PaymentModel extends CommonModel{

    //自动验证
    protected $_validate = array(
        //array(验证字段,验证规则,错误提示,验证条件,附加规则,验证时间)
    );

    // 自动完成
    protected $_auto = array(
        array('create_time','time',1,'function'),
        array('handle_user','_getLoginUser',3,'callback'),
    );

    /**
     * 获取当前登陆用户（操作员）
     * @return mixed
     */
    protected function _getLoginUser(){
        return $_SESSION['name'];
    }

    protected function _before_write(&$data) {
        parent::_before_write($data);
    }
}