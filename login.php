<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<?php
include './include/header.php';
?>
<div class="container">
    <div class="page-header">
        <h1>Timeregistrering</h1>
    </div>
    <div class="col-lg-8">
        <div class="pager">
            <form class="form-horizontal" role="form" id="login" method="post" action="db/dbNavigator.php">
                <input type="hidden" name="action" value="login" />

                <div class="form-group">
                    <label for="bruker" class="col-sm-4 control-label">Brukernavn</label>
                    <div class="col-sm-6">
                        <input type="text" class="form-control" name="user" placeholder="Brukkernavn">     
                    </div>
                </div>

                <div class="form-group">
                    <label class="col-sm-4 control-label"> Passord</label>
                    <div class="col-sm-6">
                        <input type="password" class="form-control"  name="password" placeholder="passord">
                    </div>
                </div>

                <br>
                <button type="submit" name="submit" class="btn btn-default"> Logg inn</button>
                </table>
            </form>

            <a style="color:red;">Passord sendes, og lagres, i klartekst</a>
            <br>
            <br>
            <a href="resetPassword.php">Glemt passord?</a>
        </div>
    </div>

    <?php
    include './include/footer.php';
    ?>