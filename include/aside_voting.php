<?php
/**
 * Created by PhpStorm.
 * User: Mic
 * Date: 21.04.2016
 * Time: 20:25
 * Sidebar Voting
 */

/**
 * Sicherhietsabfrage
 * Ausgabe von Fragenerstellungsformular
 */
if(!isset($_SESSION['login'])):
    header ('location: ../index.php');

else:
?>

<div class="panel panel-default">
    <div class="panel-body">
        <div class="croc">
        <img src="img/snap-tipp.svg">
        </div>
        <div class='side-text'>
            <p>Füge Fragen mit bis zu sieben möglichen Antworten zu deinen Votings hinzu!</p>
        </div>
        <div id="aside_voting" class="sidebar-left">
            <div>
                <p><strong>Fügen sie eine neue Frage hinzufügen</strong></p>
            </div>
            <form class="form-horizontal" role="form" action="<?php $_SERVER['PHP_SELF'] ?>" method="post">
                <div class="form-group">
                    <div class="col-sm-12">
                        <input type="text" class="form-control" name="frage" placeholder="Frage" id="frage" required>
                    </div>
                    <div class="col-sm-12">
                        <input type="text" class="form-control" name="antwort0" placeholder="Antwort" id="antwort" required>
                    </div>
                    <div class="col-sm-12">
                        <input type="text" class="form-control" name="antwort1" placeholder="Antwort" id="antwort" required>
                    </div>
                    <div class="col-sm-12">
                        <input type="text" class="form-control" name="antwort2" placeholder="Antwort" id="antwort" >
                    </div>
                    <div class="col-sm-12">
                        <input type="text" class="form-control" name="antwort3" placeholder="Antwort" id="antwort" >
                    </div>
                    <div class="col-sm-12">
                        <input type="text" class="form-control" name="antwort4" placeholder="Antwort" id="antwort" >
                    </div>
                    <div class="col-sm-12">
                        <input type="text" class="form-control" name="antwort5" placeholder="Antwort" id="antwort" >
                    </div>
                    <div class="col-sm-12">
                        <input type="text" class="form-control" name="antwort6" placeholder="Antwort" id="antwort" >
                    </div>

                        <input type="hidden" value="1" name="fragecreate">
                    <div class="col-sm-12">
                        <button type="submit" class="btn btn-default btn-max">Frage hinzufügen</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>

<?php
endif;

require_once('include/footer.php');
?>
