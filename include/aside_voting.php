<?php

$frageCreate=$_POST["fragecreate"];

// echo $ID_Voting;

if (isset($frageCreate)) {
    $frageInstnc = new frage(); //richtige Klasse benutzen!!!    createFrage($bezeichnung, $text, $votingid)
    $frage = $frageInstnc->createFrage($bezeichnung, $frageText, $ID_Voting);

    $frageText = htmlspecialchars($_POST["frage"], ENT_QUOTES, "UTF-8");
    //$antwort = htmlspecialchars($_POST["antwort"], ENT_QUOTES, "UTF-8");
    $antwort= array ();
    for ($i = 0; $i <= 9; $i++) {
        if (!empty (htmlspecialchars($_POST["antwort" . $i], ENT_QUOTES, "UTF-8"))){
            //$antwort[] = htmlspecialchars($_POST["antwort" . $i], ENT_QUOTES, "UTF-8");
            $antwortText = htmlspecialchars($_POST["antwort" . $i], ENT_QUOTES, "UTF-8");
            $antwortInstnc = new antwort();
            $antwort = $antwortInstnc->createAntwort($antwortText, $frage);
        }

    }
print_r($antwort);



if (!empty ($bezeichnung)) {

echo "<div> Die Frage wurde eingereicht</div>";

header('Location: voting.php?id=' .$ID_Voting); //id Voting??!
}
else {echo "<div> Es ist ein Problem beim einreichen der Frage aufgetreten. Wenden Sie sich bitte an den Administrator.</div>";

}
}

?>


<div>
    <p><strong>Fügen sie eine neue Frage hinzufügen</strong></p>
</div>

<form class="form-horizontal" role="form" action="<?php $_SERVER['PHP_SELF'] ?>" method="post">
    <div class="form-group">

        <div class="col-sm-12">
            <input type="text" class="form-control" name="frage" placeholder="Frage" id="frage" required>
        </div>

        <div class="col-sm-12">
            <input type="text" class="form-control" name="antwort0" placeholder="Antwort" id="antwort" required>
        </div>
        <div class="col-sm-12">
            <input type="text" class="form-control" name="antwort1" placeholder="Antwort" id="antwort" required>
        </div>
        <div class="col-sm-12">
            <input type="text" class="form-control" name="antwort2" placeholder="Antwort" id="antwort" >
        </div>
        <div class="col-sm-12">
            <input type="text" class="form-control" name="antwort3" placeholder="Antwort" id="antwort" >
        </div>
        <div class="col-sm-12">
            <input type="text" class="form-control" name="antwort4" placeholder="Antwort" id="antwort" >
        </div>
        <div class="col-sm-12">
            <input type="text" class="form-control" name="antwort5" placeholder="Antwort" id="antwort" >
        </div>
        <div class="col-sm-12">
            <input type="text" class="form-control" name="antwort6" placeholder="Antwort" id="antwort" >
        </div>
        <div class="col-sm-12">
            <input type="text" class="form-control" name="antwort7" placeholder="Antwort" id="antwort" >
        </div>
        <div class="col-sm-12">
            <input type="text" class="form-control" name="antwort8" placeholder="Antwort" id="antwort" >
        </div>

        <div class="col-sm-12">
            <input type="text" class="form-control" name="antwort9" placeholder="Antwort" id="antwort" >
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