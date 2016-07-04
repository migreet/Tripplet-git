<!DOCTYPE html>
<html lang="de">
<body>

<?php
/**
 * Created by PhpStorm.
 * User: Mic
 * Date: 21.04.2016
 * Time: 21:42
 * Starten des Votings
 */

/**
 * Requires
 */
require_once("php/classes.php");
require_once("include/header.php");

/**
 * Session wird gestartet
 */
session_start();

/**
 * GETs
 */
$votingId=$_GET['id'];
$votingsent=$_POST['votingstart'];
$schluessel=$_POST['schluessel'];

/**
 * Instanzen
 */
$vorlesungInstnc = new vorlesung();
$votingInstnc = new voting();

$voting=$votingInstnc->getById($votingId);
$schluesselcheck=$votingInstnc->getByKey($schluessel);


/**
 * Sicherheitsabfrage
 */
if(!isset($_SESSION['login'])):
    header ('location: index.php');

else:
    /**
     * Rights Check
     */
    $usercheck=$votingInstnc->userCheck($votingId);
    if($usercheck['ID']!=$_SESSION['user_id']):
        header ('location: index.php');
    endif;

    /**
     * Ifabfrage für Schlüsseleingabe und Statusprüfung
     */
    if (isset($votingsent)):

    /**
    * Wenn Voting nicht gestartet UND Schlüssel ausgefüllt
    */
        if (empty($voting['schluessel'])):
            if (empty($schluesselcheck)):
                $voting = $votingInstnc->update($votingId, $schluessel);
                header('Location: start.php?id='.$votingId."&notification=4");
            else:
                header('Location: start.php?id='.$votingId."&notification=6");
            endif;
        else:
            $voting = $votingInstnc->update($votingId, NULL);
            header('Location: start.php?id='.$votingId."&notification=5");
        endif;
    endif;

    require_once("include/navigation.php");
    ?>

    <div class="container" id="start">
        <?php
        /**
        * Breadcrumb
        */
        $vorlesung = $vorlesungInstnc->getById($voting['ID_VORLESUNG']);
        echo"
            <div class='breadcrumb'>
                <i class='fa fa-angle-right'></i> <a href='index.php'>Vorlesungen</a> <a href='vorlesung.php?id=".$vorlesung['ID'] ."'>". $vorlesung['bezeichnung']. "</a> <i class='fa fa-angle-right'></i> ". $voting['bezeichnung'] ." starten
            </div>";
        ?>

    <h1>Voting <?php echo $voting['bezeichnung']; ?> starten</h1>
        <div class="col-md-4">
            <?php require_once('include/aside_start.php') ?>
            </div>
        <div class="col-md-8">

    <form name="registerform" class="form-horizontal" role="form" action="<?php $_SERVER['PHP_SELF'] ?>" method="post">
        <input type="hidden" value="1" name="votingstart">

    <?php
    /**
    * Button ändert sich bei klick
    */
    if (empty ($voting['schluessel'])):
    ?>
        <div class="form-group">
            <input type="text" class="form-control" name="schluessel" placeholder="Schlüssel" id="schluessel" required>
                <button type="submit" name="start" class="btn btn-default">starten</button>
        </div>
        <?php

        if ($_GET['notification']=="5"):
                echo "<div class='notifikation'>";
                echo "Das Voting wurde beendet.";
                echo "</div>";
        elseif ($_GET['notification']=="6"):
            echo "<div class='notifikation'>";
            echo "Dieser Schlüssel wird im Moment leider bereits verwendet!";
            echo "</div>";
        endif;

    else:
    ?>
        <div class="form-group">
            <input type="text" class="form-control" name="schluessel" placeholder="Schlüssel" id="schluessel" disabled>
        </div>
        <div class="form-group">
                <button type="submit" name="stop" class="btn btn-default">stoppen</button>
        </div>

        <?php
        if ($_GET['notification']=="4"):
        echo "<div class='notifikation'>";
        echo "Das Voting wurde erfolgreich gestartet.";
        echo "</div>";
        endif;

    endif;

    echo "
    </form>
        </div>
    </div>
</div>";

    require_once('include/footer.php');

endif;
?>

</body>
</html>

