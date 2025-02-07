<?php
if (!defined("FROM_ADMIN")) {
    die("403");
}

function updateConfig()
{
    $title = checkKeyAndGet($_POST, "title");
    $description = checkKeyAndGetNoEsc($_POST, "description");
    $cfgfiletpl = <<<EOF
    <?php
    return [
        "title" => "$title",
        "description" => "$description",
    ];
    EOF;
    file_put_contents("configs/pause.php", $cfgfiletpl);
    echo ("<h2 class=\"success\">OK！</h2>");
}

if (isset($_GET["target"]) && $_GET["target"] == "pause" && $_POST != NULL) {
    updateConfig();
}
$pause_cfg = require "configs/pause.php";

?>
<h2>页面：暂停/中场休息</h2>

<p>Pause 页面地址：
<a href="/show_pause.php" target="_blank">横屏</a>
<a href="/show_pause_vertical.php" target="_blank">竖屏</a>


</p>
<form action="/admin.php?target=pause" method="post" enctype="multipart/form-data">
    <table border="1">
        <tr>
            <td class="setting-title">标题</td>
            <td><input name="title" value="<?php checkKeyAndEcho($pause_cfg, "title"); ?>" /></td>
            <td>如：活动暂停、中场休息中...</td>
        </tr>
        <tr>
            <td class="setting-title">描述</td>
            <td><textarea name="description" cols="50"
                    rows="10"><?php checkKeyAndEcho($pause_cfg, "description"); ?></textarea></td>
            <td>如：请稍待、18:45继续比赛、19:00继续比赛&lt;br/&gt;A学院 VS B学院...<br /> 支持 HTML 标签</td>
        </tr>
        <tr>
            <td><button type="submit">提交</button></td>
        </tr>
    </table>


</form>