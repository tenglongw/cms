<script>
    Namespace.register("EBCMS.{$namespace}");
    $(function(){
        EBCMS.{$namespace}.queryParams = {
            page:1,
            rows:20,
            order:{
                'sort':'desc',
                'id':'desc',
            },
            model:'admin/guestbook',
        };
        EBCMS.{$namespace}.refresh = function refresh(p){
            if (p) {
                $.each(p, function(index, val) {
                    if (typeof val == 'object') {
                        EBCMS.{$namespace}.queryParams[index] = $.extend(EBCMS.{$namespace}.queryParams[index], p[index]);
                        delete p[index];
                    };
                });
                $.extend(EBCMS.{$namespace}.queryParams, p);
            };
            EBCMS.CORE.api({
                queryParams:EBCMS.{$namespace}.queryParams,
                tpl:'{$namespace}-table',
                target:'#{$namespace}_table',
                compileAfter:function(p){
                    $('#{$namespace}_table').find('.input_sort').focus(function(){
                        EBCMS.{$namespace}.sortvalue = $(this).val();
                    }).blur(function(){
                        var $this = $(this);
                        if ($this.val() != EBCMS.{$namespace}.sortvalue) {
                            EBCMS.ACT.togglefield('{:url('admin/guestbook/resort')}',$this.data('id'),$this.val(),'{$namespace}','resort');
                        };
                    });
                    EBCMS.FN.renderPage({
                        namespace:'{$namespace}',
                        total:p.data.total,
                    });
                    EBCMS.FN.renderFilter({
                        namespace:'{$namespace}',
                        filter:{
                            search:{
                                field:'nickname|mobile|content|reply',
                                value:''
                            },
                            lock:{
                                field:'locked',
                            },
                            status:{
                                field:'status',
                                filters:{'待审核':99,"已通过":1,'已屏蔽':0}
                            },
                            order:{
                                filters:{id:'id',update_time:'修改时间',create_time:'提交时间'}
                            },
                            rows:true,
                        }
                    });
                },
            });
        };
        EBCMS.{$namespace}.edit = function edit(id){
            EBCMS.CORE.get({
                url:'{:url('admin/guestbook/edit')}',
                queryParams:{
                    id:id,
                },
                target:'#lgModal .modal-content',
            });
        };
        EBCMS.{$namespace}.reply = function reply(id){
            EBCMS.CORE.get({
                url:'{:url('admin/guestbook/reply')}',
                queryParams:{
                    id:id,
                },
                target:'#lgModal .modal-content',
            });
        };
        EBCMS.CORE.compile({
            tpl:'{$namespace}-box',
            target:'#{$namespace}_box',
            compileAfter:function(){
                EBCMS.{$namespace}.refresh();
            }
        });
    });
</script>

    

<script id="{$namespace}-box" type="text/html">
    <div class="header">
        <div class="footer-page" id="{$namespace}_filter"></div>
        <div class="header-title" onclick="EBCMS.{$namespace}.refresh();">留言管理</div>
        <div class="btn-group">
            <button class="btn btn-primary" onclick="EBCMS.CORE.getconfig('{:eb_encrypt('name|guestbook')}');">设置</button>
            <!-- <button class="btn btn-primary" onclick="EBCMS.{$namespace}.add();">添加</button> -->
        </div>
    </div>
    <div class="body">
        <div id="{$namespace}_table" class="box"></div>
    </div>
    <div class="footer">
        <div id="{$namespace}_page" class="footer-page"></div>
        <div class="btn-group dropup">
          <button type="button" class="btn btn-primary" onclick="EBCMS.FN.inverse('{$namespace}');">选中(反选)</button>
          <button type="button" class="btn btn-primary dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            <span class="caret"></span>
            <span class="sr-only">Toggle Dropdown</span>
          </button>
          <ul class="dropdown-menu">
            [[if access('{:mca('delete')}',0)]]
            <li><a href="###" onclick="EBCMS.ACT.dels('{:url('admin/guestbook/delete')}','{$namespace}');">批量删除</a></li>
            [[/if]]
            [[if access('{:mca('status')}',0)]]
            <li role="separator" class="divider"></li>
            <li><a href="###" onclick="EBCMS.ACT.statuss('{:url('admin/guestbook/status')}',1,'{$namespace}');">批量审核</a></li>
            <li><a href="###" onclick="EBCMS.ACT.statuss('{:url('admin/guestbook/status')}',0,'{$namespace}');">取消审核</a></li>
            [[/if]]
            [[if access('{:mca('lock')}',0)]]
            <li role="separator" class="divider"></li>
            <li><a href="###" onclick="EBCMS.ACT.locks('{:url('admin/guestbook/lock')}',0,'{$namespace}');">批量解锁</a></li>
            <li><a href="###" onclick="EBCMS.ACT.locks('{:url('admin/guestbook/lock')}',1,'{$namespace}');">批量锁定</a></li>
            [[/if]]
          </ul>
        </div>
    </div>
</script>

<script id="{$namespace}-table" type="text/html">
    [[each rows as v n]]
    <div class="media articlelist">
        <div class="media-left">
            <div style="width:60px;">
                <img src="{:get_root()}/static/index/image/avatar.gif" alt="">
                <h5 class="text-center"><span class="label label-danger">[[v.nickname]]</span></h5>
                <p><input type="checkbox" name="id" value="[[v.id]]" id="{$namespace}_item_[[v.id]]"></p>
            </div>
        </div>
        <div class="media-body">
            <div class="alert alert-info">
                <p>[[v.content]][[if 1 == v.sort]]<sup><i class="iconfont icon-tuijian text-danger"></i></sup>[[/if]]</p>
                <p>联系电话：[[v.mobile]] 留言时间：[[v.create_time | unixtostr]]</p>
            </div>
            [[if v.reply]]
            <div class="media">
                <div class="media-body">
                    <div class="alert alert-danger">
                        <p>[[v.reply]]</p>
                        <p>回复时间：[[v.update_time | unixtostr]]</p>
                    </div>
                </div>
                <div class="media-right">
                    <div style="width:60px;">
                        <img src="{:get_root()}/static/index/image/sign.png" alt="">
                    </div>
                </div>
            </div>
            [[/if]]
            <div>
                <div class="btn-group btn-group-sm">
                    [[if access('{:mca('lock')}',0)]]
                        [[if v.locked==1]]
                        <button class="btn btn-primary" onclick="EBCMS.ACT.lock('{:url('admin/guestbook/lock')}','[[v.id]]','0','{$namespace}');">已锁</button>
                        [[else]]
                        <button class="btn btn-primary" onclick="EBCMS.ACT.lock('{:url('admin/guestbook/lock')}','[[v.id]]','1','{$namespace}');">未锁</button>
                        [[/if]]
                    [[/if]]
                    [[if access('{:mca('status')}',v.locked)]]
                        [[if v.status==99]]
                        <button class="btn btn-danger" onclick="EBCMS.ACT.status('{:url('admin/guestbook/status')}','[[v.id]]','1','{$namespace}');">通过</button>
                        <button class="btn btn-danger" onclick="EBCMS.ACT.status('{:url('admin/guestbook/status')}','[[v.id]]','0','{$namespace}');">屏蔽</button>
                        [[else if v.status==1]]
                        <button class="btn btn-primary" onclick="EBCMS.ACT.status('{:url('admin/guestbook/status')}','[[v.id]]','0','{$namespace}');">已通过</button>
                        [[else]]
                        <button class="btn btn-warning" onclick="EBCMS.ACT.status('{:url('admin/guestbook/status')}','[[v.id]]','1','{$namespace}');">已屏蔽</button>
                        [[/if]]
                    [[/if]]
                    [[if access('{:mca('edit')}',v.locked)]]
                    <button class="btn btn-primary" onclick="EBCMS.{$namespace}.edit('[[v.id]]');">编辑</button>
                    [[/if]]
                    [[if access('{:mca('reply')}',v.locked)]]
                    <button class="btn btn-primary" onclick="EBCMS.{$namespace}.reply('[[v.id]]');">回复</button>
                    [[/if]]
                    [[if access('{:mca('resort')}',v.locked)]]
                    <button class="btn btn-primary" onclick="EBCMS.ACT.togglefield('{:url('admin/guestbook/resort')}','[[v.id]]','[[if 1 == v.sort]]0[[else]]1[[/if]]','{$namespace}','resort');" role="button">推荐</button>
                    [[/if]]
                    [[if access('{:mca('delete')}',v.locked)]]
                    <button class="btn btn-primary" onclick="EBCMS.ACT.del('{:url('admin/guestbook/delete')}','[[v.id]]','{$namespace}');">删除</button>
                    [[/if]]
                    [[if access('{:mca('push','recommend')}',0)]]
                    <button class="btn btn-primary" onclick="EBCMS.CORE.recommend({
                        model:'guestbook/guestbook',
                        id:'[[v.id]]',
                        push_url:'index/guestbook/index#id=[[v.id]]',
                        title:'[[v.content | escape]]',
                        description:'[[v.reply | escape]]',
                        });" role="button">推送</a>
                    [[/if]]
                </div>
            </div>
        </div>
    </div>
    [[/each]]
</script>