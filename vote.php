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

<?php
require_once("include/header.php");
?>

<style>

    /* Hidding the radiobuttons & checkboxes */
    input[type="radio"], input[type="checkbox"] {
        display: none;
    }
    /* Hidding the "check" status of inputs */
    input[type="radio"] + label .fa-check-circle,
    input[type="checkbox"] + label .fa-check  {
        display: none;
    }
    /* Styling the "check" status */
    input[type="radio"]:checked + label .fa-check-circle,
    input[type="checkbox"]:checked + label .fa-check {
        display: block;
        color: DarkTurquoise;
    }
    /* Styling checkboxes */
    input[type="checkbox"]:checked + label .fa-check {
        position: relative;
        left: .125em;
        bottom: .125em;
    }
    /* Styling radiobuttons */
    input[type="radio"]:checked + label .fa-circle {
        display: none;
        color: DarkTurquoise;
    }
    input[type="radio"] + label .fa-circle {
        color: DarkTurquoise;
    }

    .footer{
    position: absolute;
    bottom: 0;
    width: 100%;
    height: 60px;
    background-color: #f5f5f5;
    }

</style>




<?php

require_once("php/classes.php");

session_start();

//GETs & POSTs
$schluessel=$_POST['schluessel'];
$schluesselsent=$_POST['schluesselsent'];
$fragerundeset=$_POST["fragerunde"];
$notification=$_GET['notification'];

//Instanzen
$votingInstnc = new voting();
$auswertungInstnc = new auswertung();
$frageInstnc = new frage();
$antwortInstnc = new antwort();
$voting=$votingInstnc->getByKey($schluessel); //ZU TUN::: Abfrage ob gleicher Schlüssel in der DB gerade aktiv ist!
$frage = $frageInstnc->getByVotingId($voting['ID']);
$fragerunde=$auswertungInstnc->frageRunde($voting['ID'], $_SESSION['id']);

//debug section
/*
echo"<br />=== voting === <br />";
print_r($voting)."<br />";
echo"<br />=== frage === <br />";
print_r($frage) ."<br />";
echo "<br />=== fragerunde === <br />";
print_r($fragerunde)."<br />";
echo "<br />=== Session === <br />";
print_r( $_SESSION);
*/

if ($_SESSION['rights']>0){
    header ('location: index.php');
}

if (isset($_SESSION['id']) && isset($_SESSION['votingid'])):

    $fragerunde=$auswertungInstnc->frageRunde($_SESSION['votingid'], $_SESSION['id']);
    $antwort = $antwortInstnc->getByFragenId($fragerunde['ID_FRAGE']);
    $countFragen=$auswertungInstnc->countFragen(0,$_SESSION['votingid'],$_SESSION['id']);
    $countfinished=$auswertungInstnc->countFragen(1,$_SESSION['votingid'],$_SESSION['id']);

    if (isset($fragerundeset)) {
        $eintragID = trim(stripslashes (htmlentities($_POST['antwort'], ENT_QUOTES, "UTF-8")));
        $auswertungInstnc->update($fragerunde['ID_FRAGE'], $_SESSION['id'], $eintragID);
        header('location:vote.php');
    }
    ?>

    <body>
    <div class="container" id="vote">
        <div class="col-md-4"></div>
        <div class="col-md-4">
            <div class="fragerunde">

        <?php echo "<h3>". $fragerunde['text']."</h3>"; ?>
        <form method="post" action="<?php $_SERVER['PHP_SELF'] ?>" >
            <ul class="list-group">
            <?php
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
            echo "<input type='hidden' value='1' name='fragerunde'>";
            ?>
                <input type="submit" class="list-group-item vote-sbmt-btn">
                </ul>
            </div>
        </form>
        <?php else: ?>
        Du hast alle Fragen beantwortet! :) <br>
        <?php endif; ?>
        <?php
        echo "</div>
        <div class='col-md-3'></div><div>
        <div class='col-md-1'><a href='vote_logout.php' class='btn btn-danger vote-btn'>Ausloggen</a></div>
        <div class='container vote-navi'><div class='col-md-4'></div><div class='col-md-4 col-xs-12'>";
        $anzahlFragen=$countFragen['COUNT(*)'];
        $anzahlFragenready=$countfinished ['COUNT(*)'];
        for ($i = 0; $i < $anzahlFragen; $i++)
        {if ($i<$anzahlFragenready) {
            echo "<i class='fa fa-circle fa-stack-2x stack-done'></i>" ;
        }

        elseif ($i==$anzahlFragenready) { //Grafiken einfügen für die Navi
            echo "<i class='fa fa-circle fa-stack-2x stack-active'></i>";
        }

        else {
            echo "<i class='fa fa-circle fa-stack-2x stack-open'></i>";
        }

        }
        echo "</div></div><div class='col-md-4'></div>";
        ?>

    </div>

    </body>
<?php else:
    if (isset($schluesselsent)) {
        if ($schluessel==$voting['schluessel']){
            if (!isset($_SESSION['id'])){
            $_SESSION['id']= uniqid();
                foreach ($frage as $eintrag) {
                    $auswertungInstnc->createAuswertung($eintrag['ID'],$_SESSION['id']);
                }
            }
            $_SESSION['rights']= 0;
            $_SESSION['votingid']= $voting['ID'];
        header('location:vote.php');
        }
        else {$getNot = "Falscher Schlüssel";}
        header('location:vote.php?notification=' . $getNot);

    }
    ?>

    <body>

    <div class="container" id="vote">

        <h1 style="text-align: center;">Schlüssel eingeben</h1>

        <form name="signinform" class="form-inline" style="padding-top: 7px;" action="<?php $_SERVER['PHP_SELF'] ?>" method="post">
            <div class="form-group">
                <label class="sr-only" for="schluessel">Schlüssel</label>
                <input type="password" class="form-control" name="schluessel" id="schluessel" placeholder="Schlüssel" required>
                <input type="hidden" value="1" name="schluesselsent">
            </div>
            <div>
            <button type="submit" name="login" class="btn btn-default">Einschreiben</button>
            </div>
            <?php
            //Ausgabe der Warnung bei falsher Schlüsseleingabe
            echo $notification;
            ?>
        </form>

    </div>

    </body>

<?php endif; ?>

</html>