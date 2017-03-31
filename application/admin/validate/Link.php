<?php
namespace app\admin\validate;

use think\Validate;

class Link extends Validate
{

    protected $rule = [
        'group' => 'require|max:25',
        'title' => 'require|max:80',
        'url' => 'require',
    ];

    protected $scene = [
        'add' => ['group', 'title', 'url'],
        'edit' => ['group', 'title', 'url'],
    ];
}