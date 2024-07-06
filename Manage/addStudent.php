<?php 
require_once('../config/localFunctions.php');
require_once('../config/config.php');
list($Config_username ,$Config_id ,$Config_question ,$Config_qkey ,$Config_rank ,$Config_email ,$Config_password ,$Config_score) = IfUserLogined('must');
MustAdmin(2);
$success = false;

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $codemeli = request('codemeli');
    $username = request('username');
    $rank = request('rank');
    $password = rand(100000,1000000);
    $queryCheck = mysqli_query($db , "SELECT * FROM users WHERE `email` = $codemeli");
    if (mysqli_num_rows($queryCheck) == 0) {
        if (! empty($codemeli) && ! empty($username)) {
            $query = mysqli_prepare($db , "INSERT INTO users (email , `password` , `rank` , username) VALUES (? , ? , ? , ?)");
            mysqli_stmt_bind_param($query , 'ssss' , $codemeli , $password, $rank , $username);
            $success = true;
            if (! $result = mysqli_stmt_execute($query)) {
                echo "Error : " . mysqli_error($db) . "<br>";
                // header("Location: /");
                exit;
            }
        } else {
            $errors['empty'] = "خطا : تمامی موارد باید کامل شده باشند";
        }
    }else{
        $errors['olduser'] = "خطا : این کاربر از قبل وجود دارد";
    }
}
?>
<!DOCTYPE html>
<html lang="en" dir="rtl">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="score.css">
    <title>اضافه کردن کاربر</title>
</head>
<body>
    <script>
        function scs() {
        window.setTimeout( 
            function(){ 
                location.replace("./list.php");
            },
            1500
        );
        }
    </script>
    <div class="main">
        <form action="addStudent.php" method="post">
            <center><input type="number" name="codemeli" placeholder="کد ملی ...">
            <input type="text" name="username" placeholder="نام کاربر ...">
            <label for="rank">مقام کاربر مشخص کنید</label>
            <select name="rank">
                <option value="0">کاربر</option>
                <option value="1">معلم</option>
                <option value="2">معاون</option>
                <option value="3">مدیر</option>
            </select>
            <button type="submit">افزودن کاربر</button>
            <?php if(has_error('empty')) { ?>
                <span style="color: red; font-size: 20px;"><?= get_error('empty'); ?></span><br>
            <?php } ?>
            <?php if(has_error('olduser')) { ?>
                <span style="color: red; font-size: 20px;"><?= get_error('olduser'); ?></span><br>
            <?php } ?>
                <?php if($success) { ?>
                <span style="color: green; font-size: 20px;"><?= 'کاربر با موفقیت افزوده شد'?></span><br>
                <script>
                    scs();
                </script>
                <?php } ?>
            </center>
        </form>
    </div>
</body>
</html>