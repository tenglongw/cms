<?php if (!defined('THINK_PATH')) exit(); /*a:1:{s:63:"E:\workspace-php\l7cms/application/admin\view\tongji\type1.html";i:1491451827;}*/ ?>
<?php $namespace = ns(); ?>
<div class="box" id="<?php echo $namespace; ?>_box"></div>
<script>
    Namespace.register("EBCMS.<?php echo $namespace; ?>");
    $(function(){
        EBCMS.<?php echo $namespace; ?>.queryParams = {
            page:1,
            rows:20,
            order:{
                'tongji.id':'desc',
            },
            model:'admin/tongji',
            times:'jinri',
            with:'user',
        };
        EBCMS.<?php echo $namespace; ?>.refresh = function refresh(p){
            if (p) {
                $.each(p, function(index, val) {
                    if (typeof val == 'object') {
                        EBCMS.<?php echo $namespace; ?>.queryParams[index] = $.extend(EBCMS.<?php echo $namespace; ?>.queryParams[index], p[index]);
                        delete p[index];
                    };
                });
                $.extend(EBCMS.<?php echo $namespace; ?>.queryParams, p);
            };
            EBCMS.CORE.api({
                queryParams:EBCMS.<?php echo $namespace; ?>.queryParams,
                tpl:'<?php echo $namespace; ?>-table',
                target:'#<?php echo $namespace; ?>_table',
                compileAfter:function(p){
                    EBCMS.FN.renderPage({
                        namespace:'<?php echo $namespace; ?>',
                        total:p.data.total,
                    });
                    EBCMS.FN.renderFilter({
                        namespace:'<?php echo $namespace; ?>',
                        filter:{
                            search:{
                                field:'tongji.title|tongji.url|tongji.user_id|tongji.ip',
                                value:''
                            },
                            order:{
                                filters:{'tongji.id':'id'}
                            },
                            rows:true,
                        }
                    });
                },
            });
        };

        EBCMS.<?php echo $namespace; ?>.changeuser = function(user_id){
            EBCMS.<?php echo $namespace; ?>.queryParams.page=1;
            EBCMS.<?php echo $namespace; ?>.queryParams.where={
                'tongji.user_id':['eq',user_id],
            };
            EBCMS.<?php echo $namespace; ?>.refresh();
        };

        EBCMS.<?php echo $namespace; ?>.changeurl = function(url){
            EBCMS.<?php echo $namespace; ?>.queryParams.page=1;
            EBCMS.<?php echo $namespace; ?>.queryParams.where={
                'tongji.url':['eq',url],
            };
            EBCMS.<?php echo $namespace; ?>.refresh();
        };

        EBCMS.<?php echo $namespace; ?>.changeip = function(ip){
            EBCMS.<?php echo $namespace; ?>.queryParams.page=1;
            EBCMS.<?php echo $namespace; ?>.queryParams.where={
                'tongji.ip':['eq',ip],
            };
            EBCMS.<?php echo $namespace; ?>.refresh();
        };

        EBCMS.<?php echo $namespace; ?>.delete = function(type){
            EBCMS.CORE.submit({
                url:'<?php echo url('admin/tongji/delete'); ?>',
                queryParams:{
                    type:type,
                },
                success:function(res){
                    if (res.code) {
                        EBCMS.<?php echo $namespace; ?>.refresh();
                    }else{
                        EBCMS.MSG.alert(res.msg);
                    }
                }
            });
        };
        EBCMS.<?php echo $namespace; ?>.changetime = function(times,dom){
            if (dom) {
                $(dom).addClass('active').siblings().removeClass('active');
            };
            EBCMS.<?php echo $namespace; ?>.queryParams.page = 1;
            EBCMS.<?php echo $namespace; ?>.refresh({
                times:times,
            });
        };
        EBCMS.CORE.compile({
            tpl:'<?php echo $namespace; ?>-box',
            target:'#<?php echo $namespace; ?>_box',
            compileAfter:function(){
                EBCMS.<?php echo $namespace; ?>.refresh();
            }
        });
    });
</script>

<script id="<?php echo $namespace; ?>-box" type="text/html">
    <div class="header">
        <div class="header-title" onclick="EBCMS.CORE.changemain('<?php echo url('admin/tongji/index'); ?>');">访问管理</div>
        <div class="header-title" onclick="EBCMS.CORE.changemain('<?php echo url('admin/tongji/index?type=2'); ?>');">页面统计</div>
        <div id="<?php echo $namespace; ?>_filter" class="footer-page"></div>
        <div class="btn-group">
            <button class="btn btn-primary" onclick="EBCMS.CORE.getconfig('<?php echo eb_encrypt('name|tongji'); ?>');">设置</button>
            <button class="btn btn-primary" onclick="delete EBCMS.<?php echo $namespace; ?>.queryParams.where;EBCMS.<?php echo $namespace; ?>.refresh();">全部</button>
        </div>
 		<div class="btn-group">
            <button class="btn btn-primary active" onclick="EBCMS.<?php echo $namespace; ?>.changetime('jinri',this);">今日统计</button>
            <button class="btn btn-primary" onclick="EBCMS.<?php echo $namespace; ?>.changetime('zuori',this);">昨日统计</button>
            <button class="btn btn-primary" onclick="EBCMS.<?php echo $namespace; ?>.changetime('benzhou',this);">本周统计</button>
            <button class="btn btn-primary" onclick="EBCMS.<?php echo $namespace; ?>.changetime('shangzhou',this);">上周统计</button>
            <button class="btn btn-primary" onclick="EBCMS.<?php echo $namespace; ?>.changetime('1',this);">过去一天</button>
            <button class="btn btn-primary" onclick="EBCMS.<?php echo $namespace; ?>.changetime('3',this);">过去三日</button>
            <button class="btn btn-primary" onclick="EBCMS.<?php echo $namespace; ?>.changetime('7',this);">过去一周</button>
            <button class="btn btn-primary" onclick="EBCMS.<?php echo $namespace; ?>.changetime('30',this);">过去一月</button>
            <button class="btn btn-primary" onclick="EBCMS.<?php echo $namespace; ?>.changetime('',this);">历史数据</button>
        </div>
    </div>
    <div class="body">
        <div id="<?php echo $namespace; ?>_table" class="box"></div>
    </div>
    <div class="footer">
        <div id="<?php echo $namespace; ?>_page" class="footer-page"></div>
        <div class="btn-group dropup">
          <button type="button" class="btn btn-primary">删除</button>
          <button type="button" class="btn btn-primary dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            <span class="caret"></span>
            <span class="sr-only">Toggle Dropdown</span>
          </button>
          <ul class="dropdown-menu">
            [[if access('<?php echo mca('delete'); ?>',0)]]
            <li><a href="###" onclick="EBCMS.<?php echo $namespace; ?>.delete('3');">三天之前</a></li>
            <li><a href="###" onclick="EBCMS.<?php echo $namespace; ?>.delete('7');">一周之前</a></li>
            <li><a href="###" onclick="EBCMS.<?php echo $namespace; ?>.delete('14');">两周之前</a></li>
            <li><a href="###" onclick="EBCMS.<?php echo $namespace; ?>.delete('21');">三周之前</a></li>
            <li><a href="###" onclick="EBCMS.<?php echo $namespace; ?>.delete('28');">四周之前</a></li>
            <li><a href="###" onclick="EBCMS.<?php echo $namespace; ?>.delete('60');">两个月之前</a></li>
            <li><a href="###" onclick="EBCMS.<?php echo $namespace; ?>.delete('90');">三个月之前</a></li>
            <li><a href="###" onclick="EBCMS.<?php echo $namespace; ?>.delete('120');">四个月之前</a></li>
            <li><a href="###" onclick="EBCMS.<?php echo $namespace; ?>.delete('150');">五个月之前</a></li>
            <li><a href="###" onclick="EBCMS.<?php echo $namespace; ?>.delete('180');">六个月之前</a></li>
            <li><a href="###" onclick="EBCMS.<?php echo $namespace; ?>.delete('365');">一年之前</a></li>
            [[/if]]
          </ul>
        </div>
    </div>
</script>

<script id="<?php echo $namespace; ?>-table" type="text/html">
    <table class="table table-bordered table-hover table-ebcms">
        <tbody>
            <tr>
                <th style="width:70px;">id</th>
                <th>用户</th>
                <th>链接</th>
                <th>ip</th>
                <th>时间</th>
                <th>标题</th>
            </tr>
            [[include '<?php echo $namespace; ?>-table-item' data]]
        </tbody>
    </table>
</script>
<script id="<?php echo $namespace; ?>-table-item" type="text/html">
    [[each rows as v n]]
        <tr>
            <td>[[v.id]]</td>
            <td><button class="btn btn-xs" onclick="EBCMS.<?php echo $namespace; ?>.changeuser('[[v.user_id]]');">[[if v.user_id==0]]游客[[else]][[v.user.nickname]][[/if]]</button></td>
            <td><button class="btn btn-xs" onclick="EBCMS.<?php echo $namespace; ?>.changeurl('[[v.url]]');">[[v.url]]</button></td>
            <td><button class="btn btn-xs" onclick="EBCMS.<?php echo $namespace; ?>.changeip('[[v.ip]]');">[[v.ip]]</button></td>
            <td>[[v.create_time]]</td>
            <td>[[v.title]]</td>
        </tr>
    [[/each]]
</script>