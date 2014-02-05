<?php
include './include/header.php';
?>
<div class="container">
    <div class="page-header">
        <h1>Registrer ny bruker</h1>
    </div>
    <div class="col-lg-6">
        <div class="pager">
            <form class="form-horizontal" role="form" method="post" action="db/dbNavigator.php">
                <input type="hidden" name="action" value="newUser" />

                <div class="form-group">
                    <label for="brukernavn" class="col-sm-4 control-label">Ønsket brukernavn:</label>
                    <div class="col-sm-8">
                        <input type="text" class="form-control" name="userName" placeholder="Brukernavn">
                    </div>
                </div>

                <div class="form-group">
                    <label for="epost" class="col-sm-4 control-label">Skriv epostadressen:</label>
                    <div class="col-sm-8">
                        <input type="email" class="form-control" name="userEmail" placeholder="Epost">
                    </div>
                </div>

                <div class="form-group">
                    <label for="passord" class="col-sm-4 control-label">Skriv passord:</label>
                    <div class="col-sm-8"> 
                        <input type="password" class="form-control" name="userPassword" id="password" placeholder="passord">
                    </div>
                </div>
                
                <div class="form-group">
                    <label for="gPassord" class="col-sm-4 control-label">Gjennta passord:</label>
                    <div class="col-sm-8">
                        <input type="password" class="form-control" name="userPasswordCheck" placeholder="passord">
                    </div>
                </div>
                
                <div class="form-group">
                    <button type="submit" name="submit" class="btn btn-default">Registrer deg</button>
                </div>
            </form>
        </div>
    </div>
    <div class="col-lg-6">
        <h3>Passordsikkerhet</h3>
        <p>Det anbefales ikke å bruke passord som benyttes på andre sider. 
            Dette gjelder særdeles passord som brukes på nettbank/paypal. Lagringen
        av passord har nå blitt gjort sikrere ved å benytte salting og hashing. Derfor 
        kan du føle deg trygg på at andre ikke vil få tak i passordet ditt, hvertfall fra
        vår ende.</p>
    </div>
</div>
<?php
include './include/footer.php';
?>