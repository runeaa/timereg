<?php

include_once './database_info.php';

$conn = mysqli_connect($host, $user, $password, $database);
if($conn -> connect_errno){
    echo'Connection to database failed, please try again later.';
}else{
    echo 'Connected';
}
$userName = $_POST['user'];
$userPassword = $_POST['password'];
echo 'user '.$userName;

if($stmnt = $conn -> prepare("SELECT username from user where username = ? and password = ?")){
   $stmnt -> bind_param('ss',$userName, $userPassword);
//    $stmnt -> bind_param("?pass",$userPassword);
    $stmnt -> execute();
    $stmnt -> bind_result($result);
    
    if($stmnt -> fetch()){
        session_start();
        $_SESSION['user'] = $userName;
        header('location: ../login_success.php');
    }else{
        header('location:../index.php');
    }
    
    $stmnt -> close();
}
mysqli_close($conn);



