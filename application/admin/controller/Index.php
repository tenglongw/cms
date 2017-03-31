<?php
namespace app\admin\controller;
class Index extends \app\admin\controller\Common
{

    public function index()
    {
        if (request()->isGet()) {

            $this->view->nickname = 'thinkphp';
            if ($tpl = input('tpl')) {
                if (in_array($tpl, ['main'])) {
                    $this->success('', '', $this->fetch($tpl));
                }
            } else {
                return $this->fetch();
            }
        } elseif (request()->isPost()) {
            config('default_ajax_return', 'json');
            config('default_return_type', 'json');
            $api = input('api');
            $this->$api();
        }
    }

    // 清理缓存
    public function runtime()
    {
        if (request()->isPost()) {
            if ($type = input('type')) {
                switch ($type) {
                    case 'cache':
                        \think\Cache::clear();
                        break;
                    case 'tpl':
                        deldir(TEMP_PATH);
                        break;
                    case 'all':
                        deldir(RUNTIME_PATH);
                        break;

                    default:
                        # code...
                        break;
                }
            }
            $this->success('成功清理系统缓存！');
        }
    }

    // 修改自己的密码
    public function password()
    {
        if (request()->isGet()) {
            $this->fetchform();
        } elseif (request()->isPost()) {
            $oldpassword = input('oldpassword');
            $password = input('password');
            $passwordtwo = input('passwordtwo');
            if ($passwordtwo != $password) {
                $this->error('两次密码输入不一致');
            }
            $id = session('user_id');
            $m = \think\Db::name('user');
            $user = $m->find($id);
            if (crypt_pwd($oldpassword, $user['salt']) == $user['password']) {
                if (false !== $m->where('id', $id)->setField('password', crypt_pwd($password, $user['salt']))) {
                    $this->success('修改成功');
                } else {
                    $this->error($m->getDbError());
                }
            } else {
                $this->error('密码错误');
            }
        }
    }

    // webuploader上传
    public function upload()
    {
        config('default_return_type', 'json');
        $file = request()->file('file');
        $info = $file->move('./upload/image');
        if (false !== $info) {
            $this->success('上传成功！', '', [
                'pathname' => substr(str_replace('\\', '/', $info->getPath() . '/' . $info->getBasename()), strlen('./upload')),
                'name' => $info->getBasename()
            ]);
        } else {
            $this->error('上传失败！', '', $file->getError());
        }
    }

    // 编辑器上传
    public function ueditor()
    {
        config('default_return_type', 'json');
        $config = [
            'catcherPathFormat' => '/image/{yyyy}{mm}{dd}/{time}{rand:6}',
            'fileManagerListPath' => '/file/',
            'filePathFormat' => '/file',
            'imageManagerListPath' => '/image/',
            'imagePathFormat' => '/image',
            'scrawlPathFormat' => '/image/{yyyy}{mm}{dd}/{time}{rand:6}',
            'snapscreenPathFormat' => '/image',
            'videoPathFormat' => '/video',
        ];
        $config = array_merge($config, (array)\ebcms\Config::get('system.ueditor_upload'));
        $data = new \ebcms\Ueditor($config);
        return $data->output();
    }

    // 附件地址替换
    public function replaceattachbaseurl()
    {
        if (request()->isPost()) {
            $dbpre = \think\Config::get('database.prefix');
            \think\Db::execute('UPDATE ' . $dbpre . 'content_body SET `body`=replace(`body`, :fromstr, :tostr)', ['fromstr' => input('fromstr'), 'tostr' => input('tostr')]);
            $this->success('替换成功！');
        } elseif (request()->isGet()) {
            $this->fetchform();
        }
    }

}