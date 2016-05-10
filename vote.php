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
    @import url(//netdna.bootstrapcdn.com/font-awesome/4.2.0/css/font-awesome.css);

    /* Hidding the radiobuttons & checkboxes */
    input[type="radio"], input[type="checkbox"] {
        display: none;
    }

    /* Hidding the "check" status of inputs */
    input[type="radio"] + label .fa-circle,
    input[type="checkbox"] + label .fa-check  {
        display: none;
    }

    /* Styling the "check" status */
    input[type="radio"]:checked + label .fa-circle,
    input[type="checkbox"]:checked + label .fa-check {
        display: block;
        color: DarkTurquoise;
    }

    /* Styling radiobuttons */
    input[type="radio"]:checked + label .fa-circle-o {
        display: block;
        color: DarkTurquoise;
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
    <a href='vote_logout.php' class='btn btn-danger vote-btn'>Ausloggen</a>
    <div class="container" id="vote">

        <h1>Fragerunde</h1>
        <?php echo $fragerunde['text']."<br>"; ?>
        <form method="post" action="<?php $_SERVER['PHP_SELF'] ?>" >
            <?php
            if (!empty($antwort)):
            foreach ($antwort as $eintrag) {

                echo "<input class='with-font' value='" . $eintrag['ID'] . "'type='radio' name='antwort'>". $eintrag['text'] . "<br />";

            }
            echo "<input type='hidden' value='1' name='fragerunde'>";
            ?>
            <input type="submit"> <br />
        </form>
        <?php else: ?>
        Du hast alle Fragen beantwortet! :) <br>
        <?php endif; ?>
        <?php echo "Beantwortete Fragen " .$countfinished ['COUNT(*)']; ?> <br>
        <?php echo "Gesamtfragen " .$countFragen['COUNT(*)']; ?> <br>
        <?php
        $anzahlFragen=$countFragen['COUNT(*)'];
        $anzahlFragenready=$countfinished ['COUNT(*)'];
        for ($i = 0; $i < $anzahlFragen; $i++)
        {if ($i<$anzahlFragenready) {
            echo "O" ;
        }

        elseif ($i==$anzahlFragenready) { //Grafiken einfügen für die Navi
            echo "x";
        }

        else {
            echo "o";
        }

        }

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