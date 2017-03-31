<?php
namespace app\content\model;

use think\Model;

class Comment extends Model
{

    protected $name = 'content_comment';
    protected $pk = 'id';
    protected $field = ['id', 'uid', 'touid', 'topid', 'tid', 'pid', 'content', 'update_time', 'create_time','create_date', 'status', 'locked', 'sort', 'ip'];

    // 留言人
    public function user()
    {
        return $this->belongsTo('\app\admin\model\User', 'uid', 'id', '', 'LEFT');
    }

    // 回复对象
    public function touser()
    {
        return $this->belongsTo('\app\admin\model\User', 'touid', 'id', '', 'LEFT')->setAlias(['user' => 'touser']);
    }

    // 内容
    public function tocontent()
    {
        return $this->belongsTo('\app\content\model\Content', 'tid', 'id', '', 'LEFT');
    }
}