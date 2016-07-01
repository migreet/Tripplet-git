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
$vorlesungInstnc = new vorlesung();
$antwortInstnc = new antwort();
$votingInstnc = new voting();
$frageInstnc = new frage();

//GETs
$ID_Voting=$_GET['id'];
$notification=$_GET['notification'];


//Voting Aside Logik
$frageCreate=$_POST["fragecreate"];
$frageText = trim(stripslashes (htmlentities($_POST["frage"], ENT_QUOTES, "UTF-8")));


if (isset($frageCreate)) {

    if (!empty ($frageText)) {
        $frageInstnc = new frage();
        $frage = $frageInstnc->createFrage($frageText, $ID_Voting);
        header('Location: voting.php?id=' .$ID_Voting);
        echo "<div> Die Frage wurde eingereicht</div>"; //Brauchen wir das?!


    }
    else {$getNot = "Es ist ein Problem beim Einreichen der Frage aufgetreten. Wenden Sie sich bitte an den Administrator.";
        header('Location: voting.php?id=' .$ID_Voting .'?notification=' . $getNot);
    }

    //$antwort = htmlspecialchars($_POST["antwort"], ENT_QUOTES, "UTF-8");
    $antwort= array ();
    for ($i = 0; $i <= 9; $i++) {
        if (!empty (trim(stripslashes (htmlentities($_POST["antwort" . $i], ENT_QUOTES, "UTF-8"))))){
            //$antwort[] = htmlspecialchars($_POST["antwort" . $i], ENT_QUOTES, "UTF-8");
            $antwortText = trim(stripslashes (htmlentities($_POST["antwort" . $i], ENT_QUOTES, "UTF-8")));
            $antwort = $antwortInstnc->createAntwort($antwortText, $frage);

        }

    }




}

$postVoting=$_POST["votingcreate"];
if (isset($postVoting)) {
    $bezeichnung = trim(stripslashes (htmlentities($_POST["bezeichnung"], ENT_QUOTES, "UTF-8")));
    $schluessel= trim(stripslashes (htmlentities($_POST["schluessel"], ENT_QUOTES, "UTF-8")));
    $vorlesungsId= trim(stripslashes (htmlentities($_GET["id"], ENT_QUOTES, "UTF-8")));

    if (!empty ($bezeichnung)) {
        $voting = $votingInstnc->createVoting($bezeichnung, $schluessel, $vorlesungsId);

        echo "<div> Die Registrierung war erfolgreich!</div>";

        header('Location: vorlesung.php?id='.$ID_Voting);
    }
    else {$getNot = "Registrierung nicht erfolgreich! Wenden Sie sich bitte an den Administrator.";
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

    <div class="container" id="voting">

        <?php
        //Breadcrumb
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

//Ausgeben der Fragen zur passenden Voting ID
            echo "<p><strong>Fragen in diesem Voting</strong></p>";
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
            echo "<ul>";
            foreach ($antwort as $eintragFrage) {

            echo "<li>" . $eintragFrage['text'] . "</li>";
            }
            echo "</ul>";

            ?>

        <div class="col-md-5"
        <!-- Fragenlöschen-->
        <a href="do/voting_delete.php?id=<?php echo $eintrag['ID']. '&' .'idvoting='.$ID_Voting;?>" class="btn btn-danger">Löschen</a>
        </div>

    <div class='col-md-12 seperator-line'>
    </div>
    <?php }
    else:
        echo "Es sind keine Fragen vorhanden";
    endif;
    ?>
    </div>
    </div>
    <?php require_once('include/footer.php'); ?>
    </body>

<?php endif; ?>

</html>