<?php
/*
 * Created by PhpStorm.
 * User: Andreas
 * Date: 05.04.2016
 * Time: 18:03
 */


$postVorlesung=$_POST["vorlesungcreate"];
if (isset($postVorlesung)) {
$bezeichnung = trim(stripslashes (htmlentities($_POST["bezeichnung"], ENT_QUOTES, "UTF-8")));


if (!empty ($bezeichnung)) {
$vorlesungInstnc = new vorlesung();
$vorlesung = $vorlesungInstnc->createVorlesung($bezeichnung, $_SESSION ['id']);

    $getNot = "Die Vorlesung wurde erfolgreich angelegt!";


header('Location: index.php?notification=' . $getNot);
}
else {echo "<div> Anlegen der Vorlesung nicht erfolgreich! Wenden Sie sich bitte an den Administrator.</div>";
//header('Location: vorlesung.php'."?id=1");
}
}
?>

    Eine neue Vorlesung hinzufügen!

<form name="registerform" id="aside-index" class="form-horizontal" role="form" action="<?php $_SERVER['PHP_SELF'] ?>" method="post">
    <div class="form-group">
        <input type="text" class="form-control" name="bezeichnung" placeholder="Bezeichnung" id="mail" required>
        <input type="hidden" value="1" name="vorlesungcreate">
        <button type="submit" name="registrieren" class="btn btn-default">Hinzufügen</button>
    </div>








</form>
