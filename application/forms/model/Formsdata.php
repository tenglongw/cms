<?php
namespace app\forms\model;

use think\Model;

class Formsdata extends Model
{

    protected $name = 'formsdata';
    protected $pk = 'id';
    protected $field = ['id', 'forms_id', 'data', 'ip', 'create_time', 'update_time', 'sort', 'status', 'locked'];
    protected $insert = ['ip'];
    protected $type = [
        'data' => 'json',
    ];

    public function forms()
    {
        return $this->belongsTo('Forms');
    }

    protected function setIpAttr()
    {
        return request()->ip();
    }

}