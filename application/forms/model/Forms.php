<?php
namespace app\forms\model;

use think\Model;

class Forms extends Model
{

    protected $name = 'forms';
    protected $pk = 'id';
    protected $field = ['id', 'title', 'name', 'remark', 'sort', 'update_time', 'create_time', 'status', 'locked', 'verify'];

    public function formsfield()
    {
        return $this->hasMany('\app\forms\model\Formsfield', 'forms_id', 'id');
    }

    public function formsdata()
    {
        return $this->hasMany('\app\forms\model\Formsdata', 'forms_id', 'id');
    }

    public function getCountAttr($value, $data)
    {
        static $res;
        if (isset($res[$data['id']])) {
            return $res[$data['id']];
        }
        $where = [
            'forms_id' => ['eq', $data['id']],
            'status' => ['eq', 1],
        ];
        return $res[$data['id']] = \app\forms\model\Formsdata::where($where)->count();
    }

    public function getActionAttr($value, $data)
    {
        return url('index/forms/index');
    }

    public function getVerifyUrlAttr($value, $data)
    {
        if ($data['verify']) {
            return url('index/api/verify', ['id' => 9999 + $data['id']]);
        } else {
            return '';
        }
    }

    public function getFieldsAttr($value, $data)
    {
        static $res = [];
        if (isset($res[$data['id']])) {
            return $res[$data['id']];
        } else {
            if ($x = $this->formsfield()->where(['status' => 1])->order('sort desc,id asc')->select()) {
                $res[$data['id']] = $x;
                return $res[$data['id']];
            }
        }
        return false;
    }

    public function getFormAttr($value, $data)
    {
        $formaction = url('index/forms/index');
        $forms = $this->formsfield()->where(['status' => 1])->order('sort desc,id asc')->select();
        $str = '<form class="form-horizontal" id="forms_' . $data['id'] . '" onsubmit="return _EBCMS_' . $data['id'] . '.formssubmit();" action="' . $formaction . '">';
        foreach ($forms as $key => $value) {
            $str .= '<div class="form-group">';
            $str .= '<label for="forms_field_' . $value['id'] . '" class="col-sm-2 control-label">' . $value['title'] . '</label>';
            $str .= '<div class="col-sm-10">';
            switch ($value['type']) {
                case 'text':
                    $str .= <<<str
                        <input type="text" class="form-control" name="data[{$value['title']}]" id="forms_field_{$value['id']}" placeholder="">
str;
                    break;

                case 'textarea':
                    $str .= <<<str
                        <textarea class="form-control" name="data[{$value['title']}]" id="forms_field_{$value['id']}" rows="3"></textarea>
str;
                    break;

                case 'radio':
                    $conf = explode("\r\n", $value['config']);
                    foreach ($conf as $k => $v) {
                        $str .= <<<str
                        <label class="radio-inline">
                        <input type="radio" name="data[{$value['title']}]" value="{$v}"> {$v}
                        </label>
str;
                    }
                    break;

                case 'checkbox':
                    $conf = explode("\r\n", $value['config']);
                    foreach ($conf as $k => $v) {
                        $str .= <<<str
                        <label class="checkbox-inline">
                        <input type="checkbox" name="data[{$value['title']}][]" value="{$v}"> {$v}
                        </label>
str;
                    }
                    break;

                default:
                    # code...
                    break;
            }
            if ($value['remark']) {
                $str .= '<span class="help-block">' . $value['remark'] . '</span>';
            }
            $str .= '</div>';
            $str .= '</div>';
        }
        if ($data['verify']) {
            $verifyurl = url('index/api/verify', ['id' => 9999 + $data['id']]);
            $verifyid = 'forms_verify_' . $data['id'];
            $str .= <<<str
            <div class="form-group">
                <label for="{$verifyid}" class="col-sm-2 control-label">
                    验证码
                </label>
                <div class="col-sm-10" id="{$verifyid}_container">
                    <input type="text" name="verify" class="form-control" id="{$verifyid}" placeholder="请输入验证码">
                    <script>
                        $(function() {
                            $('#{$verifyid}').focus(function(event) {
                                if (!$('#{$verifyid}_img').length) {
                                    $('#{$verifyid}').before('<img class="img-rounded img-verify" width="200" id="{$verifyid}_img" onclick="EBCMS.FN.change_verify(\'#{$verifyid}_img\');" src="{$verifyurl}" alt="验证码" title="点击更换验证码">')
                                }
                                $('#{$verifyid}_img').css({
                                    top: $("#{$verifyid}").position().top-$('#{$verifyid}_img').height()-2,
                                });
                                $('#{$verifyid}_img').show();
                            });
                            $('#{$verifyid}_container').hover(function() {
                                $('#{$verifyid}_img').show();
                            }, function() {
                                $('#{$verifyid}_img').hide();
                            });
                        });
                    </script>
                </div>
            </div>
str;
        }

        $str .= <<<str
            <input type="hidden" name="forms_id" value="{$data['id']}">
str;

        $str .= <<<str
            <div class="form-group">
                <div class="col-sm-offset-2 col-sm-10">
                    <button type="submit" class="btn btn-primary" >提交</button>
                </div>
            </div>
str;

        $str .= '</form>';
        $str .= <<<str
            <script>
                var _EBCMS_{$data['id']} = {};
                $(function(){
                    _EBCMS_{$data['id']}.formssubmit = function(){
                        $.ajax({
                            url: '{$formaction}',
                            type: 'POST',
                            dataType: 'json',
                            data: $('#forms_{$data['id']}').serialize(),
                            success:function(data){
                                alert(data.msg);
                                if (data.code) {
                                    self.location=data.url;
                                }else{
                                    EBCMS.FN.change_verify('#{$verifyid}_img');
                                }
                            }
                        });
                        return false;
                    };
                });
            </script>
str;
        return $str;
    }

}