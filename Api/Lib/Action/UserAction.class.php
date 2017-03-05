<?php
/**
 * 用户接口 控制器类
 * @author 蔡繁荣 <fanrong33@qq.com>
 * @version 1.0.0 build 20170304
 */
class UserAction extends ApiCommonAction{

    public function get_user(){
        $user = array(
            'id'       => 10001,
            'username' => 'fanrong33',
        );
        $this->ajaxReturn($user, 'success', 1);
    }

}

?>