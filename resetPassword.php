<?php
include './include/header.php';
?>
<div class="container">
    <div class="page-header">
        <h1>Tilbakestill passord</h1>
    </div>
    <div class="col-lg-6">
        <div class="pager">
            <form class="form-horizontal" method="post" action="db/dbNavigator.php">
                <input type="hidden" name="action" value="resetPass" />
                <div class="form-group">
                    <label class="col-sm-4 control-label">Epost</label>
                    <div class="col-sm-6">
                        <input type="email" class="form-control" name="userEmail" placeholder="Epost">
                    </div>
                </div>

                <button type="submit" name="submit" class="btn btn-default">Resett passord</button>
            </form>
            <p>Har du også glemt eposten? Ta kontakt med admin.</p>
        </div>
    </div>
    <div class="col-lg-6">
        <h3>Info</h3>
        <p>Dessvere fungerer ikke metoden for å resette passord. Det hjelper 
            derfor ikke å bruke denne siden. Send mail til <a href="mailto:outflanked@outlook.com">outflanked@outlook.com</a>
        eller ta kontakt med admin.</p>
    </div>
</div>
<?php
include './include/footer.php';
?>