<?php
namespace app\content\validate;

use think\Validate;

class Category extends Validate
{
    protected $rule = [
        'title' => 'require|max:80',
        'name' => 'require|max:25',
    ];

    protected $scene = [
        'add' => ['title', 'name'],
        'edit' => ['title', 'name'],
    ];
}