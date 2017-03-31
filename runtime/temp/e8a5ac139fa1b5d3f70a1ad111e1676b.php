<?php if (!defined('THINK_PATH')) exit(); /*a:3:{s:66:"E:\workspace-php\l7cms/application/admin\view\recommend\index.html";i:1472111959;s:74:"E:\workspace-php\l7cms/application/admin\view\recommend\recommendtype.html";i:1472111959;s:70:"E:\workspace-php\l7cms/application/admin\view\recommend\recommend.html";i:1472526128;}*/ ?>
<?php $namespace = ns(); ?>
<div class="layout">
    <div class="layout-left" style="width: 20%;margin-right: -20%;">
        <div class="box" id="<?php echo $namespace; ?>type_box"></div>
        <script>
    Namespace.register("EBCMS.<?php echo $namespace; ?>type");
    $(function(){
        EBCMS.<?php echo $namespace; ?>type.refresh = function refresh(){
            EBCMS.CORE.api({
                queryParams:{
                    order:{
                        'sort':'desc',
                    },
                    model:'admin/recommendcate',
                },
                group:'group',
                tree:true,
                treelevel:true,
                tpl:'<?php echo $namespace; ?>type-table',
                target:'#<?php echo $namespace; ?>type_table',
                compileAfter:function(p){
                    var $lists = $(p.target).find('a.list-group-item');
                    $lists.click(function(){
                        $lists.removeClass('active');
                        $(this).addClass('active');
                    });
                }
            });
        };
        EBCMS.<?php echo $namespace; ?>type.changecate = function changecate(category_id){
            EBCMS.CORE.compile({
                tpl:'<?php echo $namespace; ?>-box',
                target:'#<?php echo $namespace; ?>_box',
                compileAfter:function(){
                    EBCMS.<?php echo $namespace; ?>.category_id = category_id;
                    EBCMS.<?php echo $namespace; ?>.refresh({
                        page:1,
                        where:{
                            category_id:['eq',category_id],
                        }
                    });
                }
            });
        };
        EBCMS.CORE.compile({
            tpl:'<?php echo $namespace; ?>type-box',
            target:'#<?php echo $namespace; ?>type_box',
            compileAfter:function(){
                EBCMS.<?php echo $namespace; ?>type.refresh();
            }
        });
    });
</script>

<script id="<?php echo $namespace; ?>type-box" type="text/html">
    <div class="header">
        <div class="btn-group pull-right">
            <button class="btn btn-primary" onclick="EBCMS.CORE.changemain('<?php echo url('admin/recommendcate/index'); ?>');">管理</button>
        </div>
        <div class="header-title" onclick="EBCMS.<?php echo $namespace; ?>type.refresh();">推荐分类</div>
    </div>
    <div class="body" style="bottom:0px;">
        <div id="<?php echo $namespace; ?>type_table" class="box"></div>
    </div>
</script>

<script id="<?php echo $namespace; ?>type-table" type="text/html">
    <div class="list-group tree tree_first" style="border-top: 1px solid #ddd;border-right: 1px solid #ddd;border-bottom: 1px solid #ddd;">
        [[each groups as data group]]
            <a class="list-group-item" href="###">[[group]]
            </a>
            <div class="list-group-item nopadding">
                <div class="list-group tree nopadding">
                    [[include '<?php echo $namespace; ?>type-table-item' data]]
                </div>
            </div>
        [[/each]]
    </div>
</script>

<script id="<?php echo $namespace; ?>type-table-item" type="text/html">
    [[each rows as v n]]
        [[if v.rows]]
            <a class="list-group-item" href="javascript:EBCMS.<?php echo $namespace; ?>type.changecate('[[v.id]]');">[[v.title]]
            </a>
            <div class="list-group-item nopadding">
                <div class="list-group tree nopadding">
                    [[include '<?php echo $namespace; ?>type-table-item' v]]
                </div>
            </div>
        [[else]]
            <a class="list-group-item" href="javascript:EBCMS.<?php echo $namespace; ?>type.changecate('[[v.id]]');"><span class="badge">[[v.mark]]</span>[[v.title]]
            </a>
        [[/if]]
    [[/each]]
</script>
    </div>
    <div class="layout-rightbox">
        <div class="layout-right" style="height:100%;overflow:auto;margin-left: 20%;">
            <div class="box" id="<?php echo $namespace; ?>_box"></div>
            <script>
    Namespace.register("EBCMS.<?php echo $namespace; ?>");
    $(function(){
        EBCMS.<?php echo $namespace; ?>.queryParams = {
            page:1,
            rows:20,
            order:{
                'sort':'desc',
                'id':'desc',
            },
            model:'admin/recommend',
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
                    $('#<?php echo $namespace; ?>_table').find('.input_sort').focus(function(){
                        EBCMS.<?php echo $namespace; ?>.sortvalue = $(this).val();
                    }).blur(function(){
                        var $this = $(this);
                        if ($this.val() != EBCMS.<?php echo $namespace; ?>.sortvalue) {
                            EBCMS.ACT.togglefield('<?php echo url('admin/recommend/resort'); ?>',$this.data('id'),$this.val(),'<?php echo $namespace; ?>','resort');
                        };
                    });
                    EBCMS.FN.renderPage({
                        namespace:'<?php echo $namespace; ?>',
                        total:p.data.total,
                    });
                    EBCMS.FN.renderFilter({
                        namespace:'<?php echo $namespace; ?>',
                        filter:{
                            search:{
                                field:'title|description|ext',
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
                            rows:true,
                        },
                    });
                },
            });
        };
        EBCMS.<?php echo $namespace; ?>.edit = function edit(id){
            EBCMS.CORE.get({
                url:'<?php echo url('admin/recommend/edit'); ?>',
                queryParams:{
                    id:id,
                },
                target:'#lgModal .modal-content',
            });
        };
        EBCMS.<?php echo $namespace; ?>.add = function add(){
            if (EBCMS.<?php echo $namespace; ?>.category_id) {
                EBCMS.CORE.get({
                    url:'<?php echo url('admin/recommend/add'); ?>',
                    queryParams:{
                        category_id:EBCMS.<?php echo $namespace; ?>.category_id,
                    },
                    target:'#lgModal .modal-content',
                });
            }else{
                EBCMS.MSG.notice('请先选择分类！');
            };
        };
        /*加粗*/
        EBCMS.<?php echo $namespace; ?>.bold = function bold(id,value){
            EBCMS.CORE.submit({
                url:'<?php echo url('admin/recommend/style'); ?>',
                queryParams:{
                    id: id,
                    bold:value
                },
                success:function(res){
                   if (!res.code) {
                       EBCMS.MSG.alert(res.msg);
                   }
                   EBCMS.<?php echo $namespace; ?>.refresh();
                }
            });
        };
        /*着色*/
        EBCMS.<?php echo $namespace; ?>.color = function color(id,value){
            EBCMS.CORE.submit({
                url:'<?php echo url('admin/recommend/style'); ?>',
                queryParams:{
                    id: id,
                    color:value
                },
                success:function(res){
                   if (!res.code) {
                       EBCMS.MSG.alert(res.msg);
                   }
                   EBCMS.<?php echo $namespace; ?>.refresh();
                }
            });
        };
    });
</script>

<script id="<?php echo $namespace; ?>-box" type="text/html">
    <div class="header">
        <div id="<?php echo $namespace; ?>_filter" class="footer-page"></div>
        <div class="header-title" onclick="EBCMS.<?php echo $namespace; ?>.refresh();">推荐管理</div>
        <div class="btn-group">
            <button class="btn btn-primary" onclick="EBCMS.<?php echo $namespace; ?>.add();">添加</button>
        </div>
    </div>
    <div class="body">
        <div id="<?php echo $namespace; ?>_table" class="box"></div>
    </div>
    <div class="footer">
        <div id="<?php echo $namespace; ?>_page" class="footer-page"></div>
    </div>
</script>

<script id="<?php echo $namespace; ?>-table" type="text/html">
    [[each rows as v n]]
        <div class="media articlelist">
            <div class="media-left">
                <div style="width:140px;">
                    <img src="[[v.thumb | realpath ]]" alt="">
                </div>
                <br>
                <div class="input-group">
                  <span class="input-group-addon">权重</span>
                  <input type="text" class="form-control input-sm input_sort" data-id="[[v.id]]" value="[[v.sort]]" placeholder="越大越靠前">
                </div>
            </div>
            <div class="media-body">
                <div class="media-heading" style="font-size:1.5em;">[[if v.model]] <b class="text-danger">【推送】</b>[[/if]]<span style="[[if v.color]]color:[[v.color]];[[/if]][[if v.bold]]font-weight:[[v.bold]];[[/if]][[if v.size>10]]font-size:[[v.size]]px;[[/if]]">[[v.title]]</span></div>
                <div class="description">[[v.description]]</div>
                <div style="">
                    <div class="btn-group btn-group-sm">
                        [[if access('<?php echo mca('lock'); ?>',0)]]
                            [[if v.locked==1]]
                            <button class="btn btn-primary" onclick="EBCMS.ACT.lock('<?php echo url('admin/recommend/lock'); ?>','[[v.id]]','0','<?php echo $namespace; ?>');">已锁</button>
                            [[else]]
                            <button class="btn btn-primary" onclick="EBCMS.ACT.lock('<?php echo url('admin/recommend/lock'); ?>','[[v.id]]','1','<?php echo $namespace; ?>');">未锁</button>
                            [[/if]]
                        [[/if]]
                        [[if access('<?php echo mca('status'); ?>',v.locked)]]
                            [[if v.status==1]]
                            <button class="btn btn-primary" onclick="EBCMS.ACT.status('<?php echo url('admin/recommend/status'); ?>','[[v.id]]','0','<?php echo $namespace; ?>');">已审</button>
                            [[else]]
                            <button class="btn btn-warning" onclick="EBCMS.ACT.status('<?php echo url('admin/recommend/status'); ?>','[[v.id]]','1','<?php echo $namespace; ?>');">未审</button>
                            [[/if]]
                        [[/if]]
                        [[if access('<?php echo mca('edit'); ?>',v.locked)]]
                        <button class="btn btn-primary" onclick="EBCMS.<?php echo $namespace; ?>.edit('[[v.id]]');">编辑</button>
                        [[/if]]
                        [[if access('<?php echo mca('delete'); ?>',v.locked)]]
                        <button class="btn btn-primary" onclick="EBCMS.ACT.del('<?php echo url('admin/recommend/delete'); ?>','[[v.id]]','<?php echo $namespace; ?>');">删除</button>
                        [[/if]]
                    </div>
                    [[if access('<?php echo mca('style'); ?>',v.locked)]]
                    <div class="btn-group btn-group-sm">
                        <div class="btn-group btn-group-sm dropup">
                          <button type="button" class="btn btn-primary" onclick="EBCMS.<?php echo $namespace; ?>.bold('[[v.id]]','[[if '' == v.bold]]600[[/if]]');">加粗</button>
                          <button type="button" class="btn btn-primary dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <span class="caret"></span>
                            <span class="sr-only">Toggle Dropdown</span>
                          </button>
                          <div class="dropdown-menu" style="padding:5px;">
                            <div class="btn-group" style="display: inline-flex;" role="group" aria-label="...">
                              <button type="button" class="btn btn-default" onclick="EBCMS.<?php echo $namespace; ?>.bold('[[v.id]]','600');"><span style="font-weight:600;">加粗</span></button>
                              <button type="button" class="btn btn-default" onclick="EBCMS.<?php echo $namespace; ?>.bold('[[v.id]]','900');"><span style="font-weight:900;">特粗</span></button>
                            </div>
                          </div>
                        </div>
                        <div class="btn-group btn-group-sm dropup">
                          <button type="button" class="btn btn-primary" onclick="EBCMS.<?php echo $namespace; ?>.color('[[v.id]]','[[if '' == v.color]]#d9534f[[/if]]');">着色</button>
                          <button type="button" class="btn btn-primary dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <span class="caret"></span>
                            <span class="sr-only">Toggle Dropdown</span>
                          </button>
                          <div class="dropdown-menu" style="padding:5px;">
                            <div class="btn-group" style="display: inline-flex;" role="group" aria-label="...">
                              <button type="button" class="btn btn-primary" onclick="EBCMS.<?php echo $namespace; ?>.color('[[v.id]]','#428bca');">蓝</button>
                              <button type="button" class="btn btn-success" onclick="EBCMS.<?php echo $namespace; ?>.color('[[v.id]]','#5cb85c');">绿</button>
                              <button type="button" class="btn btn-info" onclick="EBCMS.<?php echo $namespace; ?>.color('[[v.id]]','#5bc0de');">青</button>
                              <button type="button" class="btn btn-warning" onclick="EBCMS.<?php echo $namespace; ?>.color('[[v.id]]','#f0ad4e');">黄</button>
                              <button type="button" class="btn btn-danger" onclick="EBCMS.<?php echo $namespace; ?>.color('[[v.id]]','#d9534f');">红</button>
                            </div>
                          </div>
                        </div>
                    </div>
                    [[/if]]
                </div>
            </div>
        </div>
    [[/each]]
</script>
        </div>
    </div>
</div>