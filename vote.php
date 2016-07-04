<!DOCTYPE html>
<html lang="de">
<body>

<?php
/**
 * Created by PhpStorm.
 * User: Mic
 * Date: 31.03.2016
 * Time: 14:12
 * Ausgabe des Votings für den Student
 */

/**
 * Requires
 */
require_once("include/header.php");
require_once("php/classes.php");

/**
 * Session wird gestartet
 */
session_start();

/**
 * GETs
 */
$schluessel=$_POST['schluessel'];
$schluesselsent=$_POST['schluesselsent'];
$fragerundeset=$_POST["fragerunde"];

/**
 * Instanzen
 */
$votingInstnc = new voting();
$auswertungInstnc = new auswertung();
$frageInstnc = new frage();
$antwortInstnc = new antwort();

$voting=$votingInstnc->getByKey($schluessel);
$frage = $frageInstnc->getByVotingId($voting['ID']);
$fragerunde=$auswertungInstnc->frageRunde($voting['ID'], $_SESSION['id']);
$votingName=$votingInstnc->getById($_SESSION['votingid']);

/**
 * Abfrage damit nur nichteingeloggte User voten können
 */
if ($_SESSION['rights']>0):
    header ('location: index.php');
endif;

/**
 * Wenn SessionID und VotingID gesetzt, dann Fragerunde initialisieren
 */
if (isset($_SESSION['id']) && isset($_SESSION['votingid'])):

    /**
     *leere Auswertungsdatensätze werden gesucht und in $fragerunde geschrieben
     */
    $fragerunde=$auswertungInstnc->frageRunde($_SESSION['votingid'], $_SESSION['id']);

    /**
     * Antworten zu entsprechenden Fragen werden ausgelesen
     */
    $antwort = $antwortInstnc->getByFragenId($fragerunde['ID_FRAGE']);

    /**
     * zählen der gesammten und beantworteten Fragen
     */
    $countFragen=$auswertungInstnc->countFragen(0,$_SESSION['votingid'],$_SESSION['id']);
    $countfinished=$auswertungInstnc->countFragen(1,$_SESSION['votingid'],$_SESSION['id']);

    /**
     * Auswertung der eingegebenen Daten, Update der Fragerunde
     */
    if (isset($fragerundeset)):
        $eintragID = trim(stripslashes (htmlentities($_POST['antwort'], ENT_QUOTES, "UTF-8")));
        $auswertungInstnc->update($fragerunde['ID_FRAGE'], $_SESSION['id'], $eintragID);
        header('location:vote.php');
    endif;
    ?>

    <div class="container" id="vote">
        <div class="col-md-4"></div>
        <div class="col-md-4">
            <div class="fragerunde">


        <h5><?php echo $votingName['bezeichnung'] ?></h5>
        <h3> <?php echo $fragerunde['text'] ?></h3>
        <form method="post" action="<?php $_SERVER['PHP_SELF'] ?>" >
            <ul class="list-group">
            <?php
            /**
             * Gibt Antworten zur passenden Frage aus
             */
            if (!empty($antwort)):
                foreach ($antwort as $eintrag) {

                    echo "<input value='" . $eintrag['ID'] . "' id='" . $eintrag['ID'] . "' type='radio' name='antwort'>
                    <label for='". $eintrag['ID'] ."' class='list-group-item'>
                        <span class='fa-stack'>
                            <i class='fa fa-circle fa-stack-1x'></i>
                            <i class='fa fa-check-circle fa-stack-2x'></i>
                        </span>"
                        . $eintrag['text'] .
                    "</label>";

                }
            ?>
            <input type='hidden' value='1' name='fragerunde'>
                <input type="submit" class="list-group-item vote-sbmt-btn">
                </ul>
            </div>


            <div class='col-md-12 vote-dot'>
            <?php
            /**
             * Bullet Navigation
             */
            $anzahlFragen=$countFragen['COUNT(*)'];
            $anzahlFragenready=$countfinished ['COUNT(*)'];
            for ($i = 0; $i < $anzahlFragen; $i++) {
                if ($i<$anzahlFragenready):
                    echo "<i class='fa fa-circle fa-stack-1x stack-done'></i>" ;

                elseif ($i==$anzahlFragenready):
                    echo "<i class='fa fa-circle fa-stack-1x stack-active'></i>";

                else:
                    echo "<i class='fa fa-circle fa-stack-1x stack-open'></i>";

                endif;
            }
            echo "DEBUG:";
            print_r($_SESSION);
            echo "FRAGERUNDE";
            print_r($fragerunde);
            ?>

            </div>
                <div class='col-md-12 no-padding vote-logout'><a href='vote_logout.php' class='btn btn-danger vote-btn logout-btn'>Ausloggen</a>
                </div>
            </div>
        </form>

        <?php
        /**
         * wenn keine leeren Fragen mehr vorhanden sind wird man automatisch ausgeloggt, Voting wird beendet
         */
        else:
            header('location:vote_logout.php');
        endif; ?>


    </div>
        <div class="vote-footer">
            <?php require_once('include/footer.php');
            echo "</div>"; ?>
    </body>
<?php
/**
 * Login check
 */
else:
    if (isset($schluesselsent)):

        if ($schluessel==$voting['schluessel']):

            if (!isset($_SESSION['id'])):
            $_SESSION['id']= uniqid();

                /**
                 * Leerer Auswertungdatensatz mit Session ID wird erstellt, je nach Anzahl der Fragen
                 */
                foreach ($frage as $eintrag) {
                    $auswertungInstnc->createAuswertung($eintrag['ID'],$_SESSION['id']);
                }

            endif;

            $_SESSION['rights']= 0;
            $_SESSION['votingid']= $voting['ID'];
        header('location:vote.php');

        else :
        header('location:vote.php?notification='."0");

        endif;

    endif;
    ?>

    <div class="container" id="vote">
    <div class="col-md-4">
    </div>
        <div class="col-md-4">
        <h3>Schlüssel eingeben</h3>

        <form name="signinform" class="form-inline"  action="<?php $_SERVER['PHP_SELF'] ?>" method="post">
            <ul class="list-group">
                <label class="sr-only" for="schluessel">Schlüssel</label>
                <input type="password" class="form-control" name="schluessel" id="schluessel" placeholder="Schlüssel" required>
                <input type="hidden" value="1" name="schluesselsent">
            </ul>
            <div>
            <button type="submit" name="login" class="btn btn-danger vote-btn logout-btn">Einschreiben</button>
            </div>

            <?php
            /**
             * Ausgabe der Notifikationen
             */
            if ($_GET['notification']=="0"):
                echo "<div class='notifikation'>";
                echo "Falscher Schlüssel";
                echo "</div>";
            elseif ($_GET['notification']=="2"):
                echo "<div class='notifikation'>";
                echo "Voting beendet. Vielen Dank für Ihre Teilnahme!";
                echo "</div>";
            endif;
            print_r($_SESSION);
            print_r();
            ?>
        </form>
        </div>


    </div>
    <div class="vote-footer">
    <?php require_once('include/footer.php');
    echo "</div>";
endif;
?>

</body>
</html>