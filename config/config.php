<?php 
// وصل شدن به مای اسکیوال
$db = mysqli_connect('localhost:3306', 'root' , '' , 'schoolwebsql');
if (! $db) {
    "ERROR : " . mysqli_connect_error();
    exit;
}
session_start();
?>