<?php

namespace app\api\controller\v1;

use think\Controller;
use think\Db;
use think\Exception;

class Member extends Controller
{
    public function index()
    {
        echo 6;
        die;
    }

    /**
     * 小程序授权用户入库
     * @return array
     */
    public function add()
    {
        if (request()->isPost()) {
            $data = input('post.');
            $member = Db::name('member')->where([
                'openid'    =>  $data['openid']
            ])->find();
            if (!empty($member))
            {
                return show(0,'already exist');
            }

            $data['nickName'] = $data['userinfo']['nickName'];
            $data['avatarUrl'] = $data['userinfo']['avatarUrl'];
            $data['gender'] = $data['userinfo']['gender'];
            $data['country'] = $data['userinfo']['country'];
            $data['province'] = $data['userinfo']['province'];
            $data['city'] = $data['userinfo']['city'];
            $data['openid'] = $data['openid'];
            $data['sessionKey'] = $data['sessionKey'];
            $data['login_time'] = date('Y-m-d H:i:s');
            try {
                $id = model('Member')->add($data);
            } catch (Exception $exception) {
                return show(0,$exception->getMessage());
            }
            if ($id)
            {
                return show(1,'ok');
            }
        }
    }
}
