<?php 
// ** وصل شدن به دیتابیس و چک کردن کوکی ** \\
require_once('./config/localFunctions.php');
require_once('./config/config.php');
// گرفتن اطلاعات
$errors = [];

if (isset($_SESSION['UserEmail']) && isset($_SESSION['UserPass'])) {
    header("location: /");
}

// ورود کابر و ست کردن کوکی
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $email = request('email');
    $password = request('password');
    if (is_null($email)) {
        $errors['email'] = "فیلد ایمیل نمی تواند خالی باشد";
    }
    if (is_null($password)) {
        $errors['password'] = "فیلد پسورد نمی تواند خالی باشد";
    } elseif (strlen($password) < 6) {
        $errors['password'] = "پسورد حداقل باید 6 حرف باشد";
    }

    // GET AND CHECK DATA \\
    if (strlen($password) >= 6 && ! is_null($password) && ! is_null($email)) {
        $checkLoginn = mysqli_query($db , "SELECT * FROM users WHERE email = '$email' AND password = '$password' ");
        if(mysqli_num_rows($checkLoginn) > 0){
            $useremail = 'UserEmail';
            $userpass = 'UserPass';
            $_SESSION['UserPass'] = $password;
            $_SESSION['UserEmail'] = $email;
            $errors['LoginCheck'] = "شما با موفقیت در حساب خود لاگین کردید";
        }else {
            $errors['LoginCheck2'] = "ایمیل یا پسورد اشتباه است";
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
    <title>ورود</title>
    <link rel="stylesheet" href="./CSS/login.css">
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
    <div id="main">
        <div id="register">
            <form action="./login.php" method="POST">
                <input name="email" type="number" placeholder="کدملی . . ."><br>
                <?php if(has_error('email')) { ?>
                <span><?= get_error('email'); ?></span><br>
                <?php } ?>
                <input name="password" type="password" placeholder="پسورد . . ."><br>
                <?php if(has_error('password')) { ?>
                <span><?= get_error('password'); ?></span><br>
                <?php } ?>
                <br>
                <a class="ah" href="./security/forgot/">فراموشی رمز عبور؟</a><br>
                <button type="submit">ورود</button>
                <?php if(has_error('LoginCheck')) { ?>
                <span style="color: green; font-size: 1.2em;"><?= get_error('LoginCheck'); ?></span><br>
                <script>
                    scs();
                </script>
                <?php } ?>

                <?php if(has_error('LoginCheck2')) { ?>
                <span style="color: red; font-size: 1.2em;"><?= get_error('LoginCheck2'); ?></span><br>
                <?php } ?>
                <br>
                <br>
            </form>
        </div>
    </div>
</body>
</html>
