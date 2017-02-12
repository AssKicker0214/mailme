<?php
/**
 * Created by PhpStorm.
 * User: Ian
 * Date: 2015/12/21
 * Time: 8:22
 */
include_once $_SERVER['DOCUMENT_ROOT']."/model/MailManager.php";

function getMailByID($mid){
    return getDetail($mid);
}