<?php
namespace ebcms;

class Notice
{

    public static function add($data)
    {
        $data['create_time'] = time();
        $data['update_time'] = time();
        $data['sort'] = 0;
        $data['status'] = 1;
        $data['isread'] = 0;
        \think\Db::name('user_notice')->insert($data);
    }

}