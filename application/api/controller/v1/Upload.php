<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/12/25
 * Time: 20:49
 */

namespace app\api\controller\v1;


use app\api\controller\Common;
use think\Request;

class Upload extends Common
{
    public function index()
    {
        $file = Request::instance()->file('image');
        //将图片上传至指定文件夹
        $info = $file->move('upload');
        if($info && $info->getPathname()) {
            return show(1,'OK','/'.$info->getPathname());
        }
        return show(0,'上传失败');
    }
}