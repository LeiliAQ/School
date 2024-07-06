<?php
require_once 'config.php';

function has_error($filed) {
    global $errors;
    return isset($errors[$filed]);
}

function get_error($filed) {
    global $errors;
    return has_error($filed) ? $errors[$filed] : null ; 
}
function request($filed) {
    return isset($_REQUEST[$filed]) && $_REQUEST[$filed] != "" ? trim($_REQUEST[$filed]) : null;
}
// type = must , type = not
// How To Use =>
// require_once './config/localFunctions.php';
// list($Config_username ,$Config_id ,$Config_question ,$Config_qkey ,$Config_rank ,$Config_email ,$Config_password ,$Config_score) = IfUserLogined('must');
function IfUserLogined($type) {
    global $db;
    if ($type == "must") {
        if (isset($_SESSION['UserEmail']) && isset($_SESSION['UserPass'])) {
            $CEmail = $_SESSION['UserEmail'];
            $CPass = $_SESSION['UserPass'];
            $IfUserLoginedMustQuery = mysqli_query($db , "SELECT * FROM users WHERE email = '$CEmail' AND password = '$CPass' ");
            if ($MustRows = mysqli_fetch_assoc($IfUserLoginedMustQuery)) {
                $Config_username = $MustRows["username"] ;
                $Config_id = $MustRows["id"];
                $Config_question = $MustRows["question"];
                $Config_qkey = $MustRows["Qkey"];
                $Config_rank = $MustRows["rank"];
                $Config_email = $MustRows["email"];
                $Config_password = $MustRows["password"];
                $Config_score = $MustRows["score"];
            }
            return [$Config_username , $Config_id , $Config_question , $Config_qkey , $Config_rank , $Config_email , $Config_password , $Config_score];
        } else {
            header("location: /");
        }
    }elseif ($type == "not") { 
        if (isset($_SESSION['UserEmail']) && isset($_SESSION['UserPass'])) {
            $CEmail = $_SESSION['UserEmail'];
            $CPass = $_SESSION['UserPass'];
            $IfUserLoginedMustQuery = mysqli_query($db , "SELECT * FROM users WHERE email = '$CEmail' AND password = '$CPass' ");
            if ($NotRows = mysqli_fetch_assoc($IfUserLoginedMustQuery)) {
                $Config_username = $NotRows["username"] ;
                $Config_id = $NotRows["id"];
                $Config_question = $NotRows["question"];
                $Config_qkey = $NotRows["Qkey"];
                $Config_rank = $NotRows["rank"];
                $Config_email = $NotRows["email"];
                $Config_password = $NotRows["password"];
                $Config_score = $NotRows["score"];
            }
            return [$Config_username , $Config_id , $Config_question , $Config_qkey , $Config_rank , $Config_email , $Config_password , $Config_score];
        }
    }
}

function MustAdmin ($mustrank) {
    global $db;
    if (isset($_SESSION['UserEmail']) && isset($_SESSION['UserPass'])) {
        $CEmail = $_SESSION['UserEmail'];
        $CPass = $_SESSION['UserPass'];
        $query = mysqli_query($db , "SELECT * FROM users WHERE email = '$CEmail' AND password = '$CPass' ");
        if ($rows = mysqli_fetch_assoc($query)) {
            $AdminRank = $rows['rank'];
        }
        if ($AdminRank < $mustrank) {
            header("location: /");
        }
    }else {
        header("location: /");
    }
}

?>