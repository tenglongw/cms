<?php
namespace app\forms\validate;

use think\Validate;

class Forms extends Validate
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