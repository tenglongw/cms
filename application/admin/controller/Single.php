<?php
namespace app\admin\controller;
class Single extends \app\admin\controller\Common
{

    public function index()
    {
        $this->success('', '', $this->fetch());
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
        if (request()->isGet()) {
            $data = \app\admin\model\Single::get(input('id'));
            $res = $data->toArray();
            if ($res['shorttitle'] == $res['title']) {
                $res['shorttitle'] = '';
            }
            if ($res['metatitle'] == $res['title']) {
                $res['metatitle'] = '';
            }
            $this->fetchform($res);
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