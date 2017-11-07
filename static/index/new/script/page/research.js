 //KEY FIGURES 数据 缓冲效果
 function Research_GeneralSituationFun(data){
    if ($('#Research_GeneralSituation').length>0) {

        var options = {
             useEasing : true,
              useGrouping : true,
              separator : '',
              decimal : '.',
              prefix : '',
              suffix : ''

        };

        $('#Research_GeneralSituation').waypoint(function(){
            var numAnim = new CountUp("Research_GeneralSituation_1", 0, 3, 0, 3.5, options);
            numAnim.start();
            var numAnim = new CountUp("Research_GeneralSituation_2", 0, 10.1, 1, 3.5, options);
            numAnim.start();
            var numAnim = new CountUp("Research_GeneralSituation_3", 0, 1.59, 2, 3.5, options);
            numAnim.start();
            var numAnim = new CountUp("Research_GeneralSituation_4", 0, 532, 0, 3.5, options);
            numAnim.start();
            var numAnim = new CountUp("Research_GeneralSituation_5", 0, 13, 0, 3.5, options);
            numAnim.start();
            var numAnim = new CountUp("Research_GeneralSituation_6", 0, 55, 0, 3.5, options);
            numAnim.start();
        }, { offset: '100%' });
    };

 }
    
Research_GeneralSituationFun()

 //KEY FIGURES 数据 缓冲效果 end