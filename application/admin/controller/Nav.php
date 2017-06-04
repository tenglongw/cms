<?php
namespace app\admin\controller;
class Nav extends \app\admin\controller\Common
{

    public function index()
    {
        if (request()->isGet()) {
            $this->success('', '', $this->fetch());
        }
    }

    public function add()
    {
        if (request()->isGet()) {
            $cate = \think\Db::name('navcate')->find(input('category_id'));
            $this->fetchform([], ['ext_id' => $cate['extend_id']]);
        } elseif (request()->isPost()) {
            $this->ebadd();
        }
    }

    public function edit()
    {
        if (request()->isGet()) {
            $data = \app\admin\model\Nav::with('navcate')->find(input('id'));
            $this->fetchform($data, ['ext_id' => $data['navcate']['extend_id']]);
        } elseif (request()->isPost()) {
            $this->ebedit();
        }
    }

    public function delete()
    {
        $this->ebdelete();
    }
}