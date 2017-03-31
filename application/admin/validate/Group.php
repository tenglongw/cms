<?php
namespace app\admin\validate;

use think\Validate;

class Group extends Validate
{

    protected $rule = [
        'group' => 'require|max:25',
        'title' => 'require|max:80',
        'description' => 'max:255',
    ];

    protected $scene = [
        'add' => ['group', 'title', 'description'],
        'edit' => ['group', 'title', 'description'],
    ];
}