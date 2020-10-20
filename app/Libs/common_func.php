<?php


if(!function_exists('sendsms')){
    /**
     * @param $phone 手机号
     * @return mixed
     */
    function sendsms($phone,$code){
        $host = "http://dingxin.market.alicloudapi.com";
        $path = "/dx/sendSms";
        $method = "POST";
        $appcode = "001f25d681ab441b8925ce668973e105";
        $headers = array();
        array_push($headers,"Authorization:APPCODE ".$appcode);
        $querys = "mobile={$phone}&param=code%3A{$code}&tpl_id=TP2005069";
        $bodys = "";
        $url = $host . $path . "?" . $querys;
//        exit;
        $curl = curl_init();
        curl_setopt($curl, CURLOPT_CUSTOMREQUEST, $method);
        curl_setopt($curl, CURLOPT_URL, $url);
        curl_setopt($curl, CURLOPT_HTTPHEADER, $headers);
        curl_setopt($curl, CURLOPT_FAILONERROR, false);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
//        curl_setopt($curl, CURLOPT_HEADER, true);
        if (1 == strpos("$".$host, "https://"))
        {
            curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
            curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, false);
        }
        $re = curl_exec($curl);
        $re = json_decode($re, true);
        return $re['return_code'] == "00000"?true:false;
    }
}
