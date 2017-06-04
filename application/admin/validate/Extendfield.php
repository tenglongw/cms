<?php
namespace app\admin\validate;

use think\Validate;

class Extendfield extends Validate
{

    protected $rule = [
        'category_id' => 'require',
        'group' => 'require|max:10',
        'title' => 'require|max:10',
        'name' => 'require|max:20',
        'type' => 'require',
        'config' => 'array',
        'id' => 'require',
    ];

    protected $scene = [
        'add' => ['category_id', 'group', 'title', 'name', 'type'],
        'edit' => ['group', 'title', 'name', 'type', 'id'],
        'config' => ['config', 'id'],
    ];
}