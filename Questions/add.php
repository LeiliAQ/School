<?php 
require_once('../config/localFunctions.php');
require_once('../config/config.php');
if (! isset($_SESSION['UserEmail']) && ! isset($_SESSION['UserPass'])) {
    header("Location: /login.php");
    exit();
} else {
    $email = $_SESSION['UserEmail'];
    $pass = $_SESSION['UserPass'];
}
$errors = [];   
$success = false;

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $title = request('title');
    $title2 = md5($title);
    $desc = request('desc');
    $bool = 'false';
    if (is_null($title)) {
        $errors['title'] = "فیلد عنوان نمی تواند خالی باشد";
    }
    if (is_null($desc)) {
        $errors['desc'] = "فیلد سوال نمی تواند خالی باشد";
    }

    if (! is_null($title) && ! is_null($desc)) {
        $check = mysqli_query($db , "SELECT * FROM users WHERE email = '$email' ");
        if ($row = mysqli_fetch_assoc($check)) {
            $User = $row["username"];
        }
        // اضافه کردن سوال به دیتابیس
        $statement = mysqli_prepare($db , "INSERT INTO `questions` (`user` , `title` , `title2` , `desc` , `status`) VALUES (? , ? , ? , ? , ?)");
        mysqli_stmt_bind_param($statement , 'sssss' , $User , $title , $title2 , $desc , $bool);
        if ($result = mysqli_stmt_execute($statement)) {
            $success = true;
        } else {
            echo "Error : " . mysqli_error($db) . "<br>";
            exit;
        }
    }
}

?>
<!DOCTYPE html>
<html lang="en" dir="rtl">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>اضافه کردن پرسش</title>
    <link rel="icon" href="../Data/question.png">
    <link rel="stylesheet" href="./add.css">
</head>
<body>
    <script>
        function scs() {
        window.setTimeout( 
            function(){ 
                location.replace("/");
            },
            3000
        );
        }
    </script>
    <form method="post" action="./add.php">
        <input type="text" name="title" placeholder="عنوان پرسش ..."><br>
        <?php if(has_error('title')) { ?>
            <span><?= get_error('title'); ?></span><br>
        <?php } ?>
        <input type="text" name="desc" placeholder="سوال ..."><br>
        <?php if(has_error('desc')) { ?>
            <span><?= get_error('desc'); ?></span><br>
        <?php } ?>
        <button type="submit">ثبت پرسش</button><br>
        <?php if($success) {?>
            <span style="color: green; font-size: 1.2em;">
                <?= "سوال شما به موفقیت برای تیم مدیریتی ارسال شد و پس از تایید نمایش داده می شود" ?>
            </span>
            <script>
                scs();
            </script>
        <?php } ?>
    </form>
</body>
</html>