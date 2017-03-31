<?php
namespace app\index\controller;
class Link extends \app\index\controller\Common
{

    public function apply()
    {
        if (!\ebcms\Config::get('link.apply_on')) {
            $this->error('系统已经关闭友情链接申请！', url('index/index/index'));
        }
        if (request()->isGet()) {

            // 位置
            \ebcms\Position::add(['title' => '申请友情链接', 'url' => url('index/link/apply')]);

            // seo
            $this->assign('seo', [
                'title' => '申请友情链接' . ' - ' . $this->seo['sitename'],
                'keywords' => '申请友情链接',
                'description' => '申请友情链接',
            ]);

            return $this->fetch();

        } elseif (request()->isPost()) {
            // 申请友情链接
            if (\ebcms\Config::get('link.apply_verify')) {
                // 验证验证码
                $verify = new \org\Verify([]);
                if (!$verify->check(input('verify'), 1)) {
                    $this->error('验证码错误！');
                }
            }

            $data = input();

            if (request()->has('logo')) {
                $file = request()->file('logo');
                $info = $file->move('./upload/image');
                $data['logo'] = substr(str_replace('\\', '/', $info->getPath() . '/' . $info->getBasename()), strlen('./upload'));
            }

            $data['group'] = '友情链接';

            $link = new \app\admin\model\Link();
            $link->allowField(['group', 'title', 'description', 'logo', 'url'])->save($data);
            $this->success('提交成功，请等待审核！', url('index/index/index'));
        }

    }
}