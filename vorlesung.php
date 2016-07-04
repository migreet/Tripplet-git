<!DOCTYPE html>
<html lang="de">
<body>

<?php
/**
 * Created by PhpStorm.
 * User: Mic
 * Date: 31.03.2016
 * Time: 14:12
 * Ausgabe der Votings
 */

/**
 * Requires
 */
require_once("include/header.php");
require_once("php/classes.php");

/**
 * GETs
 */
$ID_Vorlesung=$_GET['id'];
$postVoting=$_POST["votingcreate"];

/**
 * Instanzen
 */
$votingInstnc = new voting();
$vorlesungInstnc = new vorlesung();

/**
 * Session wird gestartet
 */
session_start();

/**
 * Abfrage ob Fomular abgesendet
 * Vorlseung wird erstellt
 */
    if (isset($postVoting)):
        $bezeichnung = trim(stripslashes (htmlentities($_POST["bezeichnung"], ENT_QUOTES, "UTF-8")));
        $vorlesungsId= trim(stripslashes (htmlentities($_GET["id"], ENT_QUOTES, "UTF-8")));

        if (!empty ($bezeichnung)):
            $voting = $votingInstnc->createVoting($bezeichnung, $vorlesungsId);
            echo "<div> Die Registrierung war erfolgreich!</div>";
            header('Location: vorlesung.php?id='.$ID_Vorlesung);

        else:
            echo "<div> Es ist ein Fehler aufgetreten! Wenden Sie sich bitte an den Administrator.</div>";

        endif;

    endif;

/**
 * Sicherhietsabfrage
 */
if(!isset($_SESSION['login'])):
	header ('location: index.php');
	
else:
require_once("include/navigation.php");
$vorlesung=$vorlesungInstnc->getById($ID_Vorlesung);

/**
 * Rights Check
 */
$usercheck=$vorlesungInstnc->userCheck($ID_Vorlesung);
if($usercheck['ID']!=$_SESSION['user_id']):
    header ('location: index.php');
endif;
?>

<div id="votingubersicht" class="container">
    <!-- Breadcrumb -->
    <div class='breadcrumb'>
        <i class='fa fa-angle-right'></i> <a href='index.php'>Vorlesungen</a> <i class='fa fa-angle-right'></i>
        <?php echo $vorlesung['bezeichnung']; ?>
    </div>
    <h1> <?php echo "Votingübersicht " . $vorlesung['bezeichnung']; ?></h1>
    <div class="col-md-4 sidebar">
        <?php require_once('include/aside_vorlesung.php'); ?>
    </div>
    <div class="col-md-8">

    <?php
    /**
     * Liste der Votings zur passenden VOrlesung wird generiert
     */
        $voting = $votingInstnc->getByVorlesungsId($ID_Vorlesung);
        if (!empty ($voting)):

            foreach ($voting as $eintrag) {
                echo "<div class='col-md-12'>
                        <div class='col-md-4'>";
                    echo $eintrag['bezeichnung'] . " ";
                    echo "</div> ";
                    echo " <div class='col-md-8'>";?>
                    <a href="start.php?id=<?php echo $eintrag['ID']?>" class="btn btn-default">starten</a>
                    <a href="voting.php?id=<?php echo $eintrag['ID']?>" type='button' class='btn btn-default'>bearbeiten</a>
                    <a href="do/vorlesung_delete.php?id=<?php echo $eintrag['ID']. '&' .'idvorlesung='.$ID_Vorlesung;?>" class="btn btn-default">löschen</a>
                    <a href="auswertung.php?id=<?php echo $eintrag['ID']?>" class="btn btn-default">Ergebnis</a>

                        </div>
                    </div>
    <?php
            }
        else:
            echo "
            <div class='col-md-12'>
            Es sind keine Votings Vorhanden
            </div>";
        endif;

    echo"</div>
</div>";

require_once('include/footer.php');

endif; ?>

</body>
</html>