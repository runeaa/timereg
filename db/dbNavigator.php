<?php
include_once '../../database_info.php';
include_once './dbFunctions.php';


if (isset($_POST['action'])) {
    switch($_POST['action']) {
        
    case 'login':
        $a = new functions();
        $b = $a -> connectDb($host, $user, $password, $database);
        $a ->checkLogin($b);
        $a -> closeDb($b);
        break; 
    
    case 'startTime':
        $a = new functions();
        $b = $a -> connectDb($host, $user, $password, $database);
        $a ->startTime($b);
        $a -> closeDb($b);
        break;
    
    case 'endTime':
        $a = new functions();
        $b = $a -> connectDb($host, $user, $password, $database);
        $a -> endTime($b);
        $a -> closeDb($b);
        break;
    
    case 'newUser':
        $a = new functions();
        $b = $a -> connectDb($host, $user, $password, $database);
        $a -> newUser($b);
        $a -> closeDb($b);
        break;
    
    case 'resetPass':
        $a = new functions();
        $b = $a -> connectDb($host, $user, $password, $database);
        $a ->getPassword($b);
        $a -> closeDb($b);
        break;
    }
}