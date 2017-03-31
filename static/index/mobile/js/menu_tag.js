$(function(){
	$('div[name=news_sub]').click(function(){
		var id = $(this).attr('data-id');
		getTagList(id,this);
	});
})
//获取标签列表
function getTagList(id,obj){
	$.ajax({
        url: 'http://120.26.192.83/index.php/index/comment/tagList?category_id='+id,
        type: 'GET',
        dataType: 'jsonp',
    })
    .done(function(data) {
        //console.log("success");
       // console.log(data);
        addHtml(data,obj);

    })
    .fail(function() {
        console.log("error");
    })
    .always(function() {
        console.log("complete");
    });
}
//添加Html
function addHtml(data,obj){
	console.log(data.length);
	var html = $(obj).parent().html()+'<ul class="NaTui">';
	var tag_class = ''
	for(var i=0;i < data.length;i++){
		html+= '<li><a href="'+data[i].url+'">'+data[i].tag+'</a></li>'
	}
	$(obj).parent().html(html+'</ul>');
}