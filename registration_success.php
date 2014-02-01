<?php
session_start();
if (!isset($_SESSION['user'])) { //&& (strpos(get_client_ip(), '158.38') !== FALSE)) {
    header('location: index.php');
}

if (isset($_GET['logout'])) {
    session_destroy();
    header('location:index.php');
}
include './include/header.php';
?>

<div class ="container">
    <h3>Lagringen var vellykket.</h3>
    <p>Gå <a href="login_success.php">tilbake</a> eller <a href='registration_success.php?logout=true'>logg ut</a></p>
</div>
<?php
include './include/footer.php';
?>