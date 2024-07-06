<?php 
require_once './config.php';
require_once './localFunctions.php';
list($Config_username ,$Config_id ,$Config_question ,$Config_qkey ,$Config_rank ,$Config_email ,$Config_password ,$Config_score) = IfUserLogined('not');
if (empty($_GET['func'])) {
    header('location: /');
}
$func = $_GET['func'];
if ($func == md5("logout")) {    
    unset($_SESSION['UserEmail']);
    unset($_SESSION['UserPass']);
    header("location: /message.php?m=LogOut");
}elseif ($func == md5("deleteq")) {
    if ($Config_rank >= 1) {
        if (isset($_GET['Question'])) {
            $QuestionID = $_GET['Question'];
            $query = mysqli_query($db , "DELETE FROM `questions` WHERE `id` = '$QuestionID' ");
            header("Location: ../Questions/Qlist.php");
            if (! $query) {
                echo "ERROR : " . mysqli_error($db);
                exit;
            }
        } else {
            header("Location: /");
        }
    } else {
        header("Location: /");
    }
}elseif($func == md5('setstatus')) {
    if ($Config_rank >= 1) {
        if (isset($_GET['Question'])) {
            $UserID = $_GET['Question'];
            // ست کردن وضعیت سوال به فعال
            $SQL = mysqli_query($db, "UPDATE `questions` SET `status` = 'true' WHERE id = $UserID");
            header("Location: ../Questions/Qlist.php");
            if (! $SQL) {
                "ERROR : " . mysqli_error($db);
                exit;
            }
        } else {
            header("Location: /");
        }
    }else {
        header("Location: /");
    }
}elseif ($func == md5("deleteuser")) {
    if ($Config_rank >= 2) {
        if (isset($_GET['id'])) {
            $UserID = $_GET['id'];
            $query = mysqli_query($db , "DELETE FROM `users` WHERE `id` = '$UserID' ");
            header("Location: ../Manage/list.php");
            if (! $query) {
                echo "ERROR : " . mysqli_error($db);
                exit;
            }
        } else {
            header("Location: /");
        }
    } else {
        header("Location: /");
    }
}elseif($func == md5("setrank")){
    if ($Config_rank >= 2) {
        if (isset($_GET['id'])) {
            if (isset($_GET['rank']) or $_GET['rank'] == 0) {
                $UserID = $_GET['id'];
                $UserRank = $_GET['rank'];
                $SQL = mysqli_query($db, "UPDATE users SET `rank` = $UserRank WHERE id = $UserID");
                header("Location: ../Manage/list.php");
                if (! $SQL) {
                    "ERROR : " . mysqli_error($db);
                    exit;
                }
            } else {
                header("Location: /");
            }
        } else {
            header("Location: /");
        }
    }else {
        header("Location: /");
    }
}elseif ($func == md5("deletefilm")) {
    if ($Config_rank >= 1) {
        if (isset($_GET['film'])) {
            $UserID = $_GET['film'];
            $query = mysqli_query($db , "DELETE FROM `film` WHERE `id` = '$UserID' ");
            header("Location: ../Manage/Flist.php");
            if (! $query) {
                echo "ERROR : " . mysqli_error($db);
                exit;
            }
        } else {
            header("Location: /");
        }
    } else {
        header("Location: /");
    }
}elseif($func == md5("deleteann")){
    if ($Config_rank >= 2) {
        if (isset($_GET['link'])) {
            $annLink = $_GET['link'];
            $query = mysqli_query($db , "DELETE FROM ann WHERE annLink = '$annLink' ");
            header("Location: ../");
            if (! $query) {
                echo "ERROR : " . mysqli_error($db);
                exit;
            }
        } else {
            header("Location: /");
        }
    } else {
        header("Location: /");
    }
}else {
    header("location: /");
}

?>