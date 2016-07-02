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

require_once("php/classes.php");
require_once("include/header.php");
session_start();
?>


<!--if Schleife für Logincheck-->
    <?php if(!isset($_SESSION['login'])):?>
	
	<body>


<?php
require_once("include/navigation_login.php");
if ($_GET['notification']=="0"){
echo "<div class='col-md-offset-6 notifikation'>Bitte geben Sie eine korrekte Passwort und Emailadressenkombination ein.</div>";
}
?>

<!--Registrierungsformular-->
<div class="container" id="registrieren" >
    <div class="form-horizontal col-sm-offset-6">
    <h1>Registrieren</h1>
    </div>
    <form name="registerform" class="form-horizontal col-sm-offset-6 loginform" role="form" action="<?php $_SERVER['PHP_SELF'] ?>" method="post">
        <div class="form-group">
            <div class="col-sm-6">
                <input type="email"  class="form-control" name="mail" placeholder="Emailadresse" id="mail" required>
            </div>
        </div>
        <div class="form-group">
            <div class="col-sm-6">
                <input type="password" class="form-control" name="passwort" placeholder="Passwort" id="passwort" required>
            </div>
        </div>
        <div class="form-group">
            <div class="col-sm-6">
                <input type="text" class="form-control" name="vorname" placeholder="Vorname" id="vorname" required>
            </div>
        </div>
        <div class="form-group">
            <div class="col-sm-6">
                <input type="text" class="form-control" name="nachname" placeholder="Nachname" id="nachname" required>
                <input type="hidden" value="1" name="sentregister">
            </div>
        </div>


        <div class="form-group">
            <div class="col-sm-6">
                <button type="submit" name="registrieren" class="btn btn-default">Registrieren</button>
            </div>
        </div>

        <!--Notificationanzeige-->
        <?php
        if ($_GET['notification']=="3") {
            echo "<div class='col-md-6 notifikation'>Die Registrierung war erfolgreich. Sie werden in Kürze von einem Administrator freigeschaltet.</div>";
        }
        if ($_GET['notification']=="4") {
            echo "<div class='col-md-6 notifikation'>Registrierung nicht erfolgreich. Diese Emailadresse wurde bereits verwendet.</div>";
        }

        ?>
    </form>

    <?php
    //Validierung der POSTS
    if (isset($_POST["sentregister"])) {
        $vorname = trim(stripslashes (htmlentities($_POST["vorname"], ENT_QUOTES, "UTF-8")));
        $nachname = trim(stripslashes (htmlentities($_POST["nachname"], ENT_QUOTES, "UTF-8")));
        $passwort = hash("MD5", trim(stripslashes (htmlentities($_POST["passwort"], ENT_QUOTES, "UTF-8"))));
        $mail = trim(stripslashes (htmlentities($_POST["mail"], ENT_QUOTES, "UTF-8")));

        //Ifabfrage für Ausfüllcheck
        if (!empty ($mail) && !empty ($passwort) && !empty ($nachname) && !empty ($vorname)) {
            $dozentInstnc = new dozent();
            $dozent = $dozentInstnc->getByMail($mail);

            if (empty($dozent)) {
                $liste = $dozentInstnc->signup($nachname, $vorname, $passwort, $mail);
                header('location:index.php?notification='."3");
            } else {
                header('location:index.php?notification='."4");
            }
        }

    }


    ?>

</div>

</body>

	
    <!-- Elseblock für Ausgabe bei eigeloggten Zustand-->
    <?php else: ?>


        <body>
   <?php require_once("include/navigation.php");
$eintragManager = new vorlesung();
?>

<div class="container" id="vorlesungsubersicht">

    <!--Breadcrumb-->
    <div class="breadcrumb" >
    <i class="fa fa-angle-right"></i> Vorlesungen
    </div>

    <h1> Vorlesungen</h1>

    <div class="col-md-4">
        <?php require_once('include/aside_index.php'); ?>
    </div>

    <div class="col-md-8">
    <?php


    $liste = $eintragManager->getByDozentenId($_SESSION ['user_id']);
    if (!empty ($liste)) {


    foreach ($liste as $eintrag) {

        echo "<div  class='col-md-12'>";
            echo "<div class='col-md-4'>";
                echo $eintrag['bezeichnung'] . " ";
            echo "</div>";
            echo " <div class='col-md-8' >";
                echo "<a href='vorlesung.php?id=" . $eintrag['ID'] . "' class='btn btn-default'>Anzeigen</a>";
                echo "<a href='do/index_delete.php?id= ".$eintrag['ID']. "'class='btn btn-default'>Löschen</a>";
        echo "<a href='vorlesung.php?id=" . $eintrag['ID'] . "' class='btn btn-default'>Anzeigen</a>";
        echo "<a href='do/index_delete.php?id= ".$eintrag['ID']. "'class='btn btn-default'>Löschen</a>";
        echo"</div>";
        echo"</div>";

    }

    }
    else {
        echo "Es sind keine Vorlesungen Vorhanden";
    }
    ?>
    </div>


    </div>
    <?php require_once('include/footer.php'); ?>
   </body>
   
    <?php endif; ?>

</html>