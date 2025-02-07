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
    <link rel="stylesheet" href="css/app_vertical.css" />
    <link rel="stylesheet" href="css/loading.css" />
    <link rel="stylesheet" href="css/loading_vertical.css" />
    <!-- <link rel="stylesheet" href="css/loadinganimation1.css" /> -->
</head>

<body>

    <div class="root">
        <div class="black-glass-cover" :style="black_cover_styles">
        </div>
        <div class="top">
            <p class="act-name">
                <?php echo $act_cfg["act_name"]; ?>
            </p>
        </div>

        <div class="center act-info">
            <?php echo $act_cfg["act_info"]; ?>
        </div>

        <div class="center countdown">
            <span class="countdownTitle"></span>
            <br/>
            <span class="countdowntimer"></span>
        </div>




    </div>
    <?php include("show_bottom_included.php") ?>

    <script src="js/settings.js"></script>
    <script src="js/app.js"></script>
    <script>
        function setCountdown() {
            countinterval = setInterval(function () {
                let start_time = new Date("<?php echo $act_cfg["start_time"]; ?>");

                let now = new Date();
                let timeDiff = (start_time - now)
                if (now.getTime() > start_time.getTime()) {
                    document.getElementsByClassName("countdownTitle")[0].textContent = "即将开始"
                    document.getElementsByClassName("countdowntimer")[0].textContent = "00:00:00"
                    clearInterval(countinterval)
                } else {
                    let remainTime = new Date(timeDiff).toISOString().substring(11, 19)
                    console.log(remainTime)
                    document.getElementsByClassName("countdownTitle")[0].textContent = "距离开始还有"
                    document.getElementsByClassName("countdowntimer")[0].textContent = remainTime
                }

            }, 1000)
        }
        setCountdown();

    </script>
</body>

</html>