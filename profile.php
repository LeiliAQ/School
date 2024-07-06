<?php 
// ** وصل شدن به دیتابیس و چک کردن کوکی ** \\
require_once './config/localFunctions.php';
require_once './config/config.php';
list($Config_username ,$Config_id ,$Config_question ,$Config_qkey ,$Config_rank ,$Config_email ,$Config_password ,$Config_score) = IfUserLogined('must');

switch ($Config_rank) {
    case 1:
        $UserKeyRank = 'معلم';
        break;
    case 2:
        $UserKeyRank = 'معاون';
        break;
    case 3:
        $UserKeyRank = 'مدیر';
        break;
    case 4:
        $UserKeyRank = 'ادمین';
        break;
    default:
        $UserKeyRank = 'کاربر';
        break;
}

?>
<!DOCTYPE html>
<html lang="en" dir="rtl">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>پنل کاربری</title>
    <link rel="stylesheet" href="./CSS/profile.css">
<link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.11.2/css/all.css"/>
</head>
<body>
    <script>
        function showPass() {
            document.getElementById('showUserPass').type = 'text';
        }
    </script>
    <header>
        <nav>
            <div class="nav-right">
                <p><?= $Config_username ?></p>
                <p style="font-size:16px; color : #006ca1;"><?= $UserKeyRank ?></p>
            </div>
            <div class="nav-left">
                <a class="home-btn" href="/"><i class="fas fa-home"></i></a>
                <a class="log-out" href="./config/call.php?func=<?=md5("logout")?>">
                    <i class="fas fa-sign-out-alt"></i>
                    خروج از حساب
                </a>
            </div>
        </nav>
    </header>
    <main>
        <div class="info">
            <label >نام کاربری شما :</label><br>
            <input disabled type="text" name="USERPROFILE" value="
    <?= trim($Config_username) ?>
            "><br><br>
            <label>کد ملی شما :</label><br>
            <input disabled type="text" name="EmailProflie" value="
    <?= trim($_SESSION['UserEmail']); ?>
            " ><br><br>
            <label >پسورد شما :</label><br>
            <input id="showUserPass" disabled type="password" name="Password" value="<?=$_SESSION['UserPass']?>"><a style="color:#006ca1 ; text-decoration:none;font-size:1.3em;cursor: pointer;padding-top:2px;margin:5px;" onclick="showPass()"><i class="fas fa-eye-slash"></i></a><br><br>
            <?php if ($Config_question != null && $Config_qkey != null) { ?>
            <label >سوال امنیتی شما :</label><br>
            <input disabled type="text" name="USERPROFILE" value="
    <?= trim($Config_question) ?>
            "><br><br>
            <label >پاسخ شما :</label><br>
            <input disabled type="text" name="USERPROFILE" value="
    <?= trim($Config_qkey) ?>
            "><br><br>
            <div class="tags">
                <?php } ?>
                <?php if ($Config_question == null || $Config_qkey == null) { ?>
                    <a href="/security/?user=<?= $Config_id ?>" class="security-question">
                        فعال سازی سوال امنیتی
                        <i style="font-size: 15px;" class="fas fa-question-circle"></i>
                    </a>
                <?php } ?>
            </div>
        </div>
    </main>
</body>
</html>