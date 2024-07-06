<?php 
// ** وصل شدن به دیتابیس و چک کردن کوکی ** \\
require_once('../config/localFunctions.php');
require_once('../config/config.php');
MustAdmin(2);
$CEmail = $_SESSION['UserEmail'];
$CPass = $_SESSION['UserPass'];
$false = 0;
$query = mysqli_query($db , "SELECT * FROM film ORDER BY `film`.`class` ASC");
if (mysqli_num_rows($query) == 0) {
    $false = 1;
} else {
    $false = 0;
}
if (! $query) {
    echo "ERROR : " . mysqli_error($db);
    exit;
}

//  Set Data 

$subject = '';
$sclass = '';

// 
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>لیست محتوا های سایت</title>
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
                <th>ایدی</th>
                <th>عنوان</th>
                <th>توضیحات</th>
                <th>لینک</th>
                <th>کلاس</th>
                <th>درس</th>
            </tr>
        </thead>
        <tbody>
            <!-- ایجاد لیست برای نمایش لیست فیلم های آموزشی -->
            <?php while ($film = mysqli_fetch_assoc($query)) {?>
                <tr>
                    <?php   
                        $lesson = $film['dars'];
                        switch ($lesson) {
                            case 'riazi':
                                $subject = "ریاضی";
                                break;
                            case 'olom':
                                $subject = "علوم";
                                break;
                            case 'farsi':
                                $subject = "فارسی";
                                break;
                            case 'negaresh':
                                $subject = "نگارش";
                                break;
                            case 'motaleat':
                                $subject = "مطالعات اجتماعی";
                                break;
                            case 'hedie':
                                $subject = "هدیه های آسمانی";
                                break;
                            case 'zaban':
                                $subject = "زبان";
                                break;
                            case 'qoran':
                                $subject = "قرآن";
                                break;
                            case 'arabi':
                                $subject = "عربی";
                                break;
                            case 'rayane':
                                $subject = "رایانه";
                                break;
                            default:
                        }

                        $gclass = $film['class'];
                        switch ($gclass) {
                            case 'haft':
                                $sclass = "هفتم";
                                break;
                            case 'hasht':
                                $sclass = "هشتم";
                                break;
                            case 'noh':
                                $sclass = "نهم";
                                break;
                        }
                    ?>
                    <td><?= $film['id'] ?></td>
                    <td><?= $film['title'] ?></td>
                    <td><?= $film['description'] ?></td>
                    <td><?= $film['link'] ?></td>
                    <td><?= $subject?></td>
                    <td><?= $sclass?></td>
                    <td><a href="../config/call.php?film=<?=$film['id']?>&func=<?=md5('deletefilm')?>">حذف<i style="color: rgb(0, 170, 255); font-size:20px;" class="fas fa-user-alt-slash"></a></i></td>
                </tr>
            <?php } ?>
        </tbody>
    </table>
    <span style="color: red;font-weight:bold;">
        <?php if ($false == 1) {
            echo "هیچ موردی برای نمایش وجود ندارد";
        } ?>
    </span>
</body>
</html>