<?php if (!defined('THINK_PATH')) exit(); /*a:2:{s:73:"E:\workspace-php\l7cms/application/content\view\admin\category\index.html";i:1472111959;s:76:"E:\workspace-php\l7cms/application/content\view\admin\category\category.html";i:1472526176;}*/ ?>
<?php $namespace = ns(); ?>
<div class="box" id="<?php echo $namespace; ?>_box"></div>
<script>
    Namespace.register("EBCMS.<?php echo $namespace; ?>");
    $(function(){
        EBCMS.<?php echo $namespace; ?>.queryParams = {
            order:{
                'category.sort':'desc',
                'category.id':'asc',
            },
            model:'content/category',
            with:'extend',
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
                tree:true,
                treelevel:true,
                tpl:'<?php echo $namespace; ?>-box',
                target:'#<?php echo $namespace; ?>_box',
                compileAfter:function(data){
                    $('#<?php echo $namespace; ?>_box').find('.input_sort').focus(function(){
                        EBCMS.<?php echo $namespace; ?>.sortvalue = $(this).val();
                    }).blur(function(){
                        var $this = $(this);
                        if ($this.val() != EBCMS.<?php echo $namespace; ?>.sortvalue) {
                            EBCMS.ACT.togglefield('<?php echo url('content/admin.category/resort'); ?>',$this.data('id'),$this.val(),'<?php echo $namespace; ?>','resort');
                        };
                    });
                    EBCMS.FN.renderFilter({
                        namespace:'<?php echo $namespace; ?>',
                        filter:{
                            search:{
                                field:'category.title|category.keywords|category.description|category.metatitle',
                                value:''
                            },
                            lock:{
                                field:'category.locked',
                            },
                            status:{
                                field:'category.status',
                            },
                            order:{
                                filters:{
                                    'category.id':'id',
                                    'category.update_time':'更新时间',
                                    'category.sort':'权重'
                                }
                            },
                        }
                    });
                },
            });
        };
        EBCMS.<?php echo $namespace; ?>.edit = function edit(id){
            EBCMS.CORE.get({
                url:'<?php echo url('content/admin.category/edit'); ?>',
                queryParams:{
                    id:id,
                },
                target:'#lgModal .modal-content',
            });
        };
        EBCMS.<?php echo $namespace; ?>.add = function add(pid){
            EBCMS.CORE.get({
                url:'<?php echo url('content/admin.category/add'); ?>',
                queryParams:{
                    pid:pid,
                },
                target:'#lgModal .modal-content',
            });
        };
        EBCMS.<?php echo $namespace; ?>.merge = function(){
            var ids = EBCMS.FN.getCheckedId('<?php echo $namespace; ?>');
            if (ids) {
                EBCMS.CORE.get({
                    url:'<?php echo url('content/admin.category/merge'); ?>',
                    queryParams:{
                        ids:ids,
                    },
                    target:'#lgModal .modal-content',
                });
            }else{
                EBCMS.MSG.notice('请先勾选要移动的数据！');
            };
        };
        EBCMS.<?php echo $namespace; ?>.refresh();
    });
</script>

<script id="<?php echo $namespace; ?>-box" type="text/html">
    <div class="header">
        <div class="footer-page" id="<?php echo $namespace; ?>_filter"></div>
        <div class="header-title">内容分类</div>
        <div class="btn-group">
            [[if access('<?php echo mca('add'); ?>',0)]]
            <button class="btn btn-primary" onclick="EBCMS.<?php echo $namespace; ?>.add();">添加</button>
            [[/if]]
            <button class="btn btn-primary" onclick="EBCMS.FN.inverse('<?php echo $namespace; ?>');">选择(反选)</button>
            <button type="button" class="btn btn-primary dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
              <span class="caret"></span>
              <span class="sr-only">Toggle Dropdown</span>
            </button>
            <ul class="dropdown-menu dropdown-menu-right">
            [[if access('<?php echo mca('delete'); ?>',0)]]
                <li><a href="###" onclick="EBCMS.ACT.dels('<?php echo url('content/admin.category/delete'); ?>','<?php echo $namespace; ?>');">批量删除</a></li>
            [[/if]]
            [[if access('<?php echo mca('status'); ?>',0)]]
                <li role="separator" class="divider"></li>
                <li><a href="###" onclick="EBCMS.ACT.statuss('<?php echo url('content/admin.category/status'); ?>',1,'<?php echo $namespace; ?>');">批量审核</a></li>
                <li><a href="###" onclick="EBCMS.ACT.statuss('<?php echo url('content/admin.category/status'); ?>',0,'<?php echo $namespace; ?>');">取消审核</a></li>
            [[/if]]
            [[if access('<?php echo mca('lock'); ?>',0)]]
                <li role="separator" class="divider"></li>
                <li><a href="###" onclick="EBCMS.ACT.locks('<?php echo url('content/admin.category/lock'); ?>',0,'<?php echo $namespace; ?>');">批量解锁</a></li>
                <li><a href="###" onclick="EBCMS.ACT.locks('<?php echo url('content/admin.category/lock'); ?>',1,'<?php echo $namespace; ?>');">批量锁定</a></li>
            [[/if]]
            [[if access('<?php echo mca('merge'); ?>',0)]]
                <li role="separator" class="divider"></li>
                <li><a href="###" onclick="EBCMS.<?php echo $namespace; ?>.merge();">合并</a></li>
            [[/if]]
            </ul>
        </div>
    </div>
    <div class="body" style="padding:5px;bottom:0px;">
        <table class="table table-bordered table-hover table-ebcms">
            <tbody>
                <tr>
                    <th style="width:70px;">id</th>
                    <th style="width:200px;">操作</th>
                    <th>标题</th>
                    <th>名称</th>
                    <th>模型</th>
                    <th>排序</th>
                </tr>
                [[include '<?php echo $namespace; ?>-table-item']]
            </tbody>
        </table>
    </div>
</script>

<script id="<?php echo $namespace; ?>-table-item" type="text/html">
    [[each rows as v n]]
        <tr>
            <td>
                <input type="checkbox" name="id" value="[[v.id]]" id="<?php echo $namespace; ?>_item_[[v.id]]">
                <label for='<?php echo $namespace; ?>_item_[[v.id]]'>[[v.id]]</label>
            </td>
            <td>
                <div class="btn-group btn-group-sm">
                [[if access('<?php echo mca('lock'); ?>',0)]]
                    [[if v.locked==1]]
                    <button class="btn btn-primary" onclick="EBCMS.ACT.lock('<?php echo url('content/admin.category/lock'); ?>','[[v.id]]','0','<?php echo $namespace; ?>');">已锁</button>
                    [[else]]
                    <button class="btn btn-primary" onclick="EBCMS.ACT.lock('<?php echo url('content/admin.category/lock'); ?>','[[v.id]]','1','<?php echo $namespace; ?>');">未锁</button>
                    [[/if]]
                [[/if]]
                [[if access('<?php echo mca('status'); ?>',v.locked)]]
                    [[if v.status==1]]
                    <button class="btn btn-primary" onclick="EBCMS.ACT.status('<?php echo url('content/admin.category/status'); ?>','[[v.id]]','0','<?php echo $namespace; ?>');">已审</button>
                    [[else]]
                    <button class="btn btn-warning" onclick="EBCMS.ACT.status('<?php echo url('content/admin.category/status'); ?>','[[v.id]]','1','<?php echo $namespace; ?>');">未审</button>
                    [[/if]]
                [[/if]]
                [[if access('<?php echo mca('edit'); ?>',v.locked)]]
                <button class="btn btn-primary" onclick="EBCMS.<?php echo $namespace; ?>.edit('[[v.id]]');">编辑</button>
                [[/if]]
                [[if access('<?php echo mca('delete'); ?>',v.locked)]]
                <button class="btn btn-primary" onclick="EBCMS.ACT.del('<?php echo url('content/admin.category/delete'); ?>','[[v.id]]','<?php echo $namespace; ?>');">删除</button>
                [[/if]]
                </div>
            </td>
            <td>[[v.levelstr]]┣[[v.title]][[if v.ebcms_url != '']]&nbsp;<b><i class="iconfont icon-url text-danger"></i></b>[[/if]]</td>
            <td>[[v.levelstr]]┣[[v.name]]</td>
            <td>[[if v.extend.title != null]][[v.extend.title]][[else]][[/if]]</td>
            <td><input value="[[v.sort]]" class="form-control input-sm input_sort" data-id="[[v.id]]"></td>
        </tr>
        [[if v.rows]]
            [[include '<?php echo $namespace; ?>-table-item' v]]
        [[/if]]
    [[/each]]
</script>