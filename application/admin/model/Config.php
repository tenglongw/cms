<?php
namespace app\admin\model;

use think\Model;

class Config extends Model
{

    protected $pk = 'id';
    protected $field = ['id', 'group', 'category_id', 'pid', 'title', 'name', 'value', 'render', 'form', 'config', 'remark', 'update_time', 'create_time', 'sort', 'status', 'locked'];
    protected $type = [
        'config' => 'json',
    ];

    public function configcate()
    {
        return $this->belongsTo('Configcate');
    }
}