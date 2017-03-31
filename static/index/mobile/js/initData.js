$(function(){
//	initIndex();
	//格式化日期
	dateFormat();
})
//获取标签列表
function initIndex(){
	$.ajax({
        url: 'http://120.26.192.83/index.php/index/mobile/indexList',
        type: 'GET',
        dataType: 'jsonp',
    })
    .done(function(data) {
        //console.log("success");
        //console.log(data);
//        addIndexHtml(data.recommend_list);

    })
    .fail(function() {
        console.log("error");
    })
    .always(function() {
        console.log("complete");
    });
}
