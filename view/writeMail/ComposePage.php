<?php
/**
 * Created by PhpStorm.
 * User: Ian
 * Date: 2015/12/16
 * Time: 18:41
 */

if(!isset($_COOKIE['userid'])){
    setcookie('userid','lxy',0,'/');
}
$userid = $_COOKIE['userid'];

?>

<!DOCTYPE html>
<html lang="zh-CN">
<head>
    <meta charset="UTF-8">
    <link href="/lib/bootstrap.min.css" rel="stylesheet">
    <link href="./ComposeCSS.css" rel="stylesheet">
    <title></title>
</head>
<body>
<nav id="compose-nav" class="navbar navbar-default navbar-fixed-top">
    <div class="container-fluid">
        <!-- Brand and toggle get grouped for better mobile display -->
        <div class="navbar-header">
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="/view/login/LoginPage.php">MailMe</a>
        </div>

        <!-- Collect the nav links, forms, and other content for toggling -->
        <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
            <ul class="nav navbar-nav">
                <li><a target="_blank" href="/view/index/Index.php">读信</a> <span class="sr-only">(current)</span></li>
                <li class="active"><a href="#">写信</a></li>
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
<div id="map"></div>
<form method="post" action="/controller/SendMail.php" enctype="multipart/form-data">

    <div class="jumbotron" id="jumbotron">
        <div class="row">
            <div class="col-lg-10">
                <h2 id="location"></h2>
                <h4 id="weather"></h4>
            </div>
            <div class="col-lg-2" id="interinfo">
                <div><span class="glyphicon glyphicon-heart"></span>&nbsp;<span id="acquaintance">正在计算...</span> </div>
                <div><span class="glyphicon glyphicon-pushpin"></span>&nbsp;<span id="distance">正在测距...</span> </div>

            </div>
        </div>

        <br />

        <div class="form-group">
            <label for="mail-title"></label>
            <input name="mail-title" id="mail-title" class="form-control" placeholder="主题" value="啦啦啦标题">
        </div>

            <label for="background-img">背景</label>
            <input type="file" id="background-img" placeholder="选择背景图片" name="background-img" >

            <input name="default-img" id="default-img">
    </div>


    <div class="form-group">
        <label for="mail-content"></label>
        <textarea id="mail-content" name="mail-content" class="form-control" placeholder="正文内容..."></textarea>
    </div>

    <hr />
    <button type="submit" class="btn btn-primary" id="send-btn"><span class="glyphicon glyphicon-send"></span>&nbsp; 发送</button>
</form>



<script src="/lib/jquery-2.1.4.min.js"></script>
<script src="/lib/bootstrap.min.js"></script>

<script type="text/javascript" src="http://api.map.baidu.com/api?v=20&ak=Zivdy91pRqUuLB5G8bioZNzS"></script>
<script src="view-source:http://int.dpool.sina.com.cn/iplookup/iplookup.php?format=js"></script>
<!--<script src="http://php.weather.sina.com.cn/xml.php?city=%B1%B1%BE%A9&password=DJOYnieT8234jlsK&day=0"></script>-->
<script src="./ComposeJS.js"></script>
</body>
</html>