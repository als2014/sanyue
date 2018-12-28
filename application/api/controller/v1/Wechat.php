<?php
namespace app\api\controller\v1;
use think\Controller;
use think\Db;
use think\Config;
use app\common\lib\Curl;
use app\server\WxBizDataCrypt;

class Wechat extends Controller{
    private $params;
    public function login()
    {
        $this->params = input('post.');
        try{
            if( empty($this->params['code']) || empty($this->params['rawData']) || empty($this->params['encryptedData']) || empty($this->params['iv']) || empty($this->params['signature'])){
                throw new \Exception('参数错误',-1);
            }
            //根据code 获取openid和session_key
            $appid  = Config::get('wechat.appid');
            $secret = Config::get('wechat.secret');
            //curl请求获得openid,session_key
            $url = "https://api.weixin.qq.com/sns/jscode2session?appid={$appid}&secret={$secret}&js_code={$this->params['code']}&grant_type=authorization_code";
            $res = Curl::get($url);
            $res    = json_decode($res,true);
            if(empty($res['openid']) || empty($res['session_key'])){
                throw new \Exception('获取用户信息失败',-1);
            }
            //验证签名
            $signature = sha1($this->params['rawData'].$res['session_key']);
            if($this->params['signature'] != $signature){
                throw new \Exception('数字签名失败',-1);
            }
            //调用解密方法获得用户信息
            $pc = new WxBizDataCrypt($appid,$res['session_key']);
            $errCode = $pc->decryptData($this->params['encryptedData'], $this->params['iv'], $data );
            if ($errCode != 0) {
                throw new \Exception($errCode);
            }
            return show(1,'ok',$res,200);
            //保持用户登录状态
//            \app\server\Redis::get_instence()->set($signature,$wid,3600*24*15);
            if ($errCode != 0) {
                throw new \Exception($errCode);
            }
        }
        catch (\Exception $e)
        {
            return show(0,$e->getMessage(),[]);
        }
    }
}