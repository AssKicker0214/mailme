<?php
/**
 * Created by PhpStorm.
 * User: Ian
 * Date: 2015/12/16
 * Time: 19:04
 */
include_once $_SERVER['DOCUMENT_ROOT'].'/model/UserInfo.php';
include_once $_SERVER['DOCUMENT_ROOT'].'/model/MailManager.php';

//print_r($_FILES);



$from = $_COOKIE['userid'];
$to = getPalID($from);
$title = $_POST['mail-title'];
$content = $_POST['mail-content'];
$backgroundImg = '';

if(isset($_FILES['background-img']) && $_FILES['background-img']['error']!=4){
    print_r($_FILES['background-img']);
    $backgroundImg = saveBackgroundImg();
}else{
    echo "use default img<br />";
    $backgroundImg = $_POST['default-img'];
    $backgroundImg = "/wallpaper/".explode("wallpaper/", $backgroundImg)[1];
}

if(countID($to)){
    sendMail($to, $from, $title, $content, $backgroundImg);
    echo '已发送','<a href="/view/writeMail/ComposePage.php">return</a>';
}else{
    echo "收件人不存在";
}

function saveBackgroundImg(){
    $file = $_FILES['background-img'];
    $type = gettype($file);
    $storageName = $_COOKIE['userid'].time().$file['name'];
    $storagePath = '/backgroundimg/'.$storageName;
    if(is_uploaded_file($file['tmp_name'])){
        if( move_uploaded_file($file['tmp_name'], $storagePath)){
            echo "<br/>图片上传成功";
        }
    }
    return $storagePath;
}
