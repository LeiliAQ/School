<?php 
require_once 'config.php';
// ** وصل شدن به دیتابیس و چک کردن کوکی ** \\
if (isset($_SESSION['UserEmail']) && isset($_SESSION['UserPass'])) {
    $CEmail = $_SESSION['UserEmail'];
    $CPass = $_SESSION['UserPass'];
    $Text = '';
    $query = mysqli_query($db , "SELECT * FROM users WHERE email = '$CEmail' AND password = '$CPass' ");
    // نمایش پیام خوش آمدید
    if(mysqli_num_rows($query) > 0) {
        if ($row = mysqli_fetch_assoc($query)) {
            $WhatRank = $row["rank"];
            $WhatName = $row["username"];
            switch ($WhatRank) {
                case '1':
                    $Text = "سلام معلم " . $WhatName . " . خوش آمدید";
                    break;
                case '2':
                    $Text = "سلام معاون " . $WhatName . " . خوش آمدید";
                    break;
                case '3':
                    $Text = "سلام مدیر " . $WhatName . " . خوش آمدید";
                    break; 
                case '4':
                    $Text = "سلام ادمین " . $WhatName . " . خوش آمدید";
                    break;            
                default:
                    $Text = "سلام کاربر " . $WhatName . " . خوش آمدید";
                    break;
            }
        }
    }
}
?>
<link rel="stylesheet" href="../School/CSS/nav.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.11.2/css/all.css"/>
<link rel="stylesheet"href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css"/>
<script src="./js/slider.js"></script>
<!-- اسلاید های سایت -->
<nav id="nav">
    <div class="nav-third">
        <i onclick="onFocus()" id="bar-icon" style="font-size: 30px;" class="fas fa-bars"></i>
        <i id="bar-icon-blur" style="font-size: 30px; display:none;" class="fas fa-times" onclick="onBlur()"></i>
    </div>
    <div class="nav-right">
        <a href="../School/index.php" class="aAsli">صفحه اصلی</a>
        <a href="../School/film.php" class="aAsli">محتوا های آموزشی</a>
        <a href="../School/Questions/q.php" class="aAsli">پرسش / پاسخ</a>
    </div>
    <div class="nav-left">
        <?php if (isset($CEmail) && isset($CPass)) {?>
        <span style="display: block;"><?= $Text ?></span>
        <?php } ?>
        <?php if (! isset($CEmail) && ! isset($CPass)) {?>
            <a href="../School/login.php" class="aKetab">
                ورود به حساب
            </a>
        <?php } else { ?>
            <a href="/profile.php" class="aProfile">
                پنل کاربری
            </a>
        <?php } ?>       
    </div>
</nav>
<div id="another-main" class="another-main">
    <a href="../index.php" class="aAsli">صفحه اصلی</a><br>
    <a href="School/film.php" class="aAsli">محتوا های آموزشی</a><br>
    <a href="School/Questions/q.php" class="aAsli">پرسش / پاسخ</a><br>
    <?php if (! isset($CEmail) && ! isset($CPass)) {?>
            <a href="/login.php">
                ورود / ثبت نام
            </a>
        </div><br>
        <?php } else { ?>
        <div style="display: inline-block;">
            <a href="/profile.php">
                پنل کاربری
            </a>
        </div><br>
        <?php } ?>          
</div>
<div class="space"></div>
<div style="margin-bottom: 80px;" class="slider">
    <div class="slides">
        <div id="slide1" class="item active">
            <img src="./Data/school.png" alt="">
        </div>
        <div class="item" id="slide2">
            <img src="./Data/s2.png" alt="">
        </div>
        <div class="item" id="slide3">
            <img src="./Data/s3.jpg" alt="">
        </div>
    </div>
    <div class="buttons">
        <i onclick="setSlide('slide1' , 1)" class="fas fa-circle"></i>
        <i onclick="setSlide('slide2' , 2)" class="fas fa-circle"></i>
        <i onclick="setSlide('slide3' , 3)" class="fas fa-circle"></i>
    </div>
</div>