<?php
namespace app\admin\validate;

use think\Validate;

class Config extends Validate
{

    protected $rule = [
        'group' => 'require|max:25',
        'category_id' => 'require',
        'pid' => 'require',
        'title' => 'require|max:80',
        'name' => 'require|max:40',
        'form' => 'require',
        'config' => 'array',
    ];

    protected $scene = [
        'add' => ['group', 'pid', 'category_id', 'title', 'name', 'form'],
        'edit' => ['group', 'title', 'name', 'form'],
    ];
}