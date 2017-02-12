<?php
/**
 * Created by PhpStorm.
 * User: Ian
 * Date: 2015/12/14
 * Time: 17:00
 */
include_once $_SERVER['DOCUMENT_ROOT']."/model/PDOLink.php";
function checkLogin($userid, $psw){
    $pdo = Link::getPDO();
    $sql = "select * from LoginInfo WHERE UID="."'".$userid."' AND PSW="."'".$psw."'";
    $query = $pdo->query($sql, PDO::FETCH_ASSOC);
//    $count = $query->rowCount();
    $result = $query->fetchAll(PDO::FETCH_ASSOC);
    if(count($result)>0){
        return true;
    }else{
        return false;
    }

}

function countID($id){
    $pdo = Link::getPDO();
    $sql = "select * from LoginInfo WHERE UID=?";
    $stmt = $pdo->prepare($sql);
    $stmt->execute(array($id));
    $set = $stmt->fetchAll(PDO::FETCH_ASSOC);
    return count($set);

}

function getPalID($userid){
    $pdo = Link::getPDO();
    $sql = "select PAL from MailLink WHERE UID=?";
    $stmt = $pdo->prepare($sql);
    $stmt->execute(array($userid));
    $set = $stmt->fetchAll(PDO::FETCH_ASSOC);
    return $set[0]['PAL'];
}