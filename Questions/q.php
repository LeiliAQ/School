<?php 
// ** وصل شدن به دیتابیس و چک کردن کوکی ** \\
require_once('../config/localFunctions.php');
require_once('../config/config.php');
$is_exist = false;
if (! isset($_SESSION['UserEmail']) && ! isset($_SESSION['UserPass'])) {
    $isLogin = false;
} else {
    $isLogin = true;
    $email = $_SESSION['UserEmail'];
    $pass = $_SESSION['UserPass'];
    $queryRank = mysqli_query($db , "SELECT * FROM users WHERE `email` = '$email' AND `password` = '$pass' ");
    if(mysqli_num_rows($queryRank) > 0) {
        if ($row = mysqli_fetch_assoc($queryRank)) {
            $WhatRank = $row["rank"];
            $WhatName = $row["username"];
        }
    }
}
// گرفتن تمامی اطلاعات از بانک اطلاعاتی
$queryQ = mysqli_query($db , "SELECT * FROM `questions`");
if (mysqli_num_rows($queryQ) == 0) {
    $is_exist = false;
} else {
    $is_exist = true;
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="../CSS/all.css">
    <link rel="icon" href="../Data/question.png">

    <link rel="stylesheet" href="../CSS/nav.css">

    <title>پرسش و پاسخ</title>
</head>
<body dir="rtl">
    <?php include '../config/nav.php' ?><br><br>
    <!-- Check Login -->
    <?php if ($isLogin == false) {?>
        <div class="nlogin">
            <span style="color: rgb(0, 108, 161); font-size:20px">برای ایجاد یک پرسش ابتدا وارد حساب خود شوید</span><br><br>
            <a class="LoginLi" href="../login.php">برای ورود به حساب کلیک کنید</a>
        </div>
    <?php } else {?>
        <div class="na">
            <a class="add" href="add.php">ایجاد سوال</a>
        </div>
    <?php if($WhatRank >= 1) { ?>
        <div class="Qlist">
            <a class="QlistA" href="Qlist.php">لیست پرسش ها</a>
        </div>
    <?php }?>
    <?php }?>
    <main style="margin-bottom: 400px;">
        <h1>سوالات</h1>
        <?php if($is_exist == false) { ?>
            <p style="font-weight: bold; color:red; font-size:20px;">سوالی موجود نیست !</p>
        <?php } ?>
        <?php while ($ques = mysqli_fetch_assoc($queryQ)) {
            // نمایش سوال اگر وضعیت اش فعال بود
            if ($ques['status'] == 'true') {?>
            <a href="./show/show.php?q=<?= $ques['title2']?>">
            <div class="questions">
                <span class="title"><?= $ques['title']?></span><br>
                <hr>
                <span class="desc"><?= $ques['desc']?></span>
            </div>
            </a><br>
        <?php }
        }?>
    </main><br>
        <?php require_once '../config/footer.php' ?>
</body>
</html>