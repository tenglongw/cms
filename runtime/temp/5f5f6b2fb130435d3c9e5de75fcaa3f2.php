<?php if (!defined('THINK_PATH')) exit(); /*a:1:{s:63:"E:\workspace-php\l7cms/application/admin\view\tongji\type2.html";i:1489045778;}*/ ?>
<?php $namespace = ns(); ?>
<div class="box" id="<?php echo $namespace; ?>type2_box"></div>
<script>
    Namespace.register("EBCMS.<?php echo $namespace; ?>type2");
    $(function(){
        EBCMS.<?php echo $namespace; ?>type2.queryParams = {
            page:1,
            rows:20,
        };
        EBCMS.<?php echo $namespace; ?>type2.refresh = function refresh(p){
            if (p) {
                $.each(p, function(index, val) {
                    if (typeof val == 'object') {
                        EBCMS.<?php echo $namespace; ?>type2.queryParams[index] = $.extend(EBCMS.<?php echo $namespace; ?>type2.queryParams[index], p[index]);
                        delete p[index];
                    };
                });
                $.extend(EBCMS.<?php echo $namespace; ?>type2.queryParams, p);
            };
            EBCMS.CORE.load({
                url:'<?php echo url('admin/tongji/index'); ?>',
                queryParams:EBCMS.<?php echo $namespace; ?>type2.queryParams,
                tpl:'<?php echo $namespace; ?>type2-table',
                target:'#<?php echo $namespace; ?>type2_table',
                compileAfter:function(p){
                    EBCMS.FN.renderPage({
                        namespace:'<?php echo $namespace; ?>type2',
                        total:-1,
                    });
                    EBCMS.FN.renderFilter({
                        namespace:'<?php echo $namespace; ?>type2',
                        filter:{
                            rows:true,
                        }
                    });
                },
            });
        };

        EBCMS.<?php echo $namespace; ?>type2.changetime = function(times,dom){
            if (dom) {
                $(dom).addClass('active').siblings().removeClass('active');
            };
            EBCMS.<?php echo $namespace; ?>type2.queryParams.page = 1;
            EBCMS.<?php echo $namespace; ?>type2.refresh({
                times:times,
            });
        };

        EBCMS.CORE.compile({
            tpl:'<?php echo $namespace; ?>type2-box',
            target:'#<?php echo $namespace; ?>type2_box',
            compileAfter:function(){
                EBCMS.<?php echo $namespace; ?>type2.changetime('jinri');
            }
        });
    });
</script>

<script id="<?php echo $namespace; ?>type2-box" type="text/html">
    <div class="header">
        <div class="header-title" onclick="EBCMS.CORE.changemain('<?php echo url('admin/tongji/index'); ?>');">访问管理</div>
        <div class="header-title" onclick="EBCMS.CORE.changemain('<?php echo url('admin/tongji/index?type=2'); ?>');">页面统计</div>
        <div id="<?php echo $namespace; ?>type2_filter" class="footer-page"></div>
        <div class="btn-group">
            <button class="btn btn-primary" onclick="EBCMS.CORE.getconfig('<?php echo eb_encrypt('name|tongji'); ?>');">设置</button>
        </div>
        <div class="btn-group">
            <button class="btn btn-primary active" onclick="EBCMS.<?php echo $namespace; ?>type2.changetime('jinri',this);">今日统计</button>
            <button class="btn btn-primary" onclick="EBCMS.<?php echo $namespace; ?>type2.changetime('zuori',this);">昨日统计</button>
            <button class="btn btn-primary" onclick="EBCMS.<?php echo $namespace; ?>type2.changetime('benzhou',this);">本周统计</button>
            <button class="btn btn-primary" onclick="EBCMS.<?php echo $namespace; ?>type2.changetime('shangzhou',this);">上周统计</button>
            <button class="btn btn-primary" onclick="EBCMS.<?php echo $namespace; ?>type2.changetime('1',this);">过去一天</button>
            <button class="btn btn-primary" onclick="EBCMS.<?php echo $namespace; ?>type2.changetime('3',this);">过去三日</button>
            <button class="btn btn-primary" onclick="EBCMS.<?php echo $namespace; ?>type2.changetime('7',this);">过去一周</button>
            <button class="btn btn-primary" onclick="EBCMS.<?php echo $namespace; ?>type2.changetime('30',this);">过去一月</button>
            <button class="btn btn-primary" onclick="EBCMS.<?php echo $namespace; ?>type2.changetime('',this);">历史数据</button>
        </div>
    </div>
    <div class="body">
        <div id="<?php echo $namespace; ?>type2_table" class="box"></div>
    </div>
    <div class="footer">
        <div id="<?php echo $namespace; ?>type2_page" class="footer-page"></div>
    </div>
</script>

<script id="<?php echo $namespace; ?>type2-table" type="text/html">
    <table class="table table-bordered table-hover table-ebcms">
 			[[include '<?php echo $namespace; ?>type2-table-total' data]] 
        <tbody>
            <tr>
                <th>页面</th>
                <th>访问次数</th>
                <th>标题</th>
            </tr>
            [[include '<?php echo $namespace; ?>type2-table-item' data]]
        </tbody>
    </table>
</script>

<script id="<?php echo $namespace; ?>type2-table-item" type="text/html">
    [[each rows.data as v n]]
        <tr>
            <td>[[v.url]]</td>
            <td>[[v.num]]</td>
            <td>[[v.title]]</td>
        </tr>
    [[/each]]
</script>
<script id="<?php echo $namespace; ?>type2-table-total" type="text/html">
   
        <tr>
 			<td>总数</td><td>[[ rows.total_num]]</td>
        </tr>
</script>