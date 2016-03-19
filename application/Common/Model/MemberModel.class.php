<?php
namespace Common\Model;
use Common\Model\CommonModel;
class MemberModel extends CommonModel{

    //自动验证
    protected $_validate = array(
        //array(验证字段,验证规则,错误提示,验证条件,附加规则,验证时间)
        array('member_name', 'require', '会员姓名不能为空！', 1, 'regex', 3 ),
        array('mobile', 'require', '手机号不能为空！', 1, 'regex', 3 ),
        array('mobile', 'number', '手机号格式不正确！！', 1, 'regex', 3 ),
        array('mobile', '', '手机号已存在！', 1, 'unique', 1 ),
        array('rid', 'require', '推荐人会员ID不能为空！', 1, 'regex', 3 ),
    );

    // 自动完成
    protected $_auto = array(
        array('create_time','time',1,'function'),
        array('update_time','time',2,'function'),
        array('handle_user','_getLoginUser',3,'callback'),
    );

    /**
     * 生成会员ID
     */
    protected function _generateMemberID(){

    }

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