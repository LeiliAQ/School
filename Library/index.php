<?php 
require_once '../config/config.php';
require_once '../config/localFunctions.php';
list($Config_username ,$Config_id ,$Config_question ,$Config_qkey ,$Config_rank ,$Config_email ,$Config_password ,$Config_score) = IfUserLogined('not');
$Query = "SELECT * FROM library";
if (isset($_GET['search'])) {
    $search = $_GET['search'];
    $QuerySearch = "SELECT * FROM library WHERE `title` LIKE '%$search%'";
    $bookQuery = mysqli_query($db , $QuerySearch);
} else {
    $bookQuery = mysqli_query($db , $Query);
}

$error = false;
if (mysqli_num_rows($bookQuery) == 0) {
    $error = true;
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>کتابخانه</title>
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.11.2/css/all.css"/>
</head>
<body dir="rtl">
    <div>
        <center><div dir="rtl" id="searchDIV">
        <form action="./" method="get">
            <input type="search" name="search" id="searchTXT" placeholder="عنوان کتاب مورد نظر ..">
            <button id="searchBTN"><i id="searchBTNI" class="fas fa-search"></i></button>
        </form>
        </div>
        <?php if ($Config_rank >= 2) { ?>
            <a id="add" href="./add.php">اضافه کردن کتاب</a>
        <?php }
        if ($error) {
        ?>
        <p style="color:red; font-size:1.2em;">هیج موردی یافت نشد !</p>
        <?php } ?>
        </center>
        <main>
            <?php while ($rows=mysqli_fetch_assoc($bookQuery)) { ?>
                <div class="book">
                    <img src="<?=$rows['link']?>" alt="کتاب">
                    <h3><?=$rows['title']?></h3>
                    <p>موضوع کتاب : <?= $rows['subject'] ?></p>
                </div>
            <?php } ?>
            <a id="home" href="/"><i class="fas fa-home"></i></a>
        </main>
    </div>
</body>
</html>