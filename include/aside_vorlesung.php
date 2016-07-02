

<div class="panel panel-default">
    <div class="panel-body">

        <div class='side-text'>
            <p>Hier steht ein Platzhaltertext</p>
        </div>

<div class="sidebar-left">
<form class="form-horizontal" role="form" action="<?php $_SERVER['PHP_SELF'] ?>" method="post">
            <div class="form-group">
                <div class="col-sm-12">
                    <input type="text" class="form-control" name="bezeichnung" placeholder="Bezeichnnung" id="bezeichnung" required>
                </div>
                <input type="hidden" value="1" name="votingcreate">






                <div class="col-sm-12">
                    <button type="submit" class="btn btn-default">hinzufügen</button>
                </div>
            </div>
        </form>

<?php
/*
<div class="col-md-4 sidebar-left">
    Eine neues Voting hinzufügen!
</div>
<form class="form-horizontal" role="form" action="<?php $_SERVER['PHP_SELF'] ?>" method="post">
    <div class="form-group">
        <div class="col-sm-12">
            <input type="text" class="form-control" name="bezeichnung" placeholder="Bezeichnnung" id="bezeichnung" required>
        </div>
        <div class="col-sm-12">
            <input type="text" class="form-control" name="schluessel" placeholder="Schluessel" id="schluessel" required>
            <input type="hidden" value="1" name="votingcreate">
        </div>

    </div>


    <div class="form-group">
        <div class="col-sm-12">
            <button type="submit" class="btn btn-default">Voting hinzufügen</button>
        </div>
    </div>
</form>
*/

?>
</div>
        </div>
    </div>