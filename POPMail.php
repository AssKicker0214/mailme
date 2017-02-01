<?php
/**
 * Created by PhpStorm.
 * User: Ian
 * Date: 2015/12/18
 * Time: 0:39
 */
include_once "POPServer.php";

function popAllMail($cntAttris){
    $host = $cntAttris['host'];
    $port = $cntAttris['port'];
    $user = $cntAttris['user'];
    $password = $cntAttris['password'];
    $checkmail = $cntAttris['checkmail'];
    $saveFile = $cntAttris['saveFile'];

    $socket = null;
    if (!($socket = fsockopen(gethostbyname($host), $port, $errno, $errstr))){
        exit($errno . ': ' . $errstr);
    }
    set_socket_blocking($socket, true);
    
    //1. check
    $command = "USER " . $user . "\r\n";
    fwrite($socket, $command);
    $msg = fgets($socket);
    echo 'USER: ',$msg, '<br />';
    $command = "PASS " . $password . "\r\n";
    fwrite($socket, $command);
    $msg = fgets($socket);
    echo 'PSWD: ',$msg,'<br />';
    

    $command = "stat \r\n";
    fwrite($socket, $command);
    $msg = fgets($socket);
    echo $msg;

//    $command = "list \r\n";
//    fwrite($socket, $command);
//    $all_mails = array();
//    while (true) {
//        $msg = fgets($socket);
//        echo '*',$msg,'*<br/>';
//        if (!preg_match('/^\+OK/', $msg) && !preg_match('/^\./', $msg)) {
//            $msg = preg_replace('/\ .*\r\n/', '', $msg);
//            array_push($all_mails, $msg);
//        }
//        if (preg_match('/^\./', $msg))
//            break;
//    }

//    getSpecific(null, $socket);

    $index = 200;
    $allContents = array();

    for($index=199;$index<210;$index++){
        $mailContent='';
        $command = "RETR ".$index."\r\n";

        fwrite($socket, $command);
        $content = getContent($socket,'lxy1313kdzj@163.com');
        echo '<br/>----------------gotContent()--------------<br/>',$index,'<br/>';
        echo $content,'<br/>---------------------<br/>';
        $allContents[] = $content;
    }



    $command = "QUIT\r\n";
    fwrite($socket, $command);
    $msg = fgets($socket);
    echo $msg;

    writeFile($allContents, $saveFile);
}

function getContent($socket, $targetSender){
    $rawContent = '';
    $caughtEncoding = false;
    $charset = null;
    $caughtSender = false;
    while(true){
        $line = fgets($socket);
        if(preg_match('/^\./', $line)){
            break;
        }

        //发件人
        if(preg_match('/From:\s[\w\?\s=]*</', $line)){
            $sender = explode('>', explode('<', $line)[1])[0];
            $caughtSender = true;
            echo '<br/>', $line,'@@@@@',explode('>', explode('<', $line)[1])[0],'<br/>';
            if($sender != $targetSender){
                fwrite($socket, 'RSET\r\n');
                echo '<br>the sender is ',$sender,' move to next', fgets($socket),'<br/>';
                return '';
            }
        }else{
            echo '<br/>(',$line,')<br/>';
        }

        $rawContent .= $line;
//        echo '#',$line,'%';
        $codeTypes = getCodingType($line);
        $encoding = $codeTypes['encoding'];
        if($codeTypes['charset']!=null && $codeTypes['charset']!=''){
            $charset = $codeTypes['charset'];
//            echo '$$get charset = ',$charset;
        }
        if(encodingValid($encoding)){//接下来的是正文内容，需要解码
            $caugtEncoding = true;
            echo '<br/>正文开始,encoding='.$encoding;
            $decodedContent = decode($rawContent, $encoding);
            while(true){
                $rawLine = fgets($socket);
                $codeTypes = getCodingType($rawLine);

                $rawContent .= $rawLine;
//                echo  $rawLine;
                if(preg_match('/^\./', $rawLine)){//读取结束
                    echo '<br/>内容读取结束';
                    if($caughtSender){
                        return $decodedContent;
                    }else{
                        echo ',未发现发件人<br/>';
                        return '';
                    }
                }else if(encodingValid($codeTypes['encoding'])){//编码转换
                    echo '<br/><br/>编码转换,encoding=',$encoding;
//                    while(preg_match('/^\./', fgets($socket))){
//
//                    }
//                    if($caughtSender){
//                        return $decodedContent; //针对163的特殊优化
//                    }else{
//                        return '';
//                    }
                    $encoding = getCodingType($rawLine)['encoding'];
                    continue;
                }else if($codeTypes['charset'] !== null){
//                    $charset = $codeTypes['charset'];

                }
//                $decodedContent .=  decode($rawLine, $encoding);
//                echo '<br/>**|||',$charset,'|||<br/><br/>';
                $decodedContent .= toUTF8($charset, decode($rawLine, $encoding));
            }
        }
    }

    //如果没有指明encoding
    if(!$caughtEncoding){
        echo '<br/><br/>_______________no encoding___________<br/>';
//        echo decode($rawContent, 'base64');
        return  decode($rawContent, 'base64');
    }
}

function encodingValid($encoding){
    if($encoding == null){
        return false;
    }

    $encodingArray = array('base64','Quoted-Printable','quoted-printable','8bit');
    foreach($encodingArray as $e){
//        echo '<br/>',$encoding,'<br/>';
        if(strpos($encoding, $e) !== false){
//            echo 'valid!!!<br/>';
            return true;
        }
    }
    return false;
}

function decode($str, $encoding){
//    echo '<br/>',$encoding,'decoding: ',$str,'<br/>';
    $result = $str;
    if(strpos($encoding,'base64') !== false){
//        echo '***base64 encoding';
        $result = base64_decode($str);
//        echo $result,'<br/>';
    }else if($encoding == '8bit'){

    }else if($encoding == null){
        $result = '';
//        echo '***null encoding';
    }else if(strpos($encoding, 'Quoted-Printable') !==false || strpos($encoding, 'quoted-printable')){
        $result = quoted_printable_decode($str);
    }else{
        echo '错误的编码';
    }

//    echo 'result:',$result,'<br/>';
    return $result;
}

function toUTF8($charset, $content){
    if($charset == 'GBK' || $charset == 'gbk' || $charset=='GB2312'){
//        return $content;
        return iconv('GBK', 'UTF-8//IGNORE', $content);
//        Linux下编译要加参数
//        return mb_convert_encoding($content, 'UTF-8', 'GB2312');
    }else if($charset == 'UTF-8' || $charset == 'utf-8'){
        return $content;
    }else{
        echo '<br/><br/>no charset',$charset,'<br/><br/>';
        return $content;
    }


}


function getCodingType($line){
//    echo $line;
    $charset = null;
    if(preg_match('/\bcharset=[\w-\"]*\b/', $line, $charsets)){
        $charset = $charsets[0];
        $charset = substr($charset, 8);
//        echo '<br/>****',$charset,'<br/>';
    }else if(preg_match('/\?GBK\?/', $line)){
        $charset = 'GBK';
    }
//    echo '***charset=',$charset,'<br/><br/>';

    $encoding = null;
    if(preg_match('/Content-Transfer-Encoding:\s[-\w]*/', $line, $encodes)){
//        print_r($encodes/**/);
        $encoding = $encodes[0];
//        $encoding = substr($encoding, 26);
    }else{
//        echo '<br/>no specified encoding<br/>',$line,'<br/>';
    }
    return array("charset"=>$charset, "encoding"=>$encoding);
}

function writeFile($contentArray, $filePath){
    $allContent = '';
    $count = 0;
    foreach($contentArray as $content){
        if($content === ''){
            ++$count;
            continue;
        }
        echo '写入',$count,'<br/>';
        $allContent .= $content;
    }

    file_put_contents($filePath, $allContent);
}

function getSpecific($address, $socket){
    for($i=1;$i<2;$i++){
        $command = 'TOP '.$i.' 10\r\n';
        fwrite($socket,$command);
        $isNeed = false;
        while (true) {
            $msg = fgets($socket);
            if(preg_match('/From:\s[\?\w]\s<', $msg)){
                echo '<br/>',$msg;
            };

            if (preg_match('/^\./', $msg))
                break;

        }

    }
}


//popAllMail($array_163);
//$str = ' 鍖椾含 鏅� 鏅� qing qing 鍖楅 鏃犳寔缁鍚� 3-4 鈮�3 2 -7 2 2 2 2 7 3 1 6 鏆傛棤 鏆傛棤 鏆傛棤 妫夎。銆佸啲澶ц。銆佺毊澶瑰厠銆佸唴鐫€琛～鎴栫緤姣涘唴琛ｃ€佹瘺琛ｃ€佸缃╁ぇ琛� 杞诲害 寮� 杈冨喎 鏆傛棤 鏆傛棤 钖勫啲琛� 寤鸿寮€鍚�(鍒剁儹) 闈炲父閫傚疁 鏆傛棤 瀵圭┖姘旀薄鏌撶墿鎵╂暎鏃犳槑鏄惧奖鍝� 绱绾垮急 澶栧嚭娲诲姩瑕佹埓钖勬墜濂楋紝钖勫洿宸惧拰甯藉瓙銆� 寤鸿寮€鍚┖璋� 娲楄溅鍚庤嚦灏戞湭鏉�4澶╁唴娌℃湁闄嶆按銆佸ぇ椋庛€佹矙灏樺ぉ姘旓紝淇濇磥鏃堕棿闀匡紝闈炲父閫傚疁娲楄溅銆傛敞鎰忔礂杞﹀綋鏃ユ皵娓╀笉鑳藉お浣庝互鍏嶇粨鍐般€� 2 澶氬彂鏈� 澶╂皵杈冨喎锛屽鍐呭娓╁樊杈冨ぇ锛岃緝鏄撳紩璧锋劅鍐掞紱 5 涓嶉€傚疁 澶╂皵杈冨喎锛屽鏁颁汉涓嶉€傚疁鎴峰杩愬姩锛� 2016-01-07 2016-01-07 2016-01-07 2016-01-07 08:10:00 ';
//$str = base64_decode($str);
//echo $str;
//echo quoted_printable_decode($str);
//getCodingType('Content-Transfer-Encoding: base64 ');
//echo iconv("GB2312","UTF-8//IGNORE", $str);
//getContent($str);

//getCodingType('Content-Transfer-Encoding: base64');
//echo preg_match('/\bFrom:\s/', 'From: =?GBK?B?wO7QptHg?= <lxy1313kdzj@163.com>');