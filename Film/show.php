<?php
// چک کردن کوکی و وصل شدن به دیتابیس
require_once '../config/localFunctions.php';
require_once '../config/config.php';
// چک کردن اگر سوپرگلوبال 
// "v"
// خالی باشه برگرده صفحه اصلی 
if (empty($_GET['v'])) {
    header("Location: /film.php");
    exit;
}
list($Config_username ,$Config_id ,$Config_question ,$Config_qkey ,$Config_rank ,$Config_email ,$Config_password ,$Config_score) = IfUserLogined('not');
$get = $_GET['v'];
$query = mysqli_query($db , "SELECT * FROM film WHERE `link2` = '$get'");
// چک کردن که اگر همچنین ویدیویی وجود نداشته باشه برگرده صفحه اصلی
if (mysqli_num_rows($query) < 1) {
    header("Location: /film.php");
    exit;
}
if (! $query) {
    echo "ERROR : " . mysqli_error($db);
    exit;
}
if ($info = mysqli_fetch_assoc($query)) {
    // ریختن اطلاعات درون متغیر ها
    $title = $info['title'];
    $link = $info['link'];
    $help = $info['description'];
    $link2 = $info['link2'];
    $id = $info['id'];
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
    <?php include '../config/nav.php' ?>
    <main style="margin-bottom: 320px;">
        <div class="video">
            <div class="VideoCenter">
            <video controls src="<?= $link ?>" title="<?= $title ?>" controlsList="nodownload"></video>
            </div>
            <div class="main-for-mobile">
                <h1><?= $title ?></h1>
                <h4><?= $help ?></h4>
                <div class="info" style="float: left;">
                        <a style="color: #222;" download="<?= $title ?>" href="<?= $link ?>">
                            <p style="font-size: 23px; display:inline;">
                                دانلود
                            </p>
                            <i style="color:rgb(0, 60, 255);" class="fas fa-download"></i>
                        </a>
                        <?php if ($Config_rank >= 1) { ?>
                        <a href="../config/call.php?film=<?=$id?>&func=<?=md5("deletefilm")?>" style="background-color: white; border:none; outline:none; cursor:pointer" title="حذف ویدیو"><i style="color: red; font-size: 26px;" class="material-icons">delete_sweep</i></a>
                        <?php } ?>
                </div>
            </div>
        </div>
        <div class="command">
            <h3>برای مشاهده محتوا های بیشتر روی لینک های زیر کلیک کنید</h3>
            <div class="main">
                <a href="./mohtava.php?m=haft">هفتم</a>
                <a href="./mohtava.php?m=hasht">هشتم</a>
                <a href="./mohtava.php?m=noh">نهم</a>
            </div>
        </div>
    </main><br>
    <?php include '../config/footer.php' ?>
</body>
</html>