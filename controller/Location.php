<?php
/**
 * Created by PhpStorm.
 * User: Ian
 * Date: 2016/1/23
 * Time: 17:11
 */

require_once "../model/LocationManager.php";
require_once "../model/UserInfo.php";
$userid = $_COOKIE['userid'];
$lgt = $_POST['lgt'];
$atd = $_POST['atd'];

$mng = new Location();
$rs = $mng->updateLocation($userid, $lgt, $atd);
if($rs == true){
    $palid = getPalID($userid);
    $palLoc = $mng->getLocation($palid);
    if($palLoc != false){
        echo $palLoc['LGT'],',',$palLoc['ATD'];
    }
}