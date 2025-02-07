<?php
define("FROM_ADMIN", true);
$cfg = require "config.php";

if (!isset($_SERVER['PHP_AUTH_USER'])) {
    header('WWW-Authenticate: Basic realm="SIC Authorized Zone."');
    header('HTTP/1.0 401 Unauthorized');
    exit;
} else {
    if ($cfg["username"] == $_SERVER['PHP_AUTH_USER'] && $cfg["password"] == $_SERVER['PHP_AUTH_PW']) {

    } else {
        header('WWW-Authenticate: Basic realm="SIC Authorized Zone."');
        header('HTTP/1.0 401 Unauthorized');
        exit;
    }
}

require("utils.php");
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>管理员页面</title>
    <link rel="stylesheet" href="css/admin.css" />

</head>

<body>
    <a href="/admin.php">首页</a>
    <a href="/admin.php?target=loading">设置：待机页面</a>
    <a href="/admin.php?target=pause">设置：暂停页面</a>
    <a href="/admin.php?target=end">设置：结束页面</a>
    <a href="/admin.php?target=watermark">设置：右下角水印</a>

    <br />
    <?php

    $target = isset($_GET["target"]) ? $_GET["target"] : "";
    switch ($target) {
        case "loading":
            require "admin_loading.php";
            break;
        case "pause":
            require "admin_pause.php";
            break;
        case "end":
            require "admin_end.php";
            break;
        case "watermark":
            require "admin_watermark.php";
            break;
        default:
            echo ("<h1>请选择模块。</h1><br/>");
            echo("<h2>SIC 第二十三届 （2022~2023）</h2>");
            echo("<h3>程序作者：黄浩泓 <br/>美术指导：刘梦云、 马世龙</h3>");
    }

    ?>
</body>

</html>