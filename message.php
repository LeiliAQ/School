<?php 
if (! empty($_GET['m'])){
    $message = $_GET['m'];
} else {
    header("location: /");
}

$text = '';
$link = '';
$help = '';
switch ($message) {
    case 'ErrorNotLogin870524':
        $text = "برای مشاهده امتیاز خود ابتدا وارد حساب خود شوید";
        $link = "/login.php";
        $help = 'برای ورود به حساب کلیک کنید';
        break;
    case 'LogOut':
        $text = "شما با موفقیت از حساب خود خارج شدید";
        $link = "/";
        $help = 'برگشت به صفحه اصلی';
        break;
    default:
        header("location: /");
        break;
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./CSS/message.css">
    <title>علامه حلی ملایر</title>
</head>
<body>
    <div class="message">
        <p><?php echo $text; ?></p>
        <a href="<?php echo $link ?>"><?php echo $help; ?></a>
    </div>
</body>
</html>