<?php
namespace app\content\validate;

use think\Validate;

class Body extends Validate
{
    protected $rule = [
        'body' => 'require',
    ];

    protected $scene = [
        'add' => ['body'],
        'edit' => ['body'],
    ];
}