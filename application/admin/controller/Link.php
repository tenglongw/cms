<?php
namespace app\admin\controller;
class Link extends \app\admin\controller\Common
{

    public function index()
    {
        if (request()->isGet()) {
            $view = new \think\View();
            $this->success('', '', $view->fetch());
        }
    }

    public function add()
    {
        if (request()->isGet()) {
            $this->fetchform();
        } elseif (request()->isPost()) {
            $this->ebadd();
        }
    }

    public function edit()
    {
        $this->ebedit();
    }

    public function delete()
    {
        if (request()->isPost()) {
            $this->ebdelete();
        }
    }

}