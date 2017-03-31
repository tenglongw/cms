       // 2017-01-10 10:56:15 日历


        $(function() {
            var $MyCalendar = $('#MyCalendar');

            var TruArray = [];

            var date = new Date(); //当前时间
            var YearT = date.getFullYear(); //当前年
            var MonthT = (date.getMonth())+1; // 当前月
            var DayT = date.getDate();  //当前日

            var MonthAy = [31,28,31,30,31,30,31,31,30,31,30,31]; //月天数对照

            var MobthDayInd = 35; //需要循环表格的数量


            var $Years = $MyCalendar.find('#Year');
            var $Months = $MyCalendar.find('#Month');
            var $MonthLsCon = $Months.find('.monthCobn');
           



            $Years.on('click', '.rr', function(event) {
                ChanggeYears(true);
            });
             $Years.on('click', '.ll', function(event) {
                ChanggeYears(false);
            });
             $Years.on('click', '.befoer', function(event) {
                ChanggeYears(true);
            });
             $Years.on('click', '.after', function(event) {
                ChanggeYears(false);

            });
              $Years.on('click', '.center', function(event) {
                $Months.show();

            });
             
             $Months.on('click', '.rr', function(event) {
                ChanggeMonth(true);
            });
             $Months.on('click', '.ll', function(event) {
                ChanggeMonth(false);
            });

             $("#Max_Con").scroll(function(){
                if ($(this)[0].scrollTop > 100) {
                    console.log('yes')

                    $Months.hide();
                }
             })



             $MonthLsCon.on('click','li.have',function(){
                var mao = $(this).attr('title');
                    $(this).addClass('current').siblings('li').removeClass('current');
                 // window.location.hash = '#'+mao;
                 $("#Max_Con").animate({scrollTop: $("#"+mao).offset().top}, 500);
                 $Months.hide();

             })


             //改变月 方法
            function ChanggeMonth(condition){

                var index = parseInt($Months.find('.Monthind').text());


                if (condition) {
                    index++;
                    if (index >12) {
                        index =1;
                    }
                }else{
                    index--;
                    if (index < 1) {
                        index =12;
                    }
                }
                $Months.find('.Monthind').text(index);

                getTa();
                
            }


           //改变年 方法
            function ChanggeYears(condition){
                $Months.show();

                var index = parseInt($Years.find('.center').text());

                if (condition) {
                    $Years.find('.befoer').text(index-2);
                    $Years.find('.center').text(index-1);
                    $Years.find('.after').text(index);

                }else{
                	if(2018 >= (index+2)){
	                    $Years.find('.befoer').text(index);
	                    $Years.find('.center').text(index+1);
	                    $Years.find('.after').text(index+2);
                	}
                }
                getTa();
                
            }



           //改变年 方法 end
           // ajaxFun(2016,12);

           function ajaxFun(Year,Month){
            $.ajax({
                url: 'http://120.26.192.83/index.php/index/comment/issueList?date='+Year+'-'+Month,
                type: 'POST',
                dataType: 'JSONP',
            })
            .done(function(data) {
                console.log("success");
                console.log(data);

                if (data.isHave) {
                     ForDome(data.issueList);
                }else{
                    // CnAlert(Year+'年'+Month+'月 没有发售的商品！')
                }

            })
            .fail(function() {
                console.log("error");
            })
            .always(function() {
                console.log("complete");
            });
            
           }

         
         //设置当前日期
         setThisDay();
        function setThisDay(){
            $Years.find('.befoer').text(YearT-1);
            $Years.find('.center').text(YearT);
            $Years.find('.after').text(YearT+1);
            $Months.find('.Monthind').text(MonthT);

            getTa();
        }
        //设置当前日期 end


        //获取 表单日期
        function getTa(){
            var Year =  $Years.find('.center').text();
            var Month = $Months.find('.Monthind').text();

            dateIn(Year,Month);
            ajaxFun(Year,Month);
        }
        //获取 表单日期 end







        // 日历
        function dateIn(Year,Month){
            var week = new Date(Year+'/'+Month+'/01').getDay(); //获取当天 星期几
            // console.log(Day)
            isLeapYear(Year); 

            if (week >= 5) {MobthDayInd = 42}else{MobthDayInd = 35}
            //判断是不是 闰年
            function isLeapYear(year) {
                if(year % 4 == 0 && year % 100 == 0 && year % 400 == 0) {
                    MonthAy[1] = 29;
                    return true;
                } else {
                    MonthAy[1] = 28;
                    return false;
                }
            }
            //判断是不是 闰年 end

            addDome();

            //循环列表
            function addDome(){
                $MonthLsCon.html('');
                var html = '';
                for (var i = 0; i < MobthDayInd; i++) {
                    var cn = '<li class="none"></li>';
                    html +=cn;
                }
                $MonthLsCon.append(html);
                addDate();
            }
            //循环列表

            // 添加日历
            function addDate(){
                var li = $MonthLsCon.find('li');
                var index = 1;
                for (var i = week; i < (week+MonthAy[Month-1]); i++) {
                    li.eq(i).text(index).addClass('hv').attr('title',Year+'-'+IsDan(Month)+'-'+IsDan(index));
                    // if (YearT == Year && MonthT == Month && index == DayT) {
                    //     li.eq(i).addClass('current');
                    // }
                    index++;
                }
            }
            // 添加日历 end
            function IsDan(number){

                var string = String(number);
                if (string.length == 1) {
                    return '0'+string;
                }else{
                    return string;
                }

            }

        }




        //循环结构
        function ForDome(data){
            var Con = $('#SellLs');

            // Con.html('');

            var html = '';
            TruArray = [];
            console.log(html);
            for (var i in data) {TruArray.push(i)};
            for (var i = 0; i < TruArray.length; i++) {
                // console.log(data[TruArray[i]]);
                html += '<li id="'+TruArray[i]+'">'+
                            '<div class="Time"><span class="yuan"><span class="dian"></span></span> <div class="Con">'+TruArray[i].replace(/-/g,".")+'</div></div>'+
                            '<ul class="SellLsCnNi clearfloat">'+Forzi(data[TruArray[i]])+'</ul>'+                    
                        '</li>';

            }
            Con.html(html);
            addTisin(TruArray)



        }

        function Forzi(data){
            var html = '';
            for (var i = 0; i < data.length; i++) {
                html += '<li>'+
                            '<a href="http://120.26.192.83/'+data[i].url+'">'+
                                '<div class="imgC"><img src="http://120.26.192.83'+data[i].thumb+'"></div>'+
                                '<div class="title">'+data[i].title+'</div>'+
                            '</a>'+
                        '</li>';
            }
            return html;
        }
        //循环结构


       function addTisin(TruArray){
        console.log(TruArray)
        var li =  $MonthLsCon.find('li');

        for (var i = 0; i < TruArray.length; i++) {
            for (var j = 0; j < li.length; j++) {
                var tit = li.eq(j).attr('title');
                if (TruArray[i] == tit) {
                    li.eq(j).addClass('have');
                    console.log(true);

                }
            }
        }
       }

    })
