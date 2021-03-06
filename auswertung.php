<?php
/**
 * Created by PhpStorm.
 * User: Mic
 * Date: 31.03.2016
 * Time: 14:12
 */
?>

<!DOCTYPE html>
<html lang="de">
<body>


<?php require_once("include/header.php");
require_once("php/classes.php");

/**
 * GETs
 */
$ID_Voting=$_GET['id'];
$postVoting=$_POST["votingcreate"];

/**
 * Instanzen
 */
$vorlesungInstnc = new vorlesung();
$antwortInstnc = new antwort();
$votingInstnc = new voting();
$frageInstnc = new frage();
$auswertungInstnc = new auswertung();

/**
 * Session starten
 */
session_start();

$frageCreate=$_POST["fragecreate"];
$frageText = trim(stripslashes (htmlentities($_POST["frage"], ENT_QUOTES, "UTF-8")));

/**
 * Rights Check
 */
$usercheck=$votingInstnc->userCheck($ID_Voting);
if($usercheck['ID']!=$_SESSION['user_id']):
    header ('location: index.php');
endif;

if (isset($frageCreate)):

    if (!empty ($frageText)):
        $frageInstnc = new frage();
        $frage = $frageInstnc->createFrage($frageText, $ID_Voting);
        header('Location: voting.php?id=' .$ID_Voting);
        echo "<div> Die Frage wurde eingereicht</div>";
    else:
        echo "<div> Es ist ein Problem beim einreichen der Frage aufgetreten. Wenden Sie sich bitte an den Administrator.</div>";
    endif;
        $antwort= array ();
        for ($i = 0; $i <= 9; $i++){
            if (!empty (trim(stripslashes (htmlentities($_POST["antwort" . $i], ENT_QUOTES, "UTF-8"))))):
                $antwortText = trim(stripslashes (htmlentities($_POST["antwort" . $i], ENT_QUOTES, "UTF-8")));
                $antwort = $antwortInstnc->createAntwort($antwortText, $frage);
            endif;
        }
endif;


if (isset($postVoting)):
    $bezeichnung = trim(stripslashes (htmlentities($_POST["bezeichnung"], ENT_QUOTES, "UTF-8")));
    $schluessel= trim(stripslashes (htmlentities($_POST["schluessel"], ENT_QUOTES, "UTF-8")));
    $vorlesungsId= trim(stripslashes (htmlentities($_GET["id"], ENT_QUOTES, "UTF-8")));
    if (!empty ($bezeichnung)):
        $voting = $votingInstnc->createVoting($bezeichnung, $schluessel, $vorlesungsId);
        echo "<div> Die Registrierung war erfolgreich!</div>";
        header('Location: vorlesung.php?id='.$ID_Voting);
    else: echo "<div> Registrierung nicht erfolgreich! Wenden Sie sich bitte an den Administrator.</div>";
    endif;
endif;

if(!isset($_SESSION['login'])):
    header ('location: index.php');
else: ?>
    <?php require_once("include/navigation.php");
    $voting=$votingInstnc->getById($ID_Voting);
    ?>
    <div class="container" id="auswertung">
        <?php
            /**
            * Breadcrumb
            */
            $vorlesung = $vorlesungInstnc->getById($voting['ID_VORLESUNG']);
            echo"
            <div class='breadcrumb'>
            <i class='fa fa-angle-right'></i> <a href='index.php'>Vorlesungen</a> <i class='fa fa-angle-right'></i> <a href='vorlesung.php?id=".$vorlesung['ID'] ."'>". $vorlesung['bezeichnung']. "</a> <i class='fa fa-angle-right'></i> Auswertung zu ". $voting['bezeichnung'] ."
            </div>";
        ?>
        <h1> Auswertung <?php echo $voting['bezeichnung']; ?></h1>
        <div class="col-md-4">
        <?php require_once('include/aside_auswertung.php');
        echo "
            </div>
            <div class='col-md-8'>";

            /**
             * Ausgeben der Fragen zur passenden Voting ID
             */
            $voting = $frageInstnc->getByVotingId($ID_Voting);
            if (!empty ($voting)):
                foreach ($voting as $eintrag) {
                    echo "
                    <div class='list-entry'>
                    <div class='col-md-10'>";
                    $anzahlTeilnehmer=$auswertungInstnc->countTeilnehmer($eintrag['ID']);
                    echo "<h3>" . $eintrag['text'] . " (" . $anzahlTeilnehmer['COUNT(*)'] . " Teilnehmer)"."   <a href='beamer.php?id=". $eintrag['ID'] ."' target='_blank' class='btn btn-success'>Beam me up!</a></h3></br>";

                    /**
                    * Ausgabe der Antworten zu der passenden Frage
                    */
                    $antwort=$antwortInstnc->getByFragenId($eintrag['ID']);
                    foreach ($antwort as $eintragFrage) {
                        $anzahlAntworten=$auswertungInstnc->countAntworten($eintragFrage['ID']);
                        $percent = 0;
                        if(intval($anzahlTeilnehmer['COUNT(*)']!=0)):
                            $percent=round(100/intval($anzahlTeilnehmer['COUNT(*)'])*intval($anzahlAntworten['COUNT(*)']),2);
                        endif;
                        echo $eintragFrage['text'] ." (Stimmen: ". $anzahlAntworten['COUNT(*)']." | ".$percent."%)";
                        echo "
                        <div class='progress'>
                            <div class='progress-bar progress-bar-info' role='progressbar' aria-valuenow='$percent' aria-valuemin='0' aria-valuemax='100' style='width: $percent%'>
                                <span class='sr-only'>20% Complete</span>
                            </div>
                        </div>";
                    }
           echo "
            </div>
        </div>";
         }
    else:
        echo "Es sind keine Fragen vorhanden";
    endif;
    ?>

    </div>
    </div>

<?php
endif;
?>

</body>
</html>