<?php
/**
 * Created by PhpStorm.
 * User: baidu
 * Date: 17/8/5
 * Time: 下午4:37
 */
namespace app\api\controller\v1;

use app\api\controller\Common;
use app\common\lib\Aesold;

class Cat extends Common {

    /**
     * 栏目接口
     */
    public function read() {
        $cats = config('cat.lists');
        $icons = config('cat.icons');

        $result[] = [
            'catid' => 0,
            'catname' => '首页',
            'icon'    =>'/images/icon-index.png'
        ];

        foreach($cats as $catid => $catname) {
            $result[] = [
                'catid' => $catid,
                'catname' => $catname,
                'icon'  =>  $icons[$catid]
            ];
        }

        return show(config('code.success'), 'OK', $result, 200);
    }

}