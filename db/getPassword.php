<?php

include_once './database_info.php';

$change = false;
$conn = mysqli_connect($host, $user, $password, $database);
if($conn -> connect_errno){
    echo'Connection to database failed, please try again later.';
}else{
    echo 'Connected <br>';
}

$userEmail = $_POST['userEmail'];

if($stmnt = $conn -> prepare("SELECT password from user where email = ?")){

   $stmnt -> bind_param('s',$userEmail);
   $stmnt -> execute();
   
   $stmnt -> bind_result($col1);
    

   if($stmnt ->fetch()){
        $pass = $col1;
        $change = true;
   }
   echo $pass;
   $stmnt ->close();
}

$message = 'Passordet ditt er '.$pass;
mail($userEmail, 'Resettpassord', $message, 'timereg@runeaasv.tihlde.org');

if($change){
    header('location: ../skrivPass.php');
}

mysqli_close($conn);



