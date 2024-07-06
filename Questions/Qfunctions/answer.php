<?php 
// ** وصل شدن به دیتابیس و چک کردن کوکی ** \\
require_once('../../config/localFunctions.php');
require_once('../../config/config.php');
$CEmail = $_SESSION['UserEmail'];
$CPass = $_SESSION['UserPass'];
$queryDB = mysqli_query($db , "SELECT * FROM `users` WHERE `email` = '$CEmail' AND `password` = '$CPass' ");
$Rankk = mysqli_fetch_assoc($queryDB);
$RankIF = $Rankk['rank'];
$who = $Rankk['username'];
$error = true;
$QAID = $_GET['id'];
// چک کردن اگر کاربر ادمین یا معلم باشه
if ($RankIF >= 1) {
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        if (isset($_GET['id'])) {
            // گرفتن مقدار اینپوتی که درون آن پاسخ نوشته شده است
            $a = trim($_POST['answer']);
            if (is_null($a)) {
                $error = true;
            }
            // ست کردن پاسخ سوال
            $SQL = mysqli_query($db, "UPDATE `questions` SET `answer` = '$a' WHERE `id` = '$QAID'");
            // ست کردن کسی که به ان سوال پاسخ داده
            $SQL2 = mysqli_query($db, "UPDATE `questions` SET `who` = '$who' WHERE `id` = '$QAID'");
            if (! $SQL || ! $SQL2) {
                echo "ERROR : " . mysqli_error($db);
                exit;
            }
            header("Location: ../Qlist.php");
        } else {
            header("Location: ../Qlist.php");
        }
    }
}else {
    header("Location: /");
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ارسال پاسخ</title>
    <link rel="stylesheet" href="answer.css">
</head>
<body>
    <div class="form">
        <form action="./answer.php?id=<?= $QAID?>" method="post">
            <textarea name="answer" placeholder="پاسخ سوال .."></textarea><br><br>
            <?php if ($error) { ?>
                <span style="color: white; font-size:16px;">لطفا فیلد هارا پر کنید</span><br><br>
            <?php }?>
            <button type="submit" style="cursor: pointer;">ارسال</button><br><br>
        </form>
    </div>
</body>
</html>