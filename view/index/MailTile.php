<?php
/**
 * Created by PhpStorm.
 * User: Ian
 * Date: 2015/12/20
 * Time: 15:11
 */

function buildLeftTile($mid, $subject, $content, $date, $url)
{
//    $d =
    if($subject == ''){
        $subject = '空的主题';
    }
    echo '
    <div class="left tile row" style="background-image: url(\''.$url.'\')" id="MID'.$mid. '" >
        <div class="col-sm-8">
            <div class="row">
                <a target="_blank" href="/view/detail/Detail.php?mid='.$mid.'"><h2 class="col-sm-8">'.$subject.'</h2></a>
                <div class="col-sm-4">
                </div>
            </div>
            <br />
            <p>'.substr($content, 0, 300).'……</p>
        </div>
        <div class="col-sm-4">
<!---->
<!--            <span class="tile-btn">全文</span>-->
<!--            <div class="tile-btn"><span class="tile-btn-icon glyphicon glyphicon-share"></span> </div>-->
<!--            <button class="btn btn-primary tile-btn">删除</button>-->
            <h2 class="tile-date">'.$date.'</h2>
            <h4 class="tile-day">周几</h4>
        </div>
    </div>
        ';
//    echo '<script>document.getElementById("MID'.$mid.'").style.backgroundImage = </script>';
}

function buildRightTile($mid, $subject, $content, $date, $color){
    if($subject == ''){
        $subject = '空的主题';
    }
    $day = getDay($date);
    echo '
    <div class="right tile row" style="background-color: #286090">
        <div class="col-sm-4">
            <h2 class="tile-date">'.$date.'</h2>
            <h4 class="tile-day">'.$day.'</h4>
        </div>
        <div class="col-sm-8">

            <a target="_blank" href="/view/detail/Detail.php?mid='.$mid.'"><h2>'.$subject.'</h2></a>
            <br />
            <p>'.substr($content, 0, 300).'……</p>
        </div>

    </div>
    ';
}

function getDay($date){
    return date("l", $date);
}