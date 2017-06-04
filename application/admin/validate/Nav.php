<?php
namespace app\admin\validate;

use think\Validate;

class Nav extends Validate
{

    protected $rule = [
        'title' => 'require',
    ];

    protected $scene = [
        'add' => ['title'],
        'edit' => ['title'],
    ];
}