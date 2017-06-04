Namespace = new Object();
Namespace.register = function(fullNS)
{
	var nsArray = fullNS.split('.');
	var sEval = "";
	var sNS = "";
	var count = nsArray.length;
	for (var i = 0; i < count; i++)
	{
		if (i != 0) sNS += ".";
		sNS += nsArray[i];
		if (i<count-1) {
			sEval += "if (typeof(" + sNS + ") == 'undefined') " + sNS + " = new Object();";
		}else{
			sEval += "delete " + sNS + ";" + sNS + " = new Object();";
		};
	}
	if (sEval != "") eval(sEval);
};
Namespace.register("EBCMS.CONFIG");
Namespace.register("EBCMS.MSG");
Namespace.register("EBCMS.FN");
EBCMS.FN = {
	favorite:function(type,cid){
		$.ajax({
			url: EBCMS.CONFIG.favorite_URL,
			type: 'POST',
			dataType: 'json',
			data: {
				type:type,
				cid:cid,
			},
			success:function(data){
				if (data.status) {
					EBCMS.MSG.success(data.info);
				}else{
					EBCMS.MSG.alert(data.info);
				}
			}
		});
	},
	htmlspecialchars:function(str){
	    if (!str) {return};
	    str = str.replace(/&/g, '&amp;');
	    str = str.replace(/</g, '&lt;');
	    str = str.replace(/>/g, '&gt;');
	    str = str.replace(/"/g, '&quot;');
	    str = str.replace(/'/g, '&#039;');
	    return str;
	},
	htmlspecialchars_decode:function(str){
	    if (!str) {return};
	    str = str.replace(/&amp;/g, '&');
	    str = str.replace(/&lt;/g, '<');
	    str = str.replace(/&gt;/g, '>');
	    str = str.replace(/&quot;/g, '"');
	    str = str.replace(/&#039;/g, "'");
	    return str;
	},
	tabs:function(a,b){
		$(a).children().bind('click', function(event) {
			$(this).addClass('current').siblings().removeClass('current');
			var i = $(this).index();
			$(b).children().eq(i).show().siblings().hide();
		});
		$(a).children().eq(0).trigger('click');
	},
	change_verify:function change_verify(selecter) {
		var url = $(selecter).attr('src');
		if (-1 != url.lastIndexOf('#')) {
			url = url.substring(0, url.lastIndexOf('#'));
		}
		$(selecter).attr('src',url + "#" + Math.random());
		return false;
	},
	formSubmit:function(url,queryParams,fun){
		$.ajax({
			url: url,
			type: 'POST',
			dataType: 'JSON',
			data: queryParams||{'__tmp__':'__tmp__'},
			success:function(data){
				if (fun) {fun(data);};
			},
			error:function(XMLHttpRequest, textStatus, errorThrown){
				EBCMS.MSG.alert('数据请求失败：'+textStatus+' '+errorThrown+'<br />请求地址:'+url+'<br />AJAX请求信息：'+JSON.stringify(this)+'<br /><span style="color:red">如无法解决该问题，请联系EBCMS官方获取帮助</span>');
			}
		});
	},
	array2tree:function(data,idFiled,parentField){
	    idFiled = idFiled||'id';
	    parentField = parentField||'pid';
	    var i,l,treeData = [],tmpMap = [];
	    var count = data.length;
	    for (i = 0, l = count; i < l; i++) {
	        tmpMap[data[i][idFiled]] = data[i];
	    }
	    for (i = 0, l = count; i < l; i++) {
	        if (tmpMap[data[i][parentField]] && data[i][idFiled] != data[i][parentField]) {
	            if (!tmpMap[data[i][parentField]]['rows'])
	                tmpMap[data[i][parentField]]['rows'] = [];
	            tmpMap[data[i][parentField]]['rows'].push(data[i]);
	        } else {
	            treeData.push(data[i]);
	        }
	    }
	    return treeData;
	},
};
EBCMS.MSG = {
	alert:function(msg){
		alert(msg);
	},
	success:function(msg){
		alert(msg);
	},
};