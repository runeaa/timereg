<?php

include_once './database_info.php';

$conn = mysqli_connect($host, $user, $password, $database);
if($conn -> connect_errno){
    echo'Connection to database failed, please try again later.';
}else{
    echo 'Connected';
}

$userName = $_POST['userName'];
$userPassword = $_POST['userPassword'];
$userEmail = $_POST['userEmail'];

if($stmnt = $conn -> prepare("SELECT username from user where username = ?")){
   
  $stmnt -> bind_param('s',$userName);
   
   $stmnt -> execute();

   if($stmnt ->fetch()){
       session_start();
       $_SESSION['taken'] = 'true';
       header('location: ../newUser.php');
   }
   $_SESSION['taken'] = false;
   
   $stmnt ->close();
}

if(  $stmnt2 = $conn -> prepare("insert into user (username, password, email, status) values(?, ?, ?,1);")){
       echo 'ALSO HI';
    $stmnt2 -> bind_param('sss',$userName, $userPassword, $userEmail);
    $stmnt2 -> execute();
    $stmnt2 -> bind_result($result);
    header('location: ../reg_ok.php');
    $stmnt2 -> close();
}

mysqli_close($conn);



