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
$schluessel=$_POST['schluessel'];

//Instanzen
$votingInstnc = new voting();
$voting=$votingInstnc->getById($votingId);
$schluesselcheck=$votingInstnc->getByKey($schluessel);


//Ifabfrage für Schlüsseleingabe und Statusprüfung
if (isset($votingsent)) {
//Wenn Voting nicht gestartet UND Schlüssel ausgefüllt
    if (empty($voting['schluessel']) && empty($schluesselcheck)){
            $voting = $votingInstnc->update($votingId, $schluessel);
            header('Location: start.php?id=' .$votingId);


        }
    else {
        $voting = $votingInstnc->update($votingId, NULL);
        header('Location: start.php?id=' .$votingId);
    }
    }

?>



<div>
Neues Voting starten

<form name="registerform" class="form-horizontal" role="form" action="<?php $_SERVER['PHP_SELF'] ?>" method="post">

    <div class="form-group">
            <input type="hidden" value="1" name="votingstart">
    </div>

<?php //Buttonänderung
if (empty ($voting['schluessel'])):
?>
    <div class="form-group">
        <input type="text" class="form-control" name="schluessel" placeholder="Schlüssel" id="schluessel" required>
    </div>
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


