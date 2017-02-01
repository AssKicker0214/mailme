<?php
/**
 * Created by PhpStorm.
 * User: Ian
 * Date: 2016/1/29
 * Time: 1:18
 */

$time = $_GET['time'];
$season = $_GET['season'];
$weather = $_GET['weather'];

$backgroundPath = makeUp($season, $time, $weather);

if(is_file($_SERVER['DOCUMENT_ROOT'].$backgroundPath)){
}else{
    $backgroundPath = makeUp('season', $time, $weather);
}
echo 'http://localhost:21314/'.$backgroundPath;

function makeUp($s, $t, $w){
//    return 'http://localhost:21314/wallpaper/defaultbackground/'.$s.'-'.$t.'-'.$w.'.jpg';
    return 'wallpaper/defaultbackground/'.$s.'-'.$t.'-'.$w.'.jpg';
}