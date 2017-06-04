<?php
namespace app\admin\controller;
class Recommendcate extends \app\admin\controller\Common
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
        $this->ebedit();
    }

    public function delete()
    {
        if (request()->isPost()) {
            $config = [
                'relation' => [
                    'recommend' => [
                        'type' => 'hasmany',
                    ],
                ],
            ];
            $this->ebdelete($config);
        }
    }

}