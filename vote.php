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

    #vote .form-control{
        width: 100%
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
$votingName=$votingInstnc->getById($_SESSION['votingid']);

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
        $getNot=2;
        header('location:vote.php?notification='.$getNot);
    }
    ?>

    <body>
    <div class="container" id="vote">
        <div class="col-md-4"></div>
        <div class="col-md-4">
            <div class="fragerunde">


        <?php
        echo "<h5>". $votingName['bezeichnung']."</h5>";
        echo "<h3>". $fragerunde['text']."</h3>"; ?>
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
            <?php
            echo "</div>


            <div class='col-md-12 vote-dot'>";
            $anzahlFragen=$countFragen['COUNT(*)'];
            $anzahlFragenready=$countfinished ['COUNT(*)'];
            for ($i = 0; $i < $anzahlFragen; $i++)
            {if ($i<$anzahlFragenready) {
                echo "<i class='fa fa-circle fa-stack-1x stack-done'></i>" ;
            }

            elseif ($i==$anzahlFragenready) { //Grafiken einfügen für die Navi
                echo "<i class='fa fa-circle fa-stack-1x stack-active'></i>";
            }

            else {
                echo "<i class='fa fa-circle fa-stack-1x stack-open'></i>";
            }

            }

            echo "
            </div>
            <div class='col-md-12 no-padding vote-logout'><a href='vote_logout.php' class='btn btn-danger vote-btn logout-btn'>Ausloggen</a></div>
            ";
            ?>

            </div>
        </form>
        <?php else:

        endif; ?>


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
        else {$getNot = "0";}
        header('location:vote.php?notification='.$getNot);

    }
    ?>

    <body>

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
            //Ausgabe der Warnung bei falsher Schlüsseleingabe
            if ($notification==0) {
                echo "<div class='notification'>";
                echo "Falscher Schlüssel";
                echo "</div>";
            }

            ?>
        </form>
        </div>


    </div>
    <?php require_once('include/footer.php'); ?>
    </body>

<?php endif; ?>

</html>