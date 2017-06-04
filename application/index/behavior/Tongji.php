<?php
namespace app\index\behavior;

class Tongji
{
    public function run(&$params)
    {
        $pos = \ebcms\Position::getLast();
        $data = [
            'user_id' => session('?user_id') ? session('user_id') : 0,
            'title' => $pos['title'],
            'url' => request()->url(true),
            'ip' => request()->ip(0, true),
            'create_time' => time(),
        ];
        \app\admin\model\Tongji::create($data);
    }
}