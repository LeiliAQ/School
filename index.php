<?php
require_once './config/localFunctions.php';
require_once './config/config.php';
list($Config_username ,$Config_id ,$Config_question ,$Config_qkey ,$Config_rank ,$Config_email ,$Config_password ,$Config_score) = IfUserLogined('not');
?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>علامه حلی ملایر</title>
        <link rel="icon" href="./Data/logo2.png">
        <link rel="stylesheet" href="./CSS/style.css" >
        <link rel="stylesheet" href="./CSS/all.css">
    </head> 
    <body dir="rtl">
        <div class="main-container">
            <?php include './config/nav-index.php' ?>
            <div class="lmain">
                <main>
                    <div class="d1">
                        <div class="dEmtiaz">
                            <a href="./Score/">
                                <p class="Emtiaz">امتیازات</p>
                            </a>
                        </div>
                    </div>
                    <div class="d2">
                        <div class="dKetab">
                            <a href="ketab.php">
                                <p class="Ketab">کتاب های درسی</p>
                            </a>
                        </div>
                        <div class="dFilm">
                            <a href="../School/film.php">
                                <p class="Film">محتوا های آموزشی</p>
                            </a>
                        </div>
                        <div class="dOnline">
                            <a href="./Questions/q.php">
                                <p class="Online">پرسش و پاسخ</p>
                            </a>
                        </div>
                        <div class="dEtelaiye">
                            <a href="/Announcement/?link=<?=md5('all')?>">
                                <p class="Etelaiye">اطلاعیه ها</p>
                            </a>
                        </div>
                    </div>
                    <div class="d3">
                        <div class="dEtelaiyeMoalem">
                            <a href="/Library/">
                                <p class="Moalem">کتابخانه</p>
                            </a>
                        </div>
                        <?php
                        if (isset($_SESSION['UserEmail']) && isset($_SESSION['UserPass'])) {
                            if ($Config_rank >= 1) {
                        ?>
                            <div class="dEtelaiyeMoalem">
                                <a href="/Announcement/?link=<?=md5('moalem')?>">
                                    <p class="Moalem">اطلاعیه معلمین</p>
                                </a>
                            </div>
                        <?php 
                            }
                        ?>    
                        <?php if ($Config_rank >= 2) { ?>
                            <div class="dEtelaiyeMoaven">
                            <a href="/Announcement/?link=<?=md5('moaven')?>">
                                    <p class="Moaven">اطلاعیه معاونین</p>
                                </a>
                            </div>
                        <div class="dPanel">
                            <a href="./Manage/admin.php">
                                <p class="Panel">پنل مدیریت</p>
                            </a>
                        </div>
                    </div>
                    <?php 
                    } 
                        }
                    ?>   
                    
                </main>
            </div>    
            <br>
            <br>
            <br>
            <?php require_once './config/footer.php' ?>
        </div>
    </body>
<html>
