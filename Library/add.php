<?php 
require_once '../config/localFunctions.php';
require_once '../config/config.php';
list($Config_username ,$Config_id ,$Config_question ,$Config_qkey ,$Config_rank ,$Config_email ,$Config_password ,$Config_score) = IfUserLogined('must');
MustAdmin(2);
$errors = []; 
$success = false;

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $title = request('title');
    $subject = request('subject');
    if (! empty($title) && ! empty($subject)) {
        if (isset($_FILES['img'])) {
            if (file_exists($_FILES['img']['tmp_name'])) {
                $IMGlink = "Data/".$_FILES['img']['name'];
                $bookQuery = mysqli_prepare($db , "INSERT INTO library (title , `subject` , link) VALUES (? , ? , ?)");
                mysqli_stmt_bind_param($bookQuery , 'sss' , $title , $subject , $IMGlink);
                if ($result = mysqli_stmt_execute($bookQuery)) {
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
    <link rel="stylesheet" href="../Announcement/CSS/add.css">
    <title>افزودن کتاب جدید</title>
</head>
<body dir="rtl">
    <script>
        function scs() {
        window.setTimeout( 
            function(){ 
                location.replace("./");
            },
            1500
        );
        }
    </script>
    <div class="maindiv">
        <form action="./add.php" method="post" enctype="multipart/form-data">
            <input type="text" name="title" placeholder="عنوان کتاب را وارد کنید">
            <input type="text" name="subject" placeholder="موضوع کتاب را وارد کنید">
            <b><label for="img" style="float: right;">عکس کتاب را وارد کنید :</label></b>
            <input type="file" name="img" class="imgInput" placeholder="عکس کتاب را وارد کنید">
            <button type="submit">افزودن کتاب</button><br>
            <?php if(has_error('empty')) { ?>
            <span style="color: red; font-size: 20px;"><?= get_error('empty'); ?></span><br>
            <?php } ?>
            <?php if($success) { ?>
            <span style="color: green; font-size: 20px;"><?= 'کتاب با موفقیت افزوده شد' ?></span><br>
            <script>
                scs();
            </script>
            <?php } ?>
        </form>
    </div>
</body>
</html>