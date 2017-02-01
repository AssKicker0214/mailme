/**
 * Created by Ian on 2016/1/15.
 */
window.onscroll = function(){
    //alert(document.body.scrollTop);
    document.getElementById('link').innerHTML = document.documentElement.scrollTop;
    //getPoint();
    if(document.documentElement.scrollTop>5){
        //alert(document.documentElement.scrollTop);
        document.getElementById('index-nav').style.backgroundColor = "red";
    }else{
        document.getElementById('index-nav').style.backgroundColor = "rgba(0,0,0,0.3";

    }
};
//
//$(".left").each(function(){
//    var img = $(this).attr("style");
//    img = "http://localhost:21314"+img.split("'")[1];
//    alert(img);
//
//    RGBaster.colors(img, {
//    success: function(payload) {
//        // payload.dominant是主色，RGB形式表示
//        // payload.secondary是次色，RGB形式表示
//        // payload.palette是调色板，含多个主要颜色，数组
//        alert(payload.dominant+payload.secondary+payload.palette);
//    }
//});
//});

//var img = document.getElementById()
//
//RGBaster.colors(img, {
//    success: function(payload) {
//        // payload.dominant是主色，RGB形式表示
//        // payload.secondary是次色，RGB形式表示
//        // payload.palette是调色板，含多个主要颜色，数组
//        console.log(payload.dominant);
//        console.log(payload.secondary);
//        console.log(payload.palette);
//    }
//});