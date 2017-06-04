<?php
namespace app\forms\controller;

class Forms extends \app\admin\controller\Common
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
            $this->ebedit();
        } elseif (request()->isPost()) {
            $this->ebedit();
        }
    }

    public function delete()
    {
        if (request()->isPost()) {
            $config = [
                'model' => 'forms',
                'relation' => [
                    'formsfield' => [
                        'type' => 'hasmany',
                    ],
                    'formsdata' => [
                        'type' => 'hasmany',
                    ],
                ],
            ];
            $this->ebdelete($config);
        }
    }

    public function status()
    {
        $this->ebstatus();
    }

}