<?php
namespace app\admin\model;

use think\Model;

class Datadict extends Model
{

    protected $pk = 'id';
    protected $field = ['id', 'pid', 'category_id', 'title', 'value', 'ext', 'remark', 'update_time', 'create_time', 'sort', 'status', 'locked'];
    protected $type = [
        'ext' => 'json',
    ];

    public function datadictcate()
    {
        return $this->belongsTo('Datadictcate', 'category_id', 'id');
    }
}