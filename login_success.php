<?php

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

session_start();
if (!isset($_SESSION['user'])) { //&& (strpos(get_client_ip(), '158.38') !== FALSE)) {
    header('location: login.php');
}

if (isset($_GET['logout'])) {
    session_destroy();
    header('location:index.php');
}

function team() {
    $text = '';
    if (($_SESSION['user'] == 'Rune')) {
        $text = '<p>For å holde oversikt over sprintene er det sprintbrett på 
            <a href="http://www.visualstudio.com/en-us?fwLinkID=240160">visual studio</a> sine nettsider.</p>';
    }
    return $text;
}

include './include/header.php';
?>

<div class="container">
    <div class="page-header">
        <h1> Timeregistrering</h1>
    </div>

    <div class ="col-lg-4">
        <h4>Start dagen med å klokk inn.</h4>
        <form method="post" action="db/dbNavigator.php">
            <input type="hidden" name="action" value="startTime" />
            <button type="submit" name="send" class="btn btn-default btn-lg"> Klokk inn</button>
        </form>
    </div>
    <div class="col-lg-4">
        <h4>Ferdig for dagen? Skriv hva du har gjort, og klokk ut.</h4>
        <form method="post" action="db/dbNavigator.php">
            <input type="hidden" name="action" value="endTime" />
            <textarea class="form-control" name="comment" placeholder="Kommentar" required></textarea>
            <br>
            <button type="submit" name="send" class="btn btn-default">Klokk ut</button>

        </form>
    </div>

    <div class="col-lg-4">
        <h3>OBS</h3>
        <p>Husk å logge ut den dagen du logger inn!</p>
    </div>
    <div class="col-lg-4">
        <?php echo team(); ?>
    </div>
</div>
<?php
include './include/footer.php';
?>