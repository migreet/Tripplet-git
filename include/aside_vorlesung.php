<?php
<form class="form-horizontal" role="form" action="<?php $_SERVER['PHP_SELF'] ?>" method="post">
            <div class="form-group">
                <div class="col-sm-12">
                    <input type="text" class="form-control" name="bezeichnung" placeholder="Bezeichnnung" id="bezeichnung" required>
                </div>
                <input type="hidden" value="1" name="votingcreate">






                <div class="col-sm-12">
                    <button type="submit" class="btn btn-default">hinzuf�gen</button>
                </div>
            </div>
        </form>


/*
<div class="col-md-4 sidebar-left">
    Eine neues Voting hinzuf�gen!
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
            <button type="submit" class="btn btn-default">Voting hinzuf�gen</button>
        </div>
    </div>
</form>
*/

?>