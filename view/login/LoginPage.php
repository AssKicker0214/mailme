<?php
/**
 * Created by PhpStorm.
 * User: Ian
 * Date: 2015/12/13
 * Time: 16:15
 */
?>
<!--lalala-->
<!DOCTYPE html>
<html lang="zh-CN">
<head>
    <meta charset="UTF-8">
    <link href="../../lib/bootstrap.min.css" rel="stylesheet">
    <link href="./LoginCSS.css" rel="stylesheet">
    <title>登录</title>
</head>
<body>
<div class="background" id="bkgd">

</div>
test
<div id="on-login-container">
    <img src="/wallpaper/test.jpg" width="150" height="150">
    <br />
</div>
<form id="login-form">
    <input type="text" placeholder="用户名" id="userid" class="form-control ghost-control">
    <input type="password" placeholder="密码" id="psw" class="form-control ghost-control">
<!--    <input type="hidden" id="city"> -->
    <div id="btns">
        <a id="login-btn" role="button" class="btn btn-success" onclick="checkLogin()">登录</a>
        <a id="register-btn" href="#" class="btn btn-default">注册</a>
    </div>
</form>

<script src="/lib/jquery-2.1.4.min.js"></script>
<script src="view-source:http://int.dpool.sina.com.cn/iplookup/iplookup.php?format=js"></script>
<script src="/view/tool/LocationJS.js"></script>
<script src="./LoginJS.js"></script>
</body>
</html>
