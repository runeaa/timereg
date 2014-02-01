<?php

include_once './database_info.php';

$timezone = date_default_timezone_get();
date_default_timezone_set($timezone);
$time = date('Y-m-d H:i:s', time());

function get_client_ip() {
    $ipaddress = '';
    if (getenv('HTTP_CLIENT_IP')) {
        $ipaddress = getenv('HTTP_CLIENT_IP');
    } else if (getenv('HTTP_X_FORWARDED_FOR')) {
        $ipaddress = getenv('HTTP_X_FORWARDED_FOR' & quot);
    } else if (getenv('HTTP_X_FORWARDED')) {
        $ipaddress = getenv('HTTP_X_FORWARDED');
    } else if (getenv('HTTP_FORWARDED_FOR')) {
        $ipaddress = getenv('HTTP_FORWARDED_FOR');
    } else if (getenv('HTTP_FORWARDED')) {
        $ipaddress = getenv('HTTP_FORWARDED');
    } else if (getenv('REMOTE_ADDR')) {
        $ipaddress = getenv('REMOTE_ADDR');
    } else {
        $ipaddress = 'UNKNOWN';
    }
    return $ipaddress;
}

$ip = get_client_ip();

$conn = mysqli_connect($host, $user, $password, $database);
if($conn -> connect_errno){
    echo'Connection to database failed, please try again later.';
}else{
    echo 'Connected';
}

session_start();
$username = $_SESSION['user'];


if($stmnt = $conn -> prepare("INSERT into timeliste(username, checkIn, checkOut, ip, comment) VALUES ('".$_SESSION['user']."', ?, '0000-00-00 00:00:00', ?, '')")){
   $stmnt -> bind_param('ss', $time, $ip);
//    $stmnt -> bind_param("?pass",$userPassword);
    $stmnt -> execute();
    $stmnt -> close();
    header('location:../registration_success.php');
}
mysqli_close($conn);



