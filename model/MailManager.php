<?php
/**
 * Created by PhpStorm.
 * User: Ian
 * Date: 2015/12/16
 * Time: 19:06
 */
include_once $_SERVER['DOCUMENT_ROOT']."/model/PDOLink.php";
function sendMail($to, $from, $title, $content, $backgroundImg){
    $pdo = Link::getPDO();
    $sql = "Insert Into Mail(FROMID, TOID, SUBJECT, CONTENT, SENTDATE, STATE, BACKGROUND) VALUES (?,?,?,?,?,?,?)";
    $stmt = $pdo->prepare($sql);
    $stmt->execute(array($from, $to, $title, $content, date('Y-m-d'), 0, $backgroundImg));

}

function getMail(){
    $pdo = Link::getPDO();
    $sql = 'Select * from Mail ORDER BY SENTDATE';
    $stmt = $pdo->prepare($sql);
    $stmt->execute();
    $rs = $stmt->fetchAll(PDO::FETCH_ASSOC);
    return $rs;
}

function getDetail($mid){
    $pdo = Link::getPDO();
    $sql = 'Select * from Mail WHERE MID=?';
    $stmt = $pdo->prepare($sql);
    $stmt->execute(array($mid));
    $rs = $stmt->fetch(PDO::FETCH_ASSOC);
    return $rs;

}
