<?php

header("Content-type: text/html; charset=utf-8");
include_once 'password.php';

class functions {

    function connectDb($host, $user, $password, $database) {
        $conn = mysqli_connect($host, $user, $password, $database);

        if ($conn->connect_errno) {
            echo'Connection to database failed, please try again later.';
            die();
        }
        if (!$conn->set_charset("utf8")) {
            printf("Error loading character set utf8: %s\n", $mysqli->error);
        }
        return $conn;
    }

    function closeDb($conn) {
        mysqli_close($conn);
    }

    function getSessionName() {
        if (session_status() == PHP_SESSION_NONE) {
            session_start();
        }
        if (isset($_SESSION['user'])) {
            return $_SESSION['user'];
        } else {
            return null;
        }
    }

    function getDateTime($out) {
        $timezone = date_default_timezone_get();
        date_default_timezone_set($timezone);
        if ($out == true) {
            $time = date('Y-m-d', time());
        } else {
            $hour = date("H", time());
            $minute = date("i", time());
            if ($minute <= 15) {
                $minute = '00';
            } else if ($minute >= 45) {
                $minute = '00';
                $hour++;
            } else {
                $minute = '30';
            }
            $time = date('Y-m-d', time()) . ' ' . $hour . ':' . $minute;
        }
        return $time;
    }

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

    function checkLogin($conn) {
        $userName = $_POST['user'];
        $userPassword = $_POST['password'];
        $pass = null;
        $salt = null;
        if ($stmnt = $conn->prepare("SELECT password, salt, status from user where username = ?")) {
            $stmnt->bind_param('s', $userName);
            $stmnt->execute();
            $stmnt->bind_result($pass, $salt, $status);
            if ($stmnt->fetch()) {
                $inputPass = pbkdf2('SHA256', $userPassword, $salt, 1000, 50);
                if ($pass == $inputPass) {
                    session_start();
                    $_SESSION['user'] = $userName;
                    if ($status == 1) {
                        $_SESSION['status'] = 1;
                    }
                    header('location: ../login_success.php');
                } else {
                    header('location: ../error.php');
                }
            } else {
                header('location: ../error.php');
            }
            $stmnt->close();
        }
    }

    function startTime($conn) {
        $time = $this->getDateTime(false);
        $ip = $this->get_client_ip();
        $user = $this->getSessionName();

        if ($stmnt = $conn->prepare("INSERT into timeliste(username, checkIn, checkOut, ip, comment) VALUES (?, ?, '0000-00-00 00:00:00', ?, '')")) {
            $stmnt->bind_param('sss', $user, $time, $ip);
            $stmnt->execute();
            $stmnt->close();
            header('location:../registration_success.php');
        } else {
            header('location: ../error.php');
        }
    }

    function endTime($conn) {
        $check = $this->getDateTime(true);
        $time = $this->getDateTime(false);
        $comment = $_POST['comment'];
        $user = $this->getSessionName();

        if ($stmnt = $conn->prepare("UPDATE timeliste set checkOut = ?, comment = ? where username = ? and DATE(checkIn) = ?")) {
            $stmnt->bind_param('ssss', $time, $comment, $user, $check);
            $stmnt->execute();
            $stmnt->close();
            header('location: ../registration_success.php');
        } else {
            header('location: ../error.php');
        }
    }

    function getPassword($conn) {
        $userEmail = $_POST['userEmail'];
        if ($stmnt = $conn->prepare("SELECT password from user where email = ?")) {
            $stmnt->bind_param('s', $userEmail);
            $stmnt->execute();
            $stmnt->bind_result($col1);
            if ($stmnt->fetch()) {
                $pass = "Beklager, denne funksjonen er for tiden ute av drift. Vennlist kontakt admin.";
                $message = 'Passordet ditt er ' . $pass;
                mail($userEmail, 'Innloggings informasjon', $message);
                header('location: ../skrivPass.php');
            } else {
                header('location: ../error.php');
            }
            $stmnt->close();
        }
    }

    function checkUser($userName, $conn) {
        $bool = false;
        if ($stmnt = $conn->prepare("SELECT username from user where username = ?")) {
            $stmnt->bind_param('s', $userName);
            $stmnt->execute();

            if ($stmnt->fetch()) {
                $bool = true;
            }
            $stmnt->close();
        }
        return $bool;
    }

    function newUser($conn) {
        $userName = $_POST['userName'];
        $userPassword = $_POST['userPassword'];
        $userPasswordCheck = $_POST['userPasswordCheck'];
        if ($userPassword == $userPasswordCheck) {
            $salted = base64_encode(mcrypt_create_iv(PBKDF2_SALT_BYTE_SIZE, MCRYPT_DEV_URANDOM));
            $hasPassword = pbkdf2('SHA256', $userPassword, $salted, 1000, 50);
            $userEmail = $_POST['userEmail'];

            if (($this->checkUser($userName, $conn) == false && ($stmnt2 = $conn->prepare("insert into user (username, password, salt, email, status) values(?, ?, ?, ?, 0)")))) {
                $stmnt2->bind_param('ssss', $userName, $hasPassword, $salted, $userEmail);
                $stmnt2->execute();
                $stmnt2->close();
                header('location: ../reg_ok.php');
            } else {
                header('location: ../index.php');
            }
        } else {
            header('location: ../error.php');
        }
    }

    function getUserTime($conn) {
        $array = array();
        $name = $this->getSessionName();
        if (($stmnt = $conn->prepare("select checkIn, checkOut from timeliste where username =?"))) {
            $stmnt->bind_param('s', $name);
            $stmnt->execute();
            $stmnt->bind_result($in, $out);
            $i = 0;
            $total = 0;
            $this->getDateTime(false);
            while ($stmnt->fetch()) {
                $timestamp1 = strtotime($in);
                $timestamp2 = strtotime($out);
                if ($timestamp2 != 1391986800) {
                    $diff = $timestamp2 - $timestamp1;
                } else {
                    $diff = 0;
                }
                $total += $diff;
                //viser 1 time for mye, hvorfor?
                $worktime = date("H:i", $diff - 3600);
                $array[$i] = "Checkin: " . $in . " checkout: " . $out . " med " . $worktime . " timer jobbet.";
                $i++;
            }
            $array[$i] = "Du har totalt jobbet " .$this->calculateTime($total)." av 455 timer";//. gmdate("H:i", 311400 - 3600) . " timer av 455 timer.";
            $stmnt->close();
            return $array;
        }
    }
    
    function writeToText($conn){
        $fileName = date('d-m-Y').".txt";
        $fh = fopen($fileName, 'w') or die("cant open file");
        $stringData = $this->getUserTime($conn);
        echo 'Er inne i wrtite text';
        foreach ($stringData as $text){
            fwrite($fh, $text."\n");
        }
        fclose($fh);
//       header('location: ../time_stat.php');

    }
    
    function calculateTime($seconds){
        $seconds -= 3600;
        $hour = ( $seconds / 60) / 60;
        $min = ($hour - (int) $hour) * 60;
        $hour = (int) $hour;
        $min = (int) $min;
        $time = $hour." timer og ".$min." minutter";
        return $time;
    }

}
