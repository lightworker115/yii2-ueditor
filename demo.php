<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2020/3/26
 * Time: 14:50
 */

namespace jerry;


class demo
{
    public function ueditor()
    {
        $ueditor = htmlspecialchars($_GET('action'));
        $up = new Ueditor($this->config());
        $res = $up->index('image');
        exit(json_encode($res));

    }

    public function config()
    {
        return [];
    }
}