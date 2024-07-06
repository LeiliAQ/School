<?php 
require_once '../config/localFunctions.php';
require_once '../config/config.php';
list($Config_username ,$Config_id ,$Config_question ,$Config_qkey ,$Config_rank ,$Config_email ,$Config_password ,$Config_score) = IfUserLogined('must');
MustAdmin(2);

$errors = []; 
$success = false;

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    global $Config_username;
    $p = request('p');
    $p1 = request('p1');
    $p2 = request('p2');
    $annView = request('annView');
    if (! empty($p) && ! empty($p1) && ! empty($p2)) {
        if (isset($_FILES['img'])) {
            if (file_exists($_FILES['img']['tmp_name'])) {
                $IMGlink = "Data/".$_FILES['img']['name'];
                $AnnLink = md5($p);
                $query12 = mysqli_prepare($db , "INSERT INTO ann (username , p1 , p2 , p , img , annLink , annView) VALUES (? , ? , ? , ? , ? , ? , ?)");
                mysqli_stmt_bind_param($query12 , 'sssssss' , $Config_username , $p1 , $p2 , $p , $IMGlink , $AnnLink , $annView);
                if ($result = mysqli_stmt_execute($query12)) {
                    $path = 'Data/';
                    $path .= $_FILES['img']['name'];
                    if (move_uploaded_file($_FILES['img']['tmp_name'] , $path )) {
                        $success = true;
                    } else {
                        $errors['empty'] = "خطا : تمامی موارد باید کامل شده باشند";
                    }
                } else {
                    echo "Error : " . mysqli_error($db) . "<br>";
                    // header("Location: /");
                    exit;
                }
            } else {
                $errors['empty'] = "خطا : تمامی موارد باید کامل شده باشند";
            }
        } else {
            $errors['empty'] = "خطا : تمامی موارد باید کامل شده باشند";
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
    <link rel="stylesheet" href="CSS/add.css">
    <title>افزودن اطلاعیه جدید</title>
</head>
<body dir="rtl">
    <script>
        function scs() {
        window.setTimeout( 
            function(){ 
                location.replace("./index.php");
            },
            1500
        );
        }
    </script>
    <div class="maindiv">
        <form action="./add.php" method="post" enctype="multipart/form-data">
            <input type="text" name="p" placeholder="عنوان را وارد کنید">
            <input type="text" name="p1" placeholder="توضیحات را وارد کنید ( کوتاه )">
            <input type="text" name="p2" placeholder="متن اصلی را وارد کنید">
            <label for="annView">نمایش اطلاعیه برای :</label>
            <select name="annView" id="view">
                <option value="0">همه کاربران</option>
                <option value="1">معلمین</option>
                <option value="2">معاونین</option>
            </select><br>
            <b><label for="img" style="float: right;">عکس اطلاعیه را وارد کنید :</label></b>
            <input type="file" name="img" class="imgInput" placeholder="عکس اطلاعیه را وارد کنید">
            <button type="submit">ثبت اطلاعیه</button><br>
            <?php if(has_error('empty')) { ?>
            <span style="color: red; font-size: 20px;"><?= get_error('empty'); ?></span><br>
            <?php } ?>
            <?php if($success) { ?>
            <span style="color: green; font-size: 20px;"><?= 'اطلاعیه با موفقیت افزوده شد' ?></span><br>
            <script>
                scs();
            </script>
            <?php } ?>
        </form>
    </div>
</body>
</html>