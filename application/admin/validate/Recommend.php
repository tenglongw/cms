<?php
namespace app\admin\validate;

use think\Validate;

class Recommend extends Validate
{

    protected $rule = [
        'title' => 'require|max:80',
        'description' => 'max:255',
        'size' => 'max:80',
    ];

    protected $scene = [
        'add' => ['title', 'description'],
        'edit' => ['title', 'description'],
        'style' => ['size'],
    ];
}