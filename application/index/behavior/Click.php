<?php
namespace app\index\behavior;

class Click
{
    public function run(&$params)
    {
        \app\content\model\Content::where(['id' => input('id')])->setInc('click', 1);
    }
}