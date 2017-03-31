<?php
namespace app\admin\controller;
class Template extends \app\admin\controller\Common
{

    public function _initialize()
    {
        parent::_initialize();
        if (true !== \think\Config::get('tpl.edit_on')) {
            $this->error('不允许后台编辑模板！');
        }
    }

    // 所有模板显示
    public function index()
    {
        if (request()->isPost()) {
            $dir = eb_decrypt(input('dir'));
            if (!is_writable($dir)) {
                $this->error('目录不存在或不可写，请检查后重试！');
            }
            $res = array(
                'rows' => file_id_dir(eb_decrypt(input('dir'))),
            );
            $this->success('', '', $res);
        } elseif (request()->isGet()) {
            $this->success('', '', $this->fetch());
        }
    }

    // 添加一个该目录下的新模板
    public function add()
    {
        if (request()->isGet()) {
            $title = eb_decrypt(input('path'));
            if (!is_writeable($title)) {
                $this->error('目录不存在或不可写，请检查后重试！');
            }
            $this->fetchform(array('title' => $title));
        } elseif (request()->isPost()) {
            $title = eb_decrypt(input('path'));
            if (!is_writeable($title)) {
                $this->error('目录不存在或不可写，请检查后重试！');
            }
            if (input('title') != $title) {
                $this->error('非法操作！');
            }
            $name = input('name');
            $filename = $title . '/' . $name;
            if (!in_array(pathinfo($filename, PATHINFO_EXTENSION), \think\Config::get('tpl.edit_ext'))) {
                $this->error('对不起，不允许添加该类型的文件');
            }
            if (is_file($filename)) {
                $this->error('对不起，文件已经存在!');
            }
            $content = htmlspecialchars_decode(input('content'));
            if (file_put_contents($filename, $content)) {
                $this->success('保存成功');
            } else {
                $this->error('保存失败');
            }
        }
    }

    // 更新一个模板
    public function edit()
    {
        if (request()->isGet()) {
            $title = eb_decrypt(input('filename'));
            if (!is_writable($title)) {
                $this->error('文件不存在或不可写，请检查后重试！');
            }
            $result = array(
                'title' => $title,
                'content' => htmlspecialchars(file_get_contents($title)),
            );
            $this->assign($result);
            $this->fetchform($result);
        } elseif (request()->isPost()) {
            $title = eb_decrypt(input('filename'));
            if (!is_writeable($title)) {
                $this->error('文件不可写，请检查后重试！');
            }
            if (input('title') != $title) {
                $this->error('非法操作！');
            }
            if (!in_array(pathinfo($title, PATHINFO_EXTENSION), \think\Config::get('tpl.edit_ext'))) {
                $this->error('对不起，不允许添加该类型的文件');
            }
            if (!is_file($title)) {
                $this->error('对不起，文件不存在!');
            }
            $content = htmlspecialchars_decode(input('content'));
            if (file_put_contents($title, $content)) {
                $this->success('保存成功');
            } else {
                $this->error('保存失败');
            }
        }
    }

    // 删除一个模板
    public function delete()
    {
        if (request()->isPost()) {
            // 取得目标文件的详细地址
            $filename = eb_decrypt(input('filename'));
            if (!in_array(pathinfo($filename, PATHINFO_EXTENSION), \think\Config::get('tpl.edit_ext'))) {
                $this->error('对不起，不允许删除该类型的文件！');
            }
            if (unlink($filename)) {
                $this->success('删除成功！');
            } else {
                $this->error('删除失败！');
            }
        }
    }
}