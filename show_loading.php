<?php
$act_cfg = require "configs/loading.php";

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=1920px, initial-scale=1.0">
    <title>待机画面</title>
    <link rel="stylesheet" href="css/app.css" />
    <link rel="stylesheet" href="css/loading.css" />
    <!-- <link rel="stylesheet" href="css/loadinganimation1.css" /> -->
</head>

<body>

    <div>

        <div class="top">
            <!-- <div class="slider">
                <div class="line"></div>
                <div class="break dot1"></div>
                <div class="break dot2"></div>
                <div class="break dot3"></div>
                <div class="break dot4"></div>
                <div class="break dot5"></div>
            </div> -->
            <p class="act-name">
                <?php echo $act_cfg["act_name"]; ?>
            </p>

        </div>
        <div class="poster-container">
            <div class="left">
                <img class="poster" src="<?php echo $act_cfg["poster_path"]; ?>" />
                <div class="act-info">
                    <?php echo $act_cfg["act_info"]; ?>

                </div>
            </div>
            <div class="right">
                <div class="countdown">
                    <span class="countdownTitle"></span>
                    <span class="countdowntimer"></span>
                </div>

            </div>
        </div>



        <div class="social-medias">
            <div class="imgs">
                <div class="social-media-box">
                    <img src="asset/bilibili.svg" style="height: 2rem;" />
                </div>
                <div class="social-media-box">
                    <img src="asset/wechat.svg" style="height: 2rem;" />
                </div>
                <div class="social-media-box social-media-box-douyin">
                    <img src="asset/douyin.svg" style="height: 1.7rem;" />
                </div>
                <div class="social-media-box">
                    <img src="asset/weibo.svg" style="height: 2rem;" />
                </div>
            </div>
            <p>深职大SIC</p>
        </div>
        <?php include("show_bottom_included.php") ?>

    </div>
    <script src="js/settings.js"></script>
    <script src="js/app.js"></script>
    <script>
        function setCountdown() {
            countinterval = setInterval(function () {
                let start_time = new Date("<?php echo $act_cfg["start_time"]; ?>");

                let now = new Date();
                let timeDiff = (start_time- now)
                if (now.getTime() > start_time.getTime()) {
                    document.getElementsByClassName("countdownTitle")[0].textContent = "即将开始"
                    document.getElementsByClassName("countdowntimer")[0].textContent = "00:00:00"
                    clearInterval(countinterval)
                } else {
                    let remainTime = new Date(timeDiff).toISOString().substring(11, 19)
                    document.getElementsByClassName("countdownTitle")[0].textContent = "距离开始还有"
                    document.getElementsByClassName("countdowntimer")[0].textContent = remainTime
                }

            }, 1000)
        }
        setCountdown();

    </script>
</body>

</html>