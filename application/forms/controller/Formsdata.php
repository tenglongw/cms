<?php
namespace app\forms\controller;

class Formsdata extends \app\admin\controller\Common
{

    public function index()
    {
        $this->success('', '', $this->fetch());
    }

    public function delete()
    {
        if (request()->isPost()) {
            $this->ebdelete();
        }
    }
}