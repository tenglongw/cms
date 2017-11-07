 //KEY FIGURES 数据 缓冲效果
 function AboutUsCriticalDataFun(data){
    if ($('#AboutUsCriticalData').length>0) {

        var options = {
             useEasing : true,
              useGrouping : true,
              separator : '',
              decimal : '.',
              prefix : '',
              suffix : ''

        };

        $('#AboutUsCriticalData').waypoint(function(){
            var numAnim = new CountUp("AboutUsCriticalData_1", 0, 10.1, 1, 3.5, options);
            numAnim.start();
            var numAnim = new CountUp("AboutUsCriticalData_2", 0, 19163, 0, 3.5, options);
            numAnim.start();
            var numAnim = new CountUp("AboutUsCriticalData_3", 0, 28, 0, 3.5, options);
            numAnim.start();
            var numAnim = new CountUp("AboutUsCriticalData_4", 0, 19, 0, 3.5, options);
            numAnim.start();
        }, { offset: '100%' });
    };

}

AboutUsCriticalDataFun()

 //KEY FIGURES 数据 缓冲效果 end




////////////////////////////////////////////////////////////////////////////////////////////////////////









var  MapBusiness =  {
        "1": [
            {
                "business_id": "8",
                "name": "\u5317\u4eac\u6cf0\u5fb7\u5236\u836f\u6709\u9650\u516c\u53f8",
                "category": "FACILITIES"
            },
            {
                "business_id": "20",
                "name": "\u5357\u4eac\u5e02",
                "category": "FACILITIES"
            },
            {
                "business_id": "24",
                "name": "\u8fde\u4e91\u6e2f",
                "category": "FACILITIES"
            },
            {
                "business_id": "30",
                "name": "\u8fde\u4e91\u6e2f\u5e02\u6b63\u5927\u5929\u6674\u836f\u4e1a\u96c6\u56e2",
                "category": "FACILITIES"
            }
        ],
        "2": [
            {
                "business_id": "13",
                "name": "\u6cb3\u5357\u7701\u90d1\u5dde\u5e02",
                "category": "HOSPITALS"
            },
            {
                "business_id": "31",
                "name": "\u6e56\u5357\u7701\u90b5\u9633\u5e02",
                "category": "HOSPITALS"
            }
        ],
        "3": [
            {
                "business_id": "14",
                "name": "\u5929\u6d25\u5e02",
                "category": "NON-PHARMA"
            }
        ],
        "4": [
            {
                "business_id": "16",
                "name": "\u53f0\u5317",
                "category": "PARTNERSHIPS"
            },
            {
                "business_id": "17",
                "name": "\u9999\u6e2f",
                "category": "PARTNERSHIPS"
            }
        ],
        "5": [
            {
                "business_id": "10",
                "name": "\u5317\u4eac\u6cf0\u5fb7\u5236\u836f\u6709\u9650\u516c\u53f8",
                "category": "PHARMACEUTICAL"
            },
            {
                "business_id": "11",
                "name": "\u8fde\u4e91\u6e2f\u5e02\u6d77\u5dde\u533a\u90c1\u6d32\u5357\u8def369\u53f7",
                "category": "PHARMACEUTICAL"
            },
            {
                "business_id": "25",
                "name": "\u4e0a\u6d77\u5e02",
                "category": "PHARMACEUTICAL"
            },
            {
                "business_id": "27",
                "name": "\u5927\u4e30\u5e02",
                "category": "PHARMACEUTICAL"
            },
            {
                "business_id": "28",
                "name": "\u9752\u5c9b\u5e02",
                "category": "PHARMACEUTICAL"
            },
            {
                "business_id": "29",
                "name": "\u6dee\u5b89\u5e02",
                "category": "PHARMACEUTICAL"
            },
            {
                "business_id": "32",
                "name": "\u5357\u4eac\u5e02",
                "category": "PHARMACEUTICAL"
            },
            {
                "business_id": "33",
                "name": "\u6d59\u6c5f\u7701\u676d\u5dde\u5e02",
                "category": "PHARMACEUTICAL"
            }
        ]
    }


var MapData = null;
var Mapdefault = [];
var mapIconInd = 1;

var map = null;
var markerOne = null;

var icon =  new AMap.Icon({            
              // size: new AMap.Size(19, 33),  //图标大小
              // image: '../images/mapicon/mark_bs.png',
              // imageSize:new AMap.Size(19, 33),
              imageOffset: new AMap.Pixel(0, 0),
              // offset: new AMap.Pixel(-15, -5),
          })


// 地图加载

function BusinessMapFun(string){
    var MapThisDa = MapData[string]
    map = new AMap.Map('BusinessMap', {
         resizeEnable: true,
         lang:'cn',
         zoom:5,
         center: [108.824032,34.167488],
         scrollWheel:false

    });
    // map.setMapStyle("dark"); //设置地图的样式

    AMap.plugin(['AMap.ToolBar','AMap.Scale','AMap.OverView','AMap.Geolocation','AMap.MapType'],
        function(){
            map.addControl(new AMap.ToolBar());

        });

    markerOne = new AMap.Marker({
        icon:icon,
        position: [116.388806,39.904462],
        // offset: new AMap.Pixel(-5, -35)

    });
    markerOne.setMap(map);

   //map.clearMap();  // 清除地图覆盖物

   clearSetMap(MapThisDa)

}



// BusinessMapFun();

// 地图加载  end

function SetMapFun(string){
    var MapThisDa = MapData[string]
    clearSetMap(MapThisDa)

}



function clearSetMap(MapThisDa){
    map.clearMap();  // 清除地图覆盖物
    markerOne.setMap(map);
    for (var i = 0; i < MapThisDa.length; i++) {
        geocoder(MapThisDa[i].name) 
    }
}

function geocoder(data) {
    var geocoder = new AMap.Geocoder({
        // city: "010", //城市，默认：“全国”
        radius: 1000 //范围，默认：500
    });
    //地理编码,返回地理编码结果
    geocoder.getLocation(data, function(status, result) {
        // console.log(result)
        if (status === 'complete' && result.info === 'OK') {
            addMarker(result.geocodes[0],data);
            // console.log(result)
        }
    });
 }


function addMarker(data,namu) {
    var marker = new AMap.Marker({
        map: map,
        position: [ data.location.getLng(),  data.location.getLat()],
        title:namu,
        icon: icon ,
        // animation:'AMAP_ANIMATION_BOUNCE',
        // offset: new AMap.Pixel(-15, -10)
    });

    map.setFitView();

}



// 控制模块

function businessFun(data){
    var BusinessMapNa =$('#BusinessMapNa');
    var Maplist = BusinessMapNa.find('li');
    MapData = data;
    console.log(MapData);

    for(var i in MapData){
        Mapdefault.push(i);
        
    }
    
    // for (var j = 0; j < Mapdefault.length; j++) {
    //  Maplist.eq(j).attr('data-name',Mapdefault[j])
    // }

    BusinessMapFun(Mapdefault[0]);

    Maplist.hover(function(){
        var val = $(this).data().mapname;
        console.log(val);

        mapIconInd = $(this).index()+1;

        $(this).addClass('active').siblings().removeClass('active');

        // if (val =='PARTNERSHIPS') {
        //     $('#BusinessMap').hide();
        //     $('#partnershipsImg').show();
        // }else{
        //     $('#BusinessMap').show();
        //     $('#partnershipsImg').hide();
        //     SetMapFun(val);
        // }
        SetMapFun(val);


    },function(){

    })


}

businessFun(MapBusiness);









