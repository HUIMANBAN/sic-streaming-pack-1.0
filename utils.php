<?php
if (!defined("FROM_ADMIN")) {
    die("403");
}

function checkKeyAndEcho($arr, string $key)
{
    if (isset($arr[$key])) {
        echo ($arr[$key]);
    } else {
        echo ("");
    }
}

function checkKeyAndGet($arr, string $key)
{
    if (isset($arr[$key])) {
        return htmlspecialchars($arr[$key]);
    } else {
        return "";
    }
}

function checkKeyAndGetNoEsc($arr, string $key)
{
    if (isset($arr[$key])) {
        return ($arr[$key]);
    } else {
        return "";
    }
}