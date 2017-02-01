<?php
/**
 * Created by PhpStorm.
 * User: Ian
 * Date: 2015/12/14
 * Time: 16:33
 */
class Link{
    private static $pdo;

    private function makePDO(){
        try{
            $RootDir = $_SERVER['DOCUMENT_ROOT'];
            $pdo = new PDO("sqlite:".$RootDir."/mailme.db3");
//            $pdo = new PDO("mysql:host=localhost;dbname=mailme","root","");
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        }catch (PDOException $e){

        }

        return $pdo;
    }

    public static function getPDO(){
        if(!isset(Link::$pdo)){
            Link::$pdo = Link::makePDO();
        }
        return Link::$pdo;
    }
}
