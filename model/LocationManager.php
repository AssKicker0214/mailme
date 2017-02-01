<?php
/**
 * Created by PhpStorm.
 * User: Ian
 * Date: 2016/1/23
 * Time: 17:11
 */
require_once "./PDOLink.php";
class Location{
    private $pdo;
    function __construct(){
        $this->pdo = Link::getPDO();
    }

    function updateLocation($uid, $lgt, $atd){
        $sql = "UPDATE LoginInfo SET LGT=?, ATD=? WHERE UID=?";
        $stmt = $this->pdo->prepare($sql);
        $rs = $stmt->execute(array($lgt, $atd, $uid));
        return $rs;
    }

    function getLocation($uid){
        $point = false;
        $sql = "SELECT LGT,ATD FROM LoginInfo WHERE UID=?";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute(array($uid));
        $point = $stmt->fetch(PDO::FETCH_ASSOC);
        return $point;
    }
}

