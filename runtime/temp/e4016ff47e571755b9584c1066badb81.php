<?php if (!defined('THINK_PATH')) exit(); /*a:1:{s:61:"E:\workspace-php\l7cms/application/admin\view\index\main.html";i:1489045869;}*/ ?>
<?php 
    $namespace = ns();
    $ver = include CONF_PATH.'version.php';
 ?>
<script>
    $(function() {
        EBCMS.<?php echo $namespace; ?>.tongji = function(){
            $('#<?php echo $namespace; ?>_tongjitable').html('');
            EBCMS.CORE.load({
                url:'<?php echo url('admin/tongji/index'); ?>',
                queryParams:{
                    rows:10,
                    times:'jinri',
                },
                alert:false,
                tpl:'<?php echo $namespace; ?>-tongjitable',
                target:'#<?php echo $namespace; ?>_tongjitable',
            });
        };
        EBCMS.<?php echo $namespace; ?>.tongji();
    });
</script>
<div style="height:15px;"></div>
<div class="container-fluid">
    <div class="row">
        <div class="col-md-6">
            <table class="viewtable">
                <caption>系统提醒</caption>
                <tbody>
                    <tr>
                        <th>调试模式</th>
                        <td>网站正式上线后，建议关闭调试模式，关闭trace，禁止错误输出</td>
                    </tr>
                    <tr>
                        <th>日志记录</th>
                        <td>网站正式上线后，建议开启后台用户的操作历史记录</td>
                    </tr>
                    <tr>
                        <th>数据备份</th>
                        <td>网站正式上线后，建议定期对系统重要数据进行备份</td>
                    </tr>
                    <tr>
                        <th>文件安全</th>
                        <td>网站正式上线后，建议只开启runtime、uploads、backup的读写权限，其他文件和目录设置为只读</td>
                    </tr>
                    <tr>
                        <th>权限安全</th>
                        <td>网站正式上线后，建议对不同角色后台用户分配合理权限，特别是核心基础功能权限以及删除操作权限的分配要尤为慎重！</td>
                    </tr>
                </tbody>
            </table>
            <div>
                <div id="<?php echo $namespace; ?>_tongjitable"></div>
            </div>
            <script id="<?php echo $namespace; ?>-tongjitable" type="text/html">
                <table class="viewtable">
                    <caption>
                        <div class="btn-group pull-right">
                            <button class="btn btn-xs btn-primary" onclick="EBCMS.<?php echo $namespace; ?>.tongji();">刷新</button>
                            <button class="btn btn-xs btn-primary" onclick="EBCMS.CORE.changemain('<?php echo url('admin/tongji/index'); ?>');">访问统计</button>
                            <button class="btn btn-xs btn-primary" onclick="EBCMS.CORE.changemain('<?php echo url('admin/tongji/index?type=2'); ?>');">页面统计</button>
                        </div>
                        今日统计
                    </caption>
                    <tbody>
                    <tr>
                        <td>地址</td>
                        <td style="width:160px;">次数</td>
                    </tr>
                    [[each rows.data as v n]]
                        <tr>
                            <td>[[v.url]]</td>
                            <th>[[v.num]]</th>
                        </tr>
                    [[/each]]
                    </tbody>
                </table>
            </script>
        </div>
        <div class="col-md-6">
            <!-- <table class="viewtable">
                <caption>产品团队</caption>
                <tbody>
                    <tr>
                        <th>总策划</th>
                        <td>荷塘月色</td>
                    </tr>
                    <tr>
                        <th>产品设计</th>
                        <td>荷塘月色</td>
                    </tr>
                    <tr>
                        <th>研发团队</th>
                        <td>荷塘月色、叮当苗儿、鱼摆摆、troen2、闲心等</td>
                    </tr>
                    <tr>
                        <th>官方网址</th>
                        <td><a href="http://www.ebcms.com" target="_blank">EBCMS官方网站</a></td>
                    </tr>
                    <tr>
                        <th>QQ群</th>
                        <td>457911526(<span style="color:red;">免费下载</span>)</td>
                    </tr>
                    <tr>
                        <th>欢迎使用</th>
                        <td>感谢您选择四川易贝网络科技有限公司开发的全新内容管理系统--EBCMS媒体版,EBCMS是基于ThinkPHP开发的一套内容管理系统。我们的宗旨是给客户提供一套持久更新、功能全面、操作便捷的供大众使用的内容管理系统，我们希望我们的产品能够让你从繁琐的、复杂的、低效的网站建设和维护中解脱出来！</td>
                    </tr>
                </tbody>
            </table> -->
            <table class="viewtable">
                <caption>系统信息</caption>
                <tbody>
                    <tr>
                        <th>系统版本</th>
                        <td>CMS v<?php echo (isset($ver['version']) && ($ver['version'] !== '')?$ver['version']:'5.5.0'); ?></td>
                    </tr>
                    <tr>
                        <th>上传限制</th>
                        <td><?php echo get_cfg_var('upload_max_filesize'); ?></td>
                    </tr>
                    <tr>
                        <th>脚本超时</th>
                        <td><?php echo get_cfg_var('max_execution_time'); ?>秒</td>
                    </tr>
                    <tr>
                        <th>服务器系统</th>
                        <td><?php echo php_uname(); ?></td>
                    </tr>
                    <tr>
                        <th>运行环境</th>
                        <td><?php echo $_SERVER['SERVER_SOFTWARE']; ?></td>
                    </tr>
                </tbody>
            </table>
            <!-- <table class="viewtable">
                <caption>系统更新</caption>
                <tbody>
                    <tr>
                        <td colspan="2" style="padding:0px;height: 230px;line-height: 0px;"><iframe src="http://www.ebcms.com/v5/log.html?from=<?php echo $_SERVER['HTTP_HOST']; ?>" style="width:100%;height:100%;" runat="server" frameborder="no" border="0" marginwidth="0" marginheight="0" allowtransparency="yes"></iframe></td>
                    </tr>
                </tbody>
            </table> -->
        </div>
    </div>
</div>