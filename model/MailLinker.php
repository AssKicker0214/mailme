<?php
/**
 * Created by PhpStorm.
 * User: Ian
 * Date: 2015/12/28
 * Time: 8:24
 */
include_once "./PDOLink.php";
class MailLinker{
    private $pdo;
    function __construct(){
        $this->pdo = Link::getPDO();
    }

    function getLinkInfo($uid){
        $sql = 'SELECT * FROM MailLink WHERE UID = '.'"'.$uid.'"';
        $query = $this->pdo->query($sql);
        $query->setFetchMode(PDO::FETCH_ASSOC);
        $rs = $query->fetch();
        return $rs;
    }

    function updateLinkInfo($uid, $selfMail, $mailPswd){
        $sql = 'UPDATE MailLink SET SELFMAIL=?,MAILPSWD=? WHERE UID=?';
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute(array($selfMail,$mailPswd,$uid));

    }
}

$linker = new MailLinker();
$linker->updateLinkInfo('qhb','121584565@163.com','123yuekao275');
//$rs = $linker->getLinkInfo('qhb');
//print_r($rs);