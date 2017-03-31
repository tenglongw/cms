$(function(){
	dateFormat();
});
function dateFormat(){
	$('span[name=_time]').each(function(index,value){
		var time = $(value).html();
		$(value).html(dateFormat_(time));
	});
}

function dateFormat_(time){
	var current = new Date();
	var zhuanti_time = new Date(parseInt(time)*1000);
	var days = Math.floor((current-zhuanti_time)/(1000*60*60*24));
	return days;
}