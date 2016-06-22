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
$vorlesungInstnc = new vorlesung();
$votingInstnc = new voting();
$voting=$votingInstnc->getById($votingId);
$schluesselcheck=$votingInstnc->getByKey($schluessel);


//Ifabfrage für Schlüsseleingabe und Statusprüfung
if (isset($votingsent)) {
//Wenn Voting nicht gestartet UND Schlüssel ausgefüllt
    if (empty($voting['schluessel'])){
        if (empty($schluesselcheck)){
            $voting = $votingInstnc->update($votingId, $schluessel);
            header('Location: start.php?id=' .$votingId);
        }
        else{
            echo "Dieser Schlüssel wird im Moment leider bereits verwendet!";
        }

        }
    else {
        $voting = $votingInstnc->update($votingId, NULL);
        header('Location: start.php?id=' .$votingId);
    }
    }

require_once("include/navigation.php");
?>



<div class="container">
    <?php
    //Breadcrumb
    $vorlesung = $vorlesungInstnc->getById($voting['ID_VORLESUNG']);
    echo"
        <div class='breadcrumb'>
        > <a href='index.php'>Vorlesungen</a> > <a href='vorlesung.php?id=".$vorlesung['ID'] ."'>". $vorlesung['bezeichnung']. "</a> > ". $voting['bezeichnung'] ." starten
        </div>";
    ?>
<h1>Voting <?php echo $voting['bezeichnung']; ?> starten</h1>
    <div class="col-md-8">

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
</div>


