<?php
include_once 'dbFunctions.php';
function getTimeUser(){
    include_once '../database_info.php';
    $a = new functions();
    $b = $a ->connectDb($host, $user, $password, $database);
    $temp = $a ->getUserTime($b);
    $a ->closeDb($b);
    return $temp;
}