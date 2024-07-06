<?php
require_once '../config/localFunctions.php';
require_once '../config/config.php';
if (isset($_SESSION['UserEmail']) && isset($_SESSION['UserPass'])) {
    $CEmail = $_SESSION['UserEmail'];
    $CPass = $_SESSION['UserPass'];
} else {
    header("location: /message.php?m=ErrorNotLogin870524");
}
$SQL = mysqli_query($db , "SELECT * FROM users WHERE email = '$CEmail' AND password = '$CPass' ");
if ($row = mysqli_fetch_assoc($SQL)) {
    $userUserName = $row['username'];
    $userScore = $row['score'];
}
$SQL2 = mysqli_query($db , "SELECT * FROM score WHERE username = '$userUserName' ");


?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>امتیازات</title>
    <link rel="icon" href="./../Data/logo2.png">
    <link rel="stylesheet" href="CSS/style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.11.2/css/all.css"/>
</head>
<body>
    <div class="main_div">
        <h2>امتیاز شما : <?php echo $userScore ?></h2>
        <hr>
        <div class="main_table">
            <table>
                <tr>
                    <th>دلیل</th>
                    <th>نوع</th>
                    <th>تعداد</th>
                </tr>
                <?php while ($row2 = mysqli_fetch_assoc($SQL2)) { 
                    $scoreType = $row2['type'];
                    if ($scoreType == 'افزایش') {
                ?>
                <tr>
                    <td><?php echo $row2['reason'] ?></td>
                    <td style="color : #09ff00fd;"><?php echo $row2['type'] ?></td> <!-- + -->
                    <td><?php echo $row2['tedad'] ?></td>
                </tr>
                <?php }else { ?>
                <tr>
                <td><?php echo $row2['reason'] ?></td>
                    <td style="color: red;"><?php echo $row2['type'] ?></td>
                    <td><?php echo $row2['tedad'] ?></td>
                </tr>
                <?php } 
                } ?>
        </div>
            </table>
    </div>
    <a href="/">
        <i class="fas fa-home"></i>
    </a>
</body>
</html>