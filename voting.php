<!DOCTYPE html>
<html lang="de">
<body>
<?php
/**
 * Created by PhpStorm.
 * User: Mic
 * Date: 31.03.2016
 * Time: 14:12
 * Votings bearbeiten
 */

/**
 * Requires
 */
require_once("include/header.php");
require_once("php/classes.php");

/**
 * GETs
 */
$ID_Voting=$_GET['id'];
$notification=$_GET['notification'];
$frageCreate=$_POST["fragecreate"];
$frageText = trim(stripslashes (htmlentities($_POST["frage"], ENT_QUOTES, "UTF-8")));
$postVoting=$_POST["votingcreate"];

/**
 * Instanzen
 */
$vorlesungInstnc = new vorlesung();
$antwortInstnc = new antwort();
$votingInstnc = new voting();
$frageInstnc = new frage();

/**
 * Session wird gestartet
 */
session_start();

/**
 * Rights Check
 */
$usercheck=$votingInstnc->userCheck($ID_Voting);
if($usercheck['ID']!=$_SESSION['user_id']):
    header ('location: index.php');
endif;

/**
 *Validierung der Eingabe und Erstellung einer neuen Frage
 */
if (isset($frageCreate)):

    if (!empty ($frageText)):
        $frage = $frageInstnc->createFrage($frageText, $ID_Voting);
        header('Location: voting.php?id=' .$ID_Voting);

    else: $getNot = "Es ist ein Problem beim Einreichen der Frage aufgetreten. Wenden Sie sich bitte an den Administrator.";
        header('Location: voting.php?id=' .$ID_Voting .'?notification=' . $getNot);

    endif;
    /**
     * Einzelne Antworten werden in die Datenbank geschrieben
     */
    $antwort= array ();
    for ($i = 0; $i <= 9; $i++) {
        if (!empty (trim(stripslashes (htmlentities($_POST["antwort" . $i], ENT_QUOTES, "UTF-8"))))):
            $antwortText = trim(stripslashes (htmlentities($_POST["antwort" . $i], ENT_QUOTES, "UTF-8")));
            $antwort = $antwortInstnc->createAntwort($antwortText, $frage);

        endif;
    }

endif;

if(!isset($_SESSION['login'])):
    header ('location: index.php');

else:

    require_once("include/navigation.php");
    $voting=$votingInstnc->getById($ID_Voting);
    ?>

    <div class="container" id="voting">

        <?php
        /**
         * Breadcrumb
         */
        $vorlesung = $vorlesungInstnc->getById($voting['ID_VORLESUNG']);
        echo"
        <div class='breadcrumb'>
            <i class='fa fa-angle-right'></i> <a href='index.php'>Vorlesungen</a> <i class='fa fa-angle-right'></i> <a href='vorlesung.php?id=".$vorlesung['ID'] ."'> ". $vorlesung['bezeichnung']. "</a> <i class='fa fa-angle-right'></i> ". $voting['bezeichnung'] ." bearbeiten
        </div>";
        ?>

        <h1> Voting <?php echo $voting['bezeichnung']; ?></h1>
        <div class="col-md-4">
            <?php require_once('include/aside_voting.php');
            echo "$notification";
            ?>
        </div>
        <div class="col-md-8">

            <?php

            /**
             * Ausgeben der Fragen zur passenden Voting ID
             */
            echo "<p><strong>Fragen in diesem Voting</strong></p>";
            $voting = $frageInstnc->getByVotingId($ID_Voting);
            if (!empty ($voting)):
                foreach ($voting as $eintrag) { ?>
                <div class='col-md-12'>
                    <div class='col-md-7'>
                <?php
                echo " " . $eintrag['text'] . " ";
                echo " " . $eintrag['datum'] . " ";

                /**
                 * Ausgabe der Antworten zu der passenden Frage
                 */
                $antwort=$antwortInstnc->getByFragenId($eintrag['ID']);
                echo "<ul>";
                foreach ($antwort as $eintragFrage) {
                    echo "<li>" . $eintragFrage['text'] . "</li>";
                }
                echo "</ul>";
                ?>

                </div>
                    <div class="col-md-5">
                        <a href="do/voting_delete.php?id=<?php echo $eintrag['ID']. '&' .'idvoting='.$ID_Voting;?>" class="btn btn-danger">Löschen</a>
                    </div>
                </div>

                <?php
                }
    else:
        echo "Es sind keine Fragen vorhanden";

            endif;

    echo "</div>";
    require_once('include/footer.php');

endif;
?>

</body>
</html>