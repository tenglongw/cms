<?php
namespace app\forms\validate;

use think\Validate;

class Formsfield extends Validate
{
    protected $rule = [
        'forms_id' => 'require',
        'title' => 'require|max:10',
        'type' => 'require',
        'id' => 'require',
    ];

    protected $scene = [
        'add' => ['forms_id', 'title', 'type'],
        'edit' => ['title', 'type', 'id'],
    ];
}