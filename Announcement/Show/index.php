<?php 
require_once '../../config/localFunctions.php';
require_once '../../config/config.php';
if (empty($_GET['link'])) {
    header("location: /");
}
list($Config_username ,$Config_id ,$Config_question ,$Config_qkey ,$Config_rank ,$Config_email ,$Config_password ,$Config_score) = IfUserLogined('not');
$link = $_GET['link'];
$showQuery = mysqli_query($db , "SELECT * FROM ann WHERE `annLink` = '$link'");
if (mysqli_num_rows($showQuery) != 1) {
    header("location: /");
}
if ($showRows = (mysqli_fetch_assoc($showQuery))) {
    $annTitle = $showRows['p'];
    $annText = $showRows['p2'];
    $annImage = $showRows['img'];
    $annCreator = $showRows['username'];
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <title><?= $annTitle ?></title>
</head>
<body>
    <div class="main">
        <h2><?= $annTitle ?></h2>
        <div class="content">
            <img src="<?= "../" . $annImage ?>" alt="">
            <div style="padding: 5px;">
                <p><?= $annText ?></p>
                <p>نوشته شده توسط : <?= $annCreator ?></p>
                <?php if ($Config_rank >= 2) { ?>
                    <a href="../../config/call.php?link=<?=$link?>&func=<?=md5("deleteann")?>">حذف این اطلاعیه</a><br>
                <?php } ?>
                <a href="../">بازگشت به صفحه اصلی</a>
            </div>
        </div>
    </div>
</body>
</html>