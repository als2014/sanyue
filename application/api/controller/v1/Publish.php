<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/12/21
 * Time: 14:13
 */

namespace app\api\controller\v1;


use think\Controller;

class Publish extends Controller
{
    /**
     * 发布动态接口
     */
    public function index()
    {
        if (request()->isPost())
        {
            $data = input('post.');
            var_dump($data);
        }
    }
}