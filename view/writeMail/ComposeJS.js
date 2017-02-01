/**
 * Created by Ian on 2016/1/7.
 */
document.getElementById('mail-title').onfocus = function(){
    document.getElementById('mail-title').style.backgroundColor = 'white';
    document.getElementById('mail-title').style.color = 'black';
};
document.getElementById('mail-title').onblur = function(){
    document.getElementById('mail-title').style.backgroundColor = 'rgba(255,255,255,0.3)';
    document.getElementById('mail-title').style.color = 'white';

};

function mapLocation(){
    var city = "哈密";
    if(city != ""){
        map.centerAndZoom(city,11);      // 用城市名设置地图中心点
    }
}

function getLocation(){
    alert(remote_ip_info['country']+remote_ip_info['province']+remote_ip_info['city']);

}



function getWeather() {
    var cityUrl = 'http://int.dpool.sina.com.cn/iplookup/iplookup.php?format=js';
    $.getScript(cityUrl, function(script, textStatus, jqXHR) {
        var citytq = remote_ip_info.city ;// 获取城市
        $('#location').html(citytq);
        var url = "http://php.weather.sina.com.cn/iframe/index/w_cl.php?code=js&city=" + citytq + "&day=0&dfc=3";
        $.ajax({
            url : url,
            dataType : "script",
            scriptCharset : "gbk",
            success : function(data) {
                var _w = window.SWther.w[citytq][0];
                var tq = citytq + " " + " " + _w.s1 + " " + _w.t1 + "。" + _w.t2 + "。" + _w.d1 + _w.p1 + "级";
                $('#weather').html(_w.s1);
                changeBackground(_w.s1);
            }

        
        });
    });
}

function changeBackground(w){
    var weather = 'weather';
    switch(w){
        case '晴': weather='sunny'; break;
        case '多云': weather='cloudy'; break;
        default : alert('未识别的天气：'+w);
    }

    var now = new Date();
    var month = now.getMonth()+1;

    var season = '';
    if (month >= 1 && month <= 3) season = "winter";
    if (month == 3 && date > 19) season = "spring";
    if (month > 3 && month <= 6) season = "spring";
    if (month == 6 && date > 20) season = "summer";
    if (month > 6 && month <= 9) season = "summer";
    if (month == 9 && date > 21) season = "fall";
    if (month > 9 && month <= 12) season = "fall";
    if (month == 12 && date > 20) season = "winter";

    var time = 'time';
    var hour = now.getHours();
    if(hour >= 7 && hour <18){
        time = 'day';
    }else if(hour >= 18 || hour<7){
        time = 'night';
    }


    $.ajax({url: "/controller/BackgroundImgMatcher.php/?time="+time+"&season="+season+"&weather="+weather, asyn:true, type:'get',
    success: function(respond){
        alert(respond);
        //$('#default-img').attr('value') = respond;
        document.getElementById('default-img').setAttribute("value", respond);
        //document.body.style.backgroundImage = 'url("'+respond+'")';
        document.getElementById('jumbotron').style.backgroundImage = 'url("'+respond+'")';
    }})
}


function setDuration(){
    var today = new Date();
    var acquaintance = new Date('2015/06/10');
    var duration = parseInt((today.getTime()-acquaintance.getTime())/(1000*3600*24));
    $('#acquaintance').html(duration+'天');
}

$.getScript("http://api.map.baidu.com/api?v=20&ak=Zivdy91pRqUuLB5G8bioZNzS&callback=getPoint");

//var map = new BMap.Map("map");
var map;
//var point = new BMap.Point(116.331398,39.897445);
//map.centerAndZoom(point,6);


function getPoint() {
    map  = new BMap.Map("map");
    var geolocation = new BMap.Geolocation();
    geolocation.getCurrentPosition(function (r) {
        if (this.getStatus() == BMAP_STATUS_SUCCESS) {
            //var mk = new BMap.Marker(r.point);
            //map.addOverlay(mk);
            //map.panTo(r.point);
            //alert('您的位置：' + r.point.lng + ',' + r.point.lat);
            updateLocation(r.point.lng, r.point.lat);
        }
        else {
            alert('failed' + this.getStatus());
        }
    }, {enableHighAccuracy: true});

//关于状态码
//BMAP_STATUS_SUCCESS	检索成功。对应数值“0”。
//BMAP_STATUS_CITY_LIST	城市列表。对应数值“1”。
//BMAP_STATUS_UNKNOWN_LOCATION	位置结果未知。对应数值“2”。
//BMAP_STATUS_UNKNOWN_ROUTE	导航结果未知。对应数值“3”。
//BMAP_STATUS_INVALID_KEY	非法密钥。对应数值“4”。
//BMAP_STATUS_INVALID_REQUEST	非法请求。对应数值“5”。
//BMAP_STATUS_PERMISSION_DENIED	没有权限。对应数值“6”。(自 1.1 新增)
//BMAP_STATUS_SERVICE_UNAVAILABLE	服务不可用。对应数值“7”。(自 1.1 新增)
//BMAP_STATUS_TIMEOUT	超时。对应数值“8”。(自 1.1 新增)
}

//并返回距离
function updateLocation(longitude, latitude){
    $.ajax({url:"/controller/Location.php",type:'post', data:{lgt: longitude, atd: latitude}, asyn: true,
        success: function(respond){
            var x = respond.split(',')[0];
            var y = respond.split(',')[1];
            var palPoint = new BMap.Point(x, y);
            var myPoint = new BMap.Point(longitude, latitude);
            var distance = calculateDistance(palPoint, myPoint);
            //alert('ta的位置'+respond);
        }})
}

function calculateDistance(pointMine, pointPal){
    var distance = (map.getDistance(pointMine, pointPal)).toFixed(0);
    //var polyline = new BMap.Polyline([pointMine,pointPal], {strokeColor:"blue", strokeWeight:6, strokeOpacity:0.5});  //定义折线
    //map.addOverlay(polyline);
    //document.getElementById('distance').innerHTML = distance+' 米';
    //alert('distance:'+distance);
    $('#distance').html(distance+' 米');
    return distance;
}

//mapLocation();
setDuration();
getWeather();
//findWeather();