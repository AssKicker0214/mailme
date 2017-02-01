<?php
/**
 * Created by PhpStorm.
 * User: Ian
 * Date: 2015/12/14
 * Time: 16:57
 */
include_once $_SERVER['DOCUMENT_ROOT']."/model/UserInfo.php";
$userid = $_GET['userid'];
$psw = $_GET['psw'];
$city = $_GET['city'];

$permit = checkLogin($userid, $psw);

if($permit){
    setcookie('userid',$userid,0,'/');

}
echo $permit,'<br/>µÇÂ½µØµã:',$city;