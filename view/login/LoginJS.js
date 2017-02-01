/**
 * Created by Ian on 2015/12/13.
 */
function checkLogin(){
    var id = document.getElementById('userid').value;
    var psw = document.getElementById('psw').value;
    var xhr = $.ajax({url:"/controller/CheckLoginBG.php?userid="+id+"&psw="+psw+"&city="+getCity(), async:true, success:function(respond){
        //document.getElementById('login-form').style.opacity = 0;
        //document.getElementById('on-login-container').style.opacity=100;
        //document.body.style.backgroundImage = "url(/wallpaper/paper2.jpg)";
        //document.getElementById('bkgd').style.backgroundImage = "url(/wallpaper/paper2.jpg)";
        //setInterval(hideForm, 1000);
        hideForm();
    }})
}

function hideForm(){
    document.getElementById('login-form').style.visibility = "hidden";
    //alert('jump');
    window.location.href = '/view/index/index.php';
}

