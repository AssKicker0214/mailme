<?php
/**
 *用于收取邮箱中的信件，目前只支持pop3协议
 * @filename function_getmail.php
 * @touch date Tue 22 Apr 2009 20:49:12 AM CST
 * @package Get_Ganji_test_mail
 * @author zhangyufeng
 * @version 1.0.0
 * @copyright (c) 2009, zhangyufeng@staff.ganji.com
 */


//function ganji_get_test_mail($host, $port, $user, $password, $checkmail, $saveFile)

function ganji_get_test_mail($array_values)
{

    $host = $array_values['host'];
    $port = $array_values['port'];
    $user = $array_values['user'];
    $password = $array_values['password'];
    $checkmail = $array_values['checkmail'];
    $saveFile = $array_values['saveFile'];
    $msg = '';
    $return_msg = '';
    //ini_set('memory_limit', '80M');
    if (!($sock = fsockopen(gethostbyname($host), $port, $errno, $errstr)))
        exit($errno . ': ' . $errstr);
    set_socket_blocking($sock, true);

    $command = "USER " . $user . "\r\n";
    fwrite($sock, $command);
    $msg = fgets($sock);
    echo 'USER: ',$msg, '<br />';
    $command = "PASS " . $password . "\r\n";
    fwrite($sock, $command);
    $msg = fgets($sock);
    echo 'PSWD: ',$msg,'<br />';


    $command = "stat\r\n";
    fwrite($sock, $command);
    $return_msg = fgets($sock);
    echo 'stat: ',$return_msg,'<br />';

    $msg = fgets($sock);
    echo $msg;

    $command = "LIST\r\n";
    fwrite($sock, $command);
    $all_mails = array();
    $num = 10;
    while (true) {
        if($num--<0){
            break;
        }
        $msg = fgets($sock);
        echo '*',$msg,'*<br/>';
        if (!preg_match('/^\+OK/', $msg) && !preg_match('/^\./', $msg)) {
            $msg = preg_replace('/\ .*\r\n/', '', $msg);
            echo '->',$msg,'<br/>';
            array_push($all_mails, $msg);
        }
        if (preg_match('/^\./', $msg))
            break;
    }

    $ganji_mails = array();
    foreach ($all_mails as $item) {
        fwrite($sock, "TOP $item 0\r\n");
        while (true) {
            $msg = fgets($sock);

            array_push($ganji_mails, $item);
            if (preg_match('/^\./', $msg))
                break;
        }
    }
    $mail_content = '';
    $array_ganji_mails = array();
    foreach ($ganji_mails as $item) {
        fwrite($sock, "RETR $item\r\n");
        while (true) {
            $msg = fgets($sock);
            $mail_content .= $msg;
            if (preg_match('/^\./', $msg)) {
//                array_push($array_ganji_mails, iconv_mime_decode_headers($mail_content, 0, "ISO-8859-1"));
//                array_push($array_ganji_mails, quoted_printable_decode($mail_content));
                array_push($array_ganji_mails, $mail_content);
                echo count($array_ganji_mails).'<br/>';
                $mail_content = '';
                break;
            }
        }
    }
    $command = "QUIT\r\n";
    fwrite($sock, $command);
    $msg = fgets($sock);
    for($i=1;$i<count($array_ganji_mails);$i++){
        file_put_contents($_SERVER['DOCUMENT_ROOT'].'/files/mail'.$i.'.txt', $array_ganji_mails[$i]);
    }
//    file_put_contents($saveFile, json_encode($array_ganji_mails));
    //echo $msg;
    return $return_msg;
}
///////////////////////////////////////////////
$checkmail  = 'javazyf@gmail.com';
$array_all  = array();

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
    "password"  => '123yuekao275',
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

//array_push($array_all, $array_sohu);
array_push($array_all, $array_163);
//array_push($array_all, $array_qq);
//array_push($array_all, $array_21cn);
//array_push($array_all, $array_tom);
//array_push($array_all, $array_sina);
//array_push($array_all, $array_gmail);


foreach($array_all as $item)
{
    echo "===============================================<br/>";
    echo "===============================================<br />";
    echo "===============================================<br />";
    echo "Start get {$item['host']} mail..<br/>";


    echo ganji_get_test_mail($item) . "<br />";

    echo "Get {$item['host']} maili finished..<br />";
    echo "===============================================<br />";
    echo "===============================================<br />";

}