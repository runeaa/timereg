<?php

include_once './database_info.php';

$timezone = date_default_timezone_get();
date_default_timezone_set($timezone);
$time = date('Y-m-d H:i:s', time());
$timeCheck = date('Y-m-d', time());

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
if ($conn->connect_errno) {
    echo'Connection to database failed, please try again later.';
} else {
    echo 'Connected';
}
session_start();
$comment = $_POST['comment'];

if ($stmnt = $conn->prepare("UPDATE timeliste set checkOut = ?, comment = ? where username = '" . $_SESSION['user'] . "'")) {
    $stmnt->bind_param('ss', $time, $comment);
    $stmnt->execute();
    header('location: ../registration_success.php');
    $stmnt->close();
}
mysqli_close($conn);



