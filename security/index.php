<?php 
require_once '../config/config.php';
require_once '../config/localFunctions.php';

if (empty($_GET['user'])) {
    header("location: /");
}else {
    $id = $_GET['user'];
}

if (isset($_SESSION['UserEmail']) && isset($_SESSION['UserPass'])) {
    $CEmail = $_SESSION['UserEmail'];
    $CPass = $_SESSION['UserPass'];
    $query = mysqli_query($db , "SELECT * FROM `users` WHERE `id` = '$id'");
    if (mysqli_num_rows($query) > 0) {
        if ($usinf = mysqli_fetch_assoc($query)) {
            $name = $usinf['username'];
            $pass = $usinf['password'];
            $email = $usinf['email'];
            $Qk = $usinf['Qkey'];
            $Q = $usinf['question'];
            if ($Qk != null || $Q != null) {
                header("location: /");
            }
            if ($CEmail != $email && $CPass != $pass) {
                header("location: /");
            }
        }
    } else {
        header("location: /");
    }
} else {
    header("location: /");
}

$errors = []; 

// ارسال اطلاعات
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $box = request('box');
    $answer = request('answer');
    if ($box != 'none') {
        if (empty($answer)) {
            $errors['answer'] = "لطفا پاسخ سوال امنیتی را وارد کنید";
        } else {
            $SQL = mysqli_query($db, "UPDATE `users` SET `question` = '$box' WHERE id = $id");
            $SQL2 = mysqli_query($db, "UPDATE `users` SET `Qkey` = '$answer' WHERE id = $id");
            $errors['sql'] = "سوال امنیتی شما با موفقیت ثبت شد";
        }
    } else {
        $errors['box'] = "لطفا یک مورد را انتخاب کنید";
    }
}
?>
<!DOCTYPE html>
<html lang="fa" dir="rtl">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>فعال سازی سوال امنیتی</title>
    <link rel="icon" href="../Data/logo.png">
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <script>
    function scs() {
    window.setTimeout( 
        function(){ 
            location.replace("/");
        },
        400
    );
    }
    </script>
    <div class="main-container">
        <h2>فرم درخواست سوال امنیتی</h2>
        <form action="./index.php?user=<?= $id ?>" method="post">
            <select name="box" id="box">
                <option value="none">لیست سوالات امنیتی</option>
                <option value="نام پدر شما ؟">نام پدر شما ؟</option>
                <option value="شهر محل زندگی شما ؟">شهر محل زندگی شما ؟</option>
                <option value="سن شما ؟">سن شما ؟</option>
            </select><br>
            <input name="answer" class="inp" type="text" placeholder="پاسخ شما ( حداکثر 15 کاراکتر ) "><br>
            <button type="submit" class="btn">ارسال درخواست</button><br>
            <?php if(has_error('box')) { ?>
            <span style="color: red; font-size: 14px;"><?= get_error('box'); ?></span><br>
            <?php } ?>
            <?php if(has_error('answer')) { ?>
            <span style="color: red; font-size: 14px;"><?= get_error('answer'); ?></span><br>
            <?php } ?>
            <?php if(has_error('sql')) { ?>
            <span style="color: green; font-size: 14px;"><?= get_error('sql'); ?></span><br>
            <script>
                scs()
            </script>
            <?php } ?>
        </form>
    </div>
</body>
</html>
