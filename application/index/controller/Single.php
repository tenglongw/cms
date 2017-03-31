<?php
namespace app\index\controller;
class Single extends \app\index\controller\Common
{

    public function index($id)
    {
        if (request()->isGet()) {
            $data = \app\admin\model\Single::get($id);

            if (!$data) {
                $this->error('内容不存在！');
            }
            if (1 != $data['status']) {
                $this->error('内容未审核！');
            }

            if ($data['ebcms_url']) {
                $this->redirect(htmlspecialchars_decode($data['ebcms_url']), 302);
            }

            // 位置
            \ebcms\Position::add(['title' => $data['title'], 'url' => $data['url']]);

            // seo设置
            $this->assign('seo', [
                'title' => $data['metatitle'] . ' - ' . $this->seo['sitename'],
                'keywords' => $data['keywords'],
                'description' => $data['description'],
            ]);

            $ext = $data['ext'] ?: [];
            if (isset($ext['__config__'])) {
                unset($ext['__config__']);
            }
            $data->setAttr('ext', $ext);

            $this->assign('single', $data);
            return $this->fetch($data['tpl']);
        }
    }
}