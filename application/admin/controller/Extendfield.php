<?php
namespace app\admin\controller;
class Extendfield extends \app\admin\controller\Common
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
            $m = \app\admin\model\Extendfield::get(input('id'));
            if (input('__type') == 'config') {
                $this->fetchform($m, array('formname' => $m['type']));
            } else {
                $this->fetchform($m);
            }
        } elseif (request()->isPost()) {
            if (input('group')) {
                $this->ebedit(['validate_scene' => 'edit']);
            } else {
                $this->ebedit(['validate_scene' => 'config']);
            }
        }
    }

    public function delete()
    {
        if (request()->isPost()) {
            $this->ebdelete();
        }
    }
}