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
        <p>Passordet lagres i klartekst, og derfor vil du få passordet tilsendt 
            på mail i klartekst. Dette er ikke optimalt for noen av partene og det
        jobbes med bedre løsninger.</p>
        <p>I fremtiden skal passordene sikres bedre, når det blir tilfellet vil 
        brukerne bli bedt om å lage ett nytt passord</p>
    </div>
</div>
<?php
include './include/footer.php';
?>