<?php
namespace app\admin\validate;

use think\Validate;

class Recommendcate extends Validate
{

    protected $rule = [
        'group' => 'require|max:25',
        'title' => 'require|max:80',
        'mark' => 'require|max:40',
    ];

    protected $scene = [
        'add' => ['group', 'title', 'mark'],
        'edit' => ['group', 'title', 'mark'],
    ];
}