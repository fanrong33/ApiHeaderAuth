<?php
/**
 * 模拟API客户端 控制器类
 * @author 蔡繁荣 <fanrong33@qq.com>
 * @version 1.0.0 build 20170304
 */
class ClientAction extends Action{

    public function test(){

        import('@.ORG.Api.TestPHPSDK');
        $test_client = new TestPHPSDK(10000, 'AT6KWO7M338YK9SJ0KQM');
        $json = $test_client->get_user(array());
        dump($json);
        exit;

    }

}
?>