<?php

function checkLogin() {
    if (session_status() == PHP_SESSION_NONE) {
        session_start();
    }
    if (isset($_SESSION['user'])) {
        echo "<li><a href='login_success.php'>Logg timer</a></li>";
        echo "<li> <a href='time_stat.php'>Se tidsbruk</a></li>";
        echo "<li> <a href='login_success.php?logout=true'>Logg ut ".$_SESSION['user']."</a></li>";
    } else {
        echo "<li><a href='login.php'>Logg inn</a></li>";
        echo "<li><a href='newUser.php'>Registrer ny konto</a></li>";
    }
}
?>

<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
        
        <link href="res/dist/css/bootstrap.css" rel="stylesheet">
        <link rel="icon" href="res/icon/favicon.ico" type="image/x-icon">
        <title>Clocktime</title>
    </head>
    <body>
        <!-- Header bar -->
        <div class ="navbar navbar-default navbar-static-top">
            <div class ="container">
                <div class="navbar-header">
                    <a href="index.php" class="navbar-brand disabled"><img src="res/img/logo.png">Clocktime</a>
                    <button type="button" class="navbar-toggle" 
                            data-toggle="collapse" data-target="#navHeaderCollapse"> 
                        <span class="sr-only">Toggle navigations</span>
                        <span class ="icon-bar"></span>
                        <span class ="icon-bar"></span>
                        <span class ="icon-bar"></span>
                    </button>
                </div>
                
                <div class ="collapse navbar-collapse" id="navHeaderCollapse">
                    <ul class="nav navbar-nav navbar-right">
                        <?php checkLogin(); ?>
                    </ul>
                </div>
            </div>
        </div>
