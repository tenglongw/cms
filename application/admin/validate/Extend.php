<?php
namespace app\admin\validate;

use think\Validate;

class Extend extends Validate
{
    protected $rule = [
        'group' => 'require',
        'title' => 'require',
    ];

    protected $scene = [
        'add' => ['group', 'title'],
        'edit' => ['title'],
    ];
}