template.helper('datadict', function (key, dict) {
    var s = dict.split('.');
    if (s[1]) {
        if (EBCMS.DATA[s[0]] && EBCMS.DATA[s[0]][key]) {
            return EBCMS.DATA[s[0]][key][s[1]];
        };
    }else{
        if (EBCMS.DATA[S[0]]) {
            return EBCMS.DATA[s[0]][key];
        };
    };
    return 'undefined';
});
template.helper('str_repeat', function (n, str) {
    return EBCMS.FN.str_repeat(n,str);
});
template.helper('access', function (rule,locked) {
    if (EBCMS.DATA.super_admin==1 || (locked==0 && EBCMS.DATA.rules.indexOf(rule)>-1)) {
        return true;
    };
    return false;
});
template.helper('jump', function (url) {
    if (url.substr(0,4) == 'http') {
        return true;
    }
    return false;
});
template.helper('realpath', function (filename) {
    if (filename) {
        if (filename.substr(0,4) == 'http') {
            return filename;
        }else{
            return EBCMS.DATA.root+"/upload" + filename;
        }
    }else{
        return EBCMS.DATA.root+"/static/index/image/nopic.gif";
    };
});
template.helper('dostr', function (v) {
    if (typeof v == 'string') {
        return v;
    }else{
        return v.join(',');
    }
});
template.helper('fileicon', function (filename) {
    var fileExtension = filename.substring(filename.lastIndexOf('.') + 1);
    if (-1 != $.inArray(fileExtension, ['zip','rar','7z'])) {
        return 'yasuobao';
    }else if (-1 != $.inArray(fileExtension, ['jpg','png','jpeg','gif','bmp','icon'])) {
        return 'suini-pic';
    }else{
        return 'wenjian';
    }
});
template.helper('unixtostr', function (time) {
    return EBCMS.FN.unixtostr(time);
});
template.helper('keyword', function (str,style,delimiter) {
    delimiter = delimiter || ',';
    style = style || 'default';
    var keywords = str.split(delimiter);
    var res = '';
    $.each(keywords, function(index, val) {
        res += '<span class="label label-'+style+'">' + val + '</span> ';
    });
    return res;
});
template.helper('htmlspecialchars_decode', function (str) {
    return EBCMS.FN.htmlspecialchars_decode(str);
});
template.helper('htmlspecialchars', function (str) {
    return EBCMS.FN.htmlspecialchars(str);
});
template.helper('escape', function (str) {
    return str = str.replace(/'/g, '\\&#039;');
});
template.helper('left', function (str) {
    return '[';
});
template.helper('right', function (str) {
    return ']';
});