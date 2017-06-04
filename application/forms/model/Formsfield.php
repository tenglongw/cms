<?php
namespace app\forms\model;

use think\Model;

class Formsfield extends Model
{

    protected $pk = 'id';
    protected $field = ['id', 'forms_id', 'title', 'type', 'config', 'remark', 'sort', 'update_time', 'create_time', 'status', 'locked'];

    public function forms()
    {
        return $this->belongsTo('Forms');
    }
}