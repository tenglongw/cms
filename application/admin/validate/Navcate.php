<?php
namespace app\admin\validate;

use think\Validate;

class Navcate extends Validate
{

    protected $rule = [
        'title' => 'require',
        'mark' => 'require',
    ];

    protected $scene = [
        'add' => ['title', 'mark'],
        'edit' => ['title', 'mark'],
    ];
}