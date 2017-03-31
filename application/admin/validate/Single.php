<?php
namespace app\admin\validate;

use think\Validate;

class Single extends Validate
{

    protected $rule = [
        'group' => 'require|max:25',
        'title' => 'require|max:80',
        'path' => 'regex:[A-Za-z0-9_\/]*',
        'tpl' => 'regex:[A-Za-z0-9_-]*',
        'description' => 'max:255',
        'body' => 'require',
    ];

    protected $scene = [
        'add' => ['group', 'title', 'path', 'tpl', 'description', 'body'],
        'edit' => ['group', 'title', 'path', 'tpl', 'description', 'body'],
    ];
}