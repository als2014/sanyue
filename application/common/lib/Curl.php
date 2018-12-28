<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/12/20
 * Time: 18:23
 */

namespace app\common\lib;


class Curl
{
    public static function get($url)
    {
        //请求HTTPS
        $curl = curl_init();
        curl_setopt($curl, CURLOPT_URL, $url);
        curl_setopt($curl, CURLOPT_HEADER, 0);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, FALSE); //这个是重点,规避ssl的证书检查。
        curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, FALSE); // 跳过host验证
        $data = curl_exec($curl);
        curl_close($curl);
        return $data;
    }
}