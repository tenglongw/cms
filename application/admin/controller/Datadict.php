<?php
namespace app\admin\controller;
class Datadict extends \app\admin\controller\Common
{

    public function index()
    {
        $this->success('', '', $this->fetch());
    }

    public function add()
    {
        if (request()->isGet()) {
            $cate = \think\Db::name('datadictcate')->find(input('category_id'));
            $this->fetchform([], ['ext_id' => $cate['extend_id']]);
        } elseif (request()->isPost()) {
            $this->ebadd();
        }
    }

    public function edit()
    {
        if (request()->isGet()) {
            $data = \app\admin\model\Datadict::with('datadictcate')->find(input('id'));
            $this->fetchform($data, ['ext_id' => $data['datadictcate']['extend_id']]);
        } elseif (request()->isPost()) {
            $this->ebedit();
        }
    }

    public function delete()
    {
        if (request()->isPost()) {
            $this->ebdelete();
        }
    }

}