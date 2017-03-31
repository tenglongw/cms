<?php
namespace app\admin\controller;
class Navcate extends \app\admin\controller\Common
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
            $config = [
                'relation' => [
                    'nav' => [
                        'type' => 'hasmany',
                    ],
                ],
            ];
            $this->ebdelete($config);
        }
    }
}