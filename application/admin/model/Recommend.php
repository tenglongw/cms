<?php
namespace app\admin\model;

use think\Model;

class Recommend extends Model
{

    protected $pk = 'id';
    protected $field = ['id', 'category_id', 'title', 'thumb', 'description', 'ebcms_url', 'push_url', 'ext', 'model', 'content_id', 'update_time', 'create_time', 'sort', 'status', 'locked', 'color', 'size', 'bold','ext'];
    protected $type = [
        'ext' => 'json',
    ];

    public function Recommendcate()
    {
        return $this->belongsTo('Recommendcate', 'category_id');
    }

    // 获取样式
    public function getStyleAttr($value, $data)
    {
        $str = '';
        if ($data['color']) {
            $str .= 'color:' . $data['color'] . ';';
        }
        if ($data['bold']) {
            $str .= 'font-weight:' . $data['bold'] . ';';
        }
        if ($data['size']) {
            $str .= 'font-size:' . $data['size'] . 'px;';
        }
        return $str;
    }

    // 获取链接
    public function getUrlAttr($value, $data)
    {
        if (!$data['ebcms_url']) {
            if ($data['push_url']) {
                return $data['push_url'];
            }
            if ($data['model'] && $data['content_id']) {
                $content = \think\Loader::model($data['model'])->find($data['content_id']);
                $url = $content['url'];
                $this->where(['id' => $data['id']])->setField('push_url', $url);
                return $url;
            }
            return '';
        } else {
            if (0 === strpos($data['ebcms_url'], 'http')) {
                return htmlspecialchars_decode($data['ebcms_url']);
            } else {
                return url(htmlspecialchars_decode($data['ebcms_url']));
            }
        }
    }

}