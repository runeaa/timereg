<?php
include 'include/header.php';
include_once 'db/output.php';

if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
if (!isset($_SESSION['user'])) { //&& (strpos(get_client_ip(), '158.38') !== FALSE)) {
    header('location: login.php');
}
?>
<div class="container">
    <div class="col-lg-12">
        <h1>Oversikt over dine timer</h1>
        <ul>
        <?php
        $array = getTimeUser();
        
        foreach ($array as $a) {
            echo '<li>'.$a . '</li>';
        }
        ?>
        </ul>
    </div>


</div>
<?php
include './include/footer.php';
?>
