<?php 
// ** وصل شدن به دیتابیس و چک کردن کوکی ** \\
require_once('../config/localFunctions.php');
require_once('../config/config.php');
MustAdmin(2);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>پنل مدیریت</title>
    <link rel="stylesheet" href="admin.css">
    <link rel="stylesheet" href="../CSS/all.css">
</head>
<body>
    <div class="panel">
        <!-- رفتن به صفحه لیست کاربران و ... -->
        <a href="./list.php">
            <i class="fas fa-users"></i>
            لیست کاربران
        </a><br>
        <a href="./addStudent.php">
            <i class="fas fa-user-plus"></i>
            اضافه کردن کاربر
        </a><br>
        <a href="../Questions/Qlist.php">
            <i class="fas fa-comment"></i>
            لیست سوالات
        </a><br>
        <a href="./Flist.php">
            <i class="fas fa-video"></i>
            لیست محتوا ها
        </a><br>
        <a href="./sList.php">
            <i class="fas fa-medal"></i>
            لیست امتیازات
        </a><br>
    </div>
</body>
</html>