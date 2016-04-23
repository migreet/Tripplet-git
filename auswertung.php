<?php
/**
 * Created by PhpStorm.
 * User: Mic
 * Date: 31.03.2016
 * Time: 14:12
 */
/*include("include/sessioncheck.php");*/
?>

<!DOCTYPE html>
<html lang="de">


<?php require_once("include/header.php");
require_once("php/classes.php");

session_start();
//Instanzen
$antwortInstnc = new antwort();
$votingInstnc = new voting();
$frageInstnc = new frage();

//GETs
$ID_Voting=$_GET['id'];


//Voting Aside Logik
$frageCreate=$_POST["fragecreate"];
$frageText = htmlspecialchars($_POST["frage"], ENT_QUOTES, "UTF-8");


if (isset($frageCreate)) {

    if (!empty ($frageText)) {
        $frageInstnc = new frage();
        $frage = $frageInstnc->createFrage($frageText, $ID_Voting);
        header('Location: voting.php?id=' .$ID_Voting);
        echo "<div> Die Frage wurde eingereicht</div>";


    }
    else {echo "<div> Es ist ein Problem beim einreichen der Frage aufgetreten. Wenden Sie sich bitte an den Administrator.</div>";

    }

    //$antwort = htmlspecialchars($_POST["antwort"], ENT_QUOTES, "UTF-8");
    $antwort= array ();
    for ($i = 0; $i <= 9; $i++) {
        if (!empty (htmlspecialchars($_POST["antwort" . $i], ENT_QUOTES, "UTF-8"))){
            //$antwort[] = htmlspecialchars($_POST["antwort" . $i], ENT_QUOTES, "UTF-8");
            $antwortText = htmlspecialchars($_POST["antwort" . $i], ENT_QUOTES, "UTF-8");
            $antwort = $antwortInstnc->createAntwort($antwortText, $frage);

        }

    }




}

$postVoting=$_POST["votingcreate"];
if (isset($postVoting)) {
    $bezeichnung = htmlspecialchars($_POST["bezeichnung"], ENT_QUOTES, "UTF-8");
    $schluessel= htmlspecialchars($_POST["schluessel"], ENT_QUOTES, "UTF-8");
    $vorlesungsId= htmlspecialchars($_GET["id"], ENT_QUOTES, "UTF-8");

    if (!empty ($bezeichnung)) {
        $voting = $votingInstnc->createVoting($bezeichnung, $schluessel, $vorlesungsId);

        echo "<div> Die Registrierung war erfolgreich!</div>";

        header('Location: vorlesung.php?id='.$ID_Voting);
    }
    else {echo "<div> Registrierung nicht erfolgreich! Wenden Sie sich bitte an den Administrator.</div>";
        //header('Location: vorlesung.php'."?id=1");
    }
}



?>



<?php if(!isset($_SESSION['login'])):
    header ('location: index.php');?>

<?php else: ?>
    <body>
    <?php require_once("include/navigation.php");
    $voting=$votingInstnc->getById($ID_Voting);
    ?>

    <div class="container">
        <h1> Auswertung <?php echo $voting['bezeichnung']; ?></h1>
        <div class="col-md-8">
            <?php

            //Ausgeben der Fragen zur passenden Voting ID
            echo "<p><strong>Statistiken im Überblick</strong></p>";
            $voting = $frageInstnc->getByVotingId($ID_Voting);
            if (!empty ($voting)):
            foreach ($voting as $eintrag) {
            echo "
    <div class='list-entry'>
    <div class='col-md-7'>";

            echo " " . $eintrag['text'] . " ";
            echo " " . $eintrag['datum'] . " ";
            ?>

            <!--Ausgabe der Antworten zu der passenden Frage -->
            <?php
            $antwort=$antwortInstnc->getByFragenId($eintrag['ID']);
            foreach ($antwort as $eintragFrage) {

                echo $eintragFrage['text'];
            }
            ?>
        </div>

    </div>
    <?php }
    else:
        echo "Es sind keine Fragen vorhanden";
    endif;
    ?>

    </div>
    </div>
    </body>

<?php endif; ?>

</html>