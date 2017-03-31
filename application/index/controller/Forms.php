<?php
namespace app\index\controller;
class Forms extends \app\index\controller\Common
{

    public function index()
    {
        if (request()->isPost()) {
            $forms_id = input('forms_id');
            $forms = \app\forms\model\Forms::get($forms_id);
            if ($forms && $forms['status']) {
                // 校验验证码
                if ($forms['verify']) {
                    $verify = new \org\Verify([]);
                    if (!$verify->check(input('verify'), 9999 + $forms['id'])) {
                        $this->error('验证码错误！');
                    }
                }
                // 校验提交字段
                $fields = $forms->formsfield()->where(['status' => 1])->column('title');
                $data = input('data/a');
                if (array_diff(array_values($fields), array_keys($data)) || array_diff(array_keys($data), array_values($fields))) {
                    $this->error('校验失败！');
                }
                // 写入数据
                $formsdata = new \app\forms\model\Formsdata();
                $formsdata->allowField(true)->save(input());
                $this->success('提交成功！');
            }
            $this->error('提交失败！');
        }
    }

}