<?php 
// ** وصل شدن به دیتابیس و چک کردن کوکی ** \\
require_once('../config/localFunctions.php');
// فانکشن
// گرفتن مقدار از اینپوت های
$errors = []; 
$success = false;  
require_once '../config/config.php';
if (! $db) {
    "ERROR : " . mysqli_connect_error();
    exit;
}
list($Config_username ,$Config_id ,$Config_question ,$Config_qkey ,$Config_rank ,$Config_email ,$Config_password ,$Config_score) = IfUserLogined('must');
MustAdmin(1);

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $dars = request('dars');
    $class = request('class');
    $help = request('help');
    $title = request('title');
    if (! empty($class) && ! empty($dars) && ! empty($help) && ! empty($title)) {
        if (isset($_FILES['link'])) {
            if (file_exists($_FILES['link']['tmp_name'])) {
                $link = "uploads/".$_FILES['link']['name'];
                $link2 = md5($link);
                $check = mysqli_query($db , "SELECT * FROM film WHERE link2 = '$link2' ");
                if(mysqli_num_rows($check) > 0){
                    // چک کردن اینکه اگر ویدیو وجود داشت ارور بده
                    $errors['exists'] = 'این ویدیو از قبل وجود دارد !';
                } else {
                $stmt = mysqli_prepare($db , "INSERT INTO film (title , description , link , class , dars , link2) VALUES (? , ? , ? , ? , ? , ?)");
                mysqli_stmt_bind_param($stmt , 'ssssss' , $title , $help , $link , $class , $dars , $link2);
                if ($result = mysqli_stmt_execute($stmt)) {
                    $path = 'uploads/';
                    // ریختن فایل درون پوشه آپلود
                    $path .= $_FILES['link']['name'];
                    if (! is_dir('uploads')) {
                        mkdir('uploads');
                    }
                    if (move_uploaded_file($_FILES['link']['tmp_name'] , $path )) {
                        // اگر فایل انتقال یافت پیام موفق نشون بده
                        $success = true;
                    } else {
                        $errors['empty'] = "خطا : تمامی موارد باید کامل شده باشند";
                    }
                } else {
                    echo "Error : " . mysqli_error($db) . "<br>";
                    // header("Location: /");
                    exit;
                }
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
<html lang="en" dir="rtl">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>اضافه کردن محتوا</title>
    <link rel="stylesheet" href="./add.css">
    <link rel="stylesheet" href="./../CSS/all.css">
</head>
<body>
    <script>
        function scs() {
        window.setTimeout( 
            function(){ 
                location.replace("/");
            },
            1500
        );
        }
    </script>
    <main>
        <form action="./add.php" method="post" enctype="multipart/form-data">
            <input type="file" name="link" class="link"><br>
            <label>عنوان :</label>
            <input type="text" name="title" placeholder="عنوان فیلم ..."><br>
            <label>توضیحات :</label>
            <input type="text" name="help" class="help" placeholder="توضیحات فیلم ..."><br>
            <label>کلاس :</label>
            <select name="class" id="class">
                <option value="haft">هفتم</option>
                <option value="hasht">هشتم</option>
                <option value="noh">نهم</option>
            </select><br>
            <label>درس :</label>
            <select name="dars" id="dars">
                <option value="riazi">ریاضی</option>
                <option value="olom">علوم</option>
                <option value="farsi">فارسی</option>
                <option value="negaresh">نگارش</option>
                <option value="motaleat">مطالعات اجتماعی</option>
                <option value="hedie">هدیه های آسمانی</option>
                <option value="zaban">زبان</option>
                <option value="qoran">قرآن</option>
                <option value="arabi">عربی</option>
                <option value="rayane">رایانه</option>
            </select><br>
            <button class="submit" type="submit">ثبت محتوا</button><br><br>
            <?php if(has_error('empty')) { ?>
            <span style="color: red; font-size: 20px;"><?= get_error('empty'); ?></span><br>
            <?php } ?>
            <?php if($success) { ?>
            <span style="color: green; font-size: 20px;"><?= 'محتوا شما با موفقیت آپلود شد !' ?></span><br>
            <script>
                scs();
            </script>
            <?php } ?>
            <?php if(has_error('exists')) { ?>
            <span style="color: red; font-size: 20px;"><?= get_error('exists'); ?></span><br>
            <?php } ?>
        </form>
    </main>
</body>
</html>