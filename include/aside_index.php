<?php
/*
 * Created by PhpStorm.
 * User: Andreas
 * Date: 05.04.2016
 * Time: 18:03
 */


$postVorlesung=$_POST["vorlesungcreate"];
if (isset($postVorlesung)) {
$bezeichnung = htmlspecialchars($_POST["bezeichnung"], ENT_QUOTES, "UTF-8");


if (!empty ($bezeichnung)) {
$vorlesungInstnc = new vorlesung();
$vorlesung = $vorlesungInstnc->createVorlesung($bezeichnung, $_SESSION ['id']);

echo "<div> Die Registrierung war erfolgreich!</div>";


header('Location: index.php');
}
else {echo "<div> Registrierung nicht erfolgreich! Wenden Sie sich bitte an den Administrator.</div>";
//header('Location: vorlesung.php'."?id=1");
}
}
?>

    Eine neue Vorlesung hinzufügen!

<form name="registerform" class="form-horizontal" role="form" action="<?php $_SERVER['PHP_SELF'] ?>" method="post">
    <div class="form-group">
            <input type="text" class="form-control" name="bezeichnung" placeholder="Bezeichnung" id="mail" required>
    </div>

            <input type="hidden" value="1" name="vorlesungcreate">



    <div class="form-group">
            <button type="submit" name="registrieren" class="btn btn-default">Hinzufügen</button>
    </div>
</form>
