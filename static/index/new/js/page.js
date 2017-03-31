
$(function(){
	getPageUrl();
});

function getPageUrl(){
	var href = $('.pagination').find('.active').next().find('a').attr('href');
	console.log(href);
	$('#more').attr('href',href);
}