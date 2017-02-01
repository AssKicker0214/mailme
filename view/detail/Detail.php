<?php
/**
 * Created by PhpStorm.
 * User: Ian
 * Date: 2016/2/12
 * Time: 0:35
 */
include_once "../../controller/MailFetcher.php";
$mid = $_GET['mid'];
$details = getMailByID($mid);
$content = str_replace("\r",'</p><p>',$details['CONTENT']);
?>


<!DOCTYPE html>
<html lang="zh-CN">
<head>
    <meta charset="UTF-8">
    <link href="/lib/bootstrap.min.css" rel="stylesheet">
    <link href="./DetailCSS.css" rel="stylesheet">
    <title></title>
</head>
<body>

<div class="bottom" style="background-image: url('<?php echo $details['BACKGROUND'] ?>');"></div>

<div class="jumbotron" style="background-image: url('<?php echo $details['BACKGROUND'] ?>');">
    <div class="row">
        <div class="col-lg-10">
            <h2 id="location"></h2>
            <h4 id="weather"></h4>
        </div>
    </div>

    <br />

    <h2 id="subject"><?php echo $details['SUBJECT'];?></h2>
    <br />
    <h4 id="date"><?php echo $details['SENTDATE'];?></h4>
    <br />
    <br />
    <br />
    <h5 id="from">From:&nbsp;<?php echo $details['FROMID'];?></h5>
</div>

<hr />
<div id="content">
    <p><?php echo $content?></p>
</div>

</body>
</html>
