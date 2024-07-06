<?php 
require_once('./config/localFunctions.php');
require_once('./config/config.php');
list($Config_username ,$Config_id ,$Config_question ,$Config_qkey ,$Config_rank ,$Config_email ,$Config_password ,$Config_score) = IfUserLogined('not');


?>
<!DOCTYPE html>
<html lang="fa" dir="rtl">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>علامه حلی ملایر</title>
    <link rel="stylesheet" href="CSS/film.css">
    <link rel="icon" href="Data/logo.png">
</head>
<body>
    <main>
        <p>
            لطفا کلاس خود را انتخاب کنید و روی گزینه مورد نظر کلیک کنید .
        </p>
        <div class="shayad">
            <a href="./Film/mohtava.php?m=haft" class="haft">هفتم</a>
            <br><br>
            <a href="./Film/mohtava.php?m=hasht" class="hasht">هشتم</a>
            <br><br>
            <a href="./Film/mohtava.php?m=noh" class="noh">نهم</a>
            <br><br>
            <?php if ($Config_rank >= 1) { ?>
            <a class="add" href="./Film/add.php">اضافه کردن محتوا</a>
            <?php } ?>
        </div>
    </main>
</body>
</html>