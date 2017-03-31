<?php
namespace app\bulletin\controller;
class Bulletin extends \app\admin\controller\Common
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
        if (request()->isGet()) {
            $data = \app\bulletin\model\Bulletin::get(input('id'));
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

    // 改变样式
    public function style()
    {
        if (request()->isPost()) {

            $config = [
                'allowfield' => ['bold', 'size', 'color'],
                'validate_scene' => 'style',
            ];
            $this->ebedit($config);
        }
    }

}