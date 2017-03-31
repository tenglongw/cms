<?php if (!defined('THINK_PATH')) exit(); /*a:3:{s:72:"E:\workspace-php\l7cms/application/content\view\admin\content\index.html";i:1472111959;s:71:"E:\workspace-php\l7cms/application/content\view\admin\content\type.html";i:1472111959;s:74:"E:\workspace-php\l7cms/application/content\view\admin\content\content.html";i:1487656753;}*/ ?>
<?php $namespace = ns(); ?>
<div class="layout">
    <div class="layout-left" style="width: 20%;margin-right: -20%;">
        <div class="box" id="<?php echo $namespace; ?>type_box"></div>
    </div>
    <div class="layout-rightbox">
        <div class="layout-right" id="<?php echo $namespace; ?>_box" style="height:100%;overflow:auto;margin-left: 20%;">
        </div>
    </div>
</div>
<script>
    Namespace.register("EBCMS.<?php echo $namespace; ?>type");
    $(function(){
        EBCMS.<?php echo $namespace; ?>type.refresh = function refresh(){
            EBCMS.CORE.api({
                queryParams:{
                    order:{
                        'sort':'desc',
                        'id':'asc',
                    },
                    model:'content/category',
                },
                tree:true,
                rootitem:true,
                treelevel:true,
                loadAfter:function(data){
                    EBCMS.CORE.compile({
                        data:data,
                        tpl:'<?php echo $namespace; ?>type-table',
                        target:'#<?php echo $namespace; ?>type_table',
                        compileAfter:function(p){
                            var $lists = $(p.target).find('a.list-group-item');
                            $.each($lists, function(index, val) {
                                var ids = [];
                                ids.push($(val).data('id'));
                                if ($(val).next().is('div')) {
                                    var sub = $(val).next().find('a.list-group-item');
                                    $.each(sub, function(n, v) {
                                        ids.push($(v).data('id'));
                                    });
                                }
                                if ($(val).next().is('div')) {
                                    if ($(val).next().css('display') == 'none') {
                                        $(val).prepend('<span class="iconfont icon-zhankai icon-shouqi pull-right"></span>');
                                    }else{
                                        $(val).prepend('<span class="iconfont icon-zhankai pull-right"></span>');
                                    }
                                    $('span',val).bind('click',function(event) {
                                        EBCMS.<?php echo $namespace; ?>type.nochange = true;
                                        $(this).toggleClass('icon-shouqi');
                                        $(val).next().toggle(150);
                                        setTimeout(function(){
                                            EBCMS.<?php echo $namespace; ?>type.nochange = false;
                                        }, 150);
                                    });
                                }
                                $(val).bind('click', function(event) {
                                    if (true != EBCMS.<?php echo $namespace; ?>type.nochange) {
                                        $lists.removeClass('active');
                                        $(this).addClass('active');
                                        EBCMS.<?php echo $namespace; ?>type.changecate(ids);
                                        
                                        $(this).find('span').click();
                                        $.each($(this).siblings('a'), function(index, v) {
                                            if (!$('span',v).hasClass('icon-shouqi')) {
                                                $('span',v).click();
                                            }
                                        });
                                    }
                                });
                            });
                        }
                    });
                }
            });
        };
        EBCMS.<?php echo $namespace; ?>type.changecate = function changecate(category_ids){
            EBCMS.CORE.compile({
                tpl:'<?php echo $namespace; ?>-box',
                target:'#<?php echo $namespace; ?>_box',
                compileAfter:function(){
                    EBCMS.<?php echo $namespace; ?>.category_id = category_ids[0];
                    EBCMS.<?php echo $namespace; ?>.refresh({
                        page:1,
                        where:{
                            category_id:['in',category_ids],
                        }
                    });
                }
            });
        };
        /*合拢&展开*/
        EBCMS.<?php echo $namespace; ?>type.closure = function(eml){
            if ($('#<?php echo $namespace; ?>type_table').find('.icon-shouqi').length) {
                $('#<?php echo $namespace; ?>type_table').find('.icon-shouqi').click();
                $(eml).html('堆叠');
            }else{
                /*合拢*/
                $('#<?php echo $namespace; ?>type_table div.list-group-item span.icon-zhankai').click();
                $(eml).html('展开');
            }
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
            <div class="btn-group">
              <button type="button" class="btn btn-primary" onclick="EBCMS.<?php echo $namespace; ?>type.closure($(this));">展开</button>
            </div>
        </div>
        <div class="header-title" onclick="EBCMS.<?php echo $namespace; ?>type.refresh();">栏目</div>
    </div>
    <div class="body" style="bottom:0px;">
        <div class="box" id="<?php echo $namespace; ?>type_table"></div>
    </div>
</script>

<script id="<?php echo $namespace; ?>type-table" type="text/html">
    <div class="list-group tree tree_first" style="border-top: 1px solid #ddd;border-right: 1px solid #ddd;border-bottom: 1px solid #ddd;">
        [[include '<?php echo $namespace; ?>type-table-item']]
    </div>
</script>

<script id="<?php echo $namespace; ?>type-table-item" type="text/html">
    [[each rows as v n]]
        <a class="list-group-item" data-id='[[v.id]]' href="###">[[v.title]][[if v.pid>=0 && v.status!=1]]&nbsp;<i class="iconfont icon-tishi2"></i>[[/if]][[if v.pid>=0 && v.ebcms_url!='']]&nbsp;<i class="iconfont icon-url"></i>[[/if]]</a>
        [[if v.rows]]
            <div class="list-group-item nopadding" [[if v.pid==0]]style="display:none;"[[/if]]>
                <div class="list-group tree nopadding">
                    [[include '<?php echo $namespace; ?>type-table-item' v]]
                </div>
            </div>
        [[/if]]
    [[/each]]
</script>
<script>
    Namespace.register("EBCMS.<?php echo $namespace; ?>");
    $(function(){
        EBCMS.<?php echo $namespace; ?>.queryParams = {
            page:1,
            rows:20,
            order:{
                'content.id':'desc',
            },
            model:'content/content',
            with:'category'
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
                            EBCMS.ACT.togglefield('<?php echo url('content/admin.content/resort'); ?>',$this.data('id'),$this.val(),'<?php echo $namespace; ?>','resort');
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
                                field:'content.title|content.description',
                                value:''
                            },
                            lock:{
                                field:'content.locked',
                            },
                            status:{
                                field:'content.status',
                                filters:{'待审核':99,"已通过":1,'未通过':0}
                            },
                            order:{
                                filters:{'content.id':'id','content.update_time':'更新时间','content.sort':'权重'}
                            },
                            rows:true,
                        },
                    });
                },
            });
        };
        EBCMS.<?php echo $namespace; ?>.add = function add(){
            if (EBCMS.<?php echo $namespace; ?>.category_id) {
                EBCMS.CORE.get({
                    url:'<?php echo url('content/admin.content/add'); ?>',
                    queryParams:{
                        category_id:EBCMS.<?php echo $namespace; ?>.category_id,
                    },
                    target:'#main_edit',
                });
            }else{
                EBCMS.MSG.notice('请先选择分类！');
            };
        };
        EBCMS.<?php echo $namespace; ?>.edit = function edit(id){
            EBCMS.CORE.get({
                url:'<?php echo url('content/admin.content/edit'); ?>',
                queryParams:{
                    id:id,
                },
                target:'#main_edit',
            });
        };
        /*加粗*/
        EBCMS.<?php echo $namespace; ?>.bold = function bold(id,value){
            EBCMS.CORE.submit({
                url:'<?php echo url('content/admin.content/style'); ?>',
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
                url:'<?php echo url('content/admin.content/style'); ?>',
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
        EBCMS.<?php echo $namespace; ?>.move = function(){
            var ids = EBCMS.FN.getCheckedId('<?php echo $namespace; ?>');
            if (ids) {
                EBCMS.CORE.get({
                    url:'<?php echo url('content/admin.content/move'); ?>',
                    queryParams:{
                        ids:ids,
                    },
                    target:'#lgModal .modal-content',
                });
            }else{
                EBCMS.MSG.notice('请先勾选要移动的数据！');
            };
        };

        EBCMS.<?php echo $namespace; ?>.baidu = function baidu(id){
            EBCMS.CORE.submit({
                url:'<?php echo url('content/admin.content/baidu'); ?>',
                queryParams:{
                    id:id,
                },
                success:function(res){
                    EBCMS.MSG.notice(res.msg);
                    EBCMS.<?php echo $namespace; ?>.refresh();
                }
            });
        };

        EBCMS.<?php echo $namespace; ?>.params_comment = {
            page:1,
            size:10,
            tid:0,
        };
        EBCMS.<?php echo $namespace; ?>.comment_load = function(id){
            if (id) {
                EBCMS.<?php echo $namespace; ?>.params_comment.tid = id;
                EBCMS.<?php echo $namespace; ?>.params_comment.page = 1;
                if ($('#<?php echo $namespace; ?>_content_comment_'+EBCMS.<?php echo $namespace; ?>.params_comment.tid).html()) {
                    $('#<?php echo $namespace; ?>_content_comment_'+EBCMS.<?php echo $namespace; ?>.params_comment.tid).html('');
                    $('#<?php echo $namespace; ?>_content_comment_page_'+EBCMS.<?php echo $namespace; ?>.params_comment.tid).html('');
                    return;
                }
            }
            EBCMS.CORE.load({
                url: '<?php echo url('content/admin.comment/index'); ?>',
                queryParams:EBCMS.<?php echo $namespace; ?>.params_comment,
                loadAfter:function(data){
                    var coms = template('<?php echo $namespace; ?>-comment-item', {
                        rows:EBCMS.FN.array2tree(data.comments.data.concat(data.subcomments))||[]
                    });
                    $('#<?php echo $namespace; ?>_content_comment_'+EBCMS.<?php echo $namespace; ?>.params_comment.tid).html(coms);

                    $('#<?php echo $namespace; ?>_content_comment_page_'+EBCMS.<?php echo $namespace; ?>.params_comment.tid).html(data.page);
                    $.each($('#<?php echo $namespace; ?>_content_comment_page_'+EBCMS.<?php echo $namespace; ?>.params_comment.tid+' a'), function(index, val) {
                        $this = $(this);
                        $this.attr({
                            href: '#<?php echo $namespace; ?>_content_'+EBCMS.<?php echo $namespace; ?>.params_comment.tid
                        });
                        $this.data('<?php echo $namespace; ?>_comment_tid',EBCMS.<?php echo $namespace; ?>.params_comment.tid);
                        num = $this.html();
                        if ($.isNumeric(num)) {
                            $this.data('<?php echo $namespace; ?>_comment_page',num);
                        }else if(num == '»'){
                            $this.data('<?php echo $namespace; ?>_comment_page',Number(EBCMS.<?php echo $namespace; ?>.params_comment.page)+1);
                        }else if(num == '«'){
                            $this.data('<?php echo $namespace; ?>_comment_page',Number(EBCMS.<?php echo $namespace; ?>.params_comment.page)-1);
                        }
                        $this.bind('click', function(event) {
                            EBCMS.<?php echo $namespace; ?>.params_comment.page=$(this).data('<?php echo $namespace; ?>_comment_page');
                            EBCMS.<?php echo $namespace; ?>.params_comment.tid=$(this).data('<?php echo $namespace; ?>_comment_tid');
                            EBCMS.<?php echo $namespace; ?>.comment_load();
                        });
                    });
                }
            });
            return false;
        };

        EBCMS.<?php echo $namespace; ?>.comment_pingbi = function comment_pingbi(id,value,tid){
            EBCMS.<?php echo $namespace; ?>.params_comment.tid = tid;
            EBCMS.CORE.submit({
                url: '<?php echo url('content/admin.comment/pingbi'); ?>',
                queryParams:{
                    ids:id,
                    value:value,
                },
                success:function(res){
                    EBCMS.<?php echo $namespace; ?>.comment_load();
                    if (res.code) {
                        EBCMS.MSG.notice(res.msg);
                    }else{
                        EBCMS.MSG.alert(res.msg);
                    };
                }
            });
        };

        EBCMS.<?php echo $namespace; ?>.comment_tuijian = function(id,value){
            EBCMS.CORE.submit({
                url: '<?php echo url('content/admin.comment/resort'); ?>',
                queryParams:{
                    ids:id,
                    value:value,
                },
                success:function(res){
                    EBCMS.<?php echo $namespace; ?>.comment_load();
                    if (!res.code) {
                        EBCMS.MSG.alert(res.msg);
                    };
                }
            });
        };

    });
</script>
<script id="<?php echo $namespace; ?>-box" type="text/html">
    <div class="header">
        <div id="<?php echo $namespace; ?>_filter" class="pull-right"></div>
        <div class="header-title">内容管理</div>
        <div class="btn-group">
            <button class="btn btn-primary" onclick="EBCMS.CORE.getconfig('<?php echo eb_encrypt('name|content'); ?>');">设置</button>
            <button class="btn btn-primary" onclick="EBCMS.<?php echo $namespace; ?>.add();">添加</button>
        </div>
    </div>
    <div class="body">
        <div class="box" id="<?php echo $namespace; ?>_table" style="padding:10px;"></div>
    </div>
    <div class="footer">
        <div id="<?php echo $namespace; ?>_page" class="pull-right"></div>
        <div class="btn-group dropup">
          <button type="button" class="btn btn-primary" onclick="EBCMS.FN.inverse('<?php echo $namespace; ?>');">选中(反选)</button>
          <button type="button" class="btn btn-primary dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            <span class="caret"></span>
            <span class="sr-only">Toggle Dropdown</span>
          </button>
          <ul class="dropdown-menu">
            [[if access('<?php echo mca('delete'); ?>',0)]]
            <li><a href="###" onclick="EBCMS.ACT.dels('<?php echo url('content/admin.content/delete'); ?>','<?php echo $namespace; ?>');">批量删除</a></li>
            [[/if]]
            [[if access('<?php echo mca('status'); ?>',0)]]
            <li role="separator" class="divider"></li>
            <li><a href="###" onclick="EBCMS.ACT.statuss('<?php echo url('content/admin.content/status'); ?>',1,'<?php echo $namespace; ?>');">批量审核</a></li>
            <li><a href="###" onclick="EBCMS.ACT.statuss('<?php echo url('content/admin.content/status'); ?>',0,'<?php echo $namespace; ?>');">取消审核</a></li>
            [[/if]]
            [[if access('<?php echo mca('lock'); ?>',0)]]
            <li role="separator" class="divider"></li>
            <li><a href="###" onclick="EBCMS.ACT.locks('<?php echo url('content/admin.content/lock'); ?>',0,'<?php echo $namespace; ?>');">批量解锁</a></li>
            <li><a href="###" onclick="EBCMS.ACT.locks('<?php echo url('content/admin.content/lock'); ?>',1,'<?php echo $namespace; ?>');">批量锁定</a></li>
            [[/if]]
            [[if access('<?php echo mca('move'); ?>',0)]]
            <li role="separator" class="divider"></li>
            <li><a href="###" onclick="EBCMS.<?php echo $namespace; ?>.move();">移动</a></li>
            [[/if]]
          </ul>
        </div>
    </div>
</script>

<script id="<?php echo $namespace; ?>-table" type="text/html">
    [[each rows as v n]]
        <div class="media contentlist" id="<?php echo $namespace; ?>_content_[[v.id]]">
            <div class="media-left">
                <div class="thumbnail" style="width: 160px;">
                    <img src="[[v.thumb | realpath ]]" alt="">
                </div>
				<div class="input-group">
                  <span class="input-group-addon">权重</span>
                  <input type="text" class="form-control input-sm input_sort" data-id="[[v.id]]" value="[[v.sort]]" placeholder="越大越靠前">
                </div>
            </div>
            <div class="media-body">
                <div class="media-heading" style="font-size:1.5em;"><input type="checkbox" name="id" value="[[v.id]]" id="<?php echo $namespace; ?>_item_[[v.id]]"><span style="[[if v.color]]color:[[v.color]];[[/if]][[if v.bold]]font-weight:[[v.bold]];[[/if]][[if v.size>10]]font-size:[[v.size]]px;[[/if]]">[[v.title]]</span>[[if 1 == v.sort]]<sup><i class="iconfont icon-tuijian text-danger"></i></sup>[[/if]]</div>
                <div class="tips">
                    <span>ID:[[v.id]] </span>
                    <span>浏览：[[v.click]] </span>
                    <span>更新时间：[[v.update_time | unixtostr]] </span>
                    <span>收录：[[if v.baidu==1]]<i class="iconfont icon-baidu cursor-pointer text-danger" onclick="EBCMS.<?php echo $namespace; ?>.baidu('[[v.id]]');"></i>[[else]]<i class="iconfont icon-baidu cursor-pointer" onclick="EBCMS.<?php echo $namespace; ?>.baidu('[[v.id]]');"></i>[[/if]] </span>
                </div>
                <div class="description">[[v.description]]</div>
                <div style="margin:10px auto;">
                    <div class="btn-group btn-group-sm">
                        [[if access('<?php echo mca('lock'); ?>',0)]]
                            [[if v.locked==1]]
                            <button class="btn btn-primary" onclick="EBCMS.ACT.lock('<?php echo url('content/admin.content/lock'); ?>','[[v.id]]','0','<?php echo $namespace; ?>');">已锁</button>
                            [[else]]
                            <button class="btn btn-primary" onclick="EBCMS.ACT.lock('<?php echo url('content/admin.content/lock'); ?>','[[v.id]]','1','<?php echo $namespace; ?>');">未锁</button>
                            [[/if]]
                        [[/if]]
                        [[if access('<?php echo mca('status'); ?>',v.locked)]]
                            [[if v.status==99]]
                            <button class="btn btn-danger" onclick="EBCMS.ACT.status('<?php echo url('content/admin.content/status'); ?>','[[v.id]]','0','<?php echo $namespace; ?>');">不通过</button>
                            <button class="btn btn-danger" onclick="EBCMS.ACT.status('<?php echo url('content/admin.content/status'); ?>','[[v.id]]','1','<?php echo $namespace; ?>');">通过</button>
                            [[else if v.status==1]]
                            <button class="btn btn-primary" onclick="EBCMS.ACT.status('<?php echo url('content/admin.content/status'); ?>','[[v.id]]','0','<?php echo $namespace; ?>');">已通过</button>
                            [[else]]
                            <button class="btn btn-warning" onclick="EBCMS.ACT.status('<?php echo url('content/admin.content/status'); ?>','[[v.id]]','1','<?php echo $namespace; ?>');">未通过</button>
                            [[/if]]
                        [[/if]]
                        [[if access('<?php echo mca('edit'); ?>',v.locked)]]
                        <button class="btn btn-primary" onclick="EBCMS.<?php echo $namespace; ?>.edit('[[v.id]]');">编辑</button>
                        [[/if]]
                        [[if access('<?php echo mca('delete'); ?>',v.locked)]]
                        <button class="btn btn-primary" onclick="EBCMS.ACT.del('<?php echo url('content/admin.content/delete'); ?>','[[v.id]]','<?php echo $namespace; ?>');">删除</button>
                        [[/if]]
                    </div>
                    <div class="btn-group btn-group-sm">
                        [[if access('<?php echo mca('style'); ?>',v.locked)]]
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
                        [[/if]]
                        [[if access('<?php echo mca('resort'); ?>',0)]]
                        <button class="btn btn-primary" onclick="EBCMS.ACT.togglefield('<?php echo url('content/admin.content/resort'); ?>','[[v.id]]','[[if 255 == v.sort]]0[[else]]255[[/if]]','<?php echo $namespace; ?>','resort');" role="button">推荐</button>
                        [[/if]]
                    </div>
                    <div class="btn-group btn-group-sm" role="group">
                        [[if access('<?php echo mca('index','admin.comment'); ?>',0)]]
                        <button class="btn btn-primary" onclick="EBCMS.<?php echo $namespace; ?>.comment_load('[[v.id]]');" role="button">评论</button>
                        [[/if]]
                        [[if access('<?php echo mca('push','recommend'); ?>',0)]]
                        <button class="btn btn-primary" onclick="EBCMS.CORE.recommend({
                            model:'content/content',
                            id:'[[v.id]]',
                            thumb:'[[v.thumb]]',
                            url:'[[v.ebcms_url]]',
                            title:'[[v.shorttitle | escape]]',
                            description:'[[v.description | escape]]'
                            });" role="button">推送</button>
                        [[/if]]
                    </div>
                </div>
                <div id="<?php echo $namespace; ?>_content_comment_[[v.id]]"></div>
                <div id="<?php echo $namespace; ?>_content_comment_page_[[v.id]]"></div>
            </div>
        </div>
    [[/each]]
</script>

<script id="<?php echo $namespace; ?>-comment-item" type="text/html">
[[if rows.length]]
    [[each rows as v n]]
        <div class="media media-border" id="comment_id_[[v.id]]">
          <div class="media-left">
            <a href="#">
              <img class="media-object" src="<?php echo get_root(); ?>/static/index/image/avatar.gif" width="40" alt="...">
            </a>
				<div class="input-group">
                  <span class="input-group-addon">权重</span>
                  <input type="text" class="form-control input-sm input_sort" data-id="[[v.id]]" value="[[v.sort]]" placeholder="越大越靠前">
                </div>
          </div>
          <div class="media-body">
            <h4 class="media-heading">[[if v.user.nickname]]<button class="btn btn-xs" onclick="EBCMS.CORE.userinfo('[[v.user.id]]');">[[v.user.nickname]]</button>[[else /]]游客[[/if]][[if v.touser.nickname]] 回复 <button class="btn btn-xs" onclick="EBCMS.CORE.userinfo('[[v.touser.id]]');">[[v.touser.nickname]]</button>[[/if]]</h4>
            [[if v.status==99]]
                <div class="alert alert-warning">
                    <p>待审核！</p>
                    <hr>
                    <p>[[v.content]]</p>
                    <p>ip：[[v.ip]] 时间：[[v.create_time | unixtostr]]</p>
                </div>
                [[if access('<?php echo mca('pingbi','admin.comment'); ?>',0)]]
                <p>
                    <button class="btn btn-primary btn-xs" onclick="EBCMS.<?php echo $namespace; ?>.comment_pingbi('[[v.id]]','1','[[v.tid]]');">通过</button>
                    <button class="btn btn-primary btn-xs" onclick="EBCMS.<?php echo $namespace; ?>.comment_pingbi('[[v.id]]','0','[[v.tid]]');">屏蔽</button>
                </p>
                [[/if]]
            [[else if v.status==1]]
                <div class="alert alert-info">
                    <p>[[v.content]][[if 1 == v.sort]]<sup><i class="iconfont icon-tuijian text-danger"></i></sup>[[/if]]</p>
                    <p>ip：[[v.ip]] 时间：[[v.create_time | unixtostr]]</p>
                </div>
                <p>
                    [[if access('<?php echo mca('index','admin.comment'); ?>',0)]]
                    <button class="btn btn-primary btn-xs" onclick="EBCMS.<?php echo $namespace; ?>.comment_pingbi('[[v.id]]','0','[[v.tid]]');">屏蔽</button>
                    [[/if]]
                    [[if access('<?php echo mca('resort','admin.comment'); ?>',0)]]
                    <button class="btn btn-primary btn-xs" onclick="EBCMS.<?php echo $namespace; ?>.comment_tuijian('[[v.id]]','[[if 1 == v.sort]]0[[else]]1[[/if]]');" role="button">推荐</button>
                    [[/if]]
                </p>
            [[else]]
                <div class="alert alert-danger">
                    <p><del><b>[[v.content]]</b></del></p>
                    <p>ip：[[v.ip]] 时间：[[v.create_time | unixtostr]]</p>
                </div>
                [[if access('<?php echo mca('index','admin.comment'); ?>',0)]]
                <p>
                    <button class="btn btn-primary btn-xs" onclick="EBCMS.<?php echo $namespace; ?>.comment_pingbi('[[v.id]]','1','[[v.tid]]');">撤销</button>
                </p>
                [[/if]]
            [[/if]]
            [[if v.rows]]
                [[include '<?php echo $namespace; ?>-comment-item' v]]
            [[/if]]
          </div>
        </div>
    [[/each]]
[[else]]
    <div class="alert alert-danger">暂无评论</div>
[[/if]]
</script>