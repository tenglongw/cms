$(function(){
	getTagList();
})
//获取标签列表
function getTagList(){
	var category_id = $('#category_id').val();
	$.ajax({
        url: 'http://120.26.192.83/index.php/index/comment/tagList?category_id='+category_id,
        type: 'GET',
        dataType: 'jsonp',
    })
    .done(function(data) {
        console.log("success");
        console.log(data);
        addHtml(data);

    })
    .fail(function() {
        console.log("error");
    })
    .always(function() {
        console.log("complete");
    });
}
//添加Html
function addHtml(data){
	var tag_id = $('#tag_id').val();
	var html = '';
	var tag_class = ''
	for(var i=0;i < data.length;i++){
		if(data[i].id == tag_id){
			tage_class = 'active';
		}else{
			tage_class = '';
		}
		html+= '<li class="'+tage_class+'"> <a href="'+data[i].url+'">'+data[i].tag+' </a> </li>';
	}
	$('#tag_list').html(html);
}