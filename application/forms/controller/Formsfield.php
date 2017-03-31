<?php
namespace app\forms\controller;

class Formsfield extends \app\admin\controller\Common
{

    public function add()
    {
        if (request()->isGet()) {
            $this->fetchform();
        } elseif (request()->isPost()) {
            $this->ebadd(['validate_scene' => 'add']);
        }
    }

    public function edit()
    {
        if (request()->isGet()) {
            $m = \app\forms\model\Formsfield::get(input('id'));
            $this->fetchform($m);
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