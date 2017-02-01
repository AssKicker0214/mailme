<?php
/**
 * Created by PhpStorm.
 * User: Ian
 * Date: 2015/12/18
 * Time: 0:41
 */
$array_all  = array();
$checkmail  = 'javazyf@gmail.com';

$array_sohu = array(
    "host"      => 'pop3.sohu.com',
    "port"      => 110,
    "user"      => 'ganjizyf',
    "password"  => '111221111',
    "saveFile"  => 'result/R_sohu.com',
    "checkmail" => $checkmail
);

$array_163 = array(
    "host"      => 'pop.163.com',
    "port"      => 110,
    "user"      => '121584565',
    "password"  => 'jrxizctenkmzharo',
    "saveFile"  => $_SERVER['DOCUMENT_ROOT'].'/mail.txt',
    "checkmail" => $checkmail
);
$array_qq = array(
    "host"      => 'pop.qq.com',
    "port"      => 110,
    "user"      => '121584565',
    "password"  => '520yuekao275',
    "saveFile"  => 'result/R_qq.com',
    "checkmail" => $checkmail
);
$array_21cn = array(
    "host"      => 'pop.21cn.com',
    "port"      => 110,
    "user"      => 'ganjizyf',
    "password"  => '1111111111111',
    "saveFile"  => 'result/R_21cn.com',
    "checkmail" => $checkmail
);
$array_tom = array(
    "host"      => 'pop.tom.com',
    "port"      => 110,
    "user"      => 'ganjizyf',
    "password"  => '11111111111111111',
    "saveFile"  => 'result/R_tom.com',
    "checkmail" => $checkmail
);

$array_sina = array(
    "host"      => 'pop.sina.com',
    "port"      => 110,
    "user"      => 'ian0214',
    "password"  => 'yuekao275',
    "saveFile"  => 'result/R_sina.com',
    "checkmail" => $checkmail
);

$array_gmail = array(
    "host"      => 'ssl://pop.gmail.com',
    "port"      => 995,
    "user"      => 'ganjizyf@gmail.com',
    "password"  => 'test0152220',
    "saveFile"  => 'result/R_gmail.com',
    "checkmail" => $checkmail
);