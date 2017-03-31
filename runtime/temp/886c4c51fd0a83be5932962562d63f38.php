<?php if (!defined('THINK_PATH')) exit(); /*a:1:{s:65:"E:\workspace-php\l7cms/application/admin\view\recommend\push.html";i:1472111959;}*/ ?>
<?php $namespace = ns(); ?>
<script>
    Namespace.register("EBCMS.<?php echo $namespace; ?>temp");
    $(function(){
        EBCMS.<?php echo $namespace; ?>temp.push = function push(){
            EBCMS.CORE.submit({
                url:'<?php echo url('admin/recommend/push'); ?>',
                form:'<?php echo $namespace; ?>temp_Push_Form',
                success:function(res){
                    EBCMS.MSG.notice(res.msg);
                    $('#lgModal').modal('hide');
                }
            });
        };
        EBCMS.FN.renderPic('#<?php echo $namespace; ?>tempPushthumb');
    });
</script>
<div class="modal-header">
    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
    <h4 class="modal-title">推送服务</h4>
</div>
<div class="modal-body">
    <form class="form-horizontal" id="<?php echo $namespace; ?>temp_Push_Form">
        <div class="row">
            <div class="col-md-4">
                <div id="<?php echo $namespace; ?>temp_recommendtypecontainer"></div>
            </div>
            <div class="col-md-8">
                <!-- <hr> -->
                <div class="form-group">
                    <label for="<?php echo $namespace; ?>tempPushtitle" class="col-sm-2 control-label">标题</label>
                    <div class="col-sm-10">
                        <input type="text" name="title" value="<?php echo input('title'); ?>" class="form-control" id="<?php echo $namespace; ?>tempPushtitle" placeholder="标题">
                    </div>
                </div>
                <div class="form-group">
                    <label for="<?php echo $namespace; ?>tempPushebcms_url" class="col-sm-2 control-label">链接</label>
                    <div class="col-sm-10">
                        <input type="text" name="ebcms_url" value="<?php echo input('ebcms_url'); ?>" class="form-control" id="<?php echo $namespace; ?>tempPushebcms_url" placeholder="http://">
                        <p class="help-block">推送的内容链接地址已自动生成，若要自定义链接地址，请填写完整的链接地址！</p>
                    </div>
                </div>
                <div class="form-group">
                    <label for="<?php echo $namespace; ?>tempPushdescription" class="col-sm-2 control-label">简介</label>
                    <div class="col-sm-10">
                        <textarea class="form-control" name="description" rows="7" id="<?php echo $namespace; ?>tempPushdescription" placeholder="一般不要超过250个字符"><?php echo input('description'); ?></textarea>
                    </div>
                </div>
                <div class="form-group">
                    <label for="<?php echo $namespace; ?>tempPushthumb" class="col-sm-2 control-label">缩略图</label>
                    <div class="col-sm-8">
                        <input type="text" name="thumb" value="<?php echo input('thumb'); ?>" class="form-control" id="<?php echo $namespace; ?>tempPushthumb" placeholder="">
                    </div>
                    <div class="col-sm-2">
                        <div id="<?php echo $namespace; ?>tempPushthumbPicker" style="width:100%;height:20px;" onmouseover="$(this).resize();">上传</div>
                    </div>
                </div>
                <div class="form-group">
                    <label for="<?php echo $namespace; ?>tempPushsort" class="col-sm-2 control-label">权重</label>
                    <div class="col-sm-10">
                        <input type="number" min="1" max="99" name="sort" value="0" class="form-control" id="<?php echo $namespace; ?>tempPushsort" placeholder="">
                    </div>
                </div>
                <input type="hidden" name="content_id" value="<?php echo input('id'); ?>">
                <input type="hidden" name="model" value="<?php echo input('model'); ?>">
            </div>
        </div>
    </form>
</div>
<div class="modal-footer">
    <button type="button" class="btn btn-success" onclick="EBCMS.<?php echo $namespace; ?>temp.push();">提交</button>
    <button type="button" class="btn btn-default" data-dismiss="modal">关闭</button>
</div>
<script>
    $(function(){
        EBCMS.<?php echo $namespace; ?>temp.recommendtyperefresh = function recommendtyperefresh(){
            EBCMS.CORE.load({
                url:'<?php echo url('admin/recommend/push'); ?>',
                queryParams:{
                    __type:'getrecommendtype',
                    model:'<?php echo input('model'); ?>',
                    content_id:'<?php echo input('id'); ?>',
                },
                group:'group',
                tpl:'<?php echo $namespace; ?>temp-recommendtype-table',
                target:'#<?php echo $namespace; ?>temp_recommendtypecontainer',
            });
        };
        EBCMS.<?php echo $namespace; ?>temp.recommendtyperefresh();
    });
</script>
<script id="<?php echo $namespace; ?>temp-recommendtype-table" type="text/html">
    <div class="table-responsive">
        <table class="table table-bordered table-hover table-ebcms">
            <tbody>
                <!-- <tr>
                    <th>check</th>
                    <th>推荐位</th>
                    <th>标志</th>
                </tr> -->
                [[each groups as data group]]
                    <tr>
                        <th colspan="3">[[group]]</th>
                    </tr>
                    [[include '<?php echo $namespace; ?>temp-recommendtype-table-item' data]]
                [[/each]]
            </tbody>
        </table>
    </div>
</script>
<script id="<?php echo $namespace; ?>temp-recommendtype-table-item" type="text/html">
    [[each rows as v n]]
        <tr>
            <td>
                <input type="checkbox" name="category_ids[]" value="[[v.id]]" [[if v.checked]]checked[[/if]]>
            </td>
            <td>[[v.title]]</td>
            <td>[[v.mark]]</td>
        </tr>
    [[/each]]
</script>