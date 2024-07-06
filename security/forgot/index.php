<?php 
// ** وصل شدن به دیتابیس و چک کردن کوکی ** \\
require_once('../../config/localFunctions.php');
require_once('../../config/config.php');
$errors = [];

if (isset($_SESSION['UserEmail']) && isset($_SESSION['UserPass'])) {
    header("location: /");
}

// دستورات اصلی
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $email = request('email');
    $box = request('box');
    $answer = request('answer');
    $password = request('password');
    $password2 = request('password2');
    if (is_null($email)) {
        $errors['email'] = "لطفا فیلد ایمیل را پر کنید";
    }
    if ($box == 'none') {
        $errors['box'] = "لطفا سوال امنیتی خود را انتخاب کنید";
    }
    if (is_null($answer)) {
        $errors['answer'] = "لطفا پاسخ سوال امنیتی خود را وارد کنید";
    }
    if (is_null($password)) {
        $errors['password'] = "فیلد رمز عبور نمی تواند خالی باشد";
    } elseif (strlen($password) < 6) {
        $errors['password'] = "رمز عبور حداقل باید 6 حرف باشد";
    }
    if (is_null($password2)) {
        $errors['password2'] = "فیلد تکرار رمز عبور نمی تواند خالی باشد";
    } elseif ($password != $password2) {
        $errors['password2'] = "رمز عبور شما و تکرار آن با هم برابر نیستند !";
    }

    // دستور اصلی و تغییر دادن پسورد
    if (! is_null($password2) && $password == $password2 && strlen($password) >= 6 && ! is_null($password) && ! is_null($email) && ! is_null($answer) && $box != 'none') {
        $query = mysqli_query($db , "SELECT * FROM `users` WHERE `email` = '$email' AND `question` = '$box'");
        if (mysqli_num_rows($query) == 1) {
            if ($info = mysqli_fetch_assoc($query)) {
                $UserOldPass = $info['password'];
                $UserQkey = $info['Qkey'];
                if ($answer == $UserQkey) {
                    $update = mysqli_query($db , "UPDATE `users` SET `password` = '$password' WHERE `email` = '$email' AND `question` = '$box'");
                    if (!$update) {
                        echo "MYSQLI ERROR : " . mysqli_error($db);
                    }
                    $useremail = 'UserEmail';
                    setcookie($useremail,$email,time() + 2629800000 , "/");
                    $userpass = 'UserPass';
                    setcookie($userpass,$password,time() + 2629800000 , "/");
                    $errors['success'] = "پسورد شما با موفقیت عوض شد !";
                } else {
                    $errors['Qkey'] = "پاسخ شما درست نیست !";
                }
            }
        } else {
            $errors['not'] = "سوال شما با حساب شما برابر نیست";
        }
    }
}

?>
<!DOCTYPE html>
<html lang="fa" dir="rtl">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>بازیابی رمز عبور</title>
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
        <form action="./" method="post">
            <input type="email" name="email" placeholder="ایمیل شما"><br>
            <select name="box" id="box"><br>
                <option value="none">سوال امنیتی شما</option>
                <option value="نام پدر شما ؟">نام پدر شما ؟</option>
                <option value="شهر محل زندگی شما ؟">شهر محل زندگی شما ؟</option>
                <option value="سن شما ؟">سن شما ؟</option>
            </select><br>
            <input type="text" name="answer" placeholder="پاسخ سوال"><br>
            <input type="password" name="password" placeholder="رمز عبور جدید"><br>
            <input type="password" name="password2" placeholder="تکرار رمز عبور"><br>
            <button type="submit" class="btn">ثبت رمز عبور</button><br><br><br>
            <?php if(has_error('success')) { ?>
                <span style="color: green;"><?= get_error('success'); ?></span><br>
                <script>
                    scs()
                </script>
            <?php } ?>
            <?php if(has_error('email')) { ?>
                <span style="color: red;"><?= get_error('email'); ?></span><br>
            <?php } ?>
            <?php if(has_error('box')) { ?>
                <span style="color: red;"><?= get_error('box'); ?></span><br>
            <?php } ?>
            <?php if(has_error('answer')) { ?>
                <span style="color: red;"><?= get_error('answer'); ?></span><br>
            <?php } ?>
            <?php if(has_error('password')) { ?>
                <span style="color: red;"><?= get_error('password'); ?></span><br>
            <?php } ?>
            <?php if(has_error('password2')) { ?>
                <span style="color: red;"><?= get_error('password2'); ?></span><br>
            <?php } ?>
            <?php if(has_error('passwordint')) { ?>
                <span style="color: red;"><?= get_error('passwordint'); ?></span><br>
            <?php } ?>
            <?php if(has_error('pass')) { ?>
                <span style="color: red;"><?= get_error('pass'); ?></span><br>
            <?php } ?>
            <?php if(has_error('not')) { ?>
                <span style="color: red;"><?= get_error('not'); ?></span><br>
            <?php } ?>
            <?php if(has_error('Qkey')) { ?>
                <span style="color: red;"><?= get_error('Qkey'); ?></span><br>
            <?php } ?>
        </form>
    </div>
</body>
</html>