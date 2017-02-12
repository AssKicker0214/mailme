<?php
/**
 * Created by PhpStorm.
 * User: Ian
 * Date: 2015/12/14
 * Time: 19:56
 */
?>
<!DOCTYPE html>
<html lang="zh-CN">
<head>
    <meta charset="UTF-8">
    <link href="/lib/bootstrap.min.css" rel="stylesheet">
    <link href="./IndexCSS.css" rel="stylesheet">
    <title></title>
</head>
<body>
<nav id="index-nav" class="navbar navbar-default navbar-fixed-top">
    <div class="container-fluid">
        <!-- Brand and toggle get grouped for better mobile display -->
        <div class="navbar-header">
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="/view/login/LoginPage.php">MailMeV2</a>
        </div>

        <!-- Collect the nav links, forms, and other content for toggling -->
        <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
            <ul class="nav navbar-nav">
                <li class="active"><a href="#">读信 <span class="sr-only">(current)</span></a></li>
                <li><a href="/view/writeMail/ComposePage.php<?php //echo $_SERVER['DOCUMENT_ROOT'].'/view/writeMail/ComposePage.php'?>">写信</a></li>
<!--                <li class="dropdown">-->
<!--                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Dropdown <span class="caret"></span></a>-->
<!--                    <ul class="dropdown-menu">-->
<!--                        <li><a href="#">Action</a></li>-->
<!--                        <li><a href="#">Another action</a></li>-->
<!--                        <li><a href="#">Something else here</a></li>-->
<!--                        <li role="separator" class="divider"></li>-->
<!--                        <li><a href="#">Separated link</a></li>-->
<!--                        <li role="separator" class="divider"></li>-->
<!--                        <li><a href="#">One more separated link</a></li>-->
<!--                    </ul>-->
<!--                </li>-->
            </ul>
<!--            <form class="navbar-form navbar-left" role="search">-->
<!--                <div class="form-group">-->
<!--                    <input type="text" class="form-control" placeholder="Search">-->
<!--                </div>-->
<!--                <button type="submit" class="btn btn-default">Submit</button>-->
<!--            </form>-->
            <ul class="nav navbar-nav navbar-right">
                <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">设置 <span class="caret"></span></a>
                    <ul class="dropdown-menu">
                        <li><a href="#">关联邮箱</a></li>
<!--                        <li><a href="#">Another action</a></li>-->
<!--                        <li><a href="#">Something else here</a></li>-->
<!--                        <li role="separator" class="divider"></li>-->
<!--                        <li><a href="#">Separated link</a></li>-->
                    </ul>
                </li>
                <li>
                    <img src="/wallpaper/usericon/<?php echo $_COOKIE['userid'],'.png';?>" width="40" height="40" class="user-icon">
                </li>
            </ul>
        </div><!-- /.navbar-collapse -->
    </div><!-- /.container-fluid -->
</nav>

<br />
<br />
<br />


<div>

    <?php
    include_once $_SERVER['DOCUMENT_ROOT']."/model/MailManager.php";
    include_once "./MailTile.php";

    $mails = getMail();
    foreach($mails as $mail){
        $direction = $mail['FROMID'];
        if($direction == $_COOKIE['userid']){
            buildRightTile($mail['MID'], $mail['SUBJECT'], $mail['CONTENT'], $mail['SENTDATE'], $mail['SENTDATE']);
        }else{
            buildLeftTile($mail['MID'], $mail['SUBJECT'], $mail['CONTENT'], $mail['SENTDATE'], $mail['BACKGROUND']);
        }
    }


    ?>
</div>

<script src="/lib/jquery-2.1.4.min.js"></script>
<script src="/lib/bootstrap.min.js"></script>
<script type="text/javascript" src="http://rawgit.com/briangonzalez/rgbaster.js/master/rgbaster.js"></script>
<!--<script type="text/javascript" src="http://api.map.baidu.com/api?v=20&ak=Zivdy91pRqUuLB5G8bioZNzS"></script>-->
<script src="/view/index/IndexJS.js"></script>
</body>
</html>

