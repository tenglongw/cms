<?php
namespace app\bulletin\validate;

use think\Validate;

class Bulletin extends Validate
{

    protected $rule = [
        'title' => 'require|max:80',
        'body' => 'require',
        'size' => 'max:80',
    ];

    protected $scene = [
        'add' => ['title', 'body'],
        'edit' => ['title', 'body'],
        'style' => ['size'],
    ];
}