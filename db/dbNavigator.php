<?php
include_once './dbFunctions.php';

if (isset($_POST['action'])) {
    switch($_POST['action']) {
        
    case 'login':
        $a = new functions();
        $b = $a -> connectDb();
        $a ->checkLogin($b);
        $a -> closeDb($b);
        break; 
    
    case 'startTime':
        $a = new functions();
        $b = $a -> connectDb();
        $a ->startTime($b);
        $a -> closeDb($b);
        break;
    
    case 'endTime':
        $a = new functions();
        $b = $a -> connectDb();
        $a -> endTime($b);
        $a -> closeDb($b);
        break;
    
    case 'newUser':
        $a = new functions();
        $b = $a -> connectDb();
        $a -> newUser($b);
        $a -> closeDb($b);
        break;
    
    case 'resetPass':
        $a = new functions();
        $b = $a -> connectDb();
        $a ->getPassword($b);
        $a -> closeDb($b);
        break;
    }
}

