<?php
if (!defined("FROM_ADMIN")) {
    die("403");
}


$loadingCfg = require "configs/loading.php";

$targetPath = "";
function updateConfig()
{

    global $targetPath,$loadingCfg;

    $act_name = checkKeyAndGetNoEsc($_POST, "act_name");
    $act_info = checkKeyAndGet($_POST, "act_info");
    $start_time = checkKeyAndGet($_POST, "start_time");
    $targetPath = $loadingCfg["poster_path"];

    if (!preg_match("/^[0-9]{4}-(0[1-9]|1[0-2])-(0[1-9]|[1-2][0-9]|3[0-1]) (2[0-3]|[01][0-9]):[0-5][0-9]:[0-5][0-9]$/", $start_time)) {
        echo ("<h2 class=\"error\">错误：开始时间格式有误。</h2>");
        return;
    }

    if (!saveImg()) {
        return;
    }
    $cfgfiletpl = <<<EOF
    <?php
    return [
        "act_name" => "$act_name",
        "act_info" => "$act_info",
        "start_time" => "$start_time",
        "poster_path" => "$targetPath",
    ];
    EOF;
    file_put_contents("configs/loading.php", $cfgfiletpl);
    echo ("<h2 class=\"success\">OK！</h2>");
}

function saveImg()
{
    global $targetPath;
    if (isset($_FILES["poster_img"]) && $_FILES["poster_img"]["name"] != "") {
        $check = getimagesize($_FILES["poster_img"]["tmp_name"]);
        if (!$check) {
            echo ("<h2 class=\"error\">错误： 文件不是一张图片！</h2>");

            return false;
        } else {
            $finfo = new finfo();
            $fileMimeType = $finfo->file($_FILES["poster_img"]["tmp_name"], FILEINFO_MIME_TYPE);

            // && $fileMimeType != "image/png"
            if (!($fileMimeType == "image/jpeg" || $fileMimeType == "image/png")) {
                echo ("<h2 class=\"error\">错误： 仅接受 jpg/png 图片！</h2>");
                return false;
            }
            $imageFileType = strtolower(pathinfo($_FILES["poster_img"]["name"], PATHINFO_EXTENSION));

            if ($fileMimeType == "image/jpeg") {
                $targetPath = "upload/poster.jpg";

            } else if ($fileMimeType == "image/png") {
                $targetPath = "upload/poster.png";
            }
            // $targetPath = "upload/poster." . $imageFileType;
            move_uploaded_file($_FILES["poster_img"]["tmp_name"], $targetPath);
        }
    }
    return true;
}

if (isset($_GET["target"]) && $_GET["target"] == "loading" && $_POST != NULL) {
    updateConfig();
}
$act_cfg = require "configs/loading.php";

?>
<h2>页面：待机</h2>

<p>Loading 页面地址：
    <a href="/show_loading.php" target="_blank">横屏</a>
    <a href="/show_loading_vertical.php" target="_blank">竖屏</a>

</p>
<form action="/admin.php?target=loading" method="post" enctype="multipart/form-data">
    <table border="1">
        <tr>
            <td class="setting-title">主标题</td>
            <td><input name="act_name" value="<?php checkKeyAndEcho($act_cfg, "act_name"); ?>" /></td>
            <td>一般写活动名称。支持HTML标签。</td>
        </tr>
        <tr>
            <td class="setting-title">副标题</td>
            <td><input name="act_info" value="<?php checkKeyAndEcho($act_cfg, "act_info"); ?>" /></td>
            <td>一般写主办单位</td>
        </tr>
        <tr>
            <td class="setting-title">开始时间</td>
            <td><input name="start_time" value="<?php checkKeyAndEcho($act_cfg, "start_time"); ?>" /></td>
            <td>格式：2023-01-03 18:00:00</td>
        </tr>
        <tr>
            <td class="setting-title">海报图片</td>
            <td> <input type="file" name="poster_img" accept=".jpg, .jpeg, .png" /></td>
            <td>建议比例：16:9；如果此项不设置，则代表不更改海报图片。</td>
        </tr>
        <tr>
            <td><button type="submit">提交</button></td>
        </tr>
    </table>


</form>