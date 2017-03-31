<?php
namespace app\content\validate;

use think\Validate;

class Tag extends Validate
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