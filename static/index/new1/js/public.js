
var titleIndex = $('title').attr('data-ind'); //获取title 的attr 属性
var titleUrl    = {};  // 用于存放url 内的参数  act=index&op=special&special_id=2

var PhotosObj = null;  //相册对象存储


function CnAlert(string){
	var CnAlert = $('#CnAlert');
	CnAlert.show().find('span').html(string);
	setTimeout(function(){CnAlert.hide()},1500)
}



function zhuanjson() {
	var ObjVal = window.location.href.split('#')[0].substring(window.location.href.split('#')[0].indexOf('?')+1).split("&");
	for(var i=0;i<ObjVal.length;i++){titleUrl[ObjVal[i].substr(0,ObjVal[i].indexOf('='))]=decodeURI(ObjVal[i].substring(ObjVal[i].indexOf('=')+1))};
}
zhuanjson();







// ButSearch

function ButSearchFun(){
	console.log('ButSearch');

	$('#header').find('div#HeadSearch').show();

	
}

function guanbiSearchFun(){
	console.log('guanbiSearchFun');

	var ind = $('#header').find('div#HeadSearch').find('input').val();

	console.log(ind.length);
	if (ind.length <= 0) {
		$('#header').find('div#HeadSearch').hide();

	}else{
		window.location.href = 'search.html?searchName='+ind;
	}


}

function ButSearch(){
	$('#header').on('click','li#ButSearc',function(){
		console.log('ButSearch')

		$('#header').find('div#HeadSearch').show();
	})

	
}


// ButSearch();

// ButSearch



   // window 滚动事件 goTop
   function windowsrloo(){
   	var  win =  $(window);
   	var  winH =  win[0].innerHeight;

   	win.scroll(function(){
		// console.log(win[0].scrollY);
		
		if (win[0].scrollY > winH) {
			$('#goTop').show();
		}else{
			$('#goTop').hide();
		}



	})
   }
// windowsrloo();
// window 滚动事件 end

//时间戳 转换方法
Date.prototype.Format = function(fmt)   
	{ //author: meizz   
		var o = {   
	    "M+" : this.getMonth()+1,                 //月份   
	    "d+" : this.getDate(),                    //日   
	    "h+" : this.getHours(),                   //小时   
	    "m+" : this.getMinutes(),                 //分   
	    "s+" : this.getSeconds(),                 //秒   
	    "q+" : Math.floor((this.getMonth()+3)/3), //季度   
	    "S"  : this.getMilliseconds()             //毫秒   
	};   
	if(/(y+)/.test(fmt))   
		fmt=fmt.replace(RegExp.$1, (this.getFullYear()+"").substr(4 - RegExp.$1.length));   
	for(var k in o)   
		if(new RegExp("("+ k +")").test(fmt))   
			fmt = fmt.replace(RegExp.$1, (RegExp.$1.length==1) ? (o[k]) : (("00"+ o[k]).substr((""+ o[k]).length)));   
		return fmt;   
	}  


	//时间戳 转换方法 end

	//判断 当前 日期是否和上一日期相同
	function ifTimeTrue(topTime,thisTime,nian,yue,ri,lang){
		if (topTime == thisTime) {
			return '';
		}else{
			return '<a href="'+ '#'+lang +'"><span class="nian">'+nian+'</span><span class="yue">'+yue+'</span></a>';
		}
	}
	//判断 当前 日期是否和上一日期相同 end






// 替换josn数据里的字符

function expandEntities(data) {
	var string = null;
	if (data.length != 0) {
		string = data.replace(/\&lt;/g,"<").replace(/\&gt;/g,">").replace(/\&amp;/g,"&").replace(/\&nbsp;/g,' ').replace(/\&quot;/g,'"');
	}
	return string;
}
// 替换josn数据里的字符 end




	// 打开 搜索 
	function openSearch(){
		var input = $('#SearchInupt');

		$('#showSearch').click(function(){
				if (!input.attr('class')) {
					input.addClass('active');

				}else{
					if (input.val() == '') {
						input.removeClass('active');
						// input.blur();
					}else{
					// 方法执行
						$('#head_search').submit();
				}
			}

		})

			input.focus(function(){
				console.log('focus');
				input.bind('keydown',function(event){
					console.log(event.keyCode);
					if (event.keyCode ==27) {
						input.removeClass('active');
					}else if (event.keyCode == 13) {
						var valin = input.val();
						if (valin != ' ') {
						   //跳转
							
						}
					}
				})
			});
			input.blur(function(){
				console.log('blur');
				input.unbind('keydown');
				input.removeClass('active');

			});


	}


	// openLogoin
	function openLogoin(){
		$('#logoin').on('click','.exit',function(){
				$('#logoin').hide();
		})
	}
	openLogoin();
	// openLogoin end

	$(function(){
//		dateFormat();
//		hourFormat();
		openSearch();
		$('body').append('<div class="CnAlert" id="CnAlert"><span></span></div>');
		$('.IndMore').append('<span></span>');
		//关闭视频
		$('#guanbi').click(function(){

			console.log('Pause')

			$('#videoCon').hide();

		})
		$('#advertisementWindow').on('click','div.cood',function(){
			$('#advertisementWindow').hide();
		})
		// 打开 搜索 end
	})
	
	function hourFormat(){
		$('span[name=time_hour]').each(function(index,value){
			var time = $(value).attr('time');
			var current = new Date();
			var zhuanti_time = new Date(parseInt(time)*1000);
			var hours = Math.floor((current-zhuanti_time)/(1000*60*60));
			if(parseInt(hours)>24){
				hours =  Math.floor(hours/24);
				$(value).html(hours+'days ago');
			}else{
				$(value).html(hours+'hours ago');
			}
		});
	}

