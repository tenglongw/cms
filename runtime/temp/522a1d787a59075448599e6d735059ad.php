<?php if (!defined('THINK_PATH')) exit(); /*a:3:{s:63:"E:\workspace-php\l7cms/application/admin\view\extend\index.html";i:1472111958;s:64:"E:\workspace-php\l7cms/application/admin\view\extend\extend.html";i:1472526088;s:69:"E:\workspace-php\l7cms/application/admin\view\extend\extendfield.html";i:1472526093;}*/ ?>
<?php $namespace=ns(); ?>
<div class="layout">
    <div class="layout-left" id="<?php echo $namespace; ?>_left" style="width: 40%;margin-right: -40%;">
        <div class="box" id="<?php echo $namespace; ?>_box"></div>
    </div>
    <div class="layout-rightbox">
        <div class="layout-right" id="<?php echo ns('extendfield'); ?>_left" style="height:100%;overflow:auto;margin-left: 40%;">
            <div class="box" id="<?php echo ns('extendfield'); ?>_box"></div>
        </div>
    </div>
</div>
<?php 
$namespace=ns();
 ?>
<script>
    Namespace.register("EBCMS.<?php echo $namespace; ?>");
    $(function(){
        EBCMS.<?php echo $namespace; ?>.queryParams = {
            order:{
                'sort':'desc',
            },
            model:'admin/extend',
            where:{
                <?php if('ebcms' != input('ebcms')): 
                    $groups = [
                        'content'   =>  '内容扩展',
                        'nav'   =>  '导航扩展',
                        'recommend'   =>  '推荐扩展',
                        'datadict'   =>  '字典扩展',
                    ];
                    $group = isset($groups[$group])?$groups[$group]:'';
                 ?>
                group:['eq','<?php echo $group; ?>']
                <?php endif; ?>
            }
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
                queryParams: EBCMS.<?php echo $namespace; ?>.queryParams,
                group:'group',
                tpl:'<?php echo $namespace; ?>-table',
                target:'#<?php echo $namespace; ?>_table',
                compileAfter:function(data){
                    $('#<?php echo $namespace; ?>_table').find('.input_sort').focus(function(){
                        EBCMS.<?php echo $namespace; ?>.sortvalue = $(this).val();
                    }).blur(function(){
                        var $this = $(this);
                        if ($this.val() != EBCMS.<?php echo $namespace; ?>.sortvalue) {
                            EBCMS.ACT.togglefield('<?php echo url('extend/resort'); ?>',$this.data('id'),$this.val(),'<?php echo $namespace; ?>','resort');
                        };
                    });
                    $('#<?php echo $namespace; ?>_table').find('tr').bind('click', function(event) {
                        $(this).addClass('warning').siblings('tr').removeClass('warning');
                    });
                    EBCMS.FN.renderFilter({
                        namespace:'<?php echo $namespace; ?>',
                        filter:{
                            search:{
                                field:'group|title|remark',
                                value:''
                            },
                        }
                    });
                },
            });
        };
        EBCMS.<?php echo $namespace; ?>.edit = function edit(id){
            EBCMS.CORE.get({
                url:'<?php echo url('extend/edit'); ?>',
                queryParams:{
                    id:id,
                },
                target:'#lgModal .modal-content',
            });
        };
        EBCMS.<?php echo $namespace; ?>.add = function add(){
            EBCMS.CORE.get({
                url:'<?php echo url('extend/add'); ?>',
                queryParams:{
                    group:'<?php echo $group; ?>',
                },
                target:'#lgModal .modal-content',
            });
        };
        EBCMS.<?php echo $namespace; ?>.change_extend = function change_extend(category_id){
            EBCMS.<?php echo $namespace; ?>.category_id = category_id;
            EBCMS.CORE.compile({
                tpl:'<?php echo ns('extendfield'); ?>-box',
                target:'#<?php echo ns('extendfield'); ?>_box',
                compileAfter:function(){
                    EBCMS.<?php echo ns('extendfield'); ?>.refresh({
                        where:{
                            category_id:['eq',category_id]
                        }
                    });
                }
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
        <div class="footer-page" id="<?php echo $namespace; ?>_filter"></div>
        <div class="header-title" onclick="EBCMS.<?php echo $namespace; ?>.refresh();">模型管理</div>
        <div class="btn-group">
            <button class="btn btn-primary" onclick="EBCMS.<?php echo $namespace; ?>.add();">添加</button>
        </div>
    </div>
    <div class="body" style="bottom:0px;">
        <div class="box" id="<?php echo $namespace; ?>_table"></div>
    </div>
</script>

<script id="<?php echo $namespace; ?>-table" type="text/html">
    <div class="table-responsive">
        <table class="table table-bordered table-hover table-ebcms">
            <tbody>
                <tr>
                    <!-- <th style="width:70px;">id</th> -->
                    <th style="width:200px;">操作</th>
                    <th>名称</th>
                    <th>排序</th>
                    <th style="width:50px;">管理</th>
                </tr>
                [[each groups as data group]]
                    <tr>
                        <th colspan="4">[[group]]</th>
                    </tr>
                    [[include '<?php echo $namespace; ?>-table-item' data]]
                [[/each]]
            </tbody>
        </table>
    </div>
</script>

<script id="<?php echo $namespace; ?>-table-item" type="text/html">
    [[each rows as v n]]
        <tr>
            <!-- <td>[[v.id]]</td> -->
            <td>
                <div class="btn-group btn-group-sm">
                [[if access('<?php echo mca('lock'); ?>',0)]]
                    [[if v.locked==1]]
                    <button class="btn btn-primary" onclick="EBCMS.ACT.lock('<?php echo url('extend/lock'); ?>','[[v.id]]','0','<?php echo $namespace; ?>');">已锁</button>
                    [[else]]
                    <button class="btn btn-primary" onclick="EBCMS.ACT.lock('<?php echo url('extend/lock'); ?>','[[v.id]]','1','<?php echo $namespace; ?>');">未锁</button>
                    [[/if]]
                [[/if]]
                [[if access('<?php echo mca('status'); ?>',v.locked)]]
                    [[if v.status==1]]
                    <button class="btn btn-primary" onclick="EBCMS.ACT.status('<?php echo url('extend/status'); ?>','[[v.id]]','0','<?php echo $namespace; ?>');">已审</button>
                    [[else]]
                    <button class="btn btn-warning" onclick="EBCMS.ACT.status('<?php echo url('extend/status'); ?>','[[v.id]]','1','<?php echo $namespace; ?>');">未审</button>
                    [[/if]]
                [[/if]]
                [[if access('<?php echo mca('edit'); ?>',v.locked)]]
                <button class="btn btn-primary" onclick="EBCMS.<?php echo $namespace; ?>.edit('[[v.id]]');">编辑</button>
                [[/if]]
                [[if access('<?php echo mca('delete'); ?>',v.locked)]]
                <button class="btn btn-primary" onclick="EBCMS.ACT.del('<?php echo url('extend/delete'); ?>','[[v.id]]','<?php echo $namespace; ?>');">删除</button>
                [[/if]]
                </div>
            </td>
            <td>[[v.title]]</td>
            <td><input value="[[v.sort]]" class="form-control input-sm input_sort" data-id="[[v.id]]"></td>
            <td>
                <div class="btn-group btn-group-sm">
                [[if access('<?php echo mca('index','extendfield'); ?>',v.locked)]]
                <button class="btn btn-primary" onclick="EBCMS.<?php echo $namespace; ?>.change_extend('[[v.id]]');">管理</button>
                [[/if]]
                </div>
            </td>
        </tr>
    [[/each]]
</script>
<?php $namespace=ns('extendfield'); ?>
<script>
    Namespace.register("EBCMS.<?php echo $namespace; ?>");
    $(function(){
        EBCMS.<?php echo $namespace; ?>.queryParams = {
            order:{
                'sort':'desc',
            },
            model:'admin/extendfield',
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
                group:'group',
                tpl:'<?php echo $namespace; ?>-table',
                target:'#<?php echo $namespace; ?>_table',
                compileAfter:function(data){
                    $('#<?php echo $namespace; ?>_table').find('.input_sort').focus(function(){
                        EBCMS.<?php echo $namespace; ?>.sortvalue = $(this).val();
                    }).blur(function(){
                        var $this = $(this);
                        if ($this.val() != EBCMS.<?php echo $namespace; ?>.sortvalue) {
                            EBCMS.ACT.togglefield('<?php echo url('extendfield/resort'); ?>',$this.data('id'),$this.val(),'<?php echo $namespace; ?>','resort');
                        };
                    });
                    $('#<?php echo $namespace; ?>_table').find('tr').bind('click', function(event) {
                        $(this).addClass('warning').siblings('tr').removeClass('warning');
                    });
                    EBCMS.FN.renderFilter({
                        namespace:'<?php echo $namespace; ?>',
                        filter:{
                            search:{
                                field:'group|title|name|value|remark',
                                value:''
                            },
                            lock:{
                                field:'locked',
                            },
                            status:{
                                field:'status',
                            },
                            order:{
                                filters:{id:'id',update_time:'更新时间',sort:'权重'}
                            },
                        }
                    });
                },
            });
        };
        EBCMS.<?php echo $namespace; ?>.add = function add(){
            if (EBCMS.<?php echo ns(); ?>.category_id) {
                EBCMS.CORE.get({
                    url:'<?php echo url('extendfield/add'); ?>',
                    queryParams:{
                        category_id:EBCMS.<?php echo ns('extend'); ?>.category_id,
                    },
                    target:'#lgModal .modal-content',
                });
            }else{
                EBCMS.MSG.notice('请先选择左侧模型！');
            };
        };
        EBCMS.<?php echo $namespace; ?>.edit = function edit(id){
            EBCMS.CORE.get({
                url:'<?php echo url('extendfield/edit'); ?>',
                queryParams:{
                    id:id,
                },
                target:'#lgModal .modal-content',
            });
        };
        EBCMS.<?php echo $namespace; ?>.config = function config(id){
            EBCMS.CORE.get({
                url:'<?php echo url('extendfield/edit'); ?>',
                queryParams:{
                    __type:'config',
                    id:id,
                },
                target:'#lgModal .modal-content',
            });
        };
    });
</script>
    
<script id="<?php echo $namespace; ?>-box" type="text/html">
    <div class="header">
        <div class="footer-page" id="<?php echo $namespace; ?>_filter"></div>
        <div class="header-title" onclick="EBCMS.<?php echo $namespace; ?>.refresh();">字段管理</div>
        <div class="btn-group">
            <button class="btn btn-primary" onclick="EBCMS.<?php echo $namespace; ?>.add();">添加</button>
        </div>
    </div>
    <div class="body" style="bottom:0px;">
        <div class="box" id="<?php echo $namespace; ?>_table"></div>
    </div>
</script>
    
<script id="<?php echo $namespace; ?>-table" type="text/html">
    <div class="table-responsive">
        <table class="table table-bordered table-hover table-ebcms">
            <tbody>
                <tr>
                    <!-- <th style="width:70px;">id</th> -->
                    <th style="width:245px;">操作</th>
                    <th>标题</th>
                    <th>字段</th>
                    <th>排序</th>
                </tr>
                [[each groups as data group]]
                    <tr>
                        <th>[[group]]</th>
                        <th colspan="3"></th>
                    </tr>
                    [[include '<?php echo $namespace; ?>-table-item' data]]
                [[/each]]
            </tbody>
        </table>
    </div>
</script>

<script id="<?php echo $namespace; ?>-table-item" type="text/html">
    [[each rows as v n]]
        <tr>
            <!-- <td>[[v.id]]</td> -->
            <td>
                <div class="btn-group btn-group-sm">
                [[if access('<?php echo mca('lock'); ?>',0)]]
                    [[if v.locked==1]]
                    <button class="btn btn-primary" onclick="EBCMS.ACT.lock('<?php echo url('extendfield/lock'); ?>','[[v.id]]','0','<?php echo $namespace; ?>');">已锁</button>
                    [[else]]
                    <button class="btn btn-primary" onclick="EBCMS.ACT.lock('<?php echo url('extendfield/lock'); ?>','[[v.id]]','1','<?php echo $namespace; ?>');">未锁</button>
                    [[/if]]
                [[/if]]
                [[if access('<?php echo mca('status'); ?>',v.locked)]]
                    [[if v.status==1]]
                    <button class="btn btn-primary" onclick="EBCMS.ACT.status('<?php echo url('extendfield/status'); ?>','[[v.id]]','0','<?php echo $namespace; ?>');">已审</button>
                    [[else]]
                    <button class="btn btn-warning" onclick="EBCMS.ACT.status('<?php echo url('extendfield/status'); ?>','[[v.id]]','1','<?php echo $namespace; ?>');">未审</button>
                    [[/if]]
                [[/if]]
                [[if access('<?php echo mca('edit'); ?>',v.locked)]]
                <button class="btn btn-primary" onclick="EBCMS.<?php echo $namespace; ?>.edit('[[v.id]]');">编辑</button>
                <button class="btn btn-primary" onclick="EBCMS.<?php echo $namespace; ?>.config('[[v.id]]')">设置</a>
                [[/if]]
                [[if access('<?php echo mca('delete'); ?>',v.locked)]]
                <button class="btn btn-primary" onclick="EBCMS.ACT.del('<?php echo url('extendfield/delete'); ?>','[[v.id]]','<?php echo $namespace; ?>');">删除</button>
                [[/if]]
                </div>
            </td>
            <td>[[v.title]]</td>
            <td>[[v.name]]</td>
            <td><input value="[[v.sort]]" class="form-control input-sm input_sort" data-id="[[v.id]]"></td>
        </tr>
    [[/each]]
</script>