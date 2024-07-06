<?php 
// ** وصل شدن به دیتابیس و چک کردن کوکی ** \\
require_once('../config/localFunctions.php');
require_once('../config/config.php');
list($Config_username ,$Config_id ,$Config_question ,$Config_qkey ,$Config_rank ,$Config_email ,$Config_password ,$Config_score) = IfUserLogined('must');
MustAdmin(1);
$false = 0;
// گرفتن تمامیه اطلاعات از بانک اطلاعاتی
$queryQ = mysqli_query($db , "SELECT * FROM `questions`");
if (mysqli_num_rows($queryQ) == 0) {
    $false = 1;
} else {
    $false = 0;
}
// Functions //
$is = false;
// چک کردن وضعیت سوال
function CheckStatus($status) {
    global $is;
    if ($status == 'true') {
        echo "در حال نمایش";
        $is = true;
    } else {
        echo "غیر فعال";
        $is = false;
    }
    return $is;
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>لیست پرسش ها</title>
    <link rel="stylesheet" href="../CSS/all.css">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <style>
        @font-face {
            font-family: FontIR;
            src: url('../Font/Iranian\ Sans.ttf');
        }
        body {
            font-family: FontIR;
        }
        td , th {
            border: 1px solid rgb(0, 132, 255);
            padding: 15px;
            text-align: center;
            max-height: 50px;
            max-width: 100%;
        }
    </style>
</head>
<body>
    <!-- درست کردن جدول و اضافه کردن هر ستون با اطلاعات گرفته شده -->
    <table>
        <tr>
            <th>ایدی</th>
            <th>عنوان</th>
            <th>پرسش</th>
            <th>نمایش</th>
            <th>اقدامات</th>
            <th>پاسخ سوال</th>
        </tr>
        <?php while ($ques = mysqli_fetch_assoc($queryQ)) {?>
                <tr>
                    <td><?= $ques['id'] ?></td>
                    <td class="tdStyles"><?= $ques['title'] ?></td>
                    <td class="tdStyles"><?= $ques['desc'] ?></td>
                    <td><?php CheckStatus($ques['status']) ?></td>
                    <td>
                        <a href="/config/call.php?Question=<?=$ques['id']?>&func=<?=md5('deleteq')?>"><i class="material-icons" style="color: red;font-size:30px;">delete_sweep</i></a>
                        <a href="/config/call.php?Question=<?=$ques['id']?>&func=<?=md5('setstatus')?>"><i class="fas fa-check-circle" style="color: green; margin-left:10px;font-size:30px;"></i></a>
                    </td>
                    <td  class="tdStyles"><?= $ques['answer'] . "<br>"?> <a href="./Qfunctions/answer.php?id=<?= $ques['id']?>"><i style="color: rgb(0, 132, 255);" class="material-icons">question_answer</i></a></td>
                </tr>
        <?php } ?>
    </table>
    <span style="color: red;font-weight:bold;">
        <?php if ($false == 1) {
            echo "هیچ موردی برای نمایش وجود ندارد";
        } ?>
    </span>
</body>
</html>