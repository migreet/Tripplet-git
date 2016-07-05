<?php
/**
 * Created by PhpStorm.
 * User: Mic
 * Date: 21.04.2016
 * Time: 20:25
 * Sidebar Vorlesung
 */

/**
 * Sicherheitsabfrage
 * Formular zum Voting erstellen
 */
if(!isset($_SESSION['login'])):
    header ('location: ../index.php');

else:
?>

<div class="panel panel-default">
    <div class="panel-body">
        <img src="img/snap-hinweis.svg">
        <div class='side-text'>
            <p>Du hast die Möglichkeit Votings hinzuzufügen, zu bearbeiten und zu löschen. Auf <strong>Ergebnis</strong> kannst du die Resultate deiner Votings betrachten.</p>
        </div>
        <div class="sidebar-left">
            <form class="form-horizontal" role="form" action="<?php $_SERVER['PHP_SELF'] ?>" method="post">
                <div class="form-group">
                    <div class="col-sm-12">
                        <input type="text" class="form-control" name="bezeichnung" placeholder="Bezeichnnung" id="bezeichnung" required>
                    </div>
                        <input type="hidden" value="1" name="votingcreate">
                        <div class="col-sm-12">
                            <button type="submit" class="btn btn-default btn-max">Voting hinzufügen</button>
                        </div>
                </div>
            </form>
        </div>
    </div>
</div>

<?php endif;

require_once('include/footer.php');
?>
