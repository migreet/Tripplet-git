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



    <?php if(!isset($_SESSION['login'])):?>
	
	<body>


<?php require_once("include/navigation_login.php"); ?>

<div class="loginform" >
    <div class="form-horizontal col-sm-offset-6">
    <h1>Registrieren</h1>
    </div>
    <form name="registerform" class="form-horizontal col-sm-offset-6" role="form" action="<?php $_SERVER['PHP_SELF'] ?>" method="post">
        <div class="form-group">
            <div class="col-sm-6">
                <input type="text" class="form-control" name="mail" placeholder="Emailadresse" id="mail" required>
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
    </form>

    <?php
    if (isset($_POST["sentregister"])) {
        $vorname = htmlspecialchars($_POST["vorname"], ENT_QUOTES, "UTF-8");
        $nachname = htmlspecialchars($_POST["nachname"], ENT_QUOTES, "UTF-8");
        $passwort = hash("MD5", htmlspecialchars($_POST["passwort"], ENT_QUOTES, "UTF-8"));
        $mail = htmlspecialchars($_POST["mail"], ENT_QUOTES, "UTF-8");

        if (!empty ($mail) && !empty ($passwort) && !empty ($nachname) && !empty ($vorname)) {
            $dozentInstnc = new dozent();
            $dozent = $dozentInstnc->getByMail($mail);

            if (empty($dozent)) {
                $liste = $dozentInstnc->signup($nachname, $vorname, $passwort, $mail);
                echo "<div class='col-sm-offset-6'> Die Registrierung war erfolgreich. Sie werden in Kürze von einem Administrator freigeschaltet.</div>";
                header('location:index.php');
            } else {
                echo "<div class='col-sm-offset-6'> Registrierung nicht erfolgreich. Diese Emailadresse wurde bereits verwendet.</div>";
            }
        }
    }
    ?>

</div>

</body>

	
    <?php else: ?>
   <body>
<?php require_once("include/navigation.php");
$eintragManager = new vorlesung();
?>

<div class="container">

    <h1> Vorlesungsübersicht</h1>
    <div class="col-md-8">
    <?php



    echo "<p><strong>Ihre Vorlesungen im Überblick</strong></p> ";

    $liste = $eintragManager->getByDozentenId($_SESSION ['id']);
    if (!empty ($liste)) {
    echo "<div class='list-group'>";
    foreach ($liste as $eintrag) {

        echo "<div  class='list-group-item'>";
            echo "<div class='col-md-8'>";
                echo $eintrag['bezeichnung'] . " ";
            echo "</div>";
            echo " <div class='col-md-4'>";
                echo "<a href='vorlesung.php?id=" . $eintrag['ID'] . "' class='btn btn-default'>Anzeigen</a>";
                echo "<a href='do/index_delete.php?id= ".$eintrag['ID']. "'class='btn btn-default'>Löschen</a>";
            echo"</div>";
        echo"</div>";

    }
    echo "</div>";
    }
    else {
        echo "Es sind keine Vorlesungen Vorhanden";
    }
    ?>
    </div>
    <div class="col-md-4">
        <?php require_once('include/aside_index.php'); ?>
    </div>
    </div>
   </body>
   
    <?php endif; ?>

</html>