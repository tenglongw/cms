<?php
namespace app\content\validate;

use think\Validate;

class Hotword extends Validate
{
    protected $rule = [
        'tag' => 'require|max:80',
        'size' => 'between:10,60',
        'bold' => 'in:blod,bloder',
    ];

    protected $scene = [
        'add' => ['tag'],
        'edit' => ['tag'],
        'style' => ['size', 'blod'],
    ];
}