<?php
    // وصل شدن به دیتابیس و چک کردن کوکی
require_once('../config/localFunctions.php');
require_once '../config/config.php';
if (empty($_GET['m'])) {
    header("Location: /film.php");
    exit();
}
$mClass = $_GET['m'];
if ($mClass != 'haft' && $mClass != 'hasht' && $mClass != 'noh') {
    header("Location: /film.php");
    exit();
}
$is_search = '';
$searchText = null;
// تابع یا فانکشن نمایش ویدیو
function ShowVideo($video) {
    global $db , $mClass , $searchText;
    if (isset($_POST['search'])) {
        $searchText = trim($_POST['search']);
    }
    $SQL = "SELECT * FROM film WHERE class = '$mClass'";
    $SQL_search = "SELECT * FROM film WHERE class = '$mClass' AND title LIKE '%$searchText%'";
    if (is_null($searchText)) {
        $query = mysqli_query($db , $SQL);
    } else {
        $query = mysqli_query($db , $SQL_search);
    }
    if (! $query) {
        echo "ERROR : " . mysqli_error($db);
        exit;
    }
    while ($film = mysqli_fetch_assoc($query)) {
        $id = $film['id'];
        $link = $film['link'];
        $link2 = $film['link2'];
        $title = $film['title'];
        $help = $film['description'];
        $dars = $film['dars'];
        if ($dars == $video) {?>
        <div class="divvideo">
            <h3 style="display: inline-block;"><?= $title ?></h3>
            <a href="./show.php?v=<?=$link2?>"><video src="<?= $link ?>" controlsList="nodownload"></video></a>
        </div>
        <?php 
        } 
    }
}
// Function Mohtava ..
// چک کردن که اگر محتوا آموزشی وجود نداشت ارور نشون بده
function NotFound($find) {
    global $db , $searchText , $mClass;
    if (isset($_POST['search'])) {
        $searchText = trim($_POST['search']);
    }
    $foundQ = mysqli_query($db, "SELECT * FROM film WHERE `class` = '$mClass' AND `dars` = '$find'");
    $foundQ_search = mysqli_query($db , "SELECT * FROM film WHERE `class` = '$mClass' AND `dars` = '$find' AND `title` LIKE '%$searchText%'");
    if (! $foundQ) {
        echo "ERROR : " . mysqli_error($db);
        exit;
    }
    if (is_null($searchText)) {
        if (mysqli_num_rows($foundQ) == 0) { ?>
            <span style="color: red; font-size: 23px;">محتوایی پیدا نشد !</span>
        <?php }
    } else {
        if (mysqli_num_rows($foundQ_search) == 0) { ?>
            <span style="color: red; font-size: 23px;">محتوایی پیدا نشد !</span>
        <?php }
    }
}
?>

<!DOCTYPE html>
<html lang="fa" dir="rtl">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>علامه حلی ملایر</title>
    <link rel="icon" href="../Data/video.png">
    <link rel="stylesheet" href="./style.css" >
    <link rel="stylesheet"href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css"/>
    <link rel="stylesheet" href="./../CSS/all.css">
</head>
<body>
    <div class="main-container">
        <?php include '../config/nav.php' ?>
    </div>
    <br><br><center><div id="searchDIV">
        <form action="./mohtava.php?m=<?=$mClass?>" method="post">
            <button id="searchBTN"><i id="searchBTNI" class="fas fa-search"></i></button>
            <input type="search" name="search" id="searchTXT" placeholder="عنوان محتوا مورد نظر وارد کنید ..">
        </form>
    </center></div>
    <main style="margin-bottom: 300px;">
        <div class="table">
            <table>
                <tr>
                    <th>لیست درس ها</th>
                </tr>
                <tr>
                    <td><a href="#riazi">ریاضی</a></td>
                </tr>
                <tr>
                    <td><a href="#olom">علوم</a></td>
                </tr>
                <tr>
                    <td><a href="#farsi">فارسی</a></td>
                </tr>
                <tr>
                    <td><a href="#negaresh">نگارش</a></td>
                </tr>
                <tr>
                    <td><a href="#motaleat">مطالعات اجتماعی</a></td>
                </tr>
                <tr>
                    <td><a href="#hedie">هدیه های آسمانی</a></td>
                </tr>
                <tr>
                    <td><a href="#zaban">زبان</a></td>
                </tr>
                <tr>
                    <td><a href="#qoran">قرآن</a></td>
                </tr>
                <tr>
                    <td><a href="#arabi">عربی</a></td>
                </tr>
                <tr>
                    <td><a href="#rayane">رایانه</a></td>
                </tr>
            </table>
        </div>
        <div class="main-for-mobile">
        <center>
            <p class="pclick">برای مشاهده محتوا مورد نظر روی نام محتوا کلیک کنید !</p>
        </center>
        <!-- Videos -->
        <div class="driz">
            <h2 id="riazi">ریاضی</h2>
            <div class="driazi">
                <?php ShowVideo('riazi'); ?>
                <?php NotFound('riazi') ?>
            </div>
        </div>
        <div class="dolm">
            <h2 id="olom">علوم</h2>
            <div class="dolom">
                <?php ShowVideo('olom'); ?>
                <?php NotFound('olom') ?>
            </div>
        </div>
        <div class="dfrs">
            <h2 id="farsi">فارسی</h2>
            <div class="dfarsi">
                <?php ShowVideo('farsi'); ?>
                <?php NotFound('farsi') ?>
            </div>
        </div>
        <div class="dngr">
            <h2 id="negaresh">نگارش</h2>
            <div class="dnegaresh">
                <?php ShowVideo('negaresh'); ?>
                <?php NotFound('negaresh'); ?>
            </div>
        </div>
        <div class="dmtl">
            <h2 id="motaleat">مطالعات اجتماعی</h2>
            <div class="dmotaleat">
                <?php ShowVideo('motaleat'); ?> 
                <?php NotFound('motaleat') ?>
            </div>
        </div>
        <div class="dhd">
            <h2 id="hedie">هدیه های آسمانی</h2>
            <div class="dhedie">
                <?php ShowVideo('hedie'); ?>
                <?php NotFound('hedie') ?>
            </div>
        </div>
        <div class="dzbn">
            <h2 id="zaban">زبان</h2>
            <div class="dzaban">
                <?php ShowVideo('zaban'); ?>
                <?php NotFound('zaban') ?>
            </div>
        </div>
        <div class="dqrn">
            <h2 id="qoran">قرآن</h2>
            <div class="dqoran">
                <?php ShowVideo('qoran'); ?>
                <?php NotFound('qoran') ?>
            </div>
        </div>
        <div class="darb">
            <h2 id="arabi">عربی</h2>
            <div class="darabi">
                <?php ShowVideo('arabi'); ?>    
                <?php NotFound('arabi') ?>
            </div>
        </div>
        <div class="dryn">
            <h2 id="rayane">رایانه</h2>
            <div class="drayane">
                <?php ShowVideo('rayane'); ?> 
                <?php NotFound('rayane') ?>
            </div>
        </div>
        </div>
    </main><br>
        <?php require_once '../config/footer.php' ?>
</body>
</html>