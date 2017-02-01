/**
 * Created by Ian on 2015/12/21.
 */
window.onscroll = function(){
    //alert(document.body.scrollTop);
    document.getElementById('scroll').innerHTML = 'scrolltop: '+document.body.scrollTop+
        'clienttop: '+document.body.clientTop+'clientheight: '+document.body.clientHeight+'scrollheight:'+
    document.body.scrollHeight+'selfheight:'+document.getElementById('scroll').clientHeight;
};

//
$(window).resize(function(){
    alert(window.innerHeight);
    $('.filled').css('min-height', window.innerHeight);
});

function saveEmailAndEpswd(){
    //var xhr = $.ajax({url:})
}