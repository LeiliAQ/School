<?php 
require_once('../config/localFunctions.php');
require_once('../config/config.php');
MustAdmin(2);
$query = mysqli_query($db , "SELECT * FROM score");

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>لیست امتیازات</title>
    <link rel="stylesheet" href="../CSS/all.css">
    <link rel="stylesheet" href="../CSS/list.css">
    <style>
        th , td {
            padding: 5px;
        }
    </style>
</head>
<body>
        <table>
        <thead>
            <tr>
                <th>گیرنده امیتاز</th>
                <th>تعداد</th>
                <th>نوع</th>
                <th>دلیل</th>
                <th>امتیاز دهنده</th>
            </tr>
        </thead>
        <tbody>
            <!-- درست کردن لیست برای نمایش لیست کاربران سایت -->
            <?php while ($ann = mysqli_fetch_assoc($query)) {
                ?>
                <tr>
                    <td><?= $ann['username'] ?></td>
                    <td><?= $ann['tedad'] ?></td>
                    <td><?= $ann['type'] ?></td>
                    <td><?= $ann['reason'] ?></td>
                    <td><?= $ann['giver'] ?></td>
                </tr>
            <?php } ?>
        </tbody>
    </table>
    <a id="aHome" href="/"><i id="home" class="fas fa-home"></i></a>
</body>
</html>