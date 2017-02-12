<?php
/**
 * Created by PhpStorm.
 * User: Ian
 * Date: 2015/12/14
 * Time: 16:57
 */
//echo $_SERVER['DOCUMENT_ROOT'];
include_once $_SERVER['DOCUMENT_ROOT']."/model/UserInfo.php";
$userid = $_GET['userid'];
$psw = $_GET['psw'];
$city = $_GET['city'];
//echo $userid." ".$psw." ".$city;
$permit = checkLogin($userid, $psw);
//echo $permit;
//
if($permit){
    setcookie('userid',$userid,0,'/');

}
echo $permit,'<br/>登陆地点:',$city;