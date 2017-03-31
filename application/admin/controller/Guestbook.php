<?php
namespace app\admin\controller;
class Guestbook extends \app\admin\controller\Common
{

    public function index()
    {
        $this->success('', '', $this->fetch());
    }

    public function edit()
    {
        if (request()->isGet()) {
            $this->ebedit();
        } elseif (request()->isPost()) {
            $config = [
                'allowfield' => ['content'],
            ];
            $this->ebedit($config);
        }
    }

    public function reply()
    {
        if (request()->isGet()) {
            $this->ebedit();
        } elseif (request()->isPost()) {
            $config = [
                'allowfield' => ['reply'],
            ];
            $this->ebedit($config);
        }
    }

    public function delete()
    {
        if (request()->isPost()) {
            $this->ebdelete();
        }
    }

}