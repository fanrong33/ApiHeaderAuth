<?php
/**
 * 模拟API 客户端PHPSDK
 * PHP SDK Library for xxx.com
 */
class TestPHPSDK{

    private static $url = 'http://xxx.com/api.php';

    private $cb;
    private $apikey;


    function __construct($cb, $apikey){
        $this->cb     = $cb;
        $this->apikey = $apikey;
    }

    /**
     * 获取用户接口
     * @param  integer  $user_id  用户id
     */
    function get_user($user_id){
        $params = array(
            'user_id' => $user_id
        );

        $url = self::url.'/user/get_user';
        return $this->api($url, $params);
    }


    function api($url, $params, $method='GET'){
        if($method == 'GET'){
            $result_str = $this->http($url.'?'.http_build_query($params));
        }else{
            $result_str = $this->http($url, http_build_query($params), 'POST');
        }
        $result = array();
        if($result_str!='') $result = json_decode($result_str, true);
        return $result;
    }


    function http($url, $postfields='', $method='GET', $headers=array()){
        $ci = curl_init();
        curl_setopt($ci, CURLOPT_SSL_VERIFYPEER, FALSE); 
        curl_setopt($ci, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ci, CURLOPT_CONNECTTIMEOUT, 30);
        curl_setopt($ci, CURLOPT_TIMEOUT, 30);
        if($method=='POST'){
            curl_setopt($ci, CURLOPT_POST, TRUE);
            if($postfields!='')curl_setopt($ci, CURLOPT_POSTFIELDS, $postfields);
        }
        // $headers[]="User-Agent: PHP(php.com)";
        $time  = time();
        $token = md5($this->apikey.md5($time));

        // header auth
        $headers[] = "cb: {$this->cb}";
        $headers[] = "time: {$time}";
        $headers[] = "token: {$token}";

        curl_setopt($ci, CURLOPT_HTTPHEADER, $headers);
        curl_setopt($ci, CURLOPT_HEADER, false);
        curl_setopt($ci, CURLOPT_URL, $url);
        $response = curl_exec($ci);
        curl_close($ci);
        return $response;
    }

}


?>