<?php
namespace app\admin\validate;

use think\Validate;

class Datadictcate extends Validate
{

    protected $rule = [
        'group' => 'require|max:25',
        'title' => 'require|max:80',
        'field' => 'require|max:40',
        'remark' => 'max:255',
    ];

    protected $scene = [
        'add' => ['group', 'title', 'field', 'remark'],
        'edit' => ['group', 'title', 'field', 'remark'],
    ];
}