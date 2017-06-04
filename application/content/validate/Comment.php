<?php
namespace app\content\validate;

use think\Validate;

class Comment extends Validate
{
    protected $rule = [
        'content' => 'require',
    ];

    protected $scene = [
        'add' => ['content'],
        'edit' => ['content'],
    ];
}