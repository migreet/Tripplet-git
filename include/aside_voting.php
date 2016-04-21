<?php

$frageCrate=$_POST["fragecreate"];
if (isset($frageCreate)) {
$bezeichnung = htmlspecialchars($_POST["bezeichnung"], ENT_QUOTES, "UTF-8");
    $frageText = htmlspecialchars($_POST["frage"], ENT_QUOTES, "UTF-8");
    $antwort = htmlspecialchars($_POST["antwort"], ENT_QUOTES, "UTF-8");


if (!empty ($bezeichnung)) {
$vorlesungInstnc = new frage(); //richtige Klasse benutzen!!!    createFrage($bezeichnung, $text, $votingid)
$frage = $frageInstnc->createFrage($bezeichnung, $frageText, $ID_Voting);

echo "<div> Die Frage wurde eingereicht</div>";

header('Location: index.php' .$_SESSION ['id']); //id Voting??!
}
else {echo "<div> Es ist ein Problem beim einreichen der Frage aufgetreten. Wenden Sie sich bitte an den Administrator.</div>";

}
}
echo "<h1>Variabeltest</h1>"
echo "$bezeichnung";
echo "$frageText";
echo "$antwort";
?>


<div>
    <p><strong>Fügen sie eine neue Frage hinzufügen</strong></p>
</div>

<form class="form-horizontal" role="form" action="<?php $_SERVER['PHP_SELF'] ?>" method="post">
    <div class="form-group">
        <div class="col-sm-12">
            <input type="text" class="form-control" name="bezeichnung" placeholder="Bezeichnnung" id="bezeichnung" required>
        </div>

        <div class="col-sm-12">
            <input type="text" class="form-control" name="frage" placeholder="Frage" id="frage" required>
        </div>

        <div class="col-sm-12">
            <input type="text" class="form-control" name="antwort" placeholder="Antwort" id="antwort" required>
            <input type="hidden" value="1" name="fragecreate">
        </div>

    </div>


    <div class="form-group">
        <div class="col-sm-12">
            <button type="submit" class="btn btn-default">Voting hinzufügen</button>
        </div>
    </div>
</form>
</div>