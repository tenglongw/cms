<?php
namespace app\content\validate;

use think\Validate;

class Content extends Validate
{
    protected $rule = [
        'title' => 'require|max:80',
        'size' => 'max:80',
    ];

    protected $scene = [
        'add' => ['title'],
        'edit' => ['title'],
        'style' => ['size'],
    ];
}