<?php
/**
 * Created by PhpStorm.
 * User: Mic
 * Date: 04.04.2016
 * Time: 18:46
 */
?>
<body>
<?php require_once("include/navigation.php");
$eintragManager = new vorlesung();
?>

<div class="container">


    <h1> Vorlesungsübersicht</h1>
    <div class="col-md-8">
    <?php



    echo "<p><strong>Ihre Vorlesungen im Überblick</strong></p> <br> <p>Bugs: formulardaten auf index; loginbugs;</p>";

    $liste = $eintragManager->getByDozentenId($_SESSION ['id']);
    if (!empty ($liste)) {
        foreach ($liste as $eintrag) {
            echo "<div class='list-entry'><a href=vorlesung.php?id=" . $eintrag['ID'] . ">";
            echo $eintrag['bezeichnung'] . " ";
            echo "</a> </div>";
        }
    }
    else {
        echo "Es sind keine Vorlesungen Vorhanden";
    }
    ?>
    </div>
    <div class="col-md-4">
        <div class="col-sm-12">
            <p><strong>Fügen sie eine neue Vorlesung hinzu</strong></p>
        </div>

            <form class="form-horizontal" role="form" action="<?php $_SERVER['PHP_SELF'] ?>" method="post">
                <div class="form-group">
                    <div class="col-sm-12">
                        <input type="text" class="form-control" name="bezeichnung" placeholder="Bezeichnnung" id="bezeichnung" required>
                        <input type="hidden" value="1" name="vorlesungcreate">
                    </div>
                </div>


                <div class="form-group">
                    <div class="col-sm-12">
                        <button type="submit" class="btn btn-default">Vorlesung hinzufügen</button>
                    </div>
                </div>
            </form>
<?php
$postVorlesung=$_POST["vorlesungcreate"];
if (isset($postVorlesung)) {
    $bezeichnung = htmlspecialchars($_POST["bezeichnung"], ENT_QUOTES, "UTF-8");


    if (!empty ($bezeichnung)) {
        $vorlesungInstnc = new vorlesung();
        $vorlesung = $vorlesungInstnc->createVorlesung($bezeichnung, $_SESSION ['id']);

        echo "<div> Die Registrierung war erfolgreich!</div>";
        header('Location: index.php');
    }
    else {echo "<div> Registrierung nicht erfolgreich! Wenden Sie sich bitte an den Administrator.</div>";}
}

?>
    </div>

</div>


</body>