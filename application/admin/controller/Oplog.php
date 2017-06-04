<?php
namespace app\admin\controller;
class Oplog extends \app\admin\controller\Common
{

    public function index()
    {
        if (request()->isGet()) {
            $this->success('', '', $this->fetch());
        }
    }

    public function delete()
    {
        if (request()->isPost()) {
            $this->ebdelete(['unlock' => 1]);
        }
    }

    // 查看详细
    public function show()
    {
        if (request()->isGet()) {
            $oplog = \app\admin\model\Oplog::get(input('id'));
            $this->assign('oplog', $oplog);
            $this->success('', '', $this->fetch());
        }
    }

    public function add()
    {
    }

    public function edit()
    {
    }

    public function status()
    {
    }

    public function resort()
    {
    }

    public function lock()
    {
    }


}