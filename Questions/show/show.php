<?php
// ** وصل شدن به دیتابیس و چک کردن کوکی ** \\
require_once('../../config/localFunctions.php');
require_once('../../config/config.php');
// چک کردن اگر سوپر گلوبال "گت" خالی بود برگرده به صفحه سوالات
if (empty($_GET['q'])) {
    header("Location: /Questions/q.php");
    exit;
}
$UserRank = 0;
if (isset($_SESSION['UserEmail']) && isset($_SESSION['UserPass'])) {
    $CEmail = $_SESSION['UserEmail'];
    $CPass = $_SESSION['UserPass'];
    $queryCheckRank = mysqli_query($db , "SELECT * FROM users WHERE `email` = '$CEmail' AND `password` = '$CPass' ");
    if ($RankID = mysqli_fetch_assoc($queryCheckRank)) {
        // ریختن رنک کاربر درون یک متغیر
        $UserRank = $RankID["rank"];
        $WhatName = $RankID["username"];
        if ($UserRank == 2) {
            $Text = "سلام معاون " . $WhatName . " . خوش آمدید";
        } elseif ($UserRank == 1) {
            $Text = "سلام معلم " . $WhatName . " . خوش آمدید";
        } elseif ($UserRank == 3) {
            $Text = "سلام مدیر " . $WhatName . " . خوش آمدید";
        } elseif ($UserRank == 4) {
            $Text = "سلام ادمین " . $WhatName . " . خوش آمدید";
        } else {
            $Text = "سلام کاربر " . $WhatName . " . خوش آمدید";
        }
    }
}
$get = $_GET['q'];
// چک کردن اگر سوپر گلوبال گت وارد شده بود و درست نبود برگرده صفحه سوالات
$query = mysqli_query($db , "SELECT * FROM `questions` WHERE `title2` = '$get'");
if (mysqli_num_rows($query) < 1) {
    header("Location: /Questions/q.php");
    exit;
}
if (! $query) {
    echo "ERROR : " . mysqli_error($db);
    exit;
}
if ($info = mysqli_fetch_assoc($query)) {
    // ریختن اطلاعات موجود درون متغیر
    $title = $info['title'];
    $desc = $info['desc'];
    $user = $info['user'];
    $status = $info['status'];
    $who = $info['who'];
    $answer = $info['answer'];
}

?>
<!DOCTYPE html>
<html lang="en" dir="rtl">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="show.css">
    <link rel="stylesheet" href="/CSS/all.css">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <link rel="icon" href="/Data/logo.png">
    <title><?= $title ?></title>
</head>
<body>
    <header>
        <nav>
            <div class="nav-right">
                <a class="tag-a-main" href="/">صفحه اصلی</a>
                <a class="tag-a-film" href="/film.php">محتوا های آموزشی</a>
            </div>
            <div class="nav-left"><?= $Text?></div>
        </nav>
    </header>
    <main>
        <div class="video">
            <h1><?= $title ?></h1>
            <span style="float: left; font-size :18px; color: rgb(0, 108, 161); font-weight:bold;">
            ایجاد شده توسط :
            <?= $user ?>
            </span><br>
            <hr>
            <h4 style="font-size: 20px;">
            سوال :
            <?= $desc ?>
            </h4><br>
            <?php if (!empty($answer) && !empty($who)) {?>
            <div>
                <span style="font-size: 20px; font-weight:bold; color:rgb(0, 108, 161)">پاسخ :</span><br>
                <span style="font-size: 20px; font-weight:bold;">
                    <?php echo $answer . "<br>"?>
                </span>
                <span style="font-size: 20px; font-weight:bold; color:rgb(0, 108, 161); float:left;">
                پاسخ توسط : <?= $who?>
                </span>
            </div>
            <?php } ?>
        </div>
        <div class="command">
            <h3>برای مشاهده صفحه های دیگر روی لینک های زیر کلیک کنید</h3><br><br><br>
            <div class="main">
                <a style="font-weight: bold;" href="/">صفحه اصلی</a>
                <a style="font-weight: bold;" href="/Questions/q.php">پرسش و پاسخ</a>
                <a style="font-weight: bold;" href="/film.php">محتوا های آموزشی</a>
            </div>
        </div>
    </main>
</body>
</html>