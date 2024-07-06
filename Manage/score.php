<?php 
// ** وصل شدن به دیتابیس و چک کردن کوکی ** \\
require_once('../config/localFunctions.php');
require_once('../config/config.php');
MustAdmin(2);
$CEmail = $_SESSION['UserEmail'];
$CPass = $_SESSION['UserPass'];
if (isset($_GET['id'])) {
    $id = $_GET['id'];
} else {
    header('location: /');
}

$success = false;
$queryDB = mysqli_query($db , "SELECT * FROM users WHERE email = '$CEmail' AND password = '$CPass' ");
$Rankk = mysqli_fetch_assoc($queryDB);
$username = $Rankk['username'];


if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $tedad = request('tedad');
    $reason = request('reason');
    $type = request('type');
    $userQuery = mysqli_query($db , "SELECT * FROM users WHERE id = $id");
    if ($rows = mysqli_fetch_assoc($userQuery)) {
        $userID = $rows['username'];
        $userScore = $rows['score'];
        if ($type == 'کاهش') {
            $userScore = $userScore - $tedad;
        } elseif ($type == 'افزایش') {
            $userScore = $userScore + $tedad;
        }
    }
    if (! empty($type) && ! empty($reason) && ! empty($tedad)) {
        $scoreQuery = mysqli_query($db , "UPDATE users SET score = $userScore WHERE id = $id");
        $query = mysqli_prepare($db , "INSERT INTO score (username , tedad , `type` , reason , giver) VALUES (? , ? , ? , ? , ?)");
        mysqli_stmt_bind_param($query , 'sssss' , $userID , $tedad, $type , $reason , $username);
        $success = true;
        if (! $result = mysqli_stmt_execute($query)) {
            echo "Error : " . mysqli_error($db) . "<br>";
            // header("Location: /");
            exit;
        }
    } else {
        $errors['empty'] = "خطا : تمامی موارد باید کامل شده باشند";
    }
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="score.css">
    <title>تغییر امتیاز</title>
</head>
<body dir="rtl">
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
        <form action="./score.php?id=<?=$id?>" method="post">
            <input type="number" name="tedad" placeholder="تعداد وارد کنید">
            <input type="text" name="reason" placeholder="دلیل را وارد کنید">
            <label for="type">نوع را وارد کنید :</label>
            <select name="type" id="type">
                <option style="color: green;" value="افزایش">افزایش</option>
                <option style="color: red;" value="کاهش">کاهش</option>
            </select>
            <center><button>ثبت</button>
                <?php if($success) { ?>
                <span style="color: green; font-size: 20px;"><?= 'امتیاز با موفقیت افزوده شد' ?></span><br>
                <script>
                    scs();
                </script>
                <?php } ?>
                <br><br>
                <a style="color:#006ca1; font-size:1.05em;" href="list.php">بازگشت به صفحه اصلی</a>
            </center>
        </form>
    </div>
</body>
</html>