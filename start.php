<?php
/**
 * Created by PhpStorm.
 * User: Mic
 * Date: 21.04.2016
 * Time: 21:42
 */


//Starten des Votings


//Requires
require_once("php/classes.php");
require_once("include/header.php");
session_start();

//POSTs & GETs
$votingId=$_GET['id'];
$votingsent=$_POST['votingstart'];
$schluessel=$POST['schluessel'];

//Instanzen
$votingInstnc = new voting();
$voting=$votingInstnc->getById($votingId);



//Ifabfrage für Schlüsseleingabe und Statusprüfung
if (isset($votingsent)) {
//Wenn Voting nicht gestartet UND Schlüssel ausgefüllt
    if (!empty ($voting['schluessel'])){
            $voting = $votingInstnc->update($votingId, $schluessel);
            header('Location: voting.php?id=' .$votingId);


        }
    else {
        $voting = $votingInstnc->update($votingId, '');
        header('Location: voting.php?id=' .$votingId);
    }
    }

//ZU TUN:::Status Abfragen --> wenn status=0 dann auf 1 updaten wenn er 1 ist dann auf 0 Updaten. Möglichkeit auf Counter Checke. Schlüssel löschen beim schließen.
?>



<div>
Neues Voting starten

<form name="registerform" class="form-horizontal" role="form" action="<?php $_SERVER['PHP_SELF'] ?>" method="post">
    <div class="form-group">
            <input type="text" class="form-control" name="schluessel" placeholder="Schlüssel" id="schluessel" required>
    </div>
    <div class="form-group">
            <input type="hidden" value="1" name="votingstart">
    </div>

<?php //Buttonänderung
if (empty ($voting['schluessel'])):
?>

    <div class="form-group">
            <button type="submit" name="start" class="btn btn-success">starten</button>
    </div>

<?php
else:
?>

    <div class="form-group">
            <button type="submit" name="stop" class="btn btn-danger">stoppen</button>
    </div>


<?php
endif;
?>
</form>
</div>


