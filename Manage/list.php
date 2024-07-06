<?php 
// ** وصل شدن به دیتابیس و چک کردن کوکی ** \\
require_once('../config/localFunctions.php');
require_once('../config/config.php');
MustAdmin(2);
$CEmail = $_SESSION['UserEmail'];
$CPass = $_SESSION['UserPass'];
$searchText = null;
$found = false;
if (isset($_POST['search'])) {
    $searchText = trim($_POST['search']);
}
$query_no = "SELECT * FROM users";
$query_search = "SELECT * FROM users WHERE username LIKE '%$searchText%'";
if (is_null($searchText)) {
    $query = mysqli_query($db , $query_no);
} else {
    $query = mysqli_query($db , $query_search);
}
if (mysqli_num_rows($query) == 0) {
    $found = true;
}
if (! $query) {
    echo "ERROR : " . mysqli_error($db);
    exit;
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>لیست کاربران سایت</title>
    <link rel="stylesheet" href="../CSS/all.css">
    <link rel="stylesheet" href="../CSS/list.css">
    <style>
        th , td {
            padding: 5px;
        }
    </style>
</head>
<body>
    <center><div dir="rtl" id="searchDIV">
        <form action="./list.php" method="post">
            <button id="searchBTN"><i id="searchBTNI" class="fas fa-search"></i></button>
            <input type="search" name="search" id="searchTXT" placeholder="نام دانش اموز مورد نظر ...">
        </div>
        </form>
        <?php 
            if ($found) {?>
                <p style="color:red">موردی پیدا نشد</p>
            <?php }
        ?>
    </center>
        <table>
        <thead>
            <tr>
                <th>ایدی</th>
                <th>کدملی</th>
                <th>نام کاربری</th>
                <th>پسورد</th>
                <th>امتیاز</th>
                <th>مقام</th>
                <th>حذف کاربر</th>
                <th>تبدیل به معلم</th>
                <th>تبدیل به معاون</th>
                <th>تبدیل به کاربر</th>
                <th>تغییر امتیاز</th>
            </tr>
        </thead>
        <tbody>
            <!-- درست کردن لیست برای نمایش لیست کاربران سایت -->
            <?php while ($user = mysqli_fetch_assoc($query)) {
                if ($user['rank'] == 1) {
                    $UserRank = 'معلم';
                } elseif ($user['rank'] == 2) {
                    $UserRank = 'معاون';
                } elseif ($user['rank'] == 3) {
                    $UserRank = 'مدیر';
                } elseif ($user['rank'] == 4) {
                    $UserRank = 'ادمین';
                }else {
                    $UserRank = 'کاربر';
                }
                ?>
                <tr>
                    <td><?= $user['id'] ?></td>
                    <td><?= $user['email'] ?></td>
                    <td><?= $user['username'] ?></td>
                    <td><?= $user['password'] ?></td>
                    <td><?= $user['score'] ?></td>
                    <td><?= $UserRank?></td>
                    <td><a href="../config/call.php?id=<?=$user['id']?>&func=<?=md5("deleteuser")?>"><i style="color: rgb(0, 170, 255); font-size:20px;" class="fas fa-user-alt-slash"></a></i></td>
                    <td><a href="../config/call.php?id=<?=$user['id']?>&func=<?=md5("setrank")?>&rank=1"><i style="color: rgb(0, 170, 255); font-size:20px;" class="fas fa-user-plus"></a></i></td>
                    <td><a href="../config/call.php?id=<?=$user['id']?>&func=<?=md5("setrank")?>&rank=2"><i style="color: rgb(0, 170, 255); font-size:20px;" class="fas fa-user-plus"></a></i></td>
                    <td><a href="../config/call.php?id=<?=$user['id']?>&func=<?=md5("setrank")?>&rank=0"><i style="color: rgb(0, 170, 255); font-size:20px;" class="fas fa-user-minus"></a></i></td>
                    <td><a href="./score.php?id=<?=$user['id']?>"><i style="color: rgb(0, 170, 255); font-size:20px;" class="fas fa-medal"></a></i></td>
                </tr>
            <?php } ?>
        </tbody>
    </table>
    <a id="aHome" href="/"><i id="home" class="fas fa-home"></i></a>
</body>
</html>