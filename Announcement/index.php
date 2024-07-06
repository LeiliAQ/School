<?php 
if (empty($_GET['link'])) {
    header("location: /");
}
$link = $_GET['link'];
$allLink = md5('all');
$moalemLink = md5('moalem');
$moavenLink = md5('moaven');
require_once '../config/localFunctions.php';
require_once '../config/config.php';
list($Config_username ,$Config_id ,$Config_question ,$Config_qkey ,$Config_rank ,$Config_email ,$Config_password ,$Config_score) = IfUserLogined('not');
$annQueryAll = mysqli_query($db , "SELECT * FROM ann WHERE annView = '0'");
$annQueryMoalem = mysqli_query($db , "SELECT * FROM ann WHERE annView = '1'");
$annQueryMoaven = mysqli_query($db , "SELECT * FROM ann WHERE annView = '2'");
if ($link == $moalemLink) {
    if ($Config_rank < 1) {
        header("location: index.php?link=$allLink");
    }
} elseif ($link == $moavenLink) {
    if ($Config_rank < 2) {
        header("location: index.php?link=$allLink");
    }
} elseif ($link == $allLink) {
    $link = $allLink;
} else {
    header("location: index.php?link=$allLink");
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="CSS/style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.11.2/css/all.css"/>
    <title>اطلاعیه ها</title>
</head>
<body dir="rtl"> 
    <div class="header">
        <?php if ($Config_rank >= 2) { ?>
        <div class="firstD">
            <a href="./add.php">افزودن اطلاعیه</a>
        </div><br>
        <?php }else { ?>
        <div class="secondD">
            <p>اطلاعیه ها</p>
        </div><br>
        <?php } ?>
        <?php if ($link == $moalemLink) { ?>
            <div class="firstD">
                <p>اطلاعیه معلمین</p>
            </div>
        <?php }elseif ($link == $moavenLink){ ?>
            <div class="firstD">
                <p>اطلاعیه معاونین</p>
            </div>
        <?php } ?>
    </div>
    <main>
        <?php
        if ($link == $allLink) { 
            while($annRows = mysqli_fetch_assoc($annQueryAll)) { ?>
                <a href="./Show/?link=<?= $annRows['annLink'] ?>">
                    <div class="ann">
                        <div>
                            <p><?= $annRows['p'] ?></p>
                            <p><?= $annRows['p1'] ?></p>
                        </div>
                            <img src="<?= $annRows['img'] ?>" alt="Announcement">
                    </div>
                </a>
        <?php
            } 
        }elseif ($link == $moalemLink) { 
            while($annRows = mysqli_fetch_assoc($annQueryMoalem)) { ?>
            <a href="./Show/?link=<?= $annRows['annLink'] ?>">
                    <div class="ann">
                        <div>
                            <p><?= $annRows['p'] ?></p>
                            <p><?= $annRows['p1'] ?></p>
                        </div>
                            <img src="<?= $annRows['img'] ?>" alt="Announcement">
                    </div>
            </a>
        <?php } 
        }elseif ($link == $moavenLink) { 
            while($annRows = mysqli_fetch_assoc($annQueryMoaven)) { ?>
                <a href="./Show/?link=<?= $annRows['annLink'] ?>">
                        <div class="ann">
                            <div>
                                <p><?= $annRows['p'] ?></p>
                                <p><?= $annRows['p1'] ?></p>
                            </div>
                                <img src="<?= $annRows['img'] ?>" alt="Announcement">
                        </div>
                </a>
        <?php }
        }else {
            header("location: ./index.php?link=$allLink");
        } ?>
    </main>
    <div class="home">
        <a href="/"><i class="fas fa-home"></i></a>
    </div>
</body>
</html>