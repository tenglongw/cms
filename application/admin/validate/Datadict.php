<?php
namespace app\admin\validate;

use think\Validate;

class Datadict extends Validate
{

    protected $rule = [
        'title' => 'require|max:80',
        'value' => 'require',
        'remark' => 'max:255',
    ];

    protected $scene = [
        'add' => ['remark', 'title', 'value'],
        'edit' => ['remark', 'title', 'value'],
    ];
}