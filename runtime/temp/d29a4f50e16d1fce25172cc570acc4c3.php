<?php if (!defined('THINK_PATH')) exit(); /*a:1:{s:62:"E:\workspace-php\l7cms/application/admin\view\common\form.html";i:1482399991;}*/ ?>
<?php if($__modal == '1'): ?>
<script>Namespace.register("EBCMS.Forms");$(function(){EBCMS.Forms.FormSubmit = function FormSubmit(){
var x = <?php echo (isset($_form['ext']) && ($_form['ext'] !== '')?$_form['ext']:'new Object'); ?>;if (x.submit_alert == 1) {EBCMS.MSG.confirm(x.submit_msg,function(){EBCMS.CORE.submit({
url:'<?php echo $_form['action']; ?>',form:'<?php echo $_form['formtime']; ?>Form',success:function(data){
if (data.code) {EBCMS.MSG.notice(data.msg);$('#lgModal').modal('hide');if (EBCMS.<?php echo $namespace; ?> && EBCMS.<?php echo $namespace; ?>.refresh && typeof EBCMS.<?php echo $namespace; ?>.refresh == 'function') {EBCMS.<?php echo $namespace; ?>.refresh();};}else{
if (data.data.action) {EBCMS.MSG.confirm(data.msg,function(){
if (EBCMS[data.data.namespace] && EBCMS[data.data.namespace][data.data.action] && typeof EBCMS[data.data.namespace][data.data.action] == 'function') {EBCMS[data.data.namespace][data.data.action](data.data.param);}else{EBCMS.MSG.alert('后台参数错误！');}});}else{EBCMS.MSG.alert(data.msg);}}}});});}else{EBCMS.CORE.submit({
url:'<?php echo $_form['action']; ?>',form:'<?php echo $_form['formtime']; ?>Form',success:function(data){
if (data.code) {EBCMS.MSG.notice(data.msg);$('#lgModal').modal('hide');if (EBCMS.<?php echo $namespace; ?> && EBCMS.<?php echo $namespace; ?>.refresh && typeof EBCMS.<?php echo $namespace; ?>.refresh == 'function') {EBCMS.<?php echo $namespace; ?>.refresh();};}else{
if (data.data.action) {EBCMS.MSG.confirm(data.msg,function(){
if (EBCMS[data.data.namespace] && EBCMS[data.data.namespace][data.data.action] && typeof EBCMS[data.data.namespace][data.data.action] == 'function') {EBCMS[data.data.namespace][data.data.action](data.data.param);}else{EBCMS.MSG.alert('后台参数错误！');}});}else{EBCMS.MSG.alert(data.msg);}}}});}};EBCMS.FN.tabs('#<?php echo $_form['formtime']; ?>_tabs','#<?php echo $_form['formtime']; ?>_tabboxs');});</script>
<div class="modal-header">
	<button type="button" class="close" data-dismiss="modal"
		aria-label="Close">
		<span aria-hidden="true">&times;</span>
	</button>
	<h4 class="modal-title text-danger">
		<b>
			<?php echo $_form['group']; ?>&nbsp;-&nbsp;<?php echo $_form['title']; ?>
		</b>
	</h4>
</div>
<div class="modal-body">
	<form class="form-horizontal"
		id="<?php echo $_form['formtime']; ?>Form">
		<div class="tabs" id="<?php echo $_form['formtime']; ?>_tabs">
			<?php foreach($_groups as $key => $_fields): ?>
			<div class="tab-head">
				<?php echo $key; ?>
			</div>
			<?php endforeach; if(!(empty($_extgroups) || ($_extgroups instanceof \think\Collection && $_extgroups->isEmpty()))): foreach($_extgroups as $key => $_fields): ?>
			<div class="tab-head">
				<?php echo $key; ?>
			</div>
			<?php endforeach; endif; ?>
		</div>
		<div class="tabboxs" id="<?php echo $_form['formtime']; ?>_tabboxs">
			<?php foreach($_groups as $key => $_fields): ?>
			<div class="tab-body">
				<?php foreach($_fields as $key => $_field): 
$_nowtime = time();$_ns = 'ebcms_'.md5('ebcmsformfield_'.$_field['field'].$_nowtime);$_field['config']['disabled'] = isset($_field['config']['disabled'])?$_field['config']['disabled']:0;$_field['config']['required'] = isset($_field['config']['required'])?$_field['config']['required']:0;$_field['config']['readonly'] = isset($_field['config']['readonly'])?$_field['config']['readonly']:0;if($_field['type'] == 'hidden'): ?>
				<input type="hidden" name="<?php echo $_field['field']; ?>"
					value="<?php echo $_field['value']; ?>" />
				<?php elseif($_field['type'] == 'extend'): ?>
				<script>Namespace.register("EBCMS.Form");$(function() {EBCMS.Form.changename = function(id,value){
if ($(id).is('div')) {
$(id).next().attr('name','<?php echo $_field['field']; ?>['+value+']');}else{
$(id).attr('name','<?php echo $_field['field']; ?>['+value+']');}$(id+'__config__').attr('name','<?php echo $_field['field']; ?>[__config__]['+value+']');};EBCMS.Form.up = function(id){
if ($(id).prev().hasClass('form-group')) {
$(id).insertBefore($(id).prev());}};EBCMS.Form.down = function(id){
if ($(id).next().hasClass('form-group')) {
$(id).next().insertBefore($(id));}};EBCMS.Form.render = function(name,value,target){
if (EBCMS.Form.config[name]) {
}else{EBCMS.Form.config[name] = 'text';}if (EBCMS.Form['render_'+EBCMS.Form.config[name]]) {EBCMS.Form['render_'+EBCMS.Form.config[name]](name,value,target);}};EBCMS.Form.render_text = function(name,value,target){
name = name||'EB_' + EBCMS.FN.random_str(6);opt = {
name:name,value:value||'',id:'<?php echo $_ns; ?>_' + EBCMS.FN.random_str(15),};var str = '';str += '<div class="form-group" id="'+opt.id+'_group">';str += '<div class="col-sm-1 control-label"><label>';str += '<i class="iconfont icon-shanchu cursor-pointer" onclick="$(\'#'+opt.id+'_group\').remove();"></i>';str += '<i class="iconfont icon-xiayi cursor-pointer" onclick="EBCMS.Form.down(\'#'+opt.id+'_group\');"></i>';str += '<i class="iconfont icon-shangyi cursor-pointer" onclick="EBCMS.Form.up(\'#'+opt.id+'_group\');"></i>';str += '<label></div>';str += '<div class="col-sm-2">';str += '<input type="text" class="form-control" value="'+opt.name+'" onKeyUp="EBCMS.Form.changename(\'#'+opt.id+'\',$(this).val());" placeholder="填写名称">';str += '</div>';str += '<div class="col-sm-9">';str += '<input type="text" class="form-control" id="'+opt.id+'" name="<?php echo $_field['field']; ?>['+opt.name+']" value="'+opt.value+'" placeholder="填写值">';str += '</div>';str += '<input type="hidden" id="'+opt.id+'__config__" name="<?php echo $_field['field']; ?>[__config__]['+opt.name+']" value="text">';str += '</div>';if (target) {
$(target).append(str);}else{
return str;}};EBCMS.Form.render_textarea = function(name,value,target){
name = name||'EB_' + EBCMS.FN.random_str(6);opt = {
name:name,value:value||'',id:'<?php echo $_ns; ?>_' + EBCMS.FN.random_str(15),};var str = '';str += '<div class="form-group" id="'+opt.id+'_group">';str += '<div class="col-sm-1 control-label"><label>';str += '<i class="iconfont icon-shanchu cursor-pointer" onclick="$(\'#'+opt.id+'_group\').remove();"></i>';str += '<i class="iconfont icon-xiayi cursor-pointer" onclick="EBCMS.Form.down(\'#'+opt.id+'_group\');"></i>';str += '<i class="iconfont icon-shangyi cursor-pointer" onclick="EBCMS.Form.up(\'#'+opt.id+'_group\');"></i>';str += '<label></div>';str += '<div class="col-sm-2">';str += '<input type="text" class="form-control" value="'+opt.name+'" onKeyUp="EBCMS.Form.changename(\'#'+opt.id+'\',$(this).val());" placeholder="填写名称">';str += '</div>';str += '<div class="col-sm-9">';str += '<textarea class="form-control" id="'+opt.id+'" name="<?php echo $_field['field']; ?>['+opt.name+']" rows="3" placeholder="填写内容">'+opt.value+'</textarea>';str += '</div>';str += '<input type="hidden" id="'+opt.id+'__config__" name="<?php echo $_field['field']; ?>[__config__]['+opt.name+']" value="textarea">';str += '</div>';if (target) {
$(target).append(str);}else{
return str;}};EBCMS.Form.render_file = function(name,value,target){
name = name||'EB_' + EBCMS.FN.random_str(6);opt = {
name:name,value:value||'',id:'<?php echo $_ns; ?>_' + EBCMS.FN.random_str(15),};var str = '';str += '<div class="form-group" id="'+opt.id+'_group">';str += '<div class="col-sm-1 control-label"><label>';str += '<i class="iconfont icon-shanchu cursor-pointer" onclick="$(\'#'+opt.id+'_group\').remove();"></i>';str += '<i class="iconfont icon-xiayi cursor-pointer" onclick="EBCMS.Form.down(\'#'+opt.id+'_group\');"></i>';str += '<i class="iconfont icon-shangyi cursor-pointer" onclick="EBCMS.Form.up(\'#'+opt.id+'_group\');"></i>';str += '<label></div>';str += '<div class="col-sm-2">';str += '<input type="text" class="form-control" value="'+opt.name+'" onKeyUp="EBCMS.Form.changename(\'#'+opt.id+'\',$(this).val());" placeholder="填写名称">';str += '</div>';str += '<div class="col-sm-7">';str += '<input type="text" class="form-control" id="'+opt.id+'" name="<?php echo $_field['field']; ?>['+opt.name+']" value="'+opt.value+'" placeholder="填写值">';str += '</div>';str += '<div class="col-sm-2">';str += '<div id="'+opt.id+'Picker">上传</div>';str += '</div>';str += '<input type="hidden" id="'+opt.id+'__config__" name="<?php echo $_field['field']; ?>[__config__]['+opt.name+']" value="file">';str += '<script>';str += '$(function(){';str += '    EBCMS.FN.renderFile(\'#'+opt.id+'\');';str += '});';str += '<\/script>';str += '</div>';if (target) {
$(target).append(str);}else{
return str;}};EBCMS.Form.render_ueditor = function(name,value,target){
name = name||'EB_' + EBCMS.FN.random_str(6);opt = {
name:name,value:value||'',id:'<?php echo $_ns; ?>_' + EBCMS.FN.random_str(15),};var str = '';str += '<div class="form-group" id="'+opt.id+'_group">';str += '<div class="col-sm-1 control-label"><label>';str += '<i class="iconfont icon-shanchu cursor-pointer" onclick="$(\'#'+opt.id+'_group\').remove();"></i>';str += '<i class="iconfont icon-xiayi cursor-pointer" onclick="EBCMS.Form.down(\'#'+opt.id+'_group\');"></i>';str += '<i class="iconfont icon-shangyi cursor-pointer" onclick="EBCMS.Form.up(\'#'+opt.id+'_group\');"></i>';str += '<label></div>';str += '<div class="col-sm-2">';str += '<input type="text" class="form-control" value="'+opt.name+'" onKeyUp="EBCMS.Form.changename(\'#'+opt.id+'\',$(this).val());" placeholder="填写名称">';str += '</div>';str += '<div class="col-sm-9">';str += '<textarea id="'+opt.id+'" name="<?php echo $_field['field']; ?>['+opt.name+']" >'+opt.value+'</textarea>';str += '</div>';str += '<input type="hidden" id="'+opt.id+'__config__" name="<?php echo $_field['field']; ?>[__config__]['+opt.name+']" value="ueditor">';str += '<script>';str += '$(function(){';str += '    EBCMS.FN.renderUE("'+opt.id+'",{';str += '          autoHeightEnabled:false,';str += '          maximumWords:99999,';str += '          wordCount:true,';str += '          elementPathEnabled:true,';str += '          initialFrameHeight:400,';str += '    });';str += '});';str += '<\/script>';str += '</div>';if (target) {
$(target).append(str);}else{
return str;}};var forms = <?php echo json_encode($_field['value']); ?>||{};if (typeof forms!='object') {
forms = {};}EBCMS.Form.config = forms['__config__']||{};delete forms['__config__'];$.each(forms, function(name, val) {EBCMS.Form.render(name,val,'#<?php echo $_field['id']; ?>_container');});});</script>
				<div class="row">
					<div class="col-sm-12">
						<div class="btn-group" role="group" aria-label="...">
							<button type="button" class="btn btn-primary btn-sm"
								onclick="EBCMS.Form.render_text('','','#<?php echo $_field['id']; ?>_container');">单行文本</button>
							<button type="button" class="btn btn-primary btn-sm"
								onclick="EBCMS.Form.render_textarea('','','#<?php echo $_field['id']; ?>_container');">多行文本</button>
							<button type="button" class="btn btn-primary btn-sm"
								onclick="EBCMS.Form.render_file('','','#<?php echo $_field['id']; ?>_container');">文件</button>
							<button type="button" class="btn btn-primary btn-sm"
								onclick="EBCMS.Form.render_ueditor('','','#<?php echo $_field['id']; ?>_container');">编辑框</button>
						</div>
					</div>
				</div>
				<br>
				<div class="row">
					<div class="col-sm-12" id="<?php echo $_field['id']; ?>_container"></div>
				</div>
				<input type="hidden"
					name="<?php echo $_field['field']; ?>[__config__][__test__]"
					value='test'>
				<?php else: ?>
				<div class="form-group">
					<label for="<?php echo $_ns; ?>" class="col-sm-2 control-label">
						<?php echo $_field['title']; ?>
					</label>
					<div class="col-sm-10">
						<?php switch($_field['type']): case "bool": ?>
						<label class="radio-inline" for="<?php echo $_ns; ?>_1"><input
							type="radio" id="<?php echo $_ns; ?>_1"
							name="<?php echo $_field['field']; ?>" value="1"<?php
							if($_field['value'] == '1'): ?>checked<?php endif; if($_field['config']['disabled'] == '1'): ?>
							disabled<?php endif; if($_field['config']['readonly'] == '1'): ?>
							readonly<?php endif; ?>> 是</label><label class="radio-inline"
							for="<?php echo $_ns; ?>_0"><input type="radio"
							id="<?php echo $_ns; ?>_0" name="<?php echo $_field['field']; ?>"
							value="0"<?php if($_field['value'] == '0'): ?>checked<?php endif; if($_field['config']['disabled'] == '1'): ?>
							disabled<?php endif; if($_field['config']['readonly'] == '1'): ?>
							readonly<?php endif; ?>> 否</label>
						<?php break; case "select": 
$_temps = explode("\r\n",$_field['config']['values']);$_field['config']['editable'] = isset($_field['config']['editable'])?$_field['config']['editable']:0;if($_field['config']['editable'] == '1'): ?>
						<div class="row">
							<div class="col-md-8">
								<input type="text" class="form-control"
									id="<?php echo $_ns; ?>_obj"
									name="<?php echo $_field['field']; ?>"
									value="<?php echo $_field['value']; ?>"
									placeholder="<?php echo (isset($_field['config']['prompt']) && ($_field['config']['prompt'] !== '')?$_field['config']['prompt']:''); ?>"<?php
								if($_field['config']['readonly'] == '1'): ?> readonly
								<?php endif; if($_field['config']['disabled'] == '1'): ?>
								disabled
								<?php endif; if($_field['config']['required'] == '1'): ?>
								required
								<?php endif; ?>
								>
							</div>
							<div class="col-md-4">
								<select class="form-control" id="<?php echo $_ns; ?>"
									onchange="$('#<?php echo $_ns; ?>_obj').val($(this).val());"<?php
									if($_field['config']['readonly'] == '1'): ?> readonly
									<?php endif; if($_field['config']['disabled'] == '1'): ?>
									disabled
									<?php endif; if($_field['config']['required'] == '1'): ?>
									required
									<?php endif; ?>>
									<?php if(is_array($_temps) || $_temps instanceof \think\Collection): if( count($_temps)==0 ) : echo "" ;else: foreach($_temps as $key=>$_temp): $_temp = explode("|",$_temp); ?>
									<option value="<?php echo $_temp[1]; ?>"<?php
										if($_field['value'] == $_temp[1]): ?>selected
										<?php endif; ?>>
										<?php echo $_temp[0]; ?></option>
									<?php endforeach; endif; else: echo "" ;endif; ?>
								</select>
							</div>
						</div>
						<?php else: ?>
						<select class="form-control" id="<?php echo $_ns; ?>"
							name="<?php echo $_field['field']; ?>"<?php
							if($_field['config']['readonly'] == '1'): ?> readonly
							<?php endif; if($_field['config']['disabled'] == '1'): ?>
							disabled
							<?php endif; if($_field['config']['required'] == '1'): ?>
							required
							<?php endif; ?>>
							<?php if(is_array($_temps) || $_temps instanceof \think\Collection): if( count($_temps)==0 ) : echo "" ;else: foreach($_temps as $key=>$_temp): $_temp = explode("|",$_temp); ?>
							<option value="<?php echo $_temp[1]; ?>"<?php
								if($_field['value'] == $_temp[1]): ?>selected
								<?php endif; ?>>
								<?php echo $_temp[0]; ?></option>
							<?php endforeach; endif; else: echo "" ;endif; ?>
						</select>
						<?php endif; break; case "radio": $_temps = explode("\r\n",$_field['config']['values']); if(is_array($_temps) || $_temps instanceof \think\Collection): if( count($_temps)==0 ) : echo "" ;else: foreach($_temps as $key=>$_temp): $_temp = explode("|",$_temp); ?>
						<label class="radio-inline"
							for="<?php echo $_ns; ?>_<?php echo $key; ?>"><input
							type="radio" name="<?php echo $_field['field']; ?>"
							id="<?php echo $_ns; ?>_<?php echo $key; ?>"
							value="<?php echo $_temp[1]; ?>"<?php
							if($_field['value'] == $_temp[1]): ?>checked<?php endif; if($_field['config']['disabled'] == '1'): ?>
							disabled<?php endif; if($_field['config']['readonly'] == '1'): ?>
							readonly<?php endif; ?>> <?php echo $_temp[0]; ?></label>
						<?php endforeach; endif; else: echo "" ;endif; break; case "checkbox": $_temps = explode("\r\n",$_field['config']['values']); if(is_array($_temps) || $_temps instanceof \think\Collection): if( count($_temps)==0 ) : echo "" ;else: foreach($_temps as $key=>$_temp): $_temp = explode("|",$_temp); ?>
						<label class="checkbox-inline"
							for="<?php echo $_ns; ?>_<?php echo $key; ?>"><input
							type="checkbox" id="<?php echo $_ns; ?>_<?php echo $key; ?>"
							name="<?php echo $_field['field']; ?>[]"
							value="<?php echo $_temp[1]; ?>"<?php
							if(in_array(($_temp['1']),
							is_array($_field['value'])?$_field['value']:explode(',',$_field['value']))):
							?>checked<?php endif; if($_field['config']['disabled'] == '1'): ?>
							disabled<?php endif; if($_field['config']['readonly'] == '1'): ?>
							readonly<?php endif; ?>> <?php echo $_temp[0]; ?></label>
						<?php endforeach; endif; else: echo "" ;endif; break; case "textbox": ?>
						<input type="text" class="form-control" id="<?php echo $_ns; ?>"
							name="<?php echo $_field['field']; ?>"
							value="<?php echo $_field['value']; ?>"
							placeholder="<?php echo (isset($_field['config']['prompt']) && ($_field['config']['prompt'] !== '')?$_field['config']['prompt']:''); ?>"<?php
						if($_field['config']['readonly'] == '1'): ?> readonly
						<?php endif; if($_field['config']['disabled'] == '1'): ?>
						disabled
						<?php endif; if($_field['config']['required'] == '1'): ?>
						required
						<?php endif; ?>
						>
						<?php break; case "multitextbox": ?>
						<textarea class="form-control" id="<?php echo $_ns; ?>"
							name="<?php echo $_field['field']; ?>"
							rows="<?php echo (isset($_field['config']['height']) && ($_field['config']['height'] !== '')?$_field['config']['height']:'5'); ?>"
							placeholder="<?php echo (isset($_field['config']['prompt']) && ($_field['config']['prompt'] !== '')?$_field['config']['prompt']:''); ?>"<?php if($_field['config']['disabled'] == '1'): ?> disabled<?php endif; if($_field['config']['readonly'] == '1'): ?> readonly<?php endif; if($_field['config']['required'] == '1'): ?> required<?php endif; ?>><?php echo $_field['value']; ?></textarea>
						<?php break; case "image": ?>
						<script>$(function(){EBCMS.FN.renderPic('#<?php echo $_ns; ?>'<?php if(!(empty($_field['config']['extensions']) || ($_field['config']['extensions'] instanceof \think\Collection && $_field['config']['extensions']->isEmpty()))): ?>,'<?php echo $_field['config']['extensions']; ?>'<?php endif; ?>);});</script>
						<div class="row">
							<div class="col-md-10">
								<input id="<?php echo $_ns; ?>" class="form-control"
									name="<?php echo $_field['field']; ?>"
									value="<?php echo $_field['value']; ?>"
									placeholder="<?php echo (isset($_field['config']['prompt']) && ($_field['config']['prompt'] !== '')?$_field['config']['prompt']:''); ?>"<?php
								if($_field['config']['disabled'] == '1'): ?> disabled
								<?php endif; if($_field['config']['readonly'] == '1'): ?>
								readonly
								<?php endif; if($_field['config']['required'] == '1'): ?>
								required
								<?php endif; ?>
								/>
							</div>
							<div class="col-md-2">
								<div id="<?php echo $_ns; ?>Picker">上传</div>
							</div>
						</div>
						<?php break; case "images": ?>
						<script>$(function(){EBCMS.TEMP.temp_<?php echo $_field['id']; ?>_renderPics = function(container,extensions,picker){
extensions = extensions?extensions:'gif,jpg,jpeg,bmp,png';var pick = picker||container + 'Picker';var uploader = WebUploader.create({
auto: true,swf: EBCMS.DATA.config.WebUploader_swf,server: EBCMS.DATA.config.WebUploader_server,pick: pick,accept: {
title: 'Images',extensions: extensions,mimeTypes: 'image/*'
}});$(pick).mouseover(function(){
$(this).resize();});uploader.on( 'error', function(code) {EBCMS.MSG.webuploaderMsg(code);});uploader.on( 'uploadError', function( file ) {EBCMS.MSG.alert('上传出错');});uploader.on( 'uploadSuccess', function( file,res ) {
if (res.code) {EBCMS.TEMP.temp_<?php echo $_field['id']; ?>_imgs.push({
img:res.data.pathname,title:res.data.name,description:'',url:'',});EBCMS.TEMP.temp_<?php echo $_field['id']; ?>_refresh_<?php echo $_ns; ?>();}else{EBCMS.MSG.alert(res.msg);};});uploader.on( 'uploadComplete', function( file ) {
});};EBCMS.TEMP.temp_<?php echo $_field['id']; ?>_renderPics('#<?php echo $_ns; ?>'<?php if(!(empty($_field['config']['extensions']) || ($_field['config']['extensions'] instanceof \think\Collection && $_field['config']['extensions']->isEmpty()))): ?>,'<?php echo $_field['config']['extensions']; ?>'<?php endif; ?>);});</script>
						<div class="row">
							<div class="col-md-10">
								<div class="row" id="<?php echo $_ns; ?>_foo"></div>
							</div>
							<div class="col-md-2">
								<div id="<?php echo $_ns; ?>Picker">上传</div>
							</div>
						</div>
						<script src="<?php echo get_root(); ?>/third/sortable/Sortable.js"></script>
						<style>
.x {
	height: 200px;
	border: 1px solid #ddd;
}

.sortable-ghost {
	background: #ddd;
}
</style>
						<script>$(function() {
new Sortable(document.getElementById("<?php echo $_ns; ?>_foo"), {
group: "omega",handle: ".col-md-3",draggable: ".col-md-3",ghostClass: "sortable-ghost",onRemove: function (evt){
},onStart: function (evt){EBCMS.TEMP.temp_<?php echo $_field['id']; ?>_index1 = $(evt.item).index();},onEnd: function (evt){EBCMS.TEMP.temp_<?php echo $_field['id']; ?>_index2 = $(evt.item).index();if (EBCMS.TEMP.temp_<?php echo $_field['id']; ?>_index1 != EBCMS.TEMP.temp_<?php echo $_field['id']; ?>_index2) {EBCMS.TEMP.temp_<?php echo $_field['id']; ?>_img_temp = EBCMS.TEMP.temp_<?php echo $_field['id']; ?>_imgs[EBCMS.TEMP.temp_<?php echo $_field['id']; ?>_index1];for(var i=EBCMS.TEMP.temp_<?php echo $_field['id']; ?>_index1;i<EBCMS.TEMP.temp_<?php echo $_field['id']; ?>_imgs.length;i++){EBCMS.TEMP.temp_<?php echo $_field['id']; ?>_imgs[i]=EBCMS.TEMP.temp_<?php echo $_field['id']; ?>_imgs[i+1]; 
}EBCMS.TEMP.temp_<?php echo $_field['id']; ?>_imgs.length=EBCMS.TEMP.temp_<?php echo $_field['id']; ?>_imgs.length-1;EBCMS.TEMP.temp_<?php echo $_field['id']; ?>_imgs.splice(EBCMS.TEMP.temp_<?php echo $_field['id']; ?>_index2, 0, EBCMS.TEMP.temp_<?php echo $_field['id']; ?>_img_temp);EBCMS.TEMP.temp_<?php echo $_field['id']; ?>_refresh_<?php echo $_ns; ?>();}},});EBCMS.TEMP.temp_<?php echo $_field['id']; ?>_imgs = <?php echo json_encode($_field['value']); ?>||[];EBCMS.TEMP.temp_<?php echo $_field['id']; ?>_refresh_<?php echo $_ns; ?> = function(){EBCMS.CORE.compile({
tpl:'<?php echo $_ns; ?>-item',data:{rows:EBCMS.TEMP.temp_<?php echo $_field['id']; ?>_imgs},target:'#<?php echo $_ns; ?>_foo',});};EBCMS.TEMP.temp_<?php echo $_field['id']; ?>_refresh_<?php echo $_ns; ?>();EBCMS.TEMP.edits_<?php echo $_field['id']; ?> = function(id){
if ('edit' == id) {EBCMS.TEMP.temp_<?php echo $_field['id']; ?>_imgs[EBCMS.TEMP.editid_<?php echo $_field['id']; ?>].title = $('#<?php echo $_ns; ?>_title').val();EBCMS.TEMP.temp_<?php echo $_field['id']; ?>_imgs[EBCMS.TEMP.editid_<?php echo $_field['id']; ?>].description = $('#<?php echo $_ns; ?>_description').val();EBCMS.TEMP.temp_<?php echo $_field['id']; ?>_imgs[EBCMS.TEMP.editid_<?php echo $_field['id']; ?>].url = $('#<?php echo $_ns; ?>_url').val();EBCMS.TEMP.temp_<?php echo $_field['id']; ?>_imgs[EBCMS.TEMP.editid_<?php echo $_field['id']; ?>].img = $('#<?php echo $_ns; ?>_img').val();$('#lgModal').modal('hide');EBCMS.TEMP.temp_<?php echo $_field['id']; ?>_refresh_<?php echo $_ns; ?>();}else{
id = Number(id);EBCMS.TEMP.editid_<?php echo $_field['id']; ?> = id;EBCMS.CORE.compile({
tpl:'<?php echo $_ns; ?>-edit',data:EBCMS.TEMP.temp_<?php echo $_field['id']; ?>_imgs[id],target:'#lgModal .modal-content',compileAfter:function(){EBCMS.FN.renderPic('#<?php echo $_ns; ?>_img'<?php if(!(empty($_field['config']['extensions']) || ($_field['config']['extensions'] instanceof \think\Collection && $_field['config']['extensions']->isEmpty()))): ?>,'<?php echo $_field['config']['extensions']; ?>'<?php endif; ?>);}});}return false;};EBCMS.TEMP.delete_<?php echo $_field['id']; ?> = function(id){
id = Number(id);for(var i=id;i<EBCMS.TEMP.temp_<?php echo $_field['id']; ?>_imgs.length;i++){EBCMS.TEMP.temp_<?php echo $_field['id']; ?>_imgs[i]=EBCMS.TEMP.temp_<?php echo $_field['id']; ?>_imgs[i+1]; 
}EBCMS.TEMP.temp_<?php echo $_field['id']; ?>_imgs.length -= 1;EBCMS.TEMP.temp_<?php echo $_field['id']; ?>_refresh_<?php echo $_ns; ?>();return false;};});</script>
						<script id="<?php echo $_ns; ?>-item" type="text/html">[[each rows as v n]]<div class="col-md-3 col-sm-4 col-xs-6"><div class="panel panel-default"><div class="panel-heading text-overflow" style="width:auto;">[[v.title]]</div><div class="panel-body"><p><img src="<?php echo get_root(); ?>/upload/[[v.img]]" width="100%" height="200" alt=""></p><p><button class="btn btn-primary btn-sm" onclick="return EBCMS.TEMP.edits_<?php echo $_field['id']; ?>('[[n]]');">编辑</button> <button class="btn btn-primary btn-sm" onclick="return EBCMS.TEMP.delete_<?php echo $_field['id']; ?>('[[n]]');">删除</button></p></div></div><input type="hidden" name="<?php echo $_field['field']; ?>[[n | left]][[n]][[n | right]][title]" value="[[v.title]]"><input type="hidden" name="<?php echo $_field['field']; ?>[[n | left]][[n]][[n | right]][img]" value="[[v.img]]"><input type="hidden" name="<?php echo $_field['field']; ?>[[n | left]][[n]][[n | right]][url]" value="[[v.url]]"><input type="hidden" name="<?php echo $_field['field']; ?>[[n | left]][[n]][[n | right]][description]" value="[[v.description]]"></div>[[/each]]</script>
						<script id="<?php echo $_ns; ?>-edit" type="text/html"><div class="modal-header"><button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button><h4 class="modal-title text-danger"><b>编辑图片</b></h4></div><div class="modal-body"><div class="row"><div class="col-md-10"><input id="<?php echo $_ns; ?>_img" class="form-control" value="[[img]]"/></div><div class="col-md-2"><div id="<?php echo $_ns; ?>_imgPicker">上传</div></div></div><div class="form-group"><label class="control-label" for="<?php echo $_ns; ?>_title">标题</label><input type="text" class="form-control" id="<?php echo $_ns; ?>_title" value="[[title]]"></div><div class="form-group"><label class="control-label" for="<?php echo $_ns; ?>_url">链接地址</label><input type="text" class="form-control" id="<?php echo $_ns; ?>_url" value="[[url]]"></div><div class="form-group"><label class="control-label" for="<?php echo $_ns; ?>_description">简介</label><textarea class="form-control" id="<?php echo $_ns; ?>_description" rows="6">[[description]]</textarea></div></div><div class="modal-footer"><button type="button" class="btn btn-primary" onclick="return EBCMS.TEMP.edits_<?php echo $_field['id']; ?>('edit');">提交</button> <button type="button" class="btn btn-default" data-dismiss="modal">关闭</button></div></script>
						<?php break; case "file": ?>
						<script>$(function(){EBCMS.FN.renderFile('#<?php echo $_ns; ?>'<?php if(!(empty($_field['config']['extensions']) || ($_field['config']['extensions'] instanceof \think\Collection && $_field['config']['extensions']->isEmpty()))): ?>,'<?php echo $_field['config']['extensions']; ?>'<?php endif; ?>);});</script>
						<div class="row">
							<div class="col-md-10">
								<input id="<?php echo $_ns; ?>" class="form-control"
									name="<?php echo $_field['field']; ?>"
									value="<?php echo $_field['value']; ?>"
									placeholder="<?php echo (isset($_field['config']['prompt']) && ($_field['config']['prompt'] !== '')?$_field['config']['prompt']:''); ?>"<?php
								if($_field['config']['disabled'] == '1'): ?> disabled
								<?php endif; if($_field['config']['readonly'] == '1'): ?>
								readonly
								<?php endif; if($_field['config']['required'] == '1'): ?>
								required
								<?php endif; ?>
								/>
							</div>
							<div class="col-md-2">
								<div id="<?php echo $_ns; ?>Picker">上传</div>
							</div>
						</div>
						<?php break; case "files": ?>
						<script>$(function(){EBCMS.TEMP.temp_<?php echo $_field['id']; ?>_renderPics = function(container,extensions,picker){
extensions = extensions?extensions:'gif,jpg,jpeg,bmp,png';var pick = picker||container + 'Picker';var uploader = WebUploader.create({
auto: true,swf: EBCMS.DATA.config.WebUploader_swf,server: EBCMS.DATA.config.WebUploader_server,pick: pick,accept: {
title: 'File',extensions: extensions,mimeTypes: '*/*'
}});$(pick).mouseover(function(){
$(this).resize();});uploader.on( 'error', function(code) {EBCMS.MSG.webuploaderMsg(code);});uploader.on( 'uploadError', function( file ) {EBCMS.MSG.alert('上传出错');});uploader.on( 'uploadSuccess', function( file,res ) {
if (res.code) {EBCMS.TEMP.temp_<?php echo $_field['id']; ?>_files.push({
file:res.data.pathname,title:res.data.name,description:'',});EBCMS.TEMP.temp_<?php echo $_field['id']; ?>_refresh_<?php echo $_ns; ?>();}else{EBCMS.MSG.alert(res.msg);};});uploader.on( 'uploadComplete', function( file ) {
});};EBCMS.TEMP.temp_<?php echo $_field['id']; ?>_renderPics('#<?php echo $_ns; ?>'<?php if(!(empty($_field['config']['extensions']) || ($_field['config']['extensions'] instanceof \think\Collection && $_field['config']['extensions']->isEmpty()))): ?>,'<?php echo $_field['config']['extensions']; ?>'<?php endif; ?>);});</script>
						<div class="row">
							<div class="col-md-10">
								<div class="row" id="<?php echo $_ns; ?>_foo"></div>
							</div>
							<div class="col-md-2">
								<div id="<?php echo $_ns; ?>Picker">上传</div>
							</div>
						</div>
						<script src="<?php echo get_root(); ?>/third/sortable/Sortable.js"></script>
						<style>
.x {
	height: 200px;
	border: 1px solid #ddd;
}

.sortable-ghost {
	background: #ddd;
}
</style>
						<script>$(function() {
new Sortable(document.getElementById("<?php echo $_ns; ?>_foo"), {
group: "omega",handle: ".contentlist",draggable: ".contentlist",ghostClass: "sortable-ghost",onRemove: function (evt){
},onStart: function (evt){EBCMS.TEMP.temp_<?php echo $_field['id']; ?>_index1 = $(evt.item).index();},onEnd: function (evt){EBCMS.TEMP.temp_<?php echo $_field['id']; ?>_index2 = $(evt.item).index();if (EBCMS.TEMP.temp_<?php echo $_field['id']; ?>_index1 != EBCMS.TEMP.temp_<?php echo $_field['id']; ?>_index2) {EBCMS.TEMP.temp_<?php echo $_field['id']; ?>_file_temp = EBCMS.TEMP.temp_<?php echo $_field['id']; ?>_files[EBCMS.TEMP.temp_<?php echo $_field['id']; ?>_index1];for(var i=EBCMS.TEMP.temp_<?php echo $_field['id']; ?>_index1;i<EBCMS.TEMP.temp_<?php echo $_field['id']; ?>_files.length;i++){EBCMS.TEMP.temp_<?php echo $_field['id']; ?>_files[i]=EBCMS.TEMP.temp_<?php echo $_field['id']; ?>_files[i+1]; 
}EBCMS.TEMP.temp_<?php echo $_field['id']; ?>_files.length=EBCMS.TEMP.temp_<?php echo $_field['id']; ?>_files.length-1;EBCMS.TEMP.temp_<?php echo $_field['id']; ?>_files.splice(EBCMS.TEMP.temp_<?php echo $_field['id']; ?>_index2, 0, EBCMS.TEMP.temp_<?php echo $_field['id']; ?>_file_temp);EBCMS.TEMP.temp_<?php echo $_field['id']; ?>_refresh_<?php echo $_ns; ?>();}},});EBCMS.TEMP.temp_<?php echo $_field['id']; ?>_files = <?php echo json_encode($_field['value']); ?>||[];EBCMS.TEMP.temp_<?php echo $_field['id']; ?>_refresh_<?php echo $_ns; ?> = function(){EBCMS.CORE.compile({
tpl:'<?php echo $_ns; ?>-item',data:{rows:EBCMS.TEMP.temp_<?php echo $_field['id']; ?>_files},target:'#<?php echo $_ns; ?>_foo',});};EBCMS.TEMP.temp_<?php echo $_field['id']; ?>_refresh_<?php echo $_ns; ?>();EBCMS.TEMP.edits_<?php echo $_field['id']; ?> = function(id){
if ('edit' == id) {EBCMS.TEMP.temp_<?php echo $_field['id']; ?>_files[EBCMS.TEMP.editid_<?php echo $_field['id']; ?>].title = $('#<?php echo $_ns; ?>_title').val();EBCMS.TEMP.temp_<?php echo $_field['id']; ?>_files[EBCMS.TEMP.editid_<?php echo $_field['id']; ?>].description = $('#<?php echo $_ns; ?>_description').val();EBCMS.TEMP.temp_<?php echo $_field['id']; ?>_files[EBCMS.TEMP.editid_<?php echo $_field['id']; ?>].file = $('#<?php echo $_ns; ?>_file').val();$('#lgModal').modal('hide');EBCMS.TEMP.temp_<?php echo $_field['id']; ?>_refresh_<?php echo $_ns; ?>();}else{
id = Number(id);EBCMS.TEMP.editid_<?php echo $_field['id']; ?> = id;EBCMS.CORE.compile({
tpl:'<?php echo $_ns; ?>-edit',data:EBCMS.TEMP.temp_<?php echo $_field['id']; ?>_files[id],target:'#lgModal .modal-content',compileAfter:function(){EBCMS.FN.renderFile('#<?php echo $_ns; ?>_file'<?php if(!(empty($_field['config']['extensions']) || ($_field['config']['extensions'] instanceof \think\Collection && $_field['config']['extensions']->isEmpty()))): ?>,'<?php echo $_field['config']['extensions']; ?>'<?php endif; ?>);}});}return false;};EBCMS.TEMP.delete_<?php echo $_field['id']; ?> = function(id){
id = Number(id);for(var i=id;i<EBCMS.TEMP.temp_<?php echo $_field['id']; ?>_files.length;i++){EBCMS.TEMP.temp_<?php echo $_field['id']; ?>_files[i]=EBCMS.TEMP.temp_<?php echo $_field['id']; ?>_files[i+1]; 
}EBCMS.TEMP.temp_<?php echo $_field['id']; ?>_files.length -= 1;EBCMS.TEMP.temp_<?php echo $_field['id']; ?>_refresh_<?php echo $_ns; ?>();return false;};});</script>
						<script id="<?php echo $_ns; ?>-item" type="text/html">[[each rows as v n]]<div class="media contentlist"><div class="media-left"><i class="iconfont icon-[[v.file | fileicon]] text-primary" style="font-size:6em;"></i></div><div class="media-body"><h3 class="media-heading">[[v.title]]</h3><div class="description">[[v.description]]</div><div style="margin:10px auto;"><button class="btn btn-primary btn-sm" onclick="return EBCMS.TEMP.edits_<?php echo $_field['id']; ?>('[[n]]');">编辑</button> <button class="btn btn-primary btn-sm" onclick="return EBCMS.TEMP.delete_<?php echo $_field['id']; ?>('[[n]]');">删除</button></div></div><input type="hidden" name="<?php echo $_field['field']; ?>[[n | left]][[n]][[n | right]][title]" value="[[v.title]]"><input type="hidden" name="<?php echo $_field['field']; ?>[[n | left]][[n]][[n | right]][file]" value="[[v.file]]"><input type="hidden" name="<?php echo $_field['field']; ?>[[n | left]][[n]][[n | right]][description]" value="[[v.description]]"></div>[[/each]]</script>
						<script id="<?php echo $_ns; ?>-edit" type="text/html"><div class="modal-header"><button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button><h4 class="modal-title text-danger"><b>编辑附件</b></h4></div><div class="modal-body"><div class="row"><div class="col-md-10"><input id="<?php echo $_ns; ?>_file" class="form-control" value="[[file]]"/></div><div class="col-md-2"><div id="<?php echo $_ns; ?>_filePicker">上传</div></div></div><div class="form-group"><label class="control-label" for="<?php echo $_ns; ?>_title">标题</label><input type="text" class="form-control" id="<?php echo $_ns; ?>_title" value="[[title]]"></div><div class="form-group"><label class="control-label" for="<?php echo $_ns; ?>_description">简介</label><textarea class="form-control" id="<?php echo $_ns; ?>_description" rows="6">[[description]]</textarea></div></div><div class="modal-footer"><button type="button" class="btn btn-primary" onclick="return EBCMS.TEMP.edits_<?php echo $_field['id']; ?>('edit');">提交</button> <button type="button" class="btn btn-default" data-dismiss="modal">关闭</button></div></script>
						<?php break; case "ueditor": ?>
						<script>$(function(){EBCMS.FN.renderUE('<?php echo $_ns; ?>',{
autoHeightEnabled:<?php echo (isset($_field['config']['autoheightenabled']) && ($_field['config']['autoheightenabled'] !== '')?$_field['config']['autoheightenabled']:'false'); ?>,maximumWords:<?php echo (isset($_field['config']['maximumwords']) && ($_field['config']['maximumwords'] !== '')?$_field['config']['maximumwords']:'10000'); ?>,wordCount:<?php echo (isset($_field['config']['wordcount']) && ($_field['config']['wordcount'] !== '')?$_field['config']['wordcount']:'true'); ?>,elementPathEnabled:<?php echo (isset($_field['config']['elementpathenabled']) && ($_field['config']['elementpathenabled'] !== '')?$_field['config']['elementpathenabled']:'true'); ?>,initialFrameHeight:<?php echo (isset($_field['config']['initialframeheight']) && ($_field['config']['initialframeheight'] !== '')?$_field['config']['initialframeheight']:'420'); ?>,});});</script>
						<textarea name="<?php echo $_field['field']; ?>"
							id="<?php echo $_ns; ?>"><?php echo $_field['value']; ?></textarea>
						<?php break; case "combotree": ?>
						<script>$(function(){<?php 
if ($_field['config']['queryparams']) {
$_where = '';$_queryparams = explode("\r\n",$_field['config']['queryparams']);foreach ($_queryparams as $key => $value) {
$_tmp = explode('|',$value);if (stripos($_tmp[2],'(I)') === 0) {
$_tmp[2] = input(substr($_tmp[2],3));}elseif(stripos($_tmp[2],'(@)') === 0){
$_tmp[2] = $_data[substr($_tmp[2],3)];}elseif(stripos($_tmp[2],'($)') === 0){
$_tmp[2] = get_tpl_value($_data,substr($_tmp[2],3));};$_where .= $_tmp[0].":['".$_tmp[1]."','".$_tmp[2]."'],";}};$_field['config']['group'] = isset($_field['config']['group'])?$_field['config']['group']:0;$_field['config']['tree'] = isset($_field['config']['tree'])?$_field['config']['tree']:0;$_field['config']['rootitem'] = isset($_field['config']['rootitem'])?$_field['config']['rootitem']:0;$_field['config']['editable'] = isset($_field['config']['editable'])?$_field['config']['editable']:0;?>EBCMS.CORE.api({<?php if($_field['config']['group'] == '1'): ?>group:'group',<?php else: if($_field['config']['tree'] == '1'): ?>tree:'tree',<?php endif; if($_field['config']['rootitem'] == '1'): ?>rootitem:true,<?php endif; endif; ?>queryParams:{
order:{
'sort':'desc',},model:'<?php echo $_field['config']['model']; ?>',<?php if(!(empty($_field['config']['queryparams']) || ($_field['config']['queryparams'] instanceof \think\Collection && $_field['config']['queryparams']->isEmpty()))): ?>where:{<?php echo $_where; ?>},<?php endif; ?>},loadAfter:function(data){
$select = $('#<?php echo $_ns; ?>');var str = EBCMS.FN.renderSelect(data['rows'],'<?php echo $_field['value']; ?>','<?php echo (isset($_field['config']['valuefield']) && ($_field['config']['valuefield'] !== '')?$_field['config']['valuefield']:"id"); ?>','<?php echo (isset($_field['config']['textfield']) && ($_field['config']['textfield'] !== '')?$_field['config']['textfield']:"title"); ?>');$select.append(str);}});});</script>
						<?php if($_field['config']['editable'] == '1'): ?>
						<div class="row">
							<div class="col-md-8">
								<input type="text" class="form-control"
									id="<?php echo $_ns; ?>_obj"
									name="<?php echo $_field['field']; ?>"
									value="<?php echo $_field['value']; ?>"
									placeholder="<?php echo (isset($_field['config']['prompt']) && ($_field['config']['prompt'] !== '')?$_field['config']['prompt']:''); ?>"<?php
								if($_field['config']['readonly'] == '1'): ?> readonly
								<?php endif; if($_field['config']['disabled'] == '1'): ?>
								disabled
								<?php endif; if($_field['config']['required'] == '1'): ?>
								required
								<?php endif; ?>
								>
							</div>
							<div class="col-md-4">
								<select class="form-control" id="<?php echo $_ns; ?>"
									onchange="$('#<?php echo $_ns; ?>_obj').val($(this).val());"<?php
									if($_field['config']['readonly'] == '1'): ?> readonly
									<?php endif; if($_field['config']['disabled'] == '1'): ?>
									disabled
									<?php endif; if($_field['config']['required'] == '1'): ?>
									required
									<?php endif; ?>>
								</select>
							</div>
						</div>
						<?php else: ?>
						<select class="form-control" id="<?php echo $_ns; ?>"
							name="<?php echo $_field['field']; ?>"<?php
							if($_field['config']['readonly'] == '1'): ?> readonly
							<?php endif; if($_field['config']['disabled'] == '1'): ?>
							disabled
							<?php endif; if($_field['config']['required'] == '1'): ?>
							required
							<?php endif; ?>>
						</select>
						<?php endif; break; case "datadict": ?>
						<script>$(function(){EBCMS.CORE.datadict({
queryParams:{
order:{
'sort':'desc',},datadict:'<?php echo $_field['config']['datadict']; ?>',},<?php if($_field['config']['rootitem'] == '1'): ?>rootitem:true,<?php endif; ?>loadAfter:function(res){
$select = $('#<?php echo $_ns; ?>');var str = EBCMS.FN.renderSelect(res['rows'],'<?php echo $_field['value']; ?>','<?php echo (isset($_field['config']['valuefield']) && ($_field['config']['valuefield'] !== '')?$_field['config']['valuefield']:"id"); ?>','<?php echo (isset($_field['config']['textfield']) && ($_field['config']['textfield'] !== '')?$_field['config']['textfield']:"title"); ?>');$select.append(str);}});});</script>
						<?php 
$_field['config']['editable'] = isset($_field['config']['editable'])?$_field['config']['editable']:0;if($_field['config']['editable'] == '1'): ?>
						<div class="row">
							<div class="col-md-8">
								<input type="text" class="form-control"
									id="<?php echo $_ns; ?>_obj"
									name="<?php echo $_field['field']; ?>"
									value="<?php echo $_field['value']; ?>"
									placeholder="<?php echo (isset($_field['config']['prompt']) && ($_field['config']['prompt'] !== '')?$_field['config']['prompt']:''); ?>"<?php
								if($_field['config']['readonly'] == '1'): ?> readonly
								<?php endif; if($_field['config']['disabled'] == '1'): ?>
								disabled
								<?php endif; if($_field['config']['required'] == '1'): ?>
								required
								<?php endif; ?>
								>
							</div>
							<div class="col-md-4">
								<select class="form-control" id="<?php echo $_ns; ?>"
									onchange="$('#<?php echo $_ns; ?>_obj').val($(this).val());"<?php
									if($_field['config']['readonly'] == '1'): ?> readonly
									<?php endif; if($_field['config']['disabled'] == '1'): ?>
									disabled
									<?php endif; if($_field['config']['required'] == '1'): ?>
									required
									<?php endif; ?>>
								</select>
							</div>
						</div>
						<?php else: ?>
						<select class="form-control" id="<?php echo $_ns; ?>"
							name="<?php echo $_field['field']; ?>"<?php
							if($_field['config']['readonly'] == '1'): ?> readonly
							<?php endif; if($_field['config']['disabled'] == '1'): ?>
							disabled
							<?php endif; if($_field['config']['required'] == '1'): ?>
							required
							<?php endif; ?>>
						</select>
						<?php endif; break; case "numberbox": ?>
						<input type="number" id="<?php echo $_ns; ?>" class="form-control"
							name="<?php echo $_field['field']; ?>"
							value="<?php echo $_field['value']; ?>"<?php
						if($_field['config']['readonly'] == '1'): ?> readonly
						<?php endif; if($_field['config']['disabled'] == '1'): ?>
						disabled
						<?php endif; if($_field['config']['required'] == '1'): ?>
						required
						<?php endif; ?>
						/>
						<?php break; case "timespinner": ?>
						<input type="time" id="<?php echo $_ns; ?>" class="form-control"
							name="<?php echo $_field['field']; ?>"
							value="<?php echo $_field['value']; ?>" id="<?php echo $_ns; ?>"<?php
						if($_field['config']['readonly'] == '1'): ?> readonly
						<?php endif; if($_field['config']['disabled'] == '1'): ?>
						disabled
						<?php endif; if($_field['config']['required'] == '1'): ?>
						required
						<?php endif; ?>
						/>
						<?php break; case "datebox": ?>
						<input type="date" id="<?php echo $_ns; ?>" class="form-control"
							name="<?php echo $_field['field']; ?>"
							value="<?php echo $_field['value']; ?>" id="<?php echo $_ns; ?>"<?php
						if($_field['config']['readonly'] == '1'): ?> readonly
						<?php endif; if($_field['config']['disabled'] == '1'): ?>
						disabled
						<?php endif; if($_field['config']['required'] == '1'): ?>
						required
						<?php endif; ?>
						/>
						<?php break; case "datetimebox": ?>
						<input type="datetime-local" id="<?php echo $_ns; ?>"
							class="form-control" name="<?php echo $_field['field']; ?>"
							value="<?php echo datetimelocal($_field['value']); ?>"
							id="<?php echo $_ns; ?>"<?php
						if($_field['config']['readonly'] == '1'): ?> readonly
						<?php endif; if($_field['config']['disabled'] == '1'): ?>
						disabled
						<?php endif; if($_field['config']['required'] == '1'): ?>
						required
						<?php endif; ?>
						/>
						<?php break; case "extendtext": ?>
						<script>Namespace.register("EBCMS.Form_extendtext");$(function() {EBCMS.Form_extendtext.changename = function(id,value){
$(id).attr('name','<?php echo $_field['field']; ?>['+value+']');};EBCMS.Form_extendtext.up = function(id){
if ($(id).prev().hasClass('form-group')) {
$(id).insertBefore($(id).prev());}};EBCMS.Form_extendtext.down = function(id){
if ($(id).next().hasClass('form-group')) {
$(id).next().insertBefore($(id));}};EBCMS.Form_extendtext.render_text = function(name,value,target){
name = name||'EB_' + EBCMS.FN.random_str(6);opt = {
name:name,value:value||'',id:'<?php echo $_ns; ?>_' + EBCMS.FN.random_str(15),};var str = '';str += '<div class="form-group" id="'+opt.id+'_group">';str += '<div class="col-sm-1 control-label"><label>';str += '<i class="iconfont icon-shanchu cursor-pointer" onclick="$(\'#'+opt.id+'_group\').remove();"></i>';str += '<i class="iconfont icon-xiayi cursor-pointer" onclick="EBCMS.Form_extendtext.down(\'#'+opt.id+'_group\');"></i>';str += '<i class="iconfont icon-shangyi cursor-pointer" onclick="EBCMS.Form_extendtext.up(\'#'+opt.id+'_group\');"></i>';str += '<label></div>';str += '<div class="col-sm-2">';str += '<input type="text" class="form-control" value="'+opt.name+'" onKeyUp="EBCMS.Form_extendtext.changename(\'#'+opt.id+'\',$(this).val());" placeholder="填写名称">';str += '</div>';str += '<div class="col-sm-9">';str += '<input type="text" class="form-control" id="'+opt.id+'" name="<?php echo $_field['field']; ?>['+opt.name+']" value="'+opt.value+'" placeholder="填写值">';str += '</div>';str += '</div>';if (target) {
$(target).append(str);}else{
return str;}};var forms = <?php echo json_encode($_field['value']); ?>||{};if (typeof forms!='object') {
forms = {};}$.each(forms, function(name, val) {EBCMS.Form_extendtext.render_text(name,val,'#<?php echo $_field['id']; ?>_container');});});</script>
						<div class="row">
							<div class="col-sm-12">
								<div class="btn-group" role="group" aria-label="...">
									<button type="button" class="btn btn-primary btn-sm"
										onclick="EBCMS.Form_extendtext.render_text('','','#<?php echo $_field['id']; ?>_container');">单行文本</button>
								</div>
							</div>
						</div>
						<br>
						<div class="row">
							<div class="col-sm-12"
								id="<?php echo $_field['id']; ?>_container"></div>
						</div>
						<?php break; case "keywords": ?>
						<div class="row">
							<div class="col-md-8">
								<input id="<?php echo $_ns; ?>" class="form-control"
									name="<?php echo $_field['field']; ?>"
									value="<?php echo $_field['value']; ?>"
									placeholder="<?php echo (isset($_field['config']['prompt']) && ($_field['config']['prompt'] !== '')?$_field['config']['prompt']:''); ?>"<?php
								if($_field['config']['disabled'] == '1'): ?> disabled
								<?php endif; if($_field['config']['readonly'] == '1'): ?>
								readonly
								<?php endif; if($_field['config']['required'] == '1'): ?>
								required
								<?php endif; ?>
								/>
							</div>
							<div class="col-md-2">
								<button type="button" class="btn btn-primary btn-block"
									onclick="EBCMS.FN.suggest_keywords('#<?php echo $_ns; ?>');">长尾关键词</button>
							</div>
							<div class="col-md-2">
								<button type="button" class="btn btn-primary btn-block"
									onclick="EBCMS.FN.suggest_keywords('#<?php echo $_ns; ?>','<?php if(isset($_field['config']['field']) && $_field['config']['field']){echo 'ebcms_'.md5('ebcmsformfield_'.$_field['config']['field'].$_nowtime);}else{echo '0';} ?>','<?php echo (isset($_field['config']['strong']) && ($_field['config']['strong'] !== '')?$_field['config']['strong']:'0'); ?>');">插入到内容</button>
							</div>
						</div>
						<?php break; default: ?>
						<span style="color: red;">
							<?php echo $_field['type']; ?>表单类型不存在 请联系专业人员
						</span>
						<?php endswitch; if(!(empty($_field['remark']) || ($_field['remark'] instanceof \think\Collection && $_field['remark']->isEmpty()))): ?>
						<p class="help-block">
							<?php echo $_field['remark']; ?>
						</p>
						<?php endif; ?>
					</div>
				</div>
				<?php endif; endforeach; ?>
			</div>
			<?php endforeach; if(!(empty($_extgroups) || ($_extgroups instanceof \think\Collection && $_extgroups->isEmpty()))): foreach($_extgroups as $key => $_fields): ?>
			<div class="tab-body">
				<?php foreach($_fields as $key => $_field): 
$_nowtime = time();$_ns = 'ebcms_'.md5('ebcmsformfield_'.$_field['field'].$_nowtime);$_field['config']['disabled'] = isset($_field['config']['disabled'])?$_field['config']['disabled']:0;$_field['config']['required'] = isset($_field['config']['required'])?$_field['config']['required']:0;$_field['config']['readonly'] = isset($_field['config']['readonly'])?$_field['config']['readonly']:0;if($_field['type'] == 'hidden'): ?>
				<input type="hidden" name="<?php echo $_field['field']; ?>"
					value="<?php echo $_field['value']; ?>" />
				<?php elseif($_field['type'] == 'extend'): ?>
				<script>Namespace.register("EBCMS.Form");$(function() {EBCMS.Form.changename = function(id,value){
if ($(id).is('div')) {
$(id).next().attr('name','<?php echo $_field['field']; ?>['+value+']');}else{
$(id).attr('name','<?php echo $_field['field']; ?>['+value+']');}$(id+'__config__').attr('name','<?php echo $_field['field']; ?>[__config__]['+value+']');};EBCMS.Form.up = function(id){
if ($(id).prev().hasClass('form-group')) {
$(id).insertBefore($(id).prev());}};EBCMS.Form.down = function(id){
if ($(id).next().hasClass('form-group')) {
$(id).next().insertBefore($(id));}};EBCMS.Form.render = function(name,value,target){
if (EBCMS.Form.config[name]) {
}else{EBCMS.Form.config[name] = 'text';}if (EBCMS.Form['render_'+EBCMS.Form.config[name]]) {EBCMS.Form['render_'+EBCMS.Form.config[name]](name,value,target);}};EBCMS.Form.render_text = function(name,value,target){
name = name||'EB_' + EBCMS.FN.random_str(6);opt = {
name:name,value:value||'',id:'<?php echo $_ns; ?>_' + EBCMS.FN.random_str(15),};var str = '';str += '<div class="form-group" id="'+opt.id+'_group">';str += '<div class="col-sm-1 control-label"><label>';str += '<i class="iconfont icon-shanchu cursor-pointer" onclick="$(\'#'+opt.id+'_group\').remove();"></i>';str += '<i class="iconfont icon-xiayi cursor-pointer" onclick="EBCMS.Form.down(\'#'+opt.id+'_group\');"></i>';str += '<i class="iconfont icon-shangyi cursor-pointer" onclick="EBCMS.Form.up(\'#'+opt.id+'_group\');"></i>';str += '<label></div>';str += '<div class="col-sm-2">';str += '<input type="text" class="form-control" value="'+opt.name+'" onKeyUp="EBCMS.Form.changename(\'#'+opt.id+'\',$(this).val());" placeholder="填写名称">';str += '</div>';str += '<div class="col-sm-9">';str += '<input type="text" class="form-control" id="'+opt.id+'" name="<?php echo $_field['field']; ?>['+opt.name+']" value="'+opt.value+'" placeholder="填写值">';str += '</div>';str += '<input type="hidden" id="'+opt.id+'__config__" name="<?php echo $_field['field']; ?>[__config__]['+opt.name+']" value="text">';str += '</div>';if (target) {
$(target).append(str);}else{
return str;}};EBCMS.Form.render_textarea = function(name,value,target){
name = name||'EB_' + EBCMS.FN.random_str(6);opt = {
name:name,value:value||'',id:'<?php echo $_ns; ?>_' + EBCMS.FN.random_str(15),};var str = '';str += '<div class="form-group" id="'+opt.id+'_group">';str += '<div class="col-sm-1 control-label"><label>';str += '<i class="iconfont icon-shanchu cursor-pointer" onclick="$(\'#'+opt.id+'_group\').remove();"></i>';str += '<i class="iconfont icon-xiayi cursor-pointer" onclick="EBCMS.Form.down(\'#'+opt.id+'_group\');"></i>';str += '<i class="iconfont icon-shangyi cursor-pointer" onclick="EBCMS.Form.up(\'#'+opt.id+'_group\');"></i>';str += '<label></div>';str += '<div class="col-sm-2">';str += '<input type="text" class="form-control" value="'+opt.name+'" onKeyUp="EBCMS.Form.changename(\'#'+opt.id+'\',$(this).val());" placeholder="填写名称">';str += '</div>';str += '<div class="col-sm-9">';str += '<textarea class="form-control" id="'+opt.id+'" name="<?php echo $_field['field']; ?>['+opt.name+']" rows="3" placeholder="填写内容">'+opt.value+'</textarea>';str += '</div>';str += '<input type="hidden" id="'+opt.id+'__config__" name="<?php echo $_field['field']; ?>[__config__]['+opt.name+']" value="textarea">';str += '</div>';if (target) {
$(target).append(str);}else{
return str;}};EBCMS.Form.render_file = function(name,value,target){
name = name||'EB_' + EBCMS.FN.random_str(6);opt = {
name:name,value:value||'',id:'<?php echo $_ns; ?>_' + EBCMS.FN.random_str(15),};var str = '';str += '<div class="form-group" id="'+opt.id+'_group">';str += '<div class="col-sm-1 control-label"><label>';str += '<i class="iconfont icon-shanchu cursor-pointer" onclick="$(\'#'+opt.id+'_group\').remove();"></i>';str += '<i class="iconfont icon-xiayi cursor-pointer" onclick="EBCMS.Form.down(\'#'+opt.id+'_group\');"></i>';str += '<i class="iconfont icon-shangyi cursor-pointer" onclick="EBCMS.Form.up(\'#'+opt.id+'_group\');"></i>';str += '<label></div>';str += '<div class="col-sm-2">';str += '<input type="text" class="form-control" value="'+opt.name+'" onKeyUp="EBCMS.Form.changename(\'#'+opt.id+'\',$(this).val());" placeholder="填写名称">';str += '</div>';str += '<div class="col-sm-7">';str += '<input type="text" class="form-control" id="'+opt.id+'" name="<?php echo $_field['field']; ?>['+opt.name+']" value="'+opt.value+'" placeholder="填写值">';str += '</div>';str += '<div class="col-sm-2">';str += '<div id="'+opt.id+'Picker">上传</div>';str += '</div>';str += '<input type="hidden" id="'+opt.id+'__config__" name="<?php echo $_field['field']; ?>[__config__]['+opt.name+']" value="file">';str += '<script>';str += '$(function(){';str += '    EBCMS.FN.renderFile(\'#'+opt.id+'\');';str += '});';str += '<\/script>';str += '</div>';if (target) {
$(target).append(str);}else{
return str;}};EBCMS.Form.render_ueditor = function(name,value,target){
name = name||'EB_' + EBCMS.FN.random_str(6);opt = {
name:name,value:value||'',id:'<?php echo $_ns; ?>_' + EBCMS.FN.random_str(15),};var str = '';str += '<div class="form-group" id="'+opt.id+'_group">';str += '<div class="col-sm-1 control-label"><label>';str += '<i class="iconfont icon-shanchu cursor-pointer" onclick="$(\'#'+opt.id+'_group\').remove();"></i>';str += '<i class="iconfont icon-xiayi cursor-pointer" onclick="EBCMS.Form.down(\'#'+opt.id+'_group\');"></i>';str += '<i class="iconfont icon-shangyi cursor-pointer" onclick="EBCMS.Form.up(\'#'+opt.id+'_group\');"></i>';str += '<label></div>';str += '<div class="col-sm-2">';str += '<input type="text" class="form-control" value="'+opt.name+'" onKeyUp="EBCMS.Form.changename(\'#'+opt.id+'\',$(this).val());" placeholder="填写名称">';str += '</div>';str += '<div class="col-sm-9">';str += '<textarea id="'+opt.id+'" name="<?php echo $_field['field']; ?>['+opt.name+']" >'+opt.value+'</textarea>';str += '</div>';str += '<input type="hidden" id="'+opt.id+'__config__" name="<?php echo $_field['field']; ?>[__config__]['+opt.name+']" value="ueditor">';str += '<script>';str += '$(function(){';str += '    EBCMS.FN.renderUE("'+opt.id+'",{';str += '          autoHeightEnabled:false,';str += '          maximumWords:99999,';str += '          wordCount:true,';str += '          elementPathEnabled:true,';str += '          initialFrameHeight:400,';str += '    });';str += '});';str += '<\/script>';str += '</div>';if (target) {
$(target).append(str);}else{
return str;}};var forms = <?php echo json_encode($_field['value']); ?>||{};if (typeof forms!='object') {
forms = {};}EBCMS.Form.config = forms['__config__']||{};delete forms['__config__'];$.each(forms, function(name, val) {EBCMS.Form.render(name,val,'#<?php echo $_field['id']; ?>_container');});});</script>
				<div class="row">
					<div class="col-sm-12">
						<div class="btn-group" role="group" aria-label="...">
							<button type="button" class="btn btn-primary btn-sm"
								onclick="EBCMS.Form.render_text('','','#<?php echo $_field['id']; ?>_container');">单行文本</button>
							<button type="button" class="btn btn-primary btn-sm"
								onclick="EBCMS.Form.render_textarea('','','#<?php echo $_field['id']; ?>_container');">多行文本</button>
							<button type="button" class="btn btn-primary btn-sm"
								onclick="EBCMS.Form.render_file('','','#<?php echo $_field['id']; ?>_container');">文件</button>
							<button type="button" class="btn btn-primary btn-sm"
								onclick="EBCMS.Form.render_ueditor('','','#<?php echo $_field['id']; ?>_container');">编辑框</button>
						</div>
					</div>
				</div>
				<br>
				<div class="row">
					<div class="col-sm-12" id="<?php echo $_field['id']; ?>_container"></div>
				</div>
				<input type="hidden"
					name="<?php echo $_field['field']; ?>[__config__][__test__]"
					value='test'>
				<?php else: ?>
				<div class="form-group">
					<label for="<?php echo $_ns; ?>" class="col-sm-2 control-label">
						<?php echo $_field['title']; ?>
					</label>
					<div class="col-sm-10">
						<?php switch($_field['type']): case "bool": ?>
						<label class="radio-inline" for="<?php echo $_ns; ?>_1"><input
							type="radio" id="<?php echo $_ns; ?>_1"
							name="<?php echo $_field['field']; ?>" value="1"<?php
							if($_field['value'] == '1'): ?>checked<?php endif; if($_field['config']['disabled'] == '1'): ?>
							disabled<?php endif; if($_field['config']['readonly'] == '1'): ?>
							readonly<?php endif; ?>> 是</label><label class="radio-inline"
							for="<?php echo $_ns; ?>_0"><input type="radio"
							id="<?php echo $_ns; ?>_0" name="<?php echo $_field['field']; ?>"
							value="0"<?php if($_field['value'] == '0'): ?>checked<?php endif; if($_field['config']['disabled'] == '1'): ?>
							disabled<?php endif; if($_field['config']['readonly'] == '1'): ?>
							readonly<?php endif; ?>> 否</label>
						<?php break; case "select": 
$_temps = explode("\r\n",$_field['config']['values']);$_field['config']['editable'] = isset($_field['config']['editable'])?$_field['config']['editable']:0;if($_field['config']['editable'] == '1'): ?>
						<div class="row">
							<div class="col-md-8">
								<input type="text" class="form-control"
									id="<?php echo $_ns; ?>_obj"
									name="<?php echo $_field['field']; ?>"
									value="<?php echo $_field['value']; ?>"
									placeholder="<?php echo (isset($_field['config']['prompt']) && ($_field['config']['prompt'] !== '')?$_field['config']['prompt']:''); ?>"<?php
								if($_field['config']['readonly'] == '1'): ?> readonly
								<?php endif; if($_field['config']['disabled'] == '1'): ?>
								disabled
								<?php endif; if($_field['config']['required'] == '1'): ?>
								required
								<?php endif; ?>
								>
							</div>
							<div class="col-md-4">
								<select class="form-control" id="<?php echo $_ns; ?>"
									onchange="$('#<?php echo $_ns; ?>_obj').val($(this).val());"<?php
									if($_field['config']['readonly'] == '1'): ?> readonly
									<?php endif; if($_field['config']['disabled'] == '1'): ?>
									disabled
									<?php endif; if($_field['config']['required'] == '1'): ?>
									required
									<?php endif; ?>>
									<?php if(is_array($_temps) || $_temps instanceof \think\Collection): if( count($_temps)==0 ) : echo "" ;else: foreach($_temps as $key=>$_temp): $_temp = explode("|",$_temp); ?>
									<option value="<?php echo $_temp[1]; ?>"<?php
										if($_field['value'] == $_temp[1]): ?>selected
										<?php endif; ?>>
										<?php echo $_temp[0]; ?></option>
									<?php endforeach; endif; else: echo "" ;endif; ?>
								</select>
							</div>
						</div>
						<?php else: ?>
						<select class="form-control" id="<?php echo $_ns; ?>"
							name="<?php echo $_field['field']; ?>"<?php
							if($_field['config']['readonly'] == '1'): ?> readonly
							<?php endif; if($_field['config']['disabled'] == '1'): ?>
							disabled
							<?php endif; if($_field['config']['required'] == '1'): ?>
							required
							<?php endif; ?>>
							<?php if(is_array($_temps) || $_temps instanceof \think\Collection): if( count($_temps)==0 ) : echo "" ;else: foreach($_temps as $key=>$_temp): $_temp = explode("|",$_temp); ?>
							<option value="<?php echo $_temp[1]; ?>"<?php
								if($_field['value'] == $_temp[1]): ?>selected
								<?php endif; ?>>
								<?php echo $_temp[0]; ?></option>
							<?php endforeach; endif; else: echo "" ;endif; ?>
						</select>
						<?php endif; break; case "radio": $_temps = explode("\r\n",$_field['config']['values']); if(is_array($_temps) || $_temps instanceof \think\Collection): if( count($_temps)==0 ) : echo "" ;else: foreach($_temps as $key=>$_temp): $_temp = explode("|",$_temp); ?>
						<label class="radio-inline"
							for="<?php echo $_ns; ?>_<?php echo $key; ?>"><input
							type="radio" name="<?php echo $_field['field']; ?>"
							id="<?php echo $_ns; ?>_<?php echo $key; ?>"
							value="<?php echo $_temp[1]; ?>"<?php
							if($_field['value'] == $_temp[1]): ?>checked<?php endif; if($_field['config']['disabled'] == '1'): ?>
							disabled<?php endif; if($_field['config']['readonly'] == '1'): ?>
							readonly<?php endif; ?>> <?php echo $_temp[0]; ?></label>
						<?php endforeach; endif; else: echo "" ;endif; break; case "checkbox": $_temps = explode("\r\n",$_field['config']['values']); if(is_array($_temps) || $_temps instanceof \think\Collection): if( count($_temps)==0 ) : echo "" ;else: foreach($_temps as $key=>$_temp): $_temp = explode("|",$_temp); ?>
						<label class="checkbox-inline"
							for="<?php echo $_ns; ?>_<?php echo $key; ?>"><input
							type="checkbox" id="<?php echo $_ns; ?>_<?php echo $key; ?>"
							name="<?php echo $_field['field']; ?>[]"
							value="<?php echo $_temp[1]; ?>"<?php
							if(in_array(($_temp['1']),
							is_array($_field['value'])?$_field['value']:explode(',',$_field['value']))):
							?>checked<?php endif; if($_field['config']['disabled'] == '1'): ?>
							disabled<?php endif; if($_field['config']['readonly'] == '1'): ?>
							readonly<?php endif; ?>> <?php echo $_temp[0]; ?></label>
						<?php endforeach; endif; else: echo "" ;endif; break; case "textbox": ?>
						<input type="text" class="form-control" id="<?php echo $_ns; ?>"
							name="<?php echo $_field['field']; ?>"
							value="<?php echo $_field['value']; ?>"
							placeholder="<?php echo (isset($_field['config']['prompt']) && ($_field['config']['prompt'] !== '')?$_field['config']['prompt']:''); ?>"<?php
						if($_field['config']['readonly'] == '1'): ?> readonly
						<?php endif; if($_field['config']['disabled'] == '1'): ?>
						disabled
						<?php endif; if($_field['config']['required'] == '1'): ?>
						required
						<?php endif; ?>
						>
						<?php break; case "multitextbox": ?>
						<textarea class="form-control" id="<?php echo $_ns; ?>"
							name="<?php echo $_field['field']; ?>"
							rows="<?php echo (isset($_field['config']['height']) && ($_field['config']['height'] !== '')?$_field['config']['height']:'5'); ?>"
							placeholder="<?php echo (isset($_field['config']['prompt']) && ($_field['config']['prompt'] !== '')?$_field['config']['prompt']:''); ?>"<?php if($_field['config']['disabled'] == '1'): ?> disabled<?php endif; if($_field['config']['readonly'] == '1'): ?> readonly<?php endif; if($_field['config']['required'] == '1'): ?> required<?php endif; ?>><?php echo $_field['value']; ?></textarea>
						<?php break; case "image": ?>
						<script>$(function(){EBCMS.FN.renderPic('#<?php echo $_ns; ?>'<?php if(!(empty($_field['config']['extensions']) || ($_field['config']['extensions'] instanceof \think\Collection && $_field['config']['extensions']->isEmpty()))): ?>,'<?php echo $_field['config']['extensions']; ?>'<?php endif; ?>);});</script>
						<div class="row">
							<div class="col-md-10">
								<input id="<?php echo $_ns; ?>" class="form-control"
									name="<?php echo $_field['field']; ?>"
									value="<?php echo $_field['value']; ?>"
									placeholder="<?php echo (isset($_field['config']['prompt']) && ($_field['config']['prompt'] !== '')?$_field['config']['prompt']:''); ?>"<?php
								if($_field['config']['disabled'] == '1'): ?> disabled
								<?php endif; if($_field['config']['readonly'] == '1'): ?>
								readonly
								<?php endif; if($_field['config']['required'] == '1'): ?>
								required
								<?php endif; ?>
								/>
							</div>
							<div class="col-md-2">
								<div id="<?php echo $_ns; ?>Picker">上传</div>
							</div>
						</div>
						<?php break; case "images": ?>
						<script>$(function(){EBCMS.TEMP.temp_<?php echo $_field['id']; ?>_renderPics = function(container,extensions,picker){
extensions = extensions?extensions:'gif,jpg,jpeg,bmp,png';var pick = picker||container + 'Picker';var uploader = WebUploader.create({
auto: true,swf: EBCMS.DATA.config.WebUploader_swf,server: EBCMS.DATA.config.WebUploader_server,pick: pick,accept: {
title: 'Images',extensions: extensions,mimeTypes: 'image/*'
}});$(pick).mouseover(function(){
$(this).resize();});uploader.on( 'error', function(code) {EBCMS.MSG.webuploaderMsg(code);});uploader.on( 'uploadError', function( file ) {EBCMS.MSG.alert('上传出错');});uploader.on( 'uploadSuccess', function( file,res ) {
if (res.code) {EBCMS.TEMP.temp_<?php echo $_field['id']; ?>_imgs.push({
img:res.data.pathname,title:res.data.name,description:'',url:'',});EBCMS.TEMP.temp_<?php echo $_field['id']; ?>_refresh_<?php echo $_ns; ?>();}else{EBCMS.MSG.alert(res.msg);};});uploader.on( 'uploadComplete', function( file ) {
});};EBCMS.TEMP.temp_<?php echo $_field['id']; ?>_renderPics('#<?php echo $_ns; ?>'<?php if(!(empty($_field['config']['extensions']) || ($_field['config']['extensions'] instanceof \think\Collection && $_field['config']['extensions']->isEmpty()))): ?>,'<?php echo $_field['config']['extensions']; ?>'<?php endif; ?>);});</script>
						<div class="row">
							<div class="col-md-10">
								<div class="row" id="<?php echo $_ns; ?>_foo"></div>
							</div>
							<div class="col-md-2">
								<div id="<?php echo $_ns; ?>Picker">上传</div>
							</div>
						</div>
						<script src="<?php echo get_root(); ?>/third/sortable/Sortable.js"></script>
						<style>
.x {
	height: 200px;
	border: 1px solid #ddd;
}

.sortable-ghost {
	background: #ddd;
}
</style>
						<script>$(function() {
new Sortable(document.getElementById("<?php echo $_ns; ?>_foo"), {
group: "omega",handle: ".col-md-3",draggable: ".col-md-3",ghostClass: "sortable-ghost",onRemove: function (evt){
},onStart: function (evt){EBCMS.TEMP.temp_<?php echo $_field['id']; ?>_index1 = $(evt.item).index();},onEnd: function (evt){EBCMS.TEMP.temp_<?php echo $_field['id']; ?>_index2 = $(evt.item).index();if (EBCMS.TEMP.temp_<?php echo $_field['id']; ?>_index1 != EBCMS.TEMP.temp_<?php echo $_field['id']; ?>_index2) {EBCMS.TEMP.temp_<?php echo $_field['id']; ?>_img_temp = EBCMS.TEMP.temp_<?php echo $_field['id']; ?>_imgs[EBCMS.TEMP.temp_<?php echo $_field['id']; ?>_index1];for(var i=EBCMS.TEMP.temp_<?php echo $_field['id']; ?>_index1;i<EBCMS.TEMP.temp_<?php echo $_field['id']; ?>_imgs.length;i++){EBCMS.TEMP.temp_<?php echo $_field['id']; ?>_imgs[i]=EBCMS.TEMP.temp_<?php echo $_field['id']; ?>_imgs[i+1]; 
}EBCMS.TEMP.temp_<?php echo $_field['id']; ?>_imgs.length=EBCMS.TEMP.temp_<?php echo $_field['id']; ?>_imgs.length-1;EBCMS.TEMP.temp_<?php echo $_field['id']; ?>_imgs.splice(EBCMS.TEMP.temp_<?php echo $_field['id']; ?>_index2, 0, EBCMS.TEMP.temp_<?php echo $_field['id']; ?>_img_temp);EBCMS.TEMP.temp_<?php echo $_field['id']; ?>_refresh_<?php echo $_ns; ?>();}},});EBCMS.TEMP.temp_<?php echo $_field['id']; ?>_imgs = <?php echo json_encode($_field['value']); ?>||[];EBCMS.TEMP.temp_<?php echo $_field['id']; ?>_refresh_<?php echo $_ns; ?> = function(){EBCMS.CORE.compile({
tpl:'<?php echo $_ns; ?>-item',data:{rows:EBCMS.TEMP.temp_<?php echo $_field['id']; ?>_imgs},target:'#<?php echo $_ns; ?>_foo',});};EBCMS.TEMP.temp_<?php echo $_field['id']; ?>_refresh_<?php echo $_ns; ?>();EBCMS.TEMP.edits_<?php echo $_field['id']; ?> = function(id){
if ('edit' == id) {EBCMS.TEMP.temp_<?php echo $_field['id']; ?>_imgs[EBCMS.TEMP.editid_<?php echo $_field['id']; ?>].title = $('#<?php echo $_ns; ?>_title').val();EBCMS.TEMP.temp_<?php echo $_field['id']; ?>_imgs[EBCMS.TEMP.editid_<?php echo $_field['id']; ?>].description = $('#<?php echo $_ns; ?>_description').val();EBCMS.TEMP.temp_<?php echo $_field['id']; ?>_imgs[EBCMS.TEMP.editid_<?php echo $_field['id']; ?>].url = $('#<?php echo $_ns; ?>_url').val();EBCMS.TEMP.temp_<?php echo $_field['id']; ?>_imgs[EBCMS.TEMP.editid_<?php echo $_field['id']; ?>].img = $('#<?php echo $_ns; ?>_img').val();$('#lgModal').modal('hide');EBCMS.TEMP.temp_<?php echo $_field['id']; ?>_refresh_<?php echo $_ns; ?>();}else{
id = Number(id);EBCMS.TEMP.editid_<?php echo $_field['id']; ?> = id;EBCMS.CORE.compile({
tpl:'<?php echo $_ns; ?>-edit',data:EBCMS.TEMP.temp_<?php echo $_field['id']; ?>_imgs[id],target:'#lgModal .modal-content',compileAfter:function(){EBCMS.FN.renderPic('#<?php echo $_ns; ?>_img'<?php if(!(empty($_field['config']['extensions']) || ($_field['config']['extensions'] instanceof \think\Collection && $_field['config']['extensions']->isEmpty()))): ?>,'<?php echo $_field['config']['extensions']; ?>'<?php endif; ?>);}});}return false;};EBCMS.TEMP.delete_<?php echo $_field['id']; ?> = function(id){
id = Number(id);for(var i=id;i<EBCMS.TEMP.temp_<?php echo $_field['id']; ?>_imgs.length;i++){EBCMS.TEMP.temp_<?php echo $_field['id']; ?>_imgs[i]=EBCMS.TEMP.temp_<?php echo $_field['id']; ?>_imgs[i+1]; 
}EBCMS.TEMP.temp_<?php echo $_field['id']; ?>_imgs.length -= 1;EBCMS.TEMP.temp_<?php echo $_field['id']; ?>_refresh_<?php echo $_ns; ?>();return false;};});</script>
						<script id="<?php echo $_ns; ?>-item" type="text/html">[[each rows as v n]]<div class="col-md-3 col-sm-4 col-xs-6"><div class="panel panel-default"><div class="panel-heading text-overflow" style="width:auto;">[[v.title]]</div><div class="panel-body"><p><img src="<?php echo get_root(); ?>/upload/[[v.img]]" width="100%" height="200" alt=""></p><p><button class="btn btn-primary btn-sm" onclick="return EBCMS.TEMP.edits_<?php echo $_field['id']; ?>('[[n]]');">编辑</button> <button class="btn btn-primary btn-sm" onclick="return EBCMS.TEMP.delete_<?php echo $_field['id']; ?>('[[n]]');">删除</button></p></div></div><input type="hidden" name="<?php echo $_field['field']; ?>[[n | left]][[n]][[n | right]][title]" value="[[v.title]]"><input type="hidden" name="<?php echo $_field['field']; ?>[[n | left]][[n]][[n | right]][img]" value="[[v.img]]"><input type="hidden" name="<?php echo $_field['field']; ?>[[n | left]][[n]][[n | right]][url]" value="[[v.url]]"><input type="hidden" name="<?php echo $_field['field']; ?>[[n | left]][[n]][[n | right]][description]" value="[[v.description]]"></div>[[/each]]</script>
						<script id="<?php echo $_ns; ?>-edit" type="text/html"><div class="modal-header"><button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button><h4 class="modal-title text-danger"><b>编辑图片</b></h4></div><div class="modal-body"><div class="row"><div class="col-md-10"><input id="<?php echo $_ns; ?>_img" class="form-control" value="[[img]]"/></div><div class="col-md-2"><div id="<?php echo $_ns; ?>_imgPicker">上传</div></div></div><div class="form-group"><label class="control-label" for="<?php echo $_ns; ?>_title">标题</label><input type="text" class="form-control" id="<?php echo $_ns; ?>_title" value="[[title]]"></div><div class="form-group"><label class="control-label" for="<?php echo $_ns; ?>_url">链接地址</label><input type="text" class="form-control" id="<?php echo $_ns; ?>_url" value="[[url]]"></div><div class="form-group"><label class="control-label" for="<?php echo $_ns; ?>_description">简介</label><textarea class="form-control" id="<?php echo $_ns; ?>_description" rows="6">[[description]]</textarea></div></div><div class="modal-footer"><button type="button" class="btn btn-primary" onclick="return EBCMS.TEMP.edits_<?php echo $_field['id']; ?>('edit');">提交</button> <button type="button" class="btn btn-default" data-dismiss="modal">关闭</button></div></script>
						<?php break; case "file": ?>
						<script>$(function(){EBCMS.FN.renderFile('#<?php echo $_ns; ?>'<?php if(!(empty($_field['config']['extensions']) || ($_field['config']['extensions'] instanceof \think\Collection && $_field['config']['extensions']->isEmpty()))): ?>,'<?php echo $_field['config']['extensions']; ?>'<?php endif; ?>);});</script>
						<div class="row">
							<div class="col-md-10">
								<input id="<?php echo $_ns; ?>" class="form-control"
									name="<?php echo $_field['field']; ?>"
									value="<?php echo $_field['value']; ?>"
									placeholder="<?php echo (isset($_field['config']['prompt']) && ($_field['config']['prompt'] !== '')?$_field['config']['prompt']:''); ?>"<?php
								if($_field['config']['disabled'] == '1'): ?> disabled
								<?php endif; if($_field['config']['readonly'] == '1'): ?>
								readonly
								<?php endif; if($_field['config']['required'] == '1'): ?>
								required
								<?php endif; ?>
								/>
							</div>
							<div class="col-md-2">
								<div id="<?php echo $_ns; ?>Picker">上传</div>
							</div>
						</div>
						<?php break; case "files": ?>
						<script>$(function(){EBCMS.TEMP.temp_<?php echo $_field['id']; ?>_renderPics = function(container,extensions,picker){
extensions = extensions?extensions:'gif,jpg,jpeg,bmp,png';var pick = picker||container + 'Picker';var uploader = WebUploader.create({
auto: true,swf: EBCMS.DATA.config.WebUploader_swf,server: EBCMS.DATA.config.WebUploader_server,pick: pick,accept: {
title: 'File',extensions: extensions,mimeTypes: '*/*'
}});$(pick).mouseover(function(){
$(this).resize();});uploader.on( 'error', function(code) {EBCMS.MSG.webuploaderMsg(code);});uploader.on( 'uploadError', function( file ) {EBCMS.MSG.alert('上传出错');});uploader.on( 'uploadSuccess', function( file,res ) {
if (res.code) {EBCMS.TEMP.temp_<?php echo $_field['id']; ?>_files.push({
file:res.data.pathname,title:res.data.name,description:'',});EBCMS.TEMP.temp_<?php echo $_field['id']; ?>_refresh_<?php echo $_ns; ?>();}else{EBCMS.MSG.alert(res.msg);};});uploader.on( 'uploadComplete', function( file ) {
});};EBCMS.TEMP.temp_<?php echo $_field['id']; ?>_renderPics('#<?php echo $_ns; ?>'<?php if(!(empty($_field['config']['extensions']) || ($_field['config']['extensions'] instanceof \think\Collection && $_field['config']['extensions']->isEmpty()))): ?>,'<?php echo $_field['config']['extensions']; ?>'<?php endif; ?>);});</script>
						<div class="row">
							<div class="col-md-10">
								<div class="row" id="<?php echo $_ns; ?>_foo"></div>
							</div>
							<div class="col-md-2">
								<div id="<?php echo $_ns; ?>Picker">上传</div>
							</div>
						</div>
						<script src="<?php echo get_root(); ?>/third/sortable/Sortable.js"></script>
						<style>
.x {
	height: 200px;
	border: 1px solid #ddd;
}

.sortable-ghost {
	background: #ddd;
}
</style>
						<script>$(function() {
new Sortable(document.getElementById("<?php echo $_ns; ?>_foo"), {
group: "omega",handle: ".contentlist",draggable: ".contentlist",ghostClass: "sortable-ghost",onRemove: function (evt){
},onStart: function (evt){EBCMS.TEMP.temp_<?php echo $_field['id']; ?>_index1 = $(evt.item).index();},onEnd: function (evt){EBCMS.TEMP.temp_<?php echo $_field['id']; ?>_index2 = $(evt.item).index();if (EBCMS.TEMP.temp_<?php echo $_field['id']; ?>_index1 != EBCMS.TEMP.temp_<?php echo $_field['id']; ?>_index2) {EBCMS.TEMP.temp_<?php echo $_field['id']; ?>_file_temp = EBCMS.TEMP.temp_<?php echo $_field['id']; ?>_files[EBCMS.TEMP.temp_<?php echo $_field['id']; ?>_index1];for(var i=EBCMS.TEMP.temp_<?php echo $_field['id']; ?>_index1;i<EBCMS.TEMP.temp_<?php echo $_field['id']; ?>_files.length;i++){EBCMS.TEMP.temp_<?php echo $_field['id']; ?>_files[i]=EBCMS.TEMP.temp_<?php echo $_field['id']; ?>_files[i+1]; 
}EBCMS.TEMP.temp_<?php echo $_field['id']; ?>_files.length=EBCMS.TEMP.temp_<?php echo $_field['id']; ?>_files.length-1;EBCMS.TEMP.temp_<?php echo $_field['id']; ?>_files.splice(EBCMS.TEMP.temp_<?php echo $_field['id']; ?>_index2, 0, EBCMS.TEMP.temp_<?php echo $_field['id']; ?>_file_temp);EBCMS.TEMP.temp_<?php echo $_field['id']; ?>_refresh_<?php echo $_ns; ?>();}},});EBCMS.TEMP.temp_<?php echo $_field['id']; ?>_files = <?php echo json_encode($_field['value']); ?>||[];EBCMS.TEMP.temp_<?php echo $_field['id']; ?>_refresh_<?php echo $_ns; ?> = function(){EBCMS.CORE.compile({
tpl:'<?php echo $_ns; ?>-item',data:{rows:EBCMS.TEMP.temp_<?php echo $_field['id']; ?>_files},target:'#<?php echo $_ns; ?>_foo',});};EBCMS.TEMP.temp_<?php echo $_field['id']; ?>_refresh_<?php echo $_ns; ?>();EBCMS.TEMP.edits_<?php echo $_field['id']; ?> = function(id){
if ('edit' == id) {EBCMS.TEMP.temp_<?php echo $_field['id']; ?>_files[EBCMS.TEMP.editid_<?php echo $_field['id']; ?>].title = $('#<?php echo $_ns; ?>_title').val();EBCMS.TEMP.temp_<?php echo $_field['id']; ?>_files[EBCMS.TEMP.editid_<?php echo $_field['id']; ?>].description = $('#<?php echo $_ns; ?>_description').val();EBCMS.TEMP.temp_<?php echo $_field['id']; ?>_files[EBCMS.TEMP.editid_<?php echo $_field['id']; ?>].file = $('#<?php echo $_ns; ?>_file').val();$('#lgModal').modal('hide');EBCMS.TEMP.temp_<?php echo $_field['id']; ?>_refresh_<?php echo $_ns; ?>();}else{
id = Number(id);EBCMS.TEMP.editid_<?php echo $_field['id']; ?> = id;EBCMS.CORE.compile({
tpl:'<?php echo $_ns; ?>-edit',data:EBCMS.TEMP.temp_<?php echo $_field['id']; ?>_files[id],target:'#lgModal .modal-content',compileAfter:function(){EBCMS.FN.renderFile('#<?php echo $_ns; ?>_file'<?php if(!(empty($_field['config']['extensions']) || ($_field['config']['extensions'] instanceof \think\Collection && $_field['config']['extensions']->isEmpty()))): ?>,'<?php echo $_field['config']['extensions']; ?>'<?php endif; ?>);}});}return false;};EBCMS.TEMP.delete_<?php echo $_field['id']; ?> = function(id){
id = Number(id);for(var i=id;i<EBCMS.TEMP.temp_<?php echo $_field['id']; ?>_files.length;i++){EBCMS.TEMP.temp_<?php echo $_field['id']; ?>_files[i]=EBCMS.TEMP.temp_<?php echo $_field['id']; ?>_files[i+1]; 
}EBCMS.TEMP.temp_<?php echo $_field['id']; ?>_files.length -= 1;EBCMS.TEMP.temp_<?php echo $_field['id']; ?>_refresh_<?php echo $_ns; ?>();return false;};});</script>
						<script id="<?php echo $_ns; ?>-item" type="text/html">[[each rows as v n]]<div class="media contentlist"><div class="media-left"><i class="iconfont icon-[[v.file | fileicon]] text-primary" style="font-size:6em;"></i></div><div class="media-body"><h3 class="media-heading">[[v.title]]</h3><div class="description">[[v.description]]</div><div style="margin:10px auto;"><button class="btn btn-primary btn-sm" onclick="return EBCMS.TEMP.edits_<?php echo $_field['id']; ?>('[[n]]');">编辑</button> <button class="btn btn-primary btn-sm" onclick="return EBCMS.TEMP.delete_<?php echo $_field['id']; ?>('[[n]]');">删除</button></div></div><input type="hidden" name="<?php echo $_field['field']; ?>[[n | left]][[n]][[n | right]][title]" value="[[v.title]]"><input type="hidden" name="<?php echo $_field['field']; ?>[[n | left]][[n]][[n | right]][file]" value="[[v.file]]"><input type="hidden" name="<?php echo $_field['field']; ?>[[n | left]][[n]][[n | right]][description]" value="[[v.description]]"></div>[[/each]]</script>
						<script id="<?php echo $_ns; ?>-edit" type="text/html"><div class="modal-header"><button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button><h4 class="modal-title text-danger"><b>编辑附件</b></h4></div><div class="modal-body"><div class="row"><div class="col-md-10"><input id="<?php echo $_ns; ?>_file" class="form-control" value="[[file]]"/></div><div class="col-md-2"><div id="<?php echo $_ns; ?>_filePicker">上传</div></div></div><div class="form-group"><label class="control-label" for="<?php echo $_ns; ?>_title">标题</label><input type="text" class="form-control" id="<?php echo $_ns; ?>_title" value="[[title]]"></div><div class="form-group"><label class="control-label" for="<?php echo $_ns; ?>_description">简介</label><textarea class="form-control" id="<?php echo $_ns; ?>_description" rows="6">[[description]]</textarea></div></div><div class="modal-footer"><button type="button" class="btn btn-primary" onclick="return EBCMS.TEMP.edits_<?php echo $_field['id']; ?>('edit');">提交</button> <button type="button" class="btn btn-default" data-dismiss="modal">关闭</button></div></script>
						<?php break; case "ueditor": ?>
						<script>$(function(){EBCMS.FN.renderUE('<?php echo $_ns; ?>',{
autoHeightEnabled:<?php echo (isset($_field['config']['autoheightenabled']) && ($_field['config']['autoheightenabled'] !== '')?$_field['config']['autoheightenabled']:'false'); ?>,maximumWords:<?php echo (isset($_field['config']['maximumwords']) && ($_field['config']['maximumwords'] !== '')?$_field['config']['maximumwords']:'10000'); ?>,wordCount:<?php echo (isset($_field['config']['wordcount']) && ($_field['config']['wordcount'] !== '')?$_field['config']['wordcount']:'true'); ?>,elementPathEnabled:<?php echo (isset($_field['config']['elementpathenabled']) && ($_field['config']['elementpathenabled'] !== '')?$_field['config']['elementpathenabled']:'true'); ?>,initialFrameHeight:<?php echo (isset($_field['config']['initialframeheight']) && ($_field['config']['initialframeheight'] !== '')?$_field['config']['initialframeheight']:'420'); ?>,});});</script>
						<textarea name="<?php echo $_field['field']; ?>"
							id="<?php echo $_ns; ?>"><?php echo $_field['value']; ?></textarea>
						<?php break; case "combotree": ?>
						<script>$(function(){<?php 
if ($_field['config']['queryparams']) {
$_where = '';$_queryparams = explode("\r\n",$_field['config']['queryparams']);foreach ($_queryparams as $key => $value) {
$_tmp = explode('|',$value);if (stripos($_tmp[2],'(I)') === 0) {
$_tmp[2] = input(substr($_tmp[2],3));}elseif(stripos($_tmp[2],'(@)') === 0){
$_tmp[2] = $_data[substr($_tmp[2],3)];}elseif(stripos($_tmp[2],'($)') === 0){
$_tmp[2] = get_tpl_value($_data,substr($_tmp[2],3));};$_where .= $_tmp[0].":['".$_tmp[1]."','".$_tmp[2]."'],";}};$_field['config']['group'] = isset($_field['config']['group'])?$_field['config']['group']:0;$_field['config']['tree'] = isset($_field['config']['tree'])?$_field['config']['tree']:0;$_field['config']['rootitem'] = isset($_field['config']['rootitem'])?$_field['config']['rootitem']:0;$_field['config']['editable'] = isset($_field['config']['editable'])?$_field['config']['editable']:0;?>EBCMS.CORE.api({<?php if($_field['config']['group'] == '1'): ?>group:'group',<?php else: if($_field['config']['tree'] == '1'): ?>tree:'tree',<?php endif; if($_field['config']['rootitem'] == '1'): ?>rootitem:true,<?php endif; endif; ?>queryParams:{
order:{
'sort':'desc',},model:'<?php echo $_field['config']['model']; ?>',<?php if(!(empty($_field['config']['queryparams']) || ($_field['config']['queryparams'] instanceof \think\Collection && $_field['config']['queryparams']->isEmpty()))): ?>where:{<?php echo $_where; ?>},<?php endif; ?>},loadAfter:function(data){
$select = $('#<?php echo $_ns; ?>');var str = EBCMS.FN.renderSelect(data['rows'],'<?php echo $_field['value']; ?>','<?php echo (isset($_field['config']['valuefield']) && ($_field['config']['valuefield'] !== '')?$_field['config']['valuefield']:"id"); ?>','<?php echo (isset($_field['config']['textfield']) && ($_field['config']['textfield'] !== '')?$_field['config']['textfield']:"title"); ?>');$select.append(str);}});});</script>
						<?php if($_field['config']['editable'] == '1'): ?>
						<div class="row">
							<div class="col-md-8">
								<input type="text" class="form-control"
									id="<?php echo $_ns; ?>_obj"
									name="<?php echo $_field['field']; ?>"
									value="<?php echo $_field['value']; ?>"
									placeholder="<?php echo (isset($_field['config']['prompt']) && ($_field['config']['prompt'] !== '')?$_field['config']['prompt']:''); ?>"<?php
								if($_field['config']['readonly'] == '1'): ?> readonly
								<?php endif; if($_field['config']['disabled'] == '1'): ?>
								disabled
								<?php endif; if($_field['config']['required'] == '1'): ?>
								required
								<?php endif; ?>
								>
							</div>
							<div class="col-md-4">
								<select class="form-control" id="<?php echo $_ns; ?>"
									onchange="$('#<?php echo $_ns; ?>_obj').val($(this).val());"<?php
									if($_field['config']['readonly'] == '1'): ?> readonly
									<?php endif; if($_field['config']['disabled'] == '1'): ?>
									disabled
									<?php endif; if($_field['config']['required'] == '1'): ?>
									required
									<?php endif; ?>>
								</select>
							</div>
						</div>
						<?php else: ?>
						<select class="form-control" id="<?php echo $_ns; ?>"
							name="<?php echo $_field['field']; ?>"<?php
							if($_field['config']['readonly'] == '1'): ?> readonly
							<?php endif; if($_field['config']['disabled'] == '1'): ?>
							disabled
							<?php endif; if($_field['config']['required'] == '1'): ?>
							required
							<?php endif; ?>>
						</select>
						<?php endif; break; case "datadict": ?>
						<script>$(function(){EBCMS.CORE.datadict({
queryParams:{
order:{
'sort':'desc',},datadict:'<?php echo $_field['config']['datadict']; ?>',},<?php if($_field['config']['rootitem'] == '1'): ?>rootitem:true,<?php endif; ?>loadAfter:function(res){
$select = $('#<?php echo $_ns; ?>');var str = EBCMS.FN.renderSelect(res['rows'],'<?php echo $_field['value']; ?>','<?php echo (isset($_field['config']['valuefield']) && ($_field['config']['valuefield'] !== '')?$_field['config']['valuefield']:"id"); ?>','<?php echo (isset($_field['config']['textfield']) && ($_field['config']['textfield'] !== '')?$_field['config']['textfield']:"title"); ?>');$select.append(str);}});});</script>
						<?php 
$_field['config']['editable'] = isset($_field['config']['editable'])?$_field['config']['editable']:0;if($_field['config']['editable'] == '1'): ?>
						<div class="row">
							<div class="col-md-8">
								<input type="text" class="form-control"
									id="<?php echo $_ns; ?>_obj"
									name="<?php echo $_field['field']; ?>"
									value="<?php echo $_field['value']; ?>"
									placeholder="<?php echo (isset($_field['config']['prompt']) && ($_field['config']['prompt'] !== '')?$_field['config']['prompt']:''); ?>"<?php
								if($_field['config']['readonly'] == '1'): ?> readonly
								<?php endif; if($_field['config']['disabled'] == '1'): ?>
								disabled
								<?php endif; if($_field['config']['required'] == '1'): ?>
								required
								<?php endif; ?>
								>
							</div>
							<div class="col-md-4">
								<select class="form-control" id="<?php echo $_ns; ?>"
									onchange="$('#<?php echo $_ns; ?>_obj').val($(this).val());"<?php
									if($_field['config']['readonly'] == '1'): ?> readonly
									<?php endif; if($_field['config']['disabled'] == '1'): ?>
									disabled
									<?php endif; if($_field['config']['required'] == '1'): ?>
									required
									<?php endif; ?>>
								</select>
							</div>
						</div>
						<?php else: ?>
						<select class="form-control" id="<?php echo $_ns; ?>"
							name="<?php echo $_field['field']; ?>"<?php
							if($_field['config']['readonly'] == '1'): ?> readonly
							<?php endif; if($_field['config']['disabled'] == '1'): ?>
							disabled
							<?php endif; if($_field['config']['required'] == '1'): ?>
							required
							<?php endif; ?>>
						</select>
						<?php endif; break; case "numberbox": ?>
						<input type="number" id="<?php echo $_ns; ?>" class="form-control"
							name="<?php echo $_field['field']; ?>"
							value="<?php echo $_field['value']; ?>"<?php
						if($_field['config']['readonly'] == '1'): ?> readonly
						<?php endif; if($_field['config']['disabled'] == '1'): ?>
						disabled
						<?php endif; if($_field['config']['required'] == '1'): ?>
						required
						<?php endif; ?>
						/>
						<?php break; case "timespinner": ?>
						<input type="time" id="<?php echo $_ns; ?>" class="form-control"
							name="<?php echo $_field['field']; ?>"
							value="<?php echo $_field['value']; ?>" id="<?php echo $_ns; ?>"<?php
						if($_field['config']['readonly'] == '1'): ?> readonly
						<?php endif; if($_field['config']['disabled'] == '1'): ?>
						disabled
						<?php endif; if($_field['config']['required'] == '1'): ?>
						required
						<?php endif; ?>
						/>
						<?php break; case "datebox": ?>
						<input type="date" id="<?php echo $_ns; ?>" class="form-control"
							name="<?php echo $_field['field']; ?>"
							value="<?php echo $_field['value']; ?>" id="<?php echo $_ns; ?>"<?php
						if($_field['config']['readonly'] == '1'): ?> readonly
						<?php endif; if($_field['config']['disabled'] == '1'): ?>
						disabled
						<?php endif; if($_field['config']['required'] == '1'): ?>
						required
						<?php endif; ?>
						/>
						<?php break; case "datetimebox": ?>
						<input type="datetime-local" id="<?php echo $_ns; ?>"
							class="form-control" name="<?php echo $_field['field']; ?>"
							value="<?php echo datetimelocal($_field['value']); ?>"
							id="<?php echo $_ns; ?>"<?php
						if($_field['config']['readonly'] == '1'): ?> readonly
						<?php endif; if($_field['config']['disabled'] == '1'): ?>
						disabled
						<?php endif; if($_field['config']['required'] == '1'): ?>
						required
						<?php endif; ?>
						/>
						<?php break; case "extendtext": ?>
						<script>Namespace.register("EBCMS.Form_extendtext");$(function() {EBCMS.Form_extendtext.changename = function(id,value){
$(id).attr('name','<?php echo $_field['field']; ?>['+value+']');};EBCMS.Form_extendtext.up = function(id){
if ($(id).prev().hasClass('form-group')) {
$(id).insertBefore($(id).prev());}};EBCMS.Form_extendtext.down = function(id){
if ($(id).next().hasClass('form-group')) {
$(id).next().insertBefore($(id));}};EBCMS.Form_extendtext.render_text = function(name,value,target){
name = name||'EB_' + EBCMS.FN.random_str(6);opt = {
name:name,value:value||'',id:'<?php echo $_ns; ?>_' + EBCMS.FN.random_str(15),};var str = '';str += '<div class="form-group" id="'+opt.id+'_group">';str += '<div class="col-sm-1 control-label"><label>';str += '<i class="iconfont icon-shanchu cursor-pointer" onclick="$(\'#'+opt.id+'_group\').remove();"></i>';str += '<i class="iconfont icon-xiayi cursor-pointer" onclick="EBCMS.Form_extendtext.down(\'#'+opt.id+'_group\');"></i>';str += '<i class="iconfont icon-shangyi cursor-pointer" onclick="EBCMS.Form_extendtext.up(\'#'+opt.id+'_group\');"></i>';str += '<label></div>';str += '<div class="col-sm-2">';str += '<input type="text" class="form-control" value="'+opt.name+'" onKeyUp="EBCMS.Form_extendtext.changename(\'#'+opt.id+'\',$(this).val());" placeholder="填写名称">';str += '</div>';str += '<div class="col-sm-9">';str += '<input type="text" class="form-control" id="'+opt.id+'" name="<?php echo $_field['field']; ?>['+opt.name+']" value="'+opt.value+'" placeholder="填写值">';str += '</div>';str += '</div>';if (target) {
$(target).append(str);}else{
return str;}};var forms = <?php echo json_encode($_field['value']); ?>||{};if (typeof forms!='object') {
forms = {};}$.each(forms, function(name, val) {EBCMS.Form_extendtext.render_text(name,val,'#<?php echo $_field['id']; ?>_container');});});</script>
						<div class="row">
							<div class="col-sm-12">
								<div class="btn-group" role="group" aria-label="...">
									<button type="button" class="btn btn-primary btn-sm"
										onclick="EBCMS.Form_extendtext.render_text('','','#<?php echo $_field['id']; ?>_container');">单行文本</button>
								</div>
							</div>
						</div>
						<br>
						<div class="row">
							<div class="col-sm-12"
								id="<?php echo $_field['id']; ?>_container"></div>
						</div>
						<?php break; case "keywords": ?>
						<div class="row">
							<div class="col-md-8">
								<input id="<?php echo $_ns; ?>" class="form-control"
									name="<?php echo $_field['field']; ?>"
									value="<?php echo $_field['value']; ?>"
									placeholder="<?php echo (isset($_field['config']['prompt']) && ($_field['config']['prompt'] !== '')?$_field['config']['prompt']:''); ?>"<?php
								if($_field['config']['disabled'] == '1'): ?> disabled
								<?php endif; if($_field['config']['readonly'] == '1'): ?>
								readonly
								<?php endif; if($_field['config']['required'] == '1'): ?>
								required
								<?php endif; ?>
								/>
							</div>
							<div class="col-md-2">
								<button type="button" class="btn btn-primary btn-block"
									onclick="EBCMS.FN.suggest_keywords('#<?php echo $_ns; ?>');">长尾关键词</button>
							</div>
							<div class="col-md-2">
								<button type="button" class="btn btn-primary btn-block"
									onclick="EBCMS.FN.suggest_keywords('#<?php echo $_ns; ?>','<?php if(isset($_field['config']['field']) && $_field['config']['field']){echo 'ebcms_'.md5('ebcmsformfield_'.$_field['config']['field'].$_nowtime);}else{echo '0';} ?>','<?php echo (isset($_field['config']['strong']) && ($_field['config']['strong'] !== '')?$_field['config']['strong']:'0'); ?>');">插入到内容</button>
							</div>
						</div>
						<?php break; default: ?>
						<span style="color: red;">
							<?php echo $_field['type']; ?>表单类型不存在 请联系专业人员
						</span>
						<?php endswitch; if(!(empty($_field['remark']) || ($_field['remark'] instanceof \think\Collection && $_field['remark']->isEmpty()))): ?>
						<p class="help-block">
							<?php echo $_field['remark']; ?>
						</p>
						<?php endif; ?>
					</div>
				</div>
				<?php endif; endforeach; ?>
			</div>
			<?php endforeach; endif; ?>
		</div>
	</form>
</div>
<div class="modal-footer">
	<button type="button" class="btn btn-primary"
		onclick="EBCMS.Forms.FormSubmit();">提交</button>
	<button type="button" class="btn btn-default" data-dismiss="modal">关闭</button>
</div>
<?php else: ?>
<script>Namespace.register("EBCMS.Forms");$(function(){EBCMS.Forms.FormSubmit = function FormSubmit(){
var x = <?php echo (isset($_form['ext']) && ($_form['ext'] !== '')?$_form['ext']:'new Object'); ?>;if (x.submit_alert == 1) {EBCMS.MSG.confirm(x.submit_msg,function(){EBCMS.CORE.submit({
url:'<?php echo $_form['action']; ?>',form:'<?php echo $_form['formtime']; ?>Form',success:function(data){
if (data.code) {EBCMS.MSG.notice(data.msg);EBCMS.Forms.closes();if (EBCMS.<?php echo $namespace; ?> && EBCMS.<?php echo $namespace; ?>.refresh && typeof EBCMS.<?php echo $namespace; ?>.refresh == 'function') {EBCMS.<?php echo $namespace; ?>.refresh();};}else{
if (data.data.action) {EBCMS.MSG.confirm(data.msg,function(){
if (EBCMS[data.data.namespace] && EBCMS[data.data.namespace][data.data.action] && typeof EBCMS[data.data.namespace][data.data.action] == 'function') {EBCMS[data.data.namespace][data.data.action](data.data.param);}else{EBCMS.MSG.alert('后台参数错误！');}});}else{EBCMS.MSG.alert(data.msg);}}}});});}else{EBCMS.CORE.submit({
url:'<?php echo $_form['action']; ?>',form:'<?php echo $_form['formtime']; ?>Form',success:function(data){
if (data.code) {EBCMS.MSG.notice(data.msg);EBCMS.Forms.closes();if (EBCMS.<?php echo $namespace; ?> && EBCMS.<?php echo $namespace; ?>.refresh && typeof EBCMS.<?php echo $namespace; ?>.refresh == 'function') {EBCMS.<?php echo $namespace; ?>.refresh();};}else{
if (data.data.action) {EBCMS.MSG.confirm(data.msg,function(){
if (EBCMS[data.data.namespace] && EBCMS[data.data.namespace][data.data.action] && typeof EBCMS[data.data.namespace][data.data.action] == 'function') {EBCMS[data.data.namespace][data.data.action](data.data.param);}else{EBCMS.MSG.alert('后台参数错误！');}});}else{EBCMS.MSG.alert(data.msg);}}}});}};EBCMS.Forms.closes = function closes(){
$('#main').show().siblings().hide();};EBCMS.FN.tabs('#<?php echo $_form['formtime']; ?>_tabs','#<?php echo $_form['formtime']; ?>_tabboxs');});</script>
<div class="header">
	<div class="pull-right">
		<button class="btn btn-primary" onclick="EBCMS.Forms.FormSubmit();">提交</button>
		<button class="btn btn-default" onclick="EBCMS.Forms.closes();">关闭</button>
	</div>
	<div class="header-title text-danger">
		<b>
			<?php echo $_form['group']; ?>&nbsp;-&nbsp;<?php echo $_form['title']; ?>
		</b>
	</div>
</div>
<div class="body" style="bottom: 0px;">
	<div class="box" id="<?php echo $namespace; ?>_table">
		<form class="form-horizontal xxxx"
			id="<?php echo $_form['formtime']; ?>Form">
			<div class="tabs" id="<?php echo $_form['formtime']; ?>_tabs">
				<?php foreach($_groups as $key => $_fields): ?>
				<div class="tab-head">
					<?php echo $key; ?>
				</div>
				<?php endforeach; if(!(empty($_extgroups) || ($_extgroups instanceof \think\Collection && $_extgroups->isEmpty()))): foreach($_extgroups as $key => $_fields): ?>
				<div class="tab-head">
					<?php echo $key; ?>
				</div>
				<?php endforeach; endif; ?>
			</div>
			<div class="tabboxs" id="<?php echo $_form['formtime']; ?>_tabboxs">
				<?php foreach($_groups as $key => $_fields): ?>
				<div class="tab-body">
					<?php foreach($_fields as $key => $_field): 
$_nowtime = time();$_ns = 'ebcms_'.md5('ebcmsformfield_'.$_field['field'].$_nowtime);$_field['config']['disabled'] = isset($_field['config']['disabled'])?$_field['config']['disabled']:0;$_field['config']['required'] = isset($_field['config']['required'])?$_field['config']['required']:0;$_field['config']['readonly'] = isset($_field['config']['readonly'])?$_field['config']['readonly']:0;if($_field['type'] == 'hidden'): ?>
					<input type="hidden" name="<?php echo $_field['field']; ?>"
						value="<?php echo $_field['value']; ?>" />
					<?php elseif($_field['type'] == 'extend'): ?>
					<script>Namespace.register("EBCMS.Form");$(function() {EBCMS.Form.changename = function(id,value){
if ($(id).is('div')) {
$(id).next().attr('name','<?php echo $_field['field']; ?>['+value+']');}else{
$(id).attr('name','<?php echo $_field['field']; ?>['+value+']');}$(id+'__config__').attr('name','<?php echo $_field['field']; ?>[__config__]['+value+']');};EBCMS.Form.up = function(id){
if ($(id).prev().hasClass('form-group')) {
$(id).insertBefore($(id).prev());}};EBCMS.Form.down = function(id){
if ($(id).next().hasClass('form-group')) {
$(id).next().insertBefore($(id));}};EBCMS.Form.render = function(name,value,target){
if (EBCMS.Form.config[name]) {
}else{EBCMS.Form.config[name] = 'text';}if (EBCMS.Form['render_'+EBCMS.Form.config[name]]) {EBCMS.Form['render_'+EBCMS.Form.config[name]](name,value,target);}};EBCMS.Form.render_text = function(name,value,target){
name = name||'EB_' + EBCMS.FN.random_str(6);opt = {
name:name,value:value||'',id:'<?php echo $_ns; ?>_' + EBCMS.FN.random_str(15),};var str = '';str += '<div class="form-group" id="'+opt.id+'_group">';str += '<div class="col-sm-1 control-label"><label>';str += '<i class="iconfont icon-shanchu cursor-pointer" onclick="$(\'#'+opt.id+'_group\').remove();"></i>';str += '<i class="iconfont icon-xiayi cursor-pointer" onclick="EBCMS.Form.down(\'#'+opt.id+'_group\');"></i>';str += '<i class="iconfont icon-shangyi cursor-pointer" onclick="EBCMS.Form.up(\'#'+opt.id+'_group\');"></i>';str += '<label></div>';str += '<div class="col-sm-2">';str += '<input type="text" class="form-control" value="'+opt.name+'" onKeyUp="EBCMS.Form.changename(\'#'+opt.id+'\',$(this).val());" placeholder="填写名称">';str += '</div>';str += '<div class="col-sm-9">';str += '<input type="text" class="form-control" id="'+opt.id+'" name="<?php echo $_field['field']; ?>['+opt.name+']" value="'+opt.value+'" placeholder="填写值">';str += '</div>';str += '<input type="hidden" id="'+opt.id+'__config__" name="<?php echo $_field['field']; ?>[__config__]['+opt.name+']" value="text">';str += '</div>';if (target) {
$(target).append(str);}else{
return str;}};EBCMS.Form.render_textarea = function(name,value,target){
name = name||'EB_' + EBCMS.FN.random_str(6);opt = {
name:name,value:value||'',id:'<?php echo $_ns; ?>_' + EBCMS.FN.random_str(15),};var str = '';str += '<div class="form-group" id="'+opt.id+'_group">';str += '<div class="col-sm-1 control-label"><label>';str += '<i class="iconfont icon-shanchu cursor-pointer" onclick="$(\'#'+opt.id+'_group\').remove();"></i>';str += '<i class="iconfont icon-xiayi cursor-pointer" onclick="EBCMS.Form.down(\'#'+opt.id+'_group\');"></i>';str += '<i class="iconfont icon-shangyi cursor-pointer" onclick="EBCMS.Form.up(\'#'+opt.id+'_group\');"></i>';str += '<label></div>';str += '<div class="col-sm-2">';str += '<input type="text" class="form-control" value="'+opt.name+'" onKeyUp="EBCMS.Form.changename(\'#'+opt.id+'\',$(this).val());" placeholder="填写名称">';str += '</div>';str += '<div class="col-sm-9">';str += '<textarea class="form-control" id="'+opt.id+'" name="<?php echo $_field['field']; ?>['+opt.name+']" rows="3" placeholder="填写内容">'+opt.value+'</textarea>';str += '</div>';str += '<input type="hidden" id="'+opt.id+'__config__" name="<?php echo $_field['field']; ?>[__config__]['+opt.name+']" value="textarea">';str += '</div>';if (target) {
$(target).append(str);}else{
return str;}};EBCMS.Form.render_file = function(name,value,target){
name = name||'EB_' + EBCMS.FN.random_str(6);opt = {
name:name,value:value||'',id:'<?php echo $_ns; ?>_' + EBCMS.FN.random_str(15),};var str = '';str += '<div class="form-group" id="'+opt.id+'_group">';str += '<div class="col-sm-1 control-label"><label>';str += '<i class="iconfont icon-shanchu cursor-pointer" onclick="$(\'#'+opt.id+'_group\').remove();"></i>';str += '<i class="iconfont icon-xiayi cursor-pointer" onclick="EBCMS.Form.down(\'#'+opt.id+'_group\');"></i>';str += '<i class="iconfont icon-shangyi cursor-pointer" onclick="EBCMS.Form.up(\'#'+opt.id+'_group\');"></i>';str += '<label></div>';str += '<div class="col-sm-2">';str += '<input type="text" class="form-control" value="'+opt.name+'" onKeyUp="EBCMS.Form.changename(\'#'+opt.id+'\',$(this).val());" placeholder="填写名称">';str += '</div>';str += '<div class="col-sm-7">';str += '<input type="text" class="form-control" id="'+opt.id+'" name="<?php echo $_field['field']; ?>['+opt.name+']" value="'+opt.value+'" placeholder="填写值">';str += '</div>';str += '<div class="col-sm-2">';str += '<div id="'+opt.id+'Picker">上传</div>';str += '</div>';str += '<input type="hidden" id="'+opt.id+'__config__" name="<?php echo $_field['field']; ?>[__config__]['+opt.name+']" value="file">';str += '<script>';str += '$(function(){';str += '    EBCMS.FN.renderFile(\'#'+opt.id+'\');';str += '});';str += '<\/script>';str += '</div>';if (target) {
$(target).append(str);}else{
return str;}};EBCMS.Form.render_ueditor = function(name,value,target){
name = name||'EB_' + EBCMS.FN.random_str(6);opt = {
name:name,value:value||'',id:'<?php echo $_ns; ?>_' + EBCMS.FN.random_str(15),};var str = '';str += '<div class="form-group" id="'+opt.id+'_group">';str += '<div class="col-sm-1 control-label"><label>';str += '<i class="iconfont icon-shanchu cursor-pointer" onclick="$(\'#'+opt.id+'_group\').remove();"></i>';str += '<i class="iconfont icon-xiayi cursor-pointer" onclick="EBCMS.Form.down(\'#'+opt.id+'_group\');"></i>';str += '<i class="iconfont icon-shangyi cursor-pointer" onclick="EBCMS.Form.up(\'#'+opt.id+'_group\');"></i>';str += '<label></div>';str += '<div class="col-sm-2">';str += '<input type="text" class="form-control" value="'+opt.name+'" onKeyUp="EBCMS.Form.changename(\'#'+opt.id+'\',$(this).val());" placeholder="填写名称">';str += '</div>';str += '<div class="col-sm-9">';str += '<textarea id="'+opt.id+'" name="<?php echo $_field['field']; ?>['+opt.name+']" >'+opt.value+'</textarea>';str += '</div>';str += '<input type="hidden" id="'+opt.id+'__config__" name="<?php echo $_field['field']; ?>[__config__]['+opt.name+']" value="ueditor">';str += '<script>';str += '$(function(){';str += '    EBCMS.FN.renderUE("'+opt.id+'",{';str += '          autoHeightEnabled:false,';str += '          maximumWords:99999,';str += '          wordCount:true,';str += '          elementPathEnabled:true,';str += '          initialFrameHeight:400,';str += '    });';str += '});';str += '<\/script>';str += '</div>';if (target) {
$(target).append(str);}else{
return str;}};var forms = <?php echo json_encode($_field['value']); ?>||{};if (typeof forms!='object') {
forms = {};}EBCMS.Form.config = forms['__config__']||{};delete forms['__config__'];$.each(forms, function(name, val) {EBCMS.Form.render(name,val,'#<?php echo $_field['id']; ?>_container');});});</script>
					<div class="row">
						<div class="col-sm-12">
							<div class="btn-group" role="group" aria-label="...">
								<button type="button" class="btn btn-primary btn-sm"
									onclick="EBCMS.Form.render_text('','','#<?php echo $_field['id']; ?>_container');">单行文本</button>
								<button type="button" class="btn btn-primary btn-sm"
									onclick="EBCMS.Form.render_textarea('','','#<?php echo $_field['id']; ?>_container');">多行文本</button>
								<button type="button" class="btn btn-primary btn-sm"
									onclick="EBCMS.Form.render_file('','','#<?php echo $_field['id']; ?>_container');">文件</button>
								<button type="button" class="btn btn-primary btn-sm"
									onclick="EBCMS.Form.render_ueditor('','','#<?php echo $_field['id']; ?>_container');">编辑框</button>
							</div>
						</div>
					</div>
					<br>
					<div class="row">
						<div class="col-sm-12" id="<?php echo $_field['id']; ?>_container"></div>
					</div>
					<input type="hidden"
						name="<?php echo $_field['field']; ?>[__config__][__test__]"
						value='test'>
					<?php else: ?>
					<div class="form-group">
						<label for="<?php echo $_ns; ?>" class="col-sm-2 control-label">
							<?php echo $_field['title']; ?>
						</label>
						<div class="col-sm-10">
							<?php switch($_field['type']): case "bool": ?>
							<label class="radio-inline" for="<?php echo $_ns; ?>_1"><input
								type="radio" id="<?php echo $_ns; ?>_1"
								name="<?php echo $_field['field']; ?>" value="1"<?php
								if($_field['value'] == '1'): ?>checked<?php endif; if($_field['config']['disabled'] == '1'): ?>
								disabled<?php endif; if($_field['config']['readonly'] == '1'): ?>
								readonly<?php endif; ?>> 是</label><label class="radio-inline"
								for="<?php echo $_ns; ?>_0"><input type="radio"
								id="<?php echo $_ns; ?>_0"
								name="<?php echo $_field['field']; ?>" value="0"<?php
								if($_field['value'] == '0'): ?>checked<?php endif; if($_field['config']['disabled'] == '1'): ?>
								disabled<?php endif; if($_field['config']['readonly'] == '1'): ?>
								readonly<?php endif; ?>> 否</label>
							<?php break; case "select": 
$_temps = explode("\r\n",$_field['config']['values']);$_field['config']['editable'] = isset($_field['config']['editable'])?$_field['config']['editable']:0;if($_field['config']['editable'] == '1'): ?>
							<div class="row">
								<div class="col-md-8">
									<input type="text" class="form-control"
										id="<?php echo $_ns; ?>_obj"
										name="<?php echo $_field['field']; ?>"
										value="<?php echo $_field['value']; ?>"
										placeholder="<?php echo (isset($_field['config']['prompt']) && ($_field['config']['prompt'] !== '')?$_field['config']['prompt']:''); ?>"<?php
									if($_field['config']['readonly'] == '1'): ?> readonly
									<?php endif; if($_field['config']['disabled'] == '1'): ?>
									disabled
									<?php endif; if($_field['config']['required'] == '1'): ?>
									required
									<?php endif; ?>
									>
								</div>
								<div class="col-md-4">
									<select class="form-control" id="<?php echo $_ns; ?>"
										onchange="$('#<?php echo $_ns; ?>_obj').val($(this).val());"<?php
										if($_field['config']['readonly'] == '1'): ?> readonly
										<?php endif; if($_field['config']['disabled'] == '1'): ?>
										disabled
										<?php endif; if($_field['config']['required'] == '1'): ?>
										required
										<?php endif; ?>>
										<?php if(is_array($_temps) || $_temps instanceof \think\Collection): if( count($_temps)==0 ) : echo "" ;else: foreach($_temps as $key=>$_temp): $_temp = explode("|",$_temp); ?>
										<option value="<?php echo $_temp[1]; ?>"<?php
											if($_field['value'] == $_temp[1]): ?>selected
											<?php endif; ?>>
											<?php echo $_temp[0]; ?></option>
										<?php endforeach; endif; else: echo "" ;endif; ?>
									</select>
								</div>
							</div>
							<?php else: ?>
							<select class="form-control" id="<?php echo $_ns; ?>"
								name="<?php echo $_field['field']; ?>"<?php
								if($_field['config']['readonly'] == '1'): ?> readonly
								<?php endif; if($_field['config']['disabled'] == '1'): ?>
								disabled
								<?php endif; if($_field['config']['required'] == '1'): ?>
								required
								<?php endif; ?>>
								<?php if(is_array($_temps) || $_temps instanceof \think\Collection): if( count($_temps)==0 ) : echo "" ;else: foreach($_temps as $key=>$_temp): $_temp = explode("|",$_temp); ?>
								<option value="<?php echo $_temp[1]; ?>"<?php
									if($_field['value'] == $_temp[1]): ?>selected
									<?php endif; ?>>
									<?php echo $_temp[0]; ?></option>
								<?php endforeach; endif; else: echo "" ;endif; ?>
							</select>
							<?php endif; break; case "radio": $_temps = explode("\r\n",$_field['config']['values']); if(is_array($_temps) || $_temps instanceof \think\Collection): if( count($_temps)==0 ) : echo "" ;else: foreach($_temps as $key=>$_temp): $_temp = explode("|",$_temp); ?>
							<label class="radio-inline"
								for="<?php echo $_ns; ?>_<?php echo $key; ?>"><input
								type="radio" name="<?php echo $_field['field']; ?>"
								id="<?php echo $_ns; ?>_<?php echo $key; ?>"
								value="<?php echo $_temp[1]; ?>"<?php
								if($_field['value'] == $_temp[1]): ?>checked<?php endif; if($_field['config']['disabled'] == '1'): ?>
								disabled<?php endif; if($_field['config']['readonly'] == '1'): ?>
								readonly<?php endif; ?>> <?php echo $_temp[0]; ?></label>
							<?php endforeach; endif; else: echo "" ;endif; break; case "checkbox": $_temps = explode("\r\n",$_field['config']['values']); if(is_array($_temps) || $_temps instanceof \think\Collection): if( count($_temps)==0 ) : echo "" ;else: foreach($_temps as $key=>$_temp): $_temp = explode("|",$_temp); ?>
							<label class="checkbox-inline"
								for="<?php echo $_ns; ?>_<?php echo $key; ?>"><input
								type="checkbox" id="<?php echo $_ns; ?>_<?php echo $key; ?>"
								name="<?php echo $_field['field']; ?>[]"
								value="<?php echo $_temp[1]; ?>"<?php
								if(in_array(($_temp['1']),
								is_array($_field['value'])?$_field['value']:explode(',',$_field['value']))):
								?>checked<?php endif; if($_field['config']['disabled'] == '1'): ?>
								disabled<?php endif; if($_field['config']['readonly'] == '1'): ?>
								readonly<?php endif; ?>> <?php echo $_temp[0]; ?></label>
							<?php endforeach; endif; else: echo "" ;endif; break; case "textbox": ?>
							<input type="text" class="form-control" id="<?php echo $_ns; ?>"
								name="<?php echo $_field['field']; ?>"
								value="<?php echo $_field['value']; ?>"
								placeholder="<?php echo (isset($_field['config']['prompt']) && ($_field['config']['prompt'] !== '')?$_field['config']['prompt']:''); ?>"<?php
							if($_field['config']['readonly'] == '1'): ?> readonly
							<?php endif; if($_field['config']['disabled'] == '1'): ?>
							disabled
							<?php endif; if($_field['config']['required'] == '1'): ?>
							required
							<?php endif; ?>
							>
							<?php break; case "multitextbox": ?>
							<textarea class="form-control" id="<?php echo $_ns; ?>"
								name="<?php echo $_field['field']; ?>"
								rows="<?php echo (isset($_field['config']['height']) && ($_field['config']['height'] !== '')?$_field['config']['height']:'5'); ?>"
								placeholder="<?php echo (isset($_field['config']['prompt']) && ($_field['config']['prompt'] !== '')?$_field['config']['prompt']:''); ?>"<?php if($_field['config']['disabled'] == '1'): ?> disabled<?php endif; if($_field['config']['readonly'] == '1'): ?> readonly<?php endif; if($_field['config']['required'] == '1'): ?> required<?php endif; ?>><?php echo $_field['value']; ?></textarea>
							<?php break; case "image": ?>
							<script>$(function(){EBCMS.FN.renderPic('#<?php echo $_ns; ?>'<?php if(!(empty($_field['config']['extensions']) || ($_field['config']['extensions'] instanceof \think\Collection && $_field['config']['extensions']->isEmpty()))): ?>,'<?php echo $_field['config']['extensions']; ?>'<?php endif; ?>);});</script>
							<div class="row">
								<div class="col-md-10">
									<input id="<?php echo $_ns; ?>" class="form-control"
										name="<?php echo $_field['field']; ?>"
										value="<?php echo $_field['value']; ?>"
										placeholder="<?php echo (isset($_field['config']['prompt']) && ($_field['config']['prompt'] !== '')?$_field['config']['prompt']:''); ?>"<?php
									if($_field['config']['disabled'] == '1'): ?> disabled
									<?php endif; if($_field['config']['readonly'] == '1'): ?>
									readonly
									<?php endif; if($_field['config']['required'] == '1'): ?>
									required
									<?php endif; ?>
									/>
								</div>
								<div class="col-md-2">
									<div id="<?php echo $_ns; ?>Picker">上传</div>
								</div>
							</div>
							<?php break; case "images": ?>
							<script>$(function(){EBCMS.TEMP.temp_<?php echo $_field['id']; ?>_renderPics = function(container,extensions,picker){
extensions = extensions?extensions:'gif,jpg,jpeg,bmp,png';var pick = picker||container + 'Picker';var uploader = WebUploader.create({
auto: true,swf: EBCMS.DATA.config.WebUploader_swf,server: EBCMS.DATA.config.WebUploader_server,pick: pick,accept: {
title: 'Images',extensions: extensions,mimeTypes: 'image/*'
}});$(pick).mouseover(function(){
$(this).resize();});uploader.on( 'error', function(code) {EBCMS.MSG.webuploaderMsg(code);});uploader.on( 'uploadError', function( file ) {EBCMS.MSG.alert('上传出错');});uploader.on( 'uploadSuccess', function( file,res ) {
if (res.code) {EBCMS.TEMP.temp_<?php echo $_field['id']; ?>_imgs.push({
img:res.data.pathname,title:res.data.name,description:'',url:'',});EBCMS.TEMP.temp_<?php echo $_field['id']; ?>_refresh_<?php echo $_ns; ?>();}else{EBCMS.MSG.alert(res.msg);};});uploader.on( 'uploadComplete', function( file ) {
});};EBCMS.TEMP.temp_<?php echo $_field['id']; ?>_renderPics('#<?php echo $_ns; ?>'<?php if(!(empty($_field['config']['extensions']) || ($_field['config']['extensions'] instanceof \think\Collection && $_field['config']['extensions']->isEmpty()))): ?>,'<?php echo $_field['config']['extensions']; ?>'<?php endif; ?>);});</script>
							<div class="row">
								<div class="col-md-10">
									<div class="row" id="<?php echo $_ns; ?>_foo"></div>
								</div>
								<div class="col-md-2">
									<div id="<?php echo $_ns; ?>Picker">上传</div>
								</div>
							</div>
							<script
								src="<?php echo get_root(); ?>/third/sortable/Sortable.js"></script>
							<style>
.x {
	height: 200px;
	border: 1px solid #ddd;
}

.sortable-ghost {
	background: #ddd;
}
</style>
							<script>$(function() {
new Sortable(document.getElementById("<?php echo $_ns; ?>_foo"), {
group: "omega",handle: ".col-md-3",draggable: ".col-md-3",ghostClass: "sortable-ghost",onRemove: function (evt){
},onStart: function (evt){EBCMS.TEMP.temp_<?php echo $_field['id']; ?>_index1 = $(evt.item).index();},onEnd: function (evt){EBCMS.TEMP.temp_<?php echo $_field['id']; ?>_index2 = $(evt.item).index();if (EBCMS.TEMP.temp_<?php echo $_field['id']; ?>_index1 != EBCMS.TEMP.temp_<?php echo $_field['id']; ?>_index2) {EBCMS.TEMP.temp_<?php echo $_field['id']; ?>_img_temp = EBCMS.TEMP.temp_<?php echo $_field['id']; ?>_imgs[EBCMS.TEMP.temp_<?php echo $_field['id']; ?>_index1];for(var i=EBCMS.TEMP.temp_<?php echo $_field['id']; ?>_index1;i<EBCMS.TEMP.temp_<?php echo $_field['id']; ?>_imgs.length;i++){EBCMS.TEMP.temp_<?php echo $_field['id']; ?>_imgs[i]=EBCMS.TEMP.temp_<?php echo $_field['id']; ?>_imgs[i+1]; 
}EBCMS.TEMP.temp_<?php echo $_field['id']; ?>_imgs.length=EBCMS.TEMP.temp_<?php echo $_field['id']; ?>_imgs.length-1;EBCMS.TEMP.temp_<?php echo $_field['id']; ?>_imgs.splice(EBCMS.TEMP.temp_<?php echo $_field['id']; ?>_index2, 0, EBCMS.TEMP.temp_<?php echo $_field['id']; ?>_img_temp);EBCMS.TEMP.temp_<?php echo $_field['id']; ?>_refresh_<?php echo $_ns; ?>();}},});EBCMS.TEMP.temp_<?php echo $_field['id']; ?>_imgs = <?php echo json_encode($_field['value']); ?>||[];EBCMS.TEMP.temp_<?php echo $_field['id']; ?>_refresh_<?php echo $_ns; ?> = function(){EBCMS.CORE.compile({
tpl:'<?php echo $_ns; ?>-item',data:{rows:EBCMS.TEMP.temp_<?php echo $_field['id']; ?>_imgs},target:'#<?php echo $_ns; ?>_foo',});};EBCMS.TEMP.temp_<?php echo $_field['id']; ?>_refresh_<?php echo $_ns; ?>();EBCMS.TEMP.edits_<?php echo $_field['id']; ?> = function(id){
if ('edit' == id) {EBCMS.TEMP.temp_<?php echo $_field['id']; ?>_imgs[EBCMS.TEMP.editid_<?php echo $_field['id']; ?>].title = $('#<?php echo $_ns; ?>_title').val();EBCMS.TEMP.temp_<?php echo $_field['id']; ?>_imgs[EBCMS.TEMP.editid_<?php echo $_field['id']; ?>].description = $('#<?php echo $_ns; ?>_description').val();EBCMS.TEMP.temp_<?php echo $_field['id']; ?>_imgs[EBCMS.TEMP.editid_<?php echo $_field['id']; ?>].url = $('#<?php echo $_ns; ?>_url').val();EBCMS.TEMP.temp_<?php echo $_field['id']; ?>_imgs[EBCMS.TEMP.editid_<?php echo $_field['id']; ?>].img = $('#<?php echo $_ns; ?>_img').val();$('#lgModal').modal('hide');EBCMS.TEMP.temp_<?php echo $_field['id']; ?>_refresh_<?php echo $_ns; ?>();}else{
id = Number(id);EBCMS.TEMP.editid_<?php echo $_field['id']; ?> = id;EBCMS.CORE.compile({
tpl:'<?php echo $_ns; ?>-edit',data:EBCMS.TEMP.temp_<?php echo $_field['id']; ?>_imgs[id],target:'#lgModal .modal-content',compileAfter:function(){EBCMS.FN.renderPic('#<?php echo $_ns; ?>_img'<?php if(!(empty($_field['config']['extensions']) || ($_field['config']['extensions'] instanceof \think\Collection && $_field['config']['extensions']->isEmpty()))): ?>,'<?php echo $_field['config']['extensions']; ?>'<?php endif; ?>);}});}return false;};EBCMS.TEMP.delete_<?php echo $_field['id']; ?> = function(id){
id = Number(id);for(var i=id;i<EBCMS.TEMP.temp_<?php echo $_field['id']; ?>_imgs.length;i++){EBCMS.TEMP.temp_<?php echo $_field['id']; ?>_imgs[i]=EBCMS.TEMP.temp_<?php echo $_field['id']; ?>_imgs[i+1]; 
}EBCMS.TEMP.temp_<?php echo $_field['id']; ?>_imgs.length -= 1;EBCMS.TEMP.temp_<?php echo $_field['id']; ?>_refresh_<?php echo $_ns; ?>();return false;};});</script>
							<script id="<?php echo $_ns; ?>-item" type="text/html">[[each rows as v n]]<div class="col-md-3 col-sm-4 col-xs-6"><div class="panel panel-default"><div class="panel-heading text-overflow" style="width:auto;">[[v.title]]</div><div class="panel-body"><p><img src="<?php echo get_root(); ?>/upload/[[v.img]]" width="100%" height="200" alt=""></p><p><button class="btn btn-primary btn-sm" onclick="return EBCMS.TEMP.edits_<?php echo $_field['id']; ?>('[[n]]');">编辑</button> <button class="btn btn-primary btn-sm" onclick="return EBCMS.TEMP.delete_<?php echo $_field['id']; ?>('[[n]]');">删除</button></p></div></div><input type="hidden" name="<?php echo $_field['field']; ?>[[n | left]][[n]][[n | right]][title]" value="[[v.title]]"><input type="hidden" name="<?php echo $_field['field']; ?>[[n | left]][[n]][[n | right]][img]" value="[[v.img]]"><input type="hidden" name="<?php echo $_field['field']; ?>[[n | left]][[n]][[n | right]][url]" value="[[v.url]]"><input type="hidden" name="<?php echo $_field['field']; ?>[[n | left]][[n]][[n | right]][description]" value="[[v.description]]"></div>[[/each]]</script>
							<script id="<?php echo $_ns; ?>-edit" type="text/html"><div class="modal-header"><button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button><h4 class="modal-title text-danger"><b>编辑图片</b></h4></div><div class="modal-body"><div class="row"><div class="col-md-10"><input id="<?php echo $_ns; ?>_img" class="form-control" value="[[img]]"/></div><div class="col-md-2"><div id="<?php echo $_ns; ?>_imgPicker">上传</div></div></div><div class="form-group"><label class="control-label" for="<?php echo $_ns; ?>_title">标题</label><input type="text" class="form-control" id="<?php echo $_ns; ?>_title" value="[[title]]"></div><div class="form-group"><label class="control-label" for="<?php echo $_ns; ?>_url">链接地址</label><input type="text" class="form-control" id="<?php echo $_ns; ?>_url" value="[[url]]"></div><div class="form-group"><label class="control-label" for="<?php echo $_ns; ?>_description">简介</label><textarea class="form-control" id="<?php echo $_ns; ?>_description" rows="6">[[description]]</textarea></div></div><div class="modal-footer"><button type="button" class="btn btn-primary" onclick="return EBCMS.TEMP.edits_<?php echo $_field['id']; ?>('edit');">提交</button> <button type="button" class="btn btn-default" data-dismiss="modal">关闭</button></div></script>
							<?php break; case "file": ?>
							<script>$(function(){EBCMS.FN.renderFile('#<?php echo $_ns; ?>'<?php if(!(empty($_field['config']['extensions']) || ($_field['config']['extensions'] instanceof \think\Collection && $_field['config']['extensions']->isEmpty()))): ?>,'<?php echo $_field['config']['extensions']; ?>'<?php endif; ?>);});</script>
							<div class="row">
								<div class="col-md-10">
									<input id="<?php echo $_ns; ?>" class="form-control"
										name="<?php echo $_field['field']; ?>"
										value="<?php echo $_field['value']; ?>"
										placeholder="<?php echo (isset($_field['config']['prompt']) && ($_field['config']['prompt'] !== '')?$_field['config']['prompt']:''); ?>"<?php
									if($_field['config']['disabled'] == '1'): ?> disabled
									<?php endif; if($_field['config']['readonly'] == '1'): ?>
									readonly
									<?php endif; if($_field['config']['required'] == '1'): ?>
									required
									<?php endif; ?>
									/>
								</div>
								<div class="col-md-2">
									<div id="<?php echo $_ns; ?>Picker">上传</div>
								</div>
							</div>
							<?php break; case "files": ?>
							<script>$(function(){EBCMS.TEMP.temp_<?php echo $_field['id']; ?>_renderPics = function(container,extensions,picker){
extensions = extensions?extensions:'gif,jpg,jpeg,bmp,png';var pick = picker||container + 'Picker';var uploader = WebUploader.create({
auto: true,swf: EBCMS.DATA.config.WebUploader_swf,server: EBCMS.DATA.config.WebUploader_server,pick: pick,accept: {
title: 'File',extensions: extensions,mimeTypes: '*/*'
}});$(pick).mouseover(function(){
$(this).resize();});uploader.on( 'error', function(code) {EBCMS.MSG.webuploaderMsg(code);});uploader.on( 'uploadError', function( file ) {EBCMS.MSG.alert('上传出错');});uploader.on( 'uploadSuccess', function( file,res ) {
if (res.code) {EBCMS.TEMP.temp_<?php echo $_field['id']; ?>_files.push({
file:res.data.pathname,title:res.data.name,description:'',});EBCMS.TEMP.temp_<?php echo $_field['id']; ?>_refresh_<?php echo $_ns; ?>();}else{EBCMS.MSG.alert(res.msg);};});uploader.on( 'uploadComplete', function( file ) {
});};EBCMS.TEMP.temp_<?php echo $_field['id']; ?>_renderPics('#<?php echo $_ns; ?>'<?php if(!(empty($_field['config']['extensions']) || ($_field['config']['extensions'] instanceof \think\Collection && $_field['config']['extensions']->isEmpty()))): ?>,'<?php echo $_field['config']['extensions']; ?>'<?php endif; ?>);});</script>
							<div class="row">
								<div class="col-md-10">
									<div class="row" id="<?php echo $_ns; ?>_foo"></div>
								</div>
								<div class="col-md-2">
									<div id="<?php echo $_ns; ?>Picker">上传</div>
								</div>
							</div>
							<script
								src="<?php echo get_root(); ?>/third/sortable/Sortable.js"></script>
							<style>
.x {
	height: 200px;
	border: 1px solid #ddd;
}

.sortable-ghost {
	background: #ddd;
}
</style>
							<script>$(function() {
new Sortable(document.getElementById("<?php echo $_ns; ?>_foo"), {
group: "omega",handle: ".contentlist",draggable: ".contentlist",ghostClass: "sortable-ghost",onRemove: function (evt){
},onStart: function (evt){EBCMS.TEMP.temp_<?php echo $_field['id']; ?>_index1 = $(evt.item).index();},onEnd: function (evt){EBCMS.TEMP.temp_<?php echo $_field['id']; ?>_index2 = $(evt.item).index();if (EBCMS.TEMP.temp_<?php echo $_field['id']; ?>_index1 != EBCMS.TEMP.temp_<?php echo $_field['id']; ?>_index2) {EBCMS.TEMP.temp_<?php echo $_field['id']; ?>_file_temp = EBCMS.TEMP.temp_<?php echo $_field['id']; ?>_files[EBCMS.TEMP.temp_<?php echo $_field['id']; ?>_index1];for(var i=EBCMS.TEMP.temp_<?php echo $_field['id']; ?>_index1;i<EBCMS.TEMP.temp_<?php echo $_field['id']; ?>_files.length;i++){EBCMS.TEMP.temp_<?php echo $_field['id']; ?>_files[i]=EBCMS.TEMP.temp_<?php echo $_field['id']; ?>_files[i+1]; 
}EBCMS.TEMP.temp_<?php echo $_field['id']; ?>_files.length=EBCMS.TEMP.temp_<?php echo $_field['id']; ?>_files.length-1;EBCMS.TEMP.temp_<?php echo $_field['id']; ?>_files.splice(EBCMS.TEMP.temp_<?php echo $_field['id']; ?>_index2, 0, EBCMS.TEMP.temp_<?php echo $_field['id']; ?>_file_temp);EBCMS.TEMP.temp_<?php echo $_field['id']; ?>_refresh_<?php echo $_ns; ?>();}},});EBCMS.TEMP.temp_<?php echo $_field['id']; ?>_files = <?php echo json_encode($_field['value']); ?>||[];EBCMS.TEMP.temp_<?php echo $_field['id']; ?>_refresh_<?php echo $_ns; ?> = function(){EBCMS.CORE.compile({
tpl:'<?php echo $_ns; ?>-item',data:{rows:EBCMS.TEMP.temp_<?php echo $_field['id']; ?>_files},target:'#<?php echo $_ns; ?>_foo',});};EBCMS.TEMP.temp_<?php echo $_field['id']; ?>_refresh_<?php echo $_ns; ?>();EBCMS.TEMP.edits_<?php echo $_field['id']; ?> = function(id){
if ('edit' == id) {EBCMS.TEMP.temp_<?php echo $_field['id']; ?>_files[EBCMS.TEMP.editid_<?php echo $_field['id']; ?>].title = $('#<?php echo $_ns; ?>_title').val();EBCMS.TEMP.temp_<?php echo $_field['id']; ?>_files[EBCMS.TEMP.editid_<?php echo $_field['id']; ?>].description = $('#<?php echo $_ns; ?>_description').val();EBCMS.TEMP.temp_<?php echo $_field['id']; ?>_files[EBCMS.TEMP.editid_<?php echo $_field['id']; ?>].file = $('#<?php echo $_ns; ?>_file').val();$('#lgModal').modal('hide');EBCMS.TEMP.temp_<?php echo $_field['id']; ?>_refresh_<?php echo $_ns; ?>();}else{
id = Number(id);EBCMS.TEMP.editid_<?php echo $_field['id']; ?> = id;EBCMS.CORE.compile({
tpl:'<?php echo $_ns; ?>-edit',data:EBCMS.TEMP.temp_<?php echo $_field['id']; ?>_files[id],target:'#lgModal .modal-content',compileAfter:function(){EBCMS.FN.renderFile('#<?php echo $_ns; ?>_file'<?php if(!(empty($_field['config']['extensions']) || ($_field['config']['extensions'] instanceof \think\Collection && $_field['config']['extensions']->isEmpty()))): ?>,'<?php echo $_field['config']['extensions']; ?>'<?php endif; ?>);}});}return false;};EBCMS.TEMP.delete_<?php echo $_field['id']; ?> = function(id){
id = Number(id);for(var i=id;i<EBCMS.TEMP.temp_<?php echo $_field['id']; ?>_files.length;i++){EBCMS.TEMP.temp_<?php echo $_field['id']; ?>_files[i]=EBCMS.TEMP.temp_<?php echo $_field['id']; ?>_files[i+1]; 
}EBCMS.TEMP.temp_<?php echo $_field['id']; ?>_files.length -= 1;EBCMS.TEMP.temp_<?php echo $_field['id']; ?>_refresh_<?php echo $_ns; ?>();return false;};});</script>
							<script id="<?php echo $_ns; ?>-item" type="text/html">[[each rows as v n]]<div class="media contentlist"><div class="media-left"><i class="iconfont icon-[[v.file | fileicon]] text-primary" style="font-size:6em;"></i></div><div class="media-body"><h3 class="media-heading">[[v.title]]</h3><div class="description">[[v.description]]</div><div style="margin:10px auto;"><button class="btn btn-primary btn-sm" onclick="return EBCMS.TEMP.edits_<?php echo $_field['id']; ?>('[[n]]');">编辑</button> <button class="btn btn-primary btn-sm" onclick="return EBCMS.TEMP.delete_<?php echo $_field['id']; ?>('[[n]]');">删除</button></div></div><input type="hidden" name="<?php echo $_field['field']; ?>[[n | left]][[n]][[n | right]][title]" value="[[v.title]]"><input type="hidden" name="<?php echo $_field['field']; ?>[[n | left]][[n]][[n | right]][file]" value="[[v.file]]"><input type="hidden" name="<?php echo $_field['field']; ?>[[n | left]][[n]][[n | right]][description]" value="[[v.description]]"></div>[[/each]]</script>
							<script id="<?php echo $_ns; ?>-edit" type="text/html"><div class="modal-header"><button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button><h4 class="modal-title text-danger"><b>编辑附件</b></h4></div><div class="modal-body"><div class="row"><div class="col-md-10"><input id="<?php echo $_ns; ?>_file" class="form-control" value="[[file]]"/></div><div class="col-md-2"><div id="<?php echo $_ns; ?>_filePicker">上传</div></div></div><div class="form-group"><label class="control-label" for="<?php echo $_ns; ?>_title">标题</label><input type="text" class="form-control" id="<?php echo $_ns; ?>_title" value="[[title]]"></div><div class="form-group"><label class="control-label" for="<?php echo $_ns; ?>_description">简介</label><textarea class="form-control" id="<?php echo $_ns; ?>_description" rows="6">[[description]]</textarea></div></div><div class="modal-footer"><button type="button" class="btn btn-primary" onclick="return EBCMS.TEMP.edits_<?php echo $_field['id']; ?>('edit');">提交</button> <button type="button" class="btn btn-default" data-dismiss="modal">关闭</button></div></script>
							<?php break; case "ueditor": ?>
							<script>$(function(){EBCMS.FN.renderUE('<?php echo $_ns; ?>',{
autoHeightEnabled:<?php echo (isset($_field['config']['autoheightenabled']) && ($_field['config']['autoheightenabled'] !== '')?$_field['config']['autoheightenabled']:'false'); ?>,maximumWords:<?php echo (isset($_field['config']['maximumwords']) && ($_field['config']['maximumwords'] !== '')?$_field['config']['maximumwords']:'10000'); ?>,wordCount:<?php echo (isset($_field['config']['wordcount']) && ($_field['config']['wordcount'] !== '')?$_field['config']['wordcount']:'true'); ?>,elementPathEnabled:<?php echo (isset($_field['config']['elementpathenabled']) && ($_field['config']['elementpathenabled'] !== '')?$_field['config']['elementpathenabled']:'true'); ?>,initialFrameHeight:<?php echo (isset($_field['config']['initialframeheight']) && ($_field['config']['initialframeheight'] !== '')?$_field['config']['initialframeheight']:'420'); ?>,});});</script>
							<textarea name="<?php echo $_field['field']; ?>"
								id="<?php echo $_ns; ?>"><?php echo $_field['value']; ?></textarea>
							<?php break; case "combotree": ?>
							<script>$(function(){<?php 
if ($_field['config']['queryparams']) {
$_where = '';$_queryparams = explode("\r\n",$_field['config']['queryparams']);foreach ($_queryparams as $key => $value) {
$_tmp = explode('|',$value);if (stripos($_tmp[2],'(I)') === 0) {
$_tmp[2] = input(substr($_tmp[2],3));}elseif(stripos($_tmp[2],'(@)') === 0){
$_tmp[2] = $_data[substr($_tmp[2],3)];}elseif(stripos($_tmp[2],'($)') === 0){
$_tmp[2] = get_tpl_value($_data,substr($_tmp[2],3));};$_where .= $_tmp[0].":['".$_tmp[1]."','".$_tmp[2]."'],";}};$_field['config']['group'] = isset($_field['config']['group'])?$_field['config']['group']:0;$_field['config']['tree'] = isset($_field['config']['tree'])?$_field['config']['tree']:0;$_field['config']['rootitem'] = isset($_field['config']['rootitem'])?$_field['config']['rootitem']:0;$_field['config']['editable'] = isset($_field['config']['editable'])?$_field['config']['editable']:0;?>EBCMS.CORE.api({<?php if($_field['config']['group'] == '1'): ?>group:'group',<?php else: if($_field['config']['tree'] == '1'): ?>tree:'tree',<?php endif; if($_field['config']['rootitem'] == '1'): ?>rootitem:true,<?php endif; endif; ?>queryParams:{
order:{
'sort':'desc',},model:'<?php echo $_field['config']['model']; ?>',<?php if(!(empty($_field['config']['queryparams']) || ($_field['config']['queryparams'] instanceof \think\Collection && $_field['config']['queryparams']->isEmpty()))): ?>where:{<?php echo $_where; ?>},<?php endif; ?>},loadAfter:function(data){
$select = $('#<?php echo $_ns; ?>');var str = EBCMS.FN.renderSelect(data['rows'],'<?php echo $_field['value']; ?>','<?php echo (isset($_field['config']['valuefield']) && ($_field['config']['valuefield'] !== '')?$_field['config']['valuefield']:"id"); ?>','<?php echo (isset($_field['config']['textfield']) && ($_field['config']['textfield'] !== '')?$_field['config']['textfield']:"title"); ?>');$select.append(str);}});});</script>
							<?php if($_field['config']['editable'] == '1'): ?>
							<div class="row">
								<div class="col-md-8">
									<input type="text" class="form-control"
										id="<?php echo $_ns; ?>_obj"
										name="<?php echo $_field['field']; ?>"
										value="<?php echo $_field['value']; ?>"
										placeholder="<?php echo (isset($_field['config']['prompt']) && ($_field['config']['prompt'] !== '')?$_field['config']['prompt']:''); ?>"<?php
									if($_field['config']['readonly'] == '1'): ?> readonly
									<?php endif; if($_field['config']['disabled'] == '1'): ?>
									disabled
									<?php endif; if($_field['config']['required'] == '1'): ?>
									required
									<?php endif; ?>
									>
								</div>
								<div class="col-md-4">
									<select class="form-control" id="<?php echo $_ns; ?>"
										onchange="$('#<?php echo $_ns; ?>_obj').val($(this).val());"<?php
										if($_field['config']['readonly'] == '1'): ?> readonly
										<?php endif; if($_field['config']['disabled'] == '1'): ?>
										disabled
										<?php endif; if($_field['config']['required'] == '1'): ?>
										required
										<?php endif; ?>>
									</select>
								</div>
							</div>
							<?php else: ?>
							<select class="form-control" id="<?php echo $_ns; ?>"
								name="<?php echo $_field['field']; ?>"<?php
								if($_field['config']['readonly'] == '1'): ?> readonly
								<?php endif; if($_field['config']['disabled'] == '1'): ?>
								disabled
								<?php endif; if($_field['config']['required'] == '1'): ?>
								required
								<?php endif; ?>>
							</select>
							<?php endif; break; case "datadict": ?>
							<script>$(function(){EBCMS.CORE.datadict({
queryParams:{
order:{
'sort':'desc',},datadict:'<?php echo $_field['config']['datadict']; ?>',},<?php if($_field['config']['rootitem'] == '1'): ?>rootitem:true,<?php endif; ?>loadAfter:function(res){
$select = $('#<?php echo $_ns; ?>');var str = EBCMS.FN.renderSelect(res['rows'],'<?php echo $_field['value']; ?>','<?php echo (isset($_field['config']['valuefield']) && ($_field['config']['valuefield'] !== '')?$_field['config']['valuefield']:"id"); ?>','<?php echo (isset($_field['config']['textfield']) && ($_field['config']['textfield'] !== '')?$_field['config']['textfield']:"title"); ?>');$select.append(str);}});});</script>
							<?php 
$_field['config']['editable'] = isset($_field['config']['editable'])?$_field['config']['editable']:0;if($_field['config']['editable'] == '1'): ?>
							<div class="row">
								<div class="col-md-8">
									<input type="text" class="form-control"
										id="<?php echo $_ns; ?>_obj"
										name="<?php echo $_field['field']; ?>"
										value="<?php echo $_field['value']; ?>"
										placeholder="<?php echo (isset($_field['config']['prompt']) && ($_field['config']['prompt'] !== '')?$_field['config']['prompt']:''); ?>"<?php
									if($_field['config']['readonly'] == '1'): ?> readonly
									<?php endif; if($_field['config']['disabled'] == '1'): ?>
									disabled
									<?php endif; if($_field['config']['required'] == '1'): ?>
									required
									<?php endif; ?>
									>
								</div>
								<div class="col-md-4">
									<select class="form-control" id="<?php echo $_ns; ?>"
										onchange="$('#<?php echo $_ns; ?>_obj').val($(this).val());"<?php
										if($_field['config']['readonly'] == '1'): ?> readonly
										<?php endif; if($_field['config']['disabled'] == '1'): ?>
										disabled
										<?php endif; if($_field['config']['required'] == '1'): ?>
										required
										<?php endif; ?>>
									</select>
								</div>
							</div>
							<?php else: ?>
							<select class="form-control" id="<?php echo $_ns; ?>"
								name="<?php echo $_field['field']; ?>"<?php
								if($_field['config']['readonly'] == '1'): ?> readonly
								<?php endif; if($_field['config']['disabled'] == '1'): ?>
								disabled
								<?php endif; if($_field['config']['required'] == '1'): ?>
								required
								<?php endif; ?>>
							</select>
							<?php endif; break; case "numberbox": ?>
							<input type="number" id="<?php echo $_ns; ?>"
								class="form-control" name="<?php echo $_field['field']; ?>"
								value="<?php echo $_field['value']; ?>"<?php
							if($_field['config']['readonly'] == '1'): ?> readonly
							<?php endif; if($_field['config']['disabled'] == '1'): ?>
							disabled
							<?php endif; if($_field['config']['required'] == '1'): ?>
							required
							<?php endif; ?>
							/>
							<?php break; case "timespinner": ?>
							<input type="time" id="<?php echo $_ns; ?>" class="form-control"
								name="<?php echo $_field['field']; ?>"
								value="<?php echo $_field['value']; ?>" id="<?php echo $_ns; ?>"<?php
							if($_field['config']['readonly'] == '1'): ?> readonly
							<?php endif; if($_field['config']['disabled'] == '1'): ?>
							disabled
							<?php endif; if($_field['config']['required'] == '1'): ?>
							required
							<?php endif; ?>
							/>
							<?php break; case "datebox": ?>
							<input type="date" id="<?php echo $_ns; ?>" class="form-control"
								name="<?php echo $_field['field']; ?>"
								value="<?php echo $_field['value']; ?>" id="<?php echo $_ns; ?>"<?php
							if($_field['config']['readonly'] == '1'): ?> readonly
							<?php endif; if($_field['config']['disabled'] == '1'): ?>
							disabled
							<?php endif; if($_field['config']['required'] == '1'): ?>
							required
							<?php endif; ?>
							/>
							<?php break; case "datetimebox": ?>
							<input type="datetime-local" id="<?php echo $_ns; ?>"
								class="form-control" name="<?php echo $_field['field']; ?>"
								value="<?php echo datetimelocal($_field['value']); ?>"
								id="<?php echo $_ns; ?>"<?php
							if($_field['config']['readonly'] == '1'): ?> readonly
							<?php endif; if($_field['config']['disabled'] == '1'): ?>
							disabled
							<?php endif; if($_field['config']['required'] == '1'): ?>
							required
							<?php endif; ?>
							/>
							<?php break; case "extendtext": ?>
							<script>Namespace.register("EBCMS.Form_extendtext");$(function() {EBCMS.Form_extendtext.changename = function(id,value){
$(id).attr('name','<?php echo $_field['field']; ?>['+value+']');};EBCMS.Form_extendtext.up = function(id){
if ($(id).prev().hasClass('form-group')) {
$(id).insertBefore($(id).prev());}};EBCMS.Form_extendtext.down = function(id){
if ($(id).next().hasClass('form-group')) {
$(id).next().insertBefore($(id));}};EBCMS.Form_extendtext.render_text = function(name,value,target){
name = name||'EB_' + EBCMS.FN.random_str(6);opt = {
name:name,value:value||'',id:'<?php echo $_ns; ?>_' + EBCMS.FN.random_str(15),};var str = '';str += '<div class="form-group" id="'+opt.id+'_group">';str += '<div class="col-sm-1 control-label"><label>';str += '<i class="iconfont icon-shanchu cursor-pointer" onclick="$(\'#'+opt.id+'_group\').remove();"></i>';str += '<i class="iconfont icon-xiayi cursor-pointer" onclick="EBCMS.Form_extendtext.down(\'#'+opt.id+'_group\');"></i>';str += '<i class="iconfont icon-shangyi cursor-pointer" onclick="EBCMS.Form_extendtext.up(\'#'+opt.id+'_group\');"></i>';str += '<label></div>';str += '<div class="col-sm-2">';str += '<input type="text" class="form-control" value="'+opt.name+'" onKeyUp="EBCMS.Form_extendtext.changename(\'#'+opt.id+'\',$(this).val());" placeholder="填写名称">';str += '</div>';str += '<div class="col-sm-9">';str += '<input type="text" class="form-control" id="'+opt.id+'" name="<?php echo $_field['field']; ?>['+opt.name+']" value="'+opt.value+'" placeholder="填写值">';str += '</div>';str += '</div>';if (target) {
$(target).append(str);}else{
return str;}};var forms = <?php echo json_encode($_field['value']); ?>||{};if (typeof forms!='object') {
forms = {};}$.each(forms, function(name, val) {EBCMS.Form_extendtext.render_text(name,val,'#<?php echo $_field['id']; ?>_container');});});</script>
							<div class="row">
								<div class="col-sm-12">
									<div class="btn-group" role="group" aria-label="...">
										<button type="button" class="btn btn-primary btn-sm"
											onclick="EBCMS.Form_extendtext.render_text('','','#<?php echo $_field['id']; ?>_container');">单行文本</button>
									</div>
								</div>
							</div>
							<br>
							<div class="row">
								<div class="col-sm-12"
									id="<?php echo $_field['id']; ?>_container"></div>
							</div>
							<?php break; case "keywords": ?>
							<div class="row">
								<div class="col-md-8">
									<input id="<?php echo $_ns; ?>" class="form-control"
										name="<?php echo $_field['field']; ?>"
										value="<?php echo $_field['value']; ?>"
										placeholder="<?php echo (isset($_field['config']['prompt']) && ($_field['config']['prompt'] !== '')?$_field['config']['prompt']:''); ?>"<?php
									if($_field['config']['disabled'] == '1'): ?> disabled
									<?php endif; if($_field['config']['readonly'] == '1'): ?>
									readonly
									<?php endif; if($_field['config']['required'] == '1'): ?>
									required
									<?php endif; ?>
									/>
								</div>
								<div class="col-md-2">
									<button type="button" class="btn btn-primary btn-block"
										onclick="EBCMS.FN.suggest_keywords('#<?php echo $_ns; ?>');">长尾关键词</button>
								</div>
								<div class="col-md-2">
									<button type="button" class="btn btn-primary btn-block"
										onclick="EBCMS.FN.suggest_keywords('#<?php echo $_ns; ?>','<?php if(isset($_field['config']['field']) && $_field['config']['field']){echo 'ebcms_'.md5('ebcmsformfield_'.$_field['config']['field'].$_nowtime);}else{echo '0';} ?>','<?php echo (isset($_field['config']['strong']) && ($_field['config']['strong'] !== '')?$_field['config']['strong']:'0'); ?>');">插入到内容</button>
								</div>
							</div>
							<?php break; default: ?>
							<span style="color: red;">
								<?php echo $_field['type']; ?>表单类型不存在 请联系专业人员
							</span>
							<?php endswitch; if(!(empty($_field['remark']) || ($_field['remark'] instanceof \think\Collection && $_field['remark']->isEmpty()))): ?>
							<p class="help-block">
								<?php echo $_field['remark']; ?>
							</p>
							<?php endif; ?>
						</div>
					</div>
					<?php endif; endforeach; ?>
				</div>
				<?php endforeach; if(!(empty($_extgroups) || ($_extgroups instanceof \think\Collection && $_extgroups->isEmpty()))): foreach($_extgroups as $key => $_fields): ?>
				<div class="tab-body">
					<?php foreach($_fields as $key => $_field): 
$_nowtime = time();$_ns = 'ebcms_'.md5('ebcmsformfield_'.$_field['field'].$_nowtime);$_field['config']['disabled'] = isset($_field['config']['disabled'])?$_field['config']['disabled']:0;$_field['config']['required'] = isset($_field['config']['required'])?$_field['config']['required']:0;$_field['config']['readonly'] = isset($_field['config']['readonly'])?$_field['config']['readonly']:0;if($_field['type'] == 'hidden'): ?>
					<input type="hidden" name="<?php echo $_field['field']; ?>"
						value="<?php echo $_field['value']; ?>" />
					<?php elseif($_field['type'] == 'extend'): ?>
					<script>Namespace.register("EBCMS.Form");$(function() {EBCMS.Form.changename = function(id,value){
if ($(id).is('div')) {
$(id).next().attr('name','<?php echo $_field['field']; ?>['+value+']');}else{
$(id).attr('name','<?php echo $_field['field']; ?>['+value+']');}$(id+'__config__').attr('name','<?php echo $_field['field']; ?>[__config__]['+value+']');};EBCMS.Form.up = function(id){
if ($(id).prev().hasClass('form-group')) {
$(id).insertBefore($(id).prev());}};EBCMS.Form.down = function(id){
if ($(id).next().hasClass('form-group')) {
$(id).next().insertBefore($(id));}};EBCMS.Form.render = function(name,value,target){
if (EBCMS.Form.config[name]) {
}else{EBCMS.Form.config[name] = 'text';}if (EBCMS.Form['render_'+EBCMS.Form.config[name]]) {EBCMS.Form['render_'+EBCMS.Form.config[name]](name,value,target);}};EBCMS.Form.render_text = function(name,value,target){
name = name||'EB_' + EBCMS.FN.random_str(6);opt = {
name:name,value:value||'',id:'<?php echo $_ns; ?>_' + EBCMS.FN.random_str(15),};var str = '';str += '<div class="form-group" id="'+opt.id+'_group">';str += '<div class="col-sm-1 control-label"><label>';str += '<i class="iconfont icon-shanchu cursor-pointer" onclick="$(\'#'+opt.id+'_group\').remove();"></i>';str += '<i class="iconfont icon-xiayi cursor-pointer" onclick="EBCMS.Form.down(\'#'+opt.id+'_group\');"></i>';str += '<i class="iconfont icon-shangyi cursor-pointer" onclick="EBCMS.Form.up(\'#'+opt.id+'_group\');"></i>';str += '<label></div>';str += '<div class="col-sm-2">';str += '<input type="text" class="form-control" value="'+opt.name+'" onKeyUp="EBCMS.Form.changename(\'#'+opt.id+'\',$(this).val());" placeholder="填写名称">';str += '</div>';str += '<div class="col-sm-9">';str += '<input type="text" class="form-control" id="'+opt.id+'" name="<?php echo $_field['field']; ?>['+opt.name+']" value="'+opt.value+'" placeholder="填写值">';str += '</div>';str += '<input type="hidden" id="'+opt.id+'__config__" name="<?php echo $_field['field']; ?>[__config__]['+opt.name+']" value="text">';str += '</div>';if (target) {
$(target).append(str);}else{
return str;}};EBCMS.Form.render_textarea = function(name,value,target){
name = name||'EB_' + EBCMS.FN.random_str(6);opt = {
name:name,value:value||'',id:'<?php echo $_ns; ?>_' + EBCMS.FN.random_str(15),};var str = '';str += '<div class="form-group" id="'+opt.id+'_group">';str += '<div class="col-sm-1 control-label"><label>';str += '<i class="iconfont icon-shanchu cursor-pointer" onclick="$(\'#'+opt.id+'_group\').remove();"></i>';str += '<i class="iconfont icon-xiayi cursor-pointer" onclick="EBCMS.Form.down(\'#'+opt.id+'_group\');"></i>';str += '<i class="iconfont icon-shangyi cursor-pointer" onclick="EBCMS.Form.up(\'#'+opt.id+'_group\');"></i>';str += '<label></div>';str += '<div class="col-sm-2">';str += '<input type="text" class="form-control" value="'+opt.name+'" onKeyUp="EBCMS.Form.changename(\'#'+opt.id+'\',$(this).val());" placeholder="填写名称">';str += '</div>';str += '<div class="col-sm-9">';str += '<textarea class="form-control" id="'+opt.id+'" name="<?php echo $_field['field']; ?>['+opt.name+']" rows="3" placeholder="填写内容">'+opt.value+'</textarea>';str += '</div>';str += '<input type="hidden" id="'+opt.id+'__config__" name="<?php echo $_field['field']; ?>[__config__]['+opt.name+']" value="textarea">';str += '</div>';if (target) {
$(target).append(str);}else{
return str;}};EBCMS.Form.render_file = function(name,value,target){
name = name||'EB_' + EBCMS.FN.random_str(6);opt = {
name:name,value:value||'',id:'<?php echo $_ns; ?>_' + EBCMS.FN.random_str(15),};var str = '';str += '<div class="form-group" id="'+opt.id+'_group">';str += '<div class="col-sm-1 control-label"><label>';str += '<i class="iconfont icon-shanchu cursor-pointer" onclick="$(\'#'+opt.id+'_group\').remove();"></i>';str += '<i class="iconfont icon-xiayi cursor-pointer" onclick="EBCMS.Form.down(\'#'+opt.id+'_group\');"></i>';str += '<i class="iconfont icon-shangyi cursor-pointer" onclick="EBCMS.Form.up(\'#'+opt.id+'_group\');"></i>';str += '<label></div>';str += '<div class="col-sm-2">';str += '<input type="text" class="form-control" value="'+opt.name+'" onKeyUp="EBCMS.Form.changename(\'#'+opt.id+'\',$(this).val());" placeholder="填写名称">';str += '</div>';str += '<div class="col-sm-7">';str += '<input type="text" class="form-control" id="'+opt.id+'" name="<?php echo $_field['field']; ?>['+opt.name+']" value="'+opt.value+'" placeholder="填写值">';str += '</div>';str += '<div class="col-sm-2">';str += '<div id="'+opt.id+'Picker">上传</div>';str += '</div>';str += '<input type="hidden" id="'+opt.id+'__config__" name="<?php echo $_field['field']; ?>[__config__]['+opt.name+']" value="file">';str += '<script>';str += '$(function(){';str += '    EBCMS.FN.renderFile(\'#'+opt.id+'\');';str += '});';str += '<\/script>';str += '</div>';if (target) {
$(target).append(str);}else{
return str;}};EBCMS.Form.render_ueditor = function(name,value,target){
name = name||'EB_' + EBCMS.FN.random_str(6);opt = {
name:name,value:value||'',id:'<?php echo $_ns; ?>_' + EBCMS.FN.random_str(15),};var str = '';str += '<div class="form-group" id="'+opt.id+'_group">';str += '<div class="col-sm-1 control-label"><label>';str += '<i class="iconfont icon-shanchu cursor-pointer" onclick="$(\'#'+opt.id+'_group\').remove();"></i>';str += '<i class="iconfont icon-xiayi cursor-pointer" onclick="EBCMS.Form.down(\'#'+opt.id+'_group\');"></i>';str += '<i class="iconfont icon-shangyi cursor-pointer" onclick="EBCMS.Form.up(\'#'+opt.id+'_group\');"></i>';str += '<label></div>';str += '<div class="col-sm-2">';str += '<input type="text" class="form-control" value="'+opt.name+'" onKeyUp="EBCMS.Form.changename(\'#'+opt.id+'\',$(this).val());" placeholder="填写名称">';str += '</div>';str += '<div class="col-sm-9">';str += '<textarea id="'+opt.id+'" name="<?php echo $_field['field']; ?>['+opt.name+']" >'+opt.value+'</textarea>';str += '</div>';str += '<input type="hidden" id="'+opt.id+'__config__" name="<?php echo $_field['field']; ?>[__config__]['+opt.name+']" value="ueditor">';str += '<script>';str += '$(function(){';str += '    EBCMS.FN.renderUE("'+opt.id+'",{';str += '          autoHeightEnabled:false,';str += '          maximumWords:99999,';str += '          wordCount:true,';str += '          elementPathEnabled:true,';str += '          initialFrameHeight:400,';str += '    });';str += '});';str += '<\/script>';str += '</div>';if (target) {
$(target).append(str);}else{
return str;}};var forms = <?php echo json_encode($_field['value']); ?>||{};if (typeof forms!='object') {
forms = {};}EBCMS.Form.config = forms['__config__']||{};delete forms['__config__'];$.each(forms, function(name, val) {EBCMS.Form.render(name,val,'#<?php echo $_field['id']; ?>_container');});});</script>
					<div class="row">
						<div class="col-sm-12">
							<div class="btn-group" role="group" aria-label="...">
								<button type="button" class="btn btn-primary btn-sm"
									onclick="EBCMS.Form.render_text('','','#<?php echo $_field['id']; ?>_container');">单行文本</button>
								<button type="button" class="btn btn-primary btn-sm"
									onclick="EBCMS.Form.render_textarea('','','#<?php echo $_field['id']; ?>_container');">多行文本</button>
								<button type="button" class="btn btn-primary btn-sm"
									onclick="EBCMS.Form.render_file('','','#<?php echo $_field['id']; ?>_container');">文件</button>
								<button type="button" class="btn btn-primary btn-sm"
									onclick="EBCMS.Form.render_ueditor('','','#<?php echo $_field['id']; ?>_container');">编辑框</button>
							</div>
						</div>
					</div>
					<br>
					<div class="row">
						<div class="col-sm-12" id="<?php echo $_field['id']; ?>_container"></div>
					</div>
					<input type="hidden"
						name="<?php echo $_field['field']; ?>[__config__][__test__]"
						value='test'>
					<?php else: ?>
					<div class="form-group">
						<label for="<?php echo $_ns; ?>" class="col-sm-2 control-label">
							<?php echo $_field['title']; ?>
						</label>
						<div class="col-sm-10">
							<?php switch($_field['type']): case "bool": ?>
							<label class="radio-inline" for="<?php echo $_ns; ?>_1"><input
								type="radio" id="<?php echo $_ns; ?>_1"
								name="<?php echo $_field['field']; ?>" value="1"<?php
								if($_field['value'] == '1'): ?>checked<?php endif; if($_field['config']['disabled'] == '1'): ?>
								disabled<?php endif; if($_field['config']['readonly'] == '1'): ?>
								readonly<?php endif; ?>> 是</label><label class="radio-inline"
								for="<?php echo $_ns; ?>_0"><input type="radio"
								id="<?php echo $_ns; ?>_0"
								name="<?php echo $_field['field']; ?>" value="0"<?php
								if($_field['value'] == '0'): ?>checked<?php endif; if($_field['config']['disabled'] == '1'): ?>
								disabled<?php endif; if($_field['config']['readonly'] == '1'): ?>
								readonly<?php endif; ?>> 否</label>
							<?php break; case "select": 
$_temps = explode("\r\n",$_field['config']['values']);$_field['config']['editable'] = isset($_field['config']['editable'])?$_field['config']['editable']:0;if($_field['config']['editable'] == '1'): ?>
							<div class="row">
								<div class="col-md-8">
									<input type="text" class="form-control"
										id="<?php echo $_ns; ?>_obj"
										name="<?php echo $_field['field']; ?>"
										value="<?php echo $_field['value']; ?>"
										placeholder="<?php echo (isset($_field['config']['prompt']) && ($_field['config']['prompt'] !== '')?$_field['config']['prompt']:''); ?>"<?php
									if($_field['config']['readonly'] == '1'): ?> readonly
									<?php endif; if($_field['config']['disabled'] == '1'): ?>
									disabled
									<?php endif; if($_field['config']['required'] == '1'): ?>
									required
									<?php endif; ?>
									>
								</div>
								<div class="col-md-4">
									<select class="form-control" id="<?php echo $_ns; ?>"
										onchange="$('#<?php echo $_ns; ?>_obj').val($(this).val());"<?php
										if($_field['config']['readonly'] == '1'): ?> readonly
										<?php endif; if($_field['config']['disabled'] == '1'): ?>
										disabled
										<?php endif; if($_field['config']['required'] == '1'): ?>
										required
										<?php endif; ?>>
										<?php if(is_array($_temps) || $_temps instanceof \think\Collection): if( count($_temps)==0 ) : echo "" ;else: foreach($_temps as $key=>$_temp): $_temp = explode("|",$_temp); ?>
										<option value="<?php echo $_temp[1]; ?>"<?php
											if($_field['value'] == $_temp[1]): ?>selected
											<?php endif; ?>>
											<?php echo $_temp[0]; ?></option>
										<?php endforeach; endif; else: echo "" ;endif; ?>
									</select>
								</div>
							</div>
							<?php else: ?>
							<select class="form-control" id="<?php echo $_ns; ?>"
								name="<?php echo $_field['field']; ?>"<?php
								if($_field['config']['readonly'] == '1'): ?> readonly
								<?php endif; if($_field['config']['disabled'] == '1'): ?>
								disabled
								<?php endif; if($_field['config']['required'] == '1'): ?>
								required
								<?php endif; ?>>
								<?php if(is_array($_temps) || $_temps instanceof \think\Collection): if( count($_temps)==0 ) : echo "" ;else: foreach($_temps as $key=>$_temp): $_temp = explode("|",$_temp); ?>
								<option value="<?php echo $_temp[1]; ?>"<?php
									if($_field['value'] == $_temp[1]): ?>selected
									<?php endif; ?>>
									<?php echo $_temp[0]; ?></option>
								<?php endforeach; endif; else: echo "" ;endif; ?>
							</select>
							<?php endif; break; case "radio": $_temps = explode("\r\n",$_field['config']['values']); if(is_array($_temps) || $_temps instanceof \think\Collection): if( count($_temps)==0 ) : echo "" ;else: foreach($_temps as $key=>$_temp): $_temp = explode("|",$_temp); ?>
							<label class="radio-inline"
								for="<?php echo $_ns; ?>_<?php echo $key; ?>"><input
								type="radio" name="<?php echo $_field['field']; ?>"
								id="<?php echo $_ns; ?>_<?php echo $key; ?>"
								value="<?php echo $_temp[1]; ?>"<?php
								if($_field['value'] == $_temp[1]): ?>checked<?php endif; if($_field['config']['disabled'] == '1'): ?>
								disabled<?php endif; if($_field['config']['readonly'] == '1'): ?>
								readonly<?php endif; ?>> <?php echo $_temp[0]; ?></label>
							<?php endforeach; endif; else: echo "" ;endif; break; case "checkbox": $_temps = explode("\r\n",$_field['config']['values']); if(is_array($_temps) || $_temps instanceof \think\Collection): if( count($_temps)==0 ) : echo "" ;else: foreach($_temps as $key=>$_temp): $_temp = explode("|",$_temp); ?>
							<label class="checkbox-inline"
								for="<?php echo $_ns; ?>_<?php echo $key; ?>"><input
								type="checkbox" id="<?php echo $_ns; ?>_<?php echo $key; ?>"
								name="<?php echo $_field['field']; ?>[]"
								value="<?php echo $_temp[1]; ?>"<?php
								if(in_array(($_temp['1']),
								is_array($_field['value'])?$_field['value']:explode(',',$_field['value']))):
								?>checked<?php endif; if($_field['config']['disabled'] == '1'): ?>
								disabled<?php endif; if($_field['config']['readonly'] == '1'): ?>
								readonly<?php endif; ?>> <?php echo $_temp[0]; ?></label>
							<?php endforeach; endif; else: echo "" ;endif; break; case "textbox": ?>
							<input type="text" class="form-control" id="<?php echo $_ns; ?>"
								name="<?php echo $_field['field']; ?>"
								value="<?php echo $_field['value']; ?>"
								placeholder="<?php echo (isset($_field['config']['prompt']) && ($_field['config']['prompt'] !== '')?$_field['config']['prompt']:''); ?>"<?php
							if($_field['config']['readonly'] == '1'): ?> readonly
							<?php endif; if($_field['config']['disabled'] == '1'): ?>
							disabled
							<?php endif; if($_field['config']['required'] == '1'): ?>
							required
							<?php endif; ?>
							>
							<?php break; case "multitextbox": ?>
							<textarea class="form-control" id="<?php echo $_ns; ?>"
								name="<?php echo $_field['field']; ?>"
								rows="<?php echo (isset($_field['config']['height']) && ($_field['config']['height'] !== '')?$_field['config']['height']:'5'); ?>"
								placeholder="<?php echo (isset($_field['config']['prompt']) && ($_field['config']['prompt'] !== '')?$_field['config']['prompt']:''); ?>"<?php if($_field['config']['disabled'] == '1'): ?> disabled<?php endif; if($_field['config']['readonly'] == '1'): ?> readonly<?php endif; if($_field['config']['required'] == '1'): ?> required<?php endif; ?>><?php echo $_field['value']; ?></textarea>
							<?php break; case "image": ?>
							<script>$(function(){EBCMS.FN.renderPic('#<?php echo $_ns; ?>'<?php if(!(empty($_field['config']['extensions']) || ($_field['config']['extensions'] instanceof \think\Collection && $_field['config']['extensions']->isEmpty()))): ?>,'<?php echo $_field['config']['extensions']; ?>'<?php endif; ?>);});</script>
							<div class="row">
								<div class="col-md-10">
									<input id="<?php echo $_ns; ?>" class="form-control"
										name="<?php echo $_field['field']; ?>"
										value="<?php echo $_field['value']; ?>"
										placeholder="<?php echo (isset($_field['config']['prompt']) && ($_field['config']['prompt'] !== '')?$_field['config']['prompt']:''); ?>"<?php
									if($_field['config']['disabled'] == '1'): ?> disabled
									<?php endif; if($_field['config']['readonly'] == '1'): ?>
									readonly
									<?php endif; if($_field['config']['required'] == '1'): ?>
									required
									<?php endif; ?>
									/>
								</div>
								<div class="col-md-2">
									<div id="<?php echo $_ns; ?>Picker">上传</div>
								</div>
							</div>
							<?php break; case "images": ?>
							<script>$(function(){EBCMS.TEMP.temp_<?php echo $_field['id']; ?>_renderPics = function(container,extensions,picker){
extensions = extensions?extensions:'gif,jpg,jpeg,bmp,png';var pick = picker||container + 'Picker';var uploader = WebUploader.create({
auto: true,swf: EBCMS.DATA.config.WebUploader_swf,server: EBCMS.DATA.config.WebUploader_server,pick: pick,accept: {
title: 'Images',extensions: extensions,mimeTypes: 'image/*'
}});$(pick).mouseover(function(){
$(this).resize();});uploader.on( 'error', function(code) {EBCMS.MSG.webuploaderMsg(code);});uploader.on( 'uploadError', function( file ) {EBCMS.MSG.alert('上传出错');});uploader.on( 'uploadSuccess', function( file,res ) {
if (res.code) {EBCMS.TEMP.temp_<?php echo $_field['id']; ?>_imgs.push({
img:res.data.pathname,title:res.data.name,description:'',url:'',});EBCMS.TEMP.temp_<?php echo $_field['id']; ?>_refresh_<?php echo $_ns; ?>();}else{EBCMS.MSG.alert(res.msg);};});uploader.on( 'uploadComplete', function( file ) {
});};EBCMS.TEMP.temp_<?php echo $_field['id']; ?>_renderPics('#<?php echo $_ns; ?>'<?php if(!(empty($_field['config']['extensions']) || ($_field['config']['extensions'] instanceof \think\Collection && $_field['config']['extensions']->isEmpty()))): ?>,'<?php echo $_field['config']['extensions']; ?>'<?php endif; ?>);});</script>
							<div class="row">
								<div class="col-md-10">
									<div class="row" id="<?php echo $_ns; ?>_foo"></div>
								</div>
								<div class="col-md-2">
									<div id="<?php echo $_ns; ?>Picker">上传</div>
								</div>
							</div>
							<script
								src="<?php echo get_root(); ?>/third/sortable/Sortable.js"></script>
							<style>
.x {
	height: 200px;
	border: 1px solid #ddd;
}

.sortable-ghost {
	background: #ddd;
}
</style>
							<script>$(function() {
new Sortable(document.getElementById("<?php echo $_ns; ?>_foo"), {
group: "omega",handle: ".col-md-3",draggable: ".col-md-3",ghostClass: "sortable-ghost",onRemove: function (evt){
},onStart: function (evt){EBCMS.TEMP.temp_<?php echo $_field['id']; ?>_index1 = $(evt.item).index();},onEnd: function (evt){EBCMS.TEMP.temp_<?php echo $_field['id']; ?>_index2 = $(evt.item).index();if (EBCMS.TEMP.temp_<?php echo $_field['id']; ?>_index1 != EBCMS.TEMP.temp_<?php echo $_field['id']; ?>_index2) {EBCMS.TEMP.temp_<?php echo $_field['id']; ?>_img_temp = EBCMS.TEMP.temp_<?php echo $_field['id']; ?>_imgs[EBCMS.TEMP.temp_<?php echo $_field['id']; ?>_index1];for(var i=EBCMS.TEMP.temp_<?php echo $_field['id']; ?>_index1;i<EBCMS.TEMP.temp_<?php echo $_field['id']; ?>_imgs.length;i++){EBCMS.TEMP.temp_<?php echo $_field['id']; ?>_imgs[i]=EBCMS.TEMP.temp_<?php echo $_field['id']; ?>_imgs[i+1]; 
}EBCMS.TEMP.temp_<?php echo $_field['id']; ?>_imgs.length=EBCMS.TEMP.temp_<?php echo $_field['id']; ?>_imgs.length-1;EBCMS.TEMP.temp_<?php echo $_field['id']; ?>_imgs.splice(EBCMS.TEMP.temp_<?php echo $_field['id']; ?>_index2, 0, EBCMS.TEMP.temp_<?php echo $_field['id']; ?>_img_temp);EBCMS.TEMP.temp_<?php echo $_field['id']; ?>_refresh_<?php echo $_ns; ?>();}},});EBCMS.TEMP.temp_<?php echo $_field['id']; ?>_imgs = <?php echo json_encode($_field['value']); ?>||[];EBCMS.TEMP.temp_<?php echo $_field['id']; ?>_refresh_<?php echo $_ns; ?> = function(){EBCMS.CORE.compile({
tpl:'<?php echo $_ns; ?>-item',data:{rows:EBCMS.TEMP.temp_<?php echo $_field['id']; ?>_imgs},target:'#<?php echo $_ns; ?>_foo',});};EBCMS.TEMP.temp_<?php echo $_field['id']; ?>_refresh_<?php echo $_ns; ?>();EBCMS.TEMP.edits_<?php echo $_field['id']; ?> = function(id){
if ('edit' == id) {EBCMS.TEMP.temp_<?php echo $_field['id']; ?>_imgs[EBCMS.TEMP.editid_<?php echo $_field['id']; ?>].title = $('#<?php echo $_ns; ?>_title').val();EBCMS.TEMP.temp_<?php echo $_field['id']; ?>_imgs[EBCMS.TEMP.editid_<?php echo $_field['id']; ?>].description = $('#<?php echo $_ns; ?>_description').val();EBCMS.TEMP.temp_<?php echo $_field['id']; ?>_imgs[EBCMS.TEMP.editid_<?php echo $_field['id']; ?>].url = $('#<?php echo $_ns; ?>_url').val();EBCMS.TEMP.temp_<?php echo $_field['id']; ?>_imgs[EBCMS.TEMP.editid_<?php echo $_field['id']; ?>].img = $('#<?php echo $_ns; ?>_img').val();$('#lgModal').modal('hide');EBCMS.TEMP.temp_<?php echo $_field['id']; ?>_refresh_<?php echo $_ns; ?>();}else{
id = Number(id);EBCMS.TEMP.editid_<?php echo $_field['id']; ?> = id;EBCMS.CORE.compile({
tpl:'<?php echo $_ns; ?>-edit',data:EBCMS.TEMP.temp_<?php echo $_field['id']; ?>_imgs[id],target:'#lgModal .modal-content',compileAfter:function(){EBCMS.FN.renderPic('#<?php echo $_ns; ?>_img'<?php if(!(empty($_field['config']['extensions']) || ($_field['config']['extensions'] instanceof \think\Collection && $_field['config']['extensions']->isEmpty()))): ?>,'<?php echo $_field['config']['extensions']; ?>'<?php endif; ?>);}});}return false;};EBCMS.TEMP.delete_<?php echo $_field['id']; ?> = function(id){
id = Number(id);for(var i=id;i<EBCMS.TEMP.temp_<?php echo $_field['id']; ?>_imgs.length;i++){EBCMS.TEMP.temp_<?php echo $_field['id']; ?>_imgs[i]=EBCMS.TEMP.temp_<?php echo $_field['id']; ?>_imgs[i+1]; 
}EBCMS.TEMP.temp_<?php echo $_field['id']; ?>_imgs.length -= 1;EBCMS.TEMP.temp_<?php echo $_field['id']; ?>_refresh_<?php echo $_ns; ?>();return false;};});</script>
							<script id="<?php echo $_ns; ?>-item" type="text/html">[[each rows as v n]]<div class="col-md-3 col-sm-4 col-xs-6"><div class="panel panel-default"><div class="panel-heading text-overflow" style="width:auto;">[[v.title]]</div><div class="panel-body"><p><img src="<?php echo get_root(); ?>/upload/[[v.img]]" width="100%" height="200" alt=""></p><p><button class="btn btn-primary btn-sm" onclick="return EBCMS.TEMP.edits_<?php echo $_field['id']; ?>('[[n]]');">编辑</button> <button class="btn btn-primary btn-sm" onclick="return EBCMS.TEMP.delete_<?php echo $_field['id']; ?>('[[n]]');">删除</button></p></div></div><input type="hidden" name="<?php echo $_field['field']; ?>[[n | left]][[n]][[n | right]][title]" value="[[v.title]]"><input type="hidden" name="<?php echo $_field['field']; ?>[[n | left]][[n]][[n | right]][img]" value="[[v.img]]"><input type="hidden" name="<?php echo $_field['field']; ?>[[n | left]][[n]][[n | right]][url]" value="[[v.url]]"><input type="hidden" name="<?php echo $_field['field']; ?>[[n | left]][[n]][[n | right]][description]" value="[[v.description]]"></div>[[/each]]</script>
							<script id="<?php echo $_ns; ?>-edit" type="text/html"><div class="modal-header"><button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button><h4 class="modal-title text-danger"><b>编辑图片</b></h4></div><div class="modal-body"><div class="row"><div class="col-md-10"><input id="<?php echo $_ns; ?>_img" class="form-control" value="[[img]]"/></div><div class="col-md-2"><div id="<?php echo $_ns; ?>_imgPicker">上传</div></div></div><div class="form-group"><label class="control-label" for="<?php echo $_ns; ?>_title">标题</label><input type="text" class="form-control" id="<?php echo $_ns; ?>_title" value="[[title]]"></div><div class="form-group"><label class="control-label" for="<?php echo $_ns; ?>_url">链接地址</label><input type="text" class="form-control" id="<?php echo $_ns; ?>_url" value="[[url]]"></div><div class="form-group"><label class="control-label" for="<?php echo $_ns; ?>_description">简介</label><textarea class="form-control" id="<?php echo $_ns; ?>_description" rows="6">[[description]]</textarea></div></div><div class="modal-footer"><button type="button" class="btn btn-primary" onclick="return EBCMS.TEMP.edits_<?php echo $_field['id']; ?>('edit');">提交</button> <button type="button" class="btn btn-default" data-dismiss="modal">关闭</button></div></script>
							<?php break; case "file": ?>
							<script>$(function(){EBCMS.FN.renderFile('#<?php echo $_ns; ?>'<?php if(!(empty($_field['config']['extensions']) || ($_field['config']['extensions'] instanceof \think\Collection && $_field['config']['extensions']->isEmpty()))): ?>,'<?php echo $_field['config']['extensions']; ?>'<?php endif; ?>);});</script>
							<div class="row">
								<div class="col-md-10">
									<input id="<?php echo $_ns; ?>" class="form-control"
										name="<?php echo $_field['field']; ?>"
										value="<?php echo $_field['value']; ?>"
										placeholder="<?php echo (isset($_field['config']['prompt']) && ($_field['config']['prompt'] !== '')?$_field['config']['prompt']:''); ?>"<?php
									if($_field['config']['disabled'] == '1'): ?> disabled
									<?php endif; if($_field['config']['readonly'] == '1'): ?>
									readonly
									<?php endif; if($_field['config']['required'] == '1'): ?>
									required
									<?php endif; ?>
									/>
								</div>
								<div class="col-md-2">
									<div id="<?php echo $_ns; ?>Picker">上传</div>
								</div>
							</div>
							<?php break; case "files": ?>
							<script>$(function(){EBCMS.TEMP.temp_<?php echo $_field['id']; ?>_renderPics = function(container,extensions,picker){
extensions = extensions?extensions:'gif,jpg,jpeg,bmp,png';var pick = picker||container + 'Picker';var uploader = WebUploader.create({
auto: true,swf: EBCMS.DATA.config.WebUploader_swf,server: EBCMS.DATA.config.WebUploader_server,pick: pick,accept: {
title: 'File',extensions: extensions,mimeTypes: '*/*'
}});$(pick).mouseover(function(){
$(this).resize();});uploader.on( 'error', function(code) {EBCMS.MSG.webuploaderMsg(code);});uploader.on( 'uploadError', function( file ) {EBCMS.MSG.alert('上传出错');});uploader.on( 'uploadSuccess', function( file,res ) {
if (res.code) {EBCMS.TEMP.temp_<?php echo $_field['id']; ?>_files.push({
file:res.data.pathname,title:res.data.name,description:'',});EBCMS.TEMP.temp_<?php echo $_field['id']; ?>_refresh_<?php echo $_ns; ?>();}else{EBCMS.MSG.alert(res.msg);};});uploader.on( 'uploadComplete', function( file ) {
});};EBCMS.TEMP.temp_<?php echo $_field['id']; ?>_renderPics('#<?php echo $_ns; ?>'<?php if(!(empty($_field['config']['extensions']) || ($_field['config']['extensions'] instanceof \think\Collection && $_field['config']['extensions']->isEmpty()))): ?>,'<?php echo $_field['config']['extensions']; ?>'<?php endif; ?>);});</script>
							<div class="row">
								<div class="col-md-10">
									<div class="row" id="<?php echo $_ns; ?>_foo"></div>
								</div>
								<div class="col-md-2">
									<div id="<?php echo $_ns; ?>Picker">上传</div>
								</div>
							</div>
							<script
								src="<?php echo get_root(); ?>/third/sortable/Sortable.js"></script>
							<style>
.x {
	height: 200px;
	border: 1px solid #ddd;
}

.sortable-ghost {
	background: #ddd;
}
</style>
							<script>$(function() {
new Sortable(document.getElementById("<?php echo $_ns; ?>_foo"), {
group: "omega",handle: ".contentlist",draggable: ".contentlist",ghostClass: "sortable-ghost",onRemove: function (evt){
},onStart: function (evt){EBCMS.TEMP.temp_<?php echo $_field['id']; ?>_index1 = $(evt.item).index();},onEnd: function (evt){EBCMS.TEMP.temp_<?php echo $_field['id']; ?>_index2 = $(evt.item).index();if (EBCMS.TEMP.temp_<?php echo $_field['id']; ?>_index1 != EBCMS.TEMP.temp_<?php echo $_field['id']; ?>_index2) {EBCMS.TEMP.temp_<?php echo $_field['id']; ?>_file_temp = EBCMS.TEMP.temp_<?php echo $_field['id']; ?>_files[EBCMS.TEMP.temp_<?php echo $_field['id']; ?>_index1];for(var i=EBCMS.TEMP.temp_<?php echo $_field['id']; ?>_index1;i<EBCMS.TEMP.temp_<?php echo $_field['id']; ?>_files.length;i++){EBCMS.TEMP.temp_<?php echo $_field['id']; ?>_files[i]=EBCMS.TEMP.temp_<?php echo $_field['id']; ?>_files[i+1]; 
}EBCMS.TEMP.temp_<?php echo $_field['id']; ?>_files.length=EBCMS.TEMP.temp_<?php echo $_field['id']; ?>_files.length-1;EBCMS.TEMP.temp_<?php echo $_field['id']; ?>_files.splice(EBCMS.TEMP.temp_<?php echo $_field['id']; ?>_index2, 0, EBCMS.TEMP.temp_<?php echo $_field['id']; ?>_file_temp);EBCMS.TEMP.temp_<?php echo $_field['id']; ?>_refresh_<?php echo $_ns; ?>();}},});EBCMS.TEMP.temp_<?php echo $_field['id']; ?>_files = <?php echo json_encode($_field['value']); ?>||[];EBCMS.TEMP.temp_<?php echo $_field['id']; ?>_refresh_<?php echo $_ns; ?> = function(){EBCMS.CORE.compile({
tpl:'<?php echo $_ns; ?>-item',data:{rows:EBCMS.TEMP.temp_<?php echo $_field['id']; ?>_files},target:'#<?php echo $_ns; ?>_foo',});};EBCMS.TEMP.temp_<?php echo $_field['id']; ?>_refresh_<?php echo $_ns; ?>();EBCMS.TEMP.edits_<?php echo $_field['id']; ?> = function(id){
if ('edit' == id) {EBCMS.TEMP.temp_<?php echo $_field['id']; ?>_files[EBCMS.TEMP.editid_<?php echo $_field['id']; ?>].title = $('#<?php echo $_ns; ?>_title').val();EBCMS.TEMP.temp_<?php echo $_field['id']; ?>_files[EBCMS.TEMP.editid_<?php echo $_field['id']; ?>].description = $('#<?php echo $_ns; ?>_description').val();EBCMS.TEMP.temp_<?php echo $_field['id']; ?>_files[EBCMS.TEMP.editid_<?php echo $_field['id']; ?>].file = $('#<?php echo $_ns; ?>_file').val();$('#lgModal').modal('hide');EBCMS.TEMP.temp_<?php echo $_field['id']; ?>_refresh_<?php echo $_ns; ?>();}else{
id = Number(id);EBCMS.TEMP.editid_<?php echo $_field['id']; ?> = id;EBCMS.CORE.compile({
tpl:'<?php echo $_ns; ?>-edit',data:EBCMS.TEMP.temp_<?php echo $_field['id']; ?>_files[id],target:'#lgModal .modal-content',compileAfter:function(){EBCMS.FN.renderFile('#<?php echo $_ns; ?>_file'<?php if(!(empty($_field['config']['extensions']) || ($_field['config']['extensions'] instanceof \think\Collection && $_field['config']['extensions']->isEmpty()))): ?>,'<?php echo $_field['config']['extensions']; ?>'<?php endif; ?>);}});}return false;};EBCMS.TEMP.delete_<?php echo $_field['id']; ?> = function(id){
id = Number(id);for(var i=id;i<EBCMS.TEMP.temp_<?php echo $_field['id']; ?>_files.length;i++){EBCMS.TEMP.temp_<?php echo $_field['id']; ?>_files[i]=EBCMS.TEMP.temp_<?php echo $_field['id']; ?>_files[i+1]; 
}EBCMS.TEMP.temp_<?php echo $_field['id']; ?>_files.length -= 1;EBCMS.TEMP.temp_<?php echo $_field['id']; ?>_refresh_<?php echo $_ns; ?>();return false;};});</script>
							<script id="<?php echo $_ns; ?>-item" type="text/html">[[each rows as v n]]<div class="media contentlist"><div class="media-left"><i class="iconfont icon-[[v.file | fileicon]] text-primary" style="font-size:6em;"></i></div><div class="media-body"><h3 class="media-heading">[[v.title]]</h3><div class="description">[[v.description]]</div><div style="margin:10px auto;"><button class="btn btn-primary btn-sm" onclick="return EBCMS.TEMP.edits_<?php echo $_field['id']; ?>('[[n]]');">编辑</button> <button class="btn btn-primary btn-sm" onclick="return EBCMS.TEMP.delete_<?php echo $_field['id']; ?>('[[n]]');">删除</button></div></div><input type="hidden" name="<?php echo $_field['field']; ?>[[n | left]][[n]][[n | right]][title]" value="[[v.title]]"><input type="hidden" name="<?php echo $_field['field']; ?>[[n | left]][[n]][[n | right]][file]" value="[[v.file]]"><input type="hidden" name="<?php echo $_field['field']; ?>[[n | left]][[n]][[n | right]][description]" value="[[v.description]]"></div>[[/each]]</script>
							<script id="<?php echo $_ns; ?>-edit" type="text/html"><div class="modal-header"><button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button><h4 class="modal-title text-danger"><b>编辑附件</b></h4></div><div class="modal-body"><div class="row"><div class="col-md-10"><input id="<?php echo $_ns; ?>_file" class="form-control" value="[[file]]"/></div><div class="col-md-2"><div id="<?php echo $_ns; ?>_filePicker">上传</div></div></div><div class="form-group"><label class="control-label" for="<?php echo $_ns; ?>_title">标题</label><input type="text" class="form-control" id="<?php echo $_ns; ?>_title" value="[[title]]"></div><div class="form-group"><label class="control-label" for="<?php echo $_ns; ?>_description">简介</label><textarea class="form-control" id="<?php echo $_ns; ?>_description" rows="6">[[description]]</textarea></div></div><div class="modal-footer"><button type="button" class="btn btn-primary" onclick="return EBCMS.TEMP.edits_<?php echo $_field['id']; ?>('edit');">提交</button> <button type="button" class="btn btn-default" data-dismiss="modal">关闭</button></div></script>
							<?php break; case "ueditor": ?>
							<script>$(function(){EBCMS.FN.renderUE('<?php echo $_ns; ?>',{
autoHeightEnabled:<?php echo (isset($_field['config']['autoheightenabled']) && ($_field['config']['autoheightenabled'] !== '')?$_field['config']['autoheightenabled']:'false'); ?>,maximumWords:<?php echo (isset($_field['config']['maximumwords']) && ($_field['config']['maximumwords'] !== '')?$_field['config']['maximumwords']:'10000'); ?>,wordCount:<?php echo (isset($_field['config']['wordcount']) && ($_field['config']['wordcount'] !== '')?$_field['config']['wordcount']:'true'); ?>,elementPathEnabled:<?php echo (isset($_field['config']['elementpathenabled']) && ($_field['config']['elementpathenabled'] !== '')?$_field['config']['elementpathenabled']:'true'); ?>,initialFrameHeight:<?php echo (isset($_field['config']['initialframeheight']) && ($_field['config']['initialframeheight'] !== '')?$_field['config']['initialframeheight']:'420'); ?>,});});</script>
							<textarea name="<?php echo $_field['field']; ?>"
								id="<?php echo $_ns; ?>"><?php echo $_field['value']; ?></textarea>
							<?php break; case "combotree": ?>
							<script>$(function(){<?php 
if ($_field['config']['queryparams']) {
$_where = '';$_queryparams = explode("\r\n",$_field['config']['queryparams']);foreach ($_queryparams as $key => $value) {
$_tmp = explode('|',$value);if (stripos($_tmp[2],'(I)') === 0) {
$_tmp[2] = input(substr($_tmp[2],3));}elseif(stripos($_tmp[2],'(@)') === 0){
$_tmp[2] = $_data[substr($_tmp[2],3)];}elseif(stripos($_tmp[2],'($)') === 0){
$_tmp[2] = get_tpl_value($_data,substr($_tmp[2],3));};$_where .= $_tmp[0].":['".$_tmp[1]."','".$_tmp[2]."'],";}};$_field['config']['group'] = isset($_field['config']['group'])?$_field['config']['group']:0;$_field['config']['tree'] = isset($_field['config']['tree'])?$_field['config']['tree']:0;$_field['config']['rootitem'] = isset($_field['config']['rootitem'])?$_field['config']['rootitem']:0;$_field['config']['editable'] = isset($_field['config']['editable'])?$_field['config']['editable']:0;?>EBCMS.CORE.api({<?php if($_field['config']['group'] == '1'): ?>group:'group',<?php else: if($_field['config']['tree'] == '1'): ?>tree:'tree',<?php endif; if($_field['config']['rootitem'] == '1'): ?>rootitem:true,<?php endif; endif; ?>queryParams:{
order:{
'sort':'desc',},model:'<?php echo $_field['config']['model']; ?>',<?php if(!(empty($_field['config']['queryparams']) || ($_field['config']['queryparams'] instanceof \think\Collection && $_field['config']['queryparams']->isEmpty()))): ?>where:{<?php echo $_where; ?>},<?php endif; ?>},loadAfter:function(data){
$select = $('#<?php echo $_ns; ?>');var str = EBCMS.FN.renderSelect(data['rows'],'<?php echo $_field['value']; ?>','<?php echo (isset($_field['config']['valuefield']) && ($_field['config']['valuefield'] !== '')?$_field['config']['valuefield']:"id"); ?>','<?php echo (isset($_field['config']['textfield']) && ($_field['config']['textfield'] !== '')?$_field['config']['textfield']:"title"); ?>');$select.append(str);}});});</script>
							<?php if($_field['config']['editable'] == '1'): ?>
							<div class="row">
								<div class="col-md-8">
									<input type="text" class="form-control"
										id="<?php echo $_ns; ?>_obj"
										name="<?php echo $_field['field']; ?>"
										value="<?php echo $_field['value']; ?>"
										placeholder="<?php echo (isset($_field['config']['prompt']) && ($_field['config']['prompt'] !== '')?$_field['config']['prompt']:''); ?>"<?php
									if($_field['config']['readonly'] == '1'): ?> readonly
									<?php endif; if($_field['config']['disabled'] == '1'): ?>
									disabled
									<?php endif; if($_field['config']['required'] == '1'): ?>
									required
									<?php endif; ?>
									>
								</div>
								<div class="col-md-4">
									<select class="form-control" id="<?php echo $_ns; ?>"
										onchange="$('#<?php echo $_ns; ?>_obj').val($(this).val());"<?php
										if($_field['config']['readonly'] == '1'): ?> readonly
										<?php endif; if($_field['config']['disabled'] == '1'): ?>
										disabled
										<?php endif; if($_field['config']['required'] == '1'): ?>
										required
										<?php endif; ?>>
									</select>
								</div>
							</div>
							<?php else: ?>
							<select class="form-control" id="<?php echo $_ns; ?>"
								name="<?php echo $_field['field']; ?>"<?php
								if($_field['config']['readonly'] == '1'): ?> readonly
								<?php endif; if($_field['config']['disabled'] == '1'): ?>
								disabled
								<?php endif; if($_field['config']['required'] == '1'): ?>
								required
								<?php endif; ?>>
							</select>
							<?php endif; break; case "datadict": ?>
							<script>$(function(){EBCMS.CORE.datadict({
queryParams:{
order:{
'sort':'desc',},datadict:'<?php echo $_field['config']['datadict']; ?>',},<?php if($_field['config']['rootitem'] == '1'): ?>rootitem:true,<?php endif; ?>loadAfter:function(res){
$select = $('#<?php echo $_ns; ?>');var str = EBCMS.FN.renderSelect(res['rows'],'<?php echo $_field['value']; ?>','<?php echo (isset($_field['config']['valuefield']) && ($_field['config']['valuefield'] !== '')?$_field['config']['valuefield']:"id"); ?>','<?php echo (isset($_field['config']['textfield']) && ($_field['config']['textfield'] !== '')?$_field['config']['textfield']:"title"); ?>');$select.append(str);}});});</script>
							<?php 
$_field['config']['editable'] = isset($_field['config']['editable'])?$_field['config']['editable']:0;if($_field['config']['editable'] == '1'): ?>
							<div class="row">
								<div class="col-md-8">
									<input type="text" class="form-control"
										id="<?php echo $_ns; ?>_obj"
										name="<?php echo $_field['field']; ?>"
										value="<?php echo $_field['value']; ?>"
										placeholder="<?php echo (isset($_field['config']['prompt']) && ($_field['config']['prompt'] !== '')?$_field['config']['prompt']:''); ?>"<?php
									if($_field['config']['readonly'] == '1'): ?> readonly
									<?php endif; if($_field['config']['disabled'] == '1'): ?>
									disabled
									<?php endif; if($_field['config']['required'] == '1'): ?>
									required
									<?php endif; ?>
									>
								</div>
								<div class="col-md-4">
									<select class="form-control" id="<?php echo $_ns; ?>"
										onchange="$('#<?php echo $_ns; ?>_obj').val($(this).val());"<?php
										if($_field['config']['readonly'] == '1'): ?> readonly
										<?php endif; if($_field['config']['disabled'] == '1'): ?>
										disabled
										<?php endif; if($_field['config']['required'] == '1'): ?>
										required
										<?php endif; ?>>
									</select>
								</div>
							</div>
							<?php else: ?>
							<select class="form-control" id="<?php echo $_ns; ?>"
								name="<?php echo $_field['field']; ?>"<?php
								if($_field['config']['readonly'] == '1'): ?> readonly
								<?php endif; if($_field['config']['disabled'] == '1'): ?>
								disabled
								<?php endif; if($_field['config']['required'] == '1'): ?>
								required
								<?php endif; ?>>
							</select>
							<?php endif; break; case "numberbox": ?>
							<input type="number" id="<?php echo $_ns; ?>"
								class="form-control" name="<?php echo $_field['field']; ?>"
								value="<?php echo $_field['value']; ?>"<?php
							if($_field['config']['readonly'] == '1'): ?> readonly
							<?php endif; if($_field['config']['disabled'] == '1'): ?>
							disabled
							<?php endif; if($_field['config']['required'] == '1'): ?>
							required
							<?php endif; ?>
							/>
							<?php break; case "timespinner": ?>
							<input type="time" id="<?php echo $_ns; ?>" class="form-control"
								name="<?php echo $_field['field']; ?>"
								value="<?php echo $_field['value']; ?>" id="<?php echo $_ns; ?>"<?php
							if($_field['config']['readonly'] == '1'): ?> readonly
							<?php endif; if($_field['config']['disabled'] == '1'): ?>
							disabled
							<?php endif; if($_field['config']['required'] == '1'): ?>
							required
							<?php endif; ?>
							/>
							<?php break; case "datebox": ?>
							<input type="date" id="<?php echo $_ns; ?>" class="form-control"
								name="<?php echo $_field['field']; ?>"
								value="<?php echo $_field['value']; ?>" id="<?php echo $_ns; ?>"<?php
							if($_field['config']['readonly'] == '1'): ?> readonly
							<?php endif; if($_field['config']['disabled'] == '1'): ?>
							disabled
							<?php endif; if($_field['config']['required'] == '1'): ?>
							required
							<?php endif; ?>
							/>
							<?php break; case "datetimebox": ?>
							<input type="datetime-local" id="<?php echo $_ns; ?>"
								class="form-control" name="<?php echo $_field['field']; ?>"
								value="<?php echo datetimelocal($_field['value']); ?>"
								id="<?php echo $_ns; ?>"<?php
							if($_field['config']['readonly'] == '1'): ?> readonly
							<?php endif; if($_field['config']['disabled'] == '1'): ?>
							disabled
							<?php endif; if($_field['config']['required'] == '1'): ?>
							required
							<?php endif; ?>
							/>
							<?php break; case "extendtext": ?>
							<script>Namespace.register("EBCMS.Form_extendtext");$(function() {EBCMS.Form_extendtext.changename = function(id,value){
$(id).attr('name','<?php echo $_field['field']; ?>['+value+']');};EBCMS.Form_extendtext.up = function(id){
if ($(id).prev().hasClass('form-group')) {
$(id).insertBefore($(id).prev());}};EBCMS.Form_extendtext.down = function(id){
if ($(id).next().hasClass('form-group')) {
$(id).next().insertBefore($(id));}};EBCMS.Form_extendtext.render_text = function(name,value,target){
name = name||'EB_' + EBCMS.FN.random_str(6);opt = {
name:name,value:value||'',id:'<?php echo $_ns; ?>_' + EBCMS.FN.random_str(15),};var str = '';str += '<div class="form-group" id="'+opt.id+'_group">';str += '<div class="col-sm-1 control-label"><label>';str += '<i class="iconfont icon-shanchu cursor-pointer" onclick="$(\'#'+opt.id+'_group\').remove();"></i>';str += '<i class="iconfont icon-xiayi cursor-pointer" onclick="EBCMS.Form_extendtext.down(\'#'+opt.id+'_group\');"></i>';str += '<i class="iconfont icon-shangyi cursor-pointer" onclick="EBCMS.Form_extendtext.up(\'#'+opt.id+'_group\');"></i>';str += '<label></div>';str += '<div class="col-sm-2">';str += '<input type="text" class="form-control" value="'+opt.name+'" onKeyUp="EBCMS.Form_extendtext.changename(\'#'+opt.id+'\',$(this).val());" placeholder="填写名称">';str += '</div>';str += '<div class="col-sm-9">';str += '<input type="text" class="form-control" id="'+opt.id+'" name="<?php echo $_field['field']; ?>['+opt.name+']" value="'+opt.value+'" placeholder="填写值">';str += '</div>';str += '</div>';if (target) {
$(target).append(str);}else{
return str;}};var forms = <?php echo json_encode($_field['value']); ?>||{};if (typeof forms!='object') {
forms = {};}$.each(forms, function(name, val) {EBCMS.Form_extendtext.render_text(name,val,'#<?php echo $_field['id']; ?>_container');});});</script>
							<div class="row">
								<div class="col-sm-12">
									<div class="btn-group" role="group" aria-label="...">
										<button type="button" class="btn btn-primary btn-sm"
											onclick="EBCMS.Form_extendtext.render_text('','','#<?php echo $_field['id']; ?>_container');">单行文本</button>
									</div>
								</div>
							</div>
							<br>
							<div class="row">
								<div class="col-sm-12"
									id="<?php echo $_field['id']; ?>_container"></div>
							</div>
							<?php break; case "keywords": ?>
							<div class="row">
								<div class="col-md-8">
									<input id="<?php echo $_ns; ?>" class="form-control"
										name="<?php echo $_field['field']; ?>"
										value="<?php echo $_field['value']; ?>"
										placeholder="<?php echo (isset($_field['config']['prompt']) && ($_field['config']['prompt'] !== '')?$_field['config']['prompt']:''); ?>"<?php
									if($_field['config']['disabled'] == '1'): ?> disabled
									<?php endif; if($_field['config']['readonly'] == '1'): ?>
									readonly
									<?php endif; if($_field['config']['required'] == '1'): ?>
									required
									<?php endif; ?>
									/>
								</div>
								<div class="col-md-2">
									<button type="button" class="btn btn-primary btn-block"
										onclick="EBCMS.FN.suggest_keywords('#<?php echo $_ns; ?>');">长尾关键词</button>
								</div>
								<div class="col-md-2">
									<button type="button" class="btn btn-primary btn-block"
										onclick="EBCMS.FN.suggest_keywords('#<?php echo $_ns; ?>','<?php if(isset($_field['config']['field']) && $_field['config']['field']){echo 'ebcms_'.md5('ebcmsformfield_'.$_field['config']['field'].$_nowtime);}else{echo '0';} ?>','<?php echo (isset($_field['config']['strong']) && ($_field['config']['strong'] !== '')?$_field['config']['strong']:'0'); ?>');">插入到内容</button>
								</div>
							</div>
							<?php break; default: ?>
							<span style="color: red;">
								<?php echo $_field['type']; ?>表单类型不存在 请联系专业人员
							</span>
							<?php endswitch; if(!(empty($_field['remark']) || ($_field['remark'] instanceof \think\Collection && $_field['remark']->isEmpty()))): ?>
							<p class="help-block">
								<?php echo $_field['remark']; ?>
							</p>
							<?php endif; ?>
						</div>
					</div>
					<?php endif; endforeach; ?>
				</div>
				<?php endforeach; endif; ?>
			</div>
		</form>
	</div>
</div>
<?php endif; ?>