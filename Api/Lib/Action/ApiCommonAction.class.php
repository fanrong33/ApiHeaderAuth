<?php
/**
 * API通用 控制器类
 * @author 蔡繁荣 <fanrong33@qq.com>
 * @version 1.1.0 build 20170304
 */
class ApiCommonAction extends Action{


    public function _initialize(){

        /** 授权认证算法
         php客户端实现通过 CURLOPT_HTTPHEADER

         time    发送请求时的时间戳，与服务器时间戳最大相差不得超过1800秒，否则判断为失效请求
         token   由time, APIKey共同加密组成，验证请求合法性
                 例：由md5(APIKey.md5(time))  生成
        */

        $cb      = $_SERVER['HTTP_CB'];
        $time    = $_SERVER['HTTP_TIME'];
        $token   = $_SERVER['HTTP_TOKEN'];
        
        if($cb == ''){
            $this->ajaxReturn(array('status'=>0, 'info'=>'cb parameter is empty'));
        }
        if($time == ''){
            $this->ajaxReturn(array('status'=>0, 'info'=>'time parameter is empty'));
        }
        if($token == ''){
            $this->ajaxReturn(array('status'=>0, 'info'=>'token parameter is empty'));
        }
        $now = time();
        if(abs($now-$time) > 1800){
            $this->ajaxReturn(array('status'=>0, 'info'=>'timestamp timeout'));
        }

        // TODO 从应用数据库获取信息
        $apikey = 'AT6KWO7M338YK9SJ0KQM'; // 暂时手动填写测试应用api的apikey
        
        
        $server_token = md5($apikey.md5($time));
        if($token != $server_token){
            $this->ajaxReturn(array('status'=>0, 'info'=>'auth faild'));
        }
    }


}

?>