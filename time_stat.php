<?php
include 'include/header.php';
include_once 'db/output.php';
$admin = false;
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
if (!isset($_SESSION['user'])) { //&& (strpos(get_client_ip(), '158.38') !== FALSE)) {
    header('location: login.php');
}
if (isset($_SESSION['status'])) {
    $admin = true;
}
?>
<div class="container">
    <div class="col-lg-8">
        <h1>Timeoversikt</h1>
        <ul>
            <?php
            if ($admin == true) {
                ?><div class="jumbotron">
                    <h1>Kommer snart</h1>
</div>
            <?php
            } else {
                $array = getTimeUser();

                foreach ($array as $a) {
                    echo '<li>' . $a . '</li>';
                }
            }
            ?>
        </ul>
    </div>
    <div class="col-lg-4">
        <h3>Utvidelser</h3>
        <p>Foreløpig viser denne siden en enkel oversikt over hvor mye du har jobbet.
            Den vil bli utvidet på et senere tidspunkt.</p>

    </div>


</div>
<?php
include './include/footer.php';
?>
