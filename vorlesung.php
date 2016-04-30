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


<?php require_once("include/header.php");
require_once("php/classes.php");

session_start();
$ID_Vorlesung=$_GET['id'];


    $postVoting=$_POST["votingcreate"];
    if (isset($postVoting)) {
        $bezeichnung = htmlspecialchars($_POST["bezeichnung"], ENT_QUOTES, "UTF-8");
        $schluessel= htmlspecialchars($_POST["schluessel"], ENT_QUOTES, "UTF-8");
        $vorlesungsId= htmlspecialchars($_GET["id"], ENT_QUOTES, "UTF-8");

        if (!empty ($bezeichnung)) {
            $votingInstnc = new voting();
            $voting = $votingInstnc->createVoting($bezeichnung, $schluessel, $vorlesungsId);

            echo "<div> Die Registrierung war erfolgreich!</div>";

            header('Location: vorlesung.php?id='.$ID_Vorlesung);
        }
        else {echo "<div> Registrierung nicht erfolgreich! Wenden Sie sich bitte an den Administrator.</div>";
            //header('Location: vorlesung.php'."?id=1");
        }
    }



?>



    <?php if(!isset($_SESSION['login'])):
	header ('location: index.php');?>
	
    <?php else: ?>
   <body>
<?php require_once("include/navigation.php");
$votingInstnc = new voting();
$vorlesungInstnc = new vorlesung();
$vorlesung=$vorlesungInstnc->getById($ID_Vorlesung);
?>

<div class="container">
<h1> Vorlesung <?php echo $vorlesung['bezeichnung']; ?></h1>
<div class="col-md-8">
    <?php


    echo "<p><strong>Votings in dieser Vorlesung</strong></p>";
    $voting = $votingInstnc->getByVorlesungsId($ID_Vorlesung);
if (!empty ($voting)):
    foreach ($voting as $eintrag) {
        echo "<div class='list-entry'>
              <div class='col-md-7'>";
        if (empty($eintrag['schluessel'])){
            echo "<a href='voting.php?id=".$eintrag['ID']."' style='color:green'>";
            echo $eintrag['bezeichnung'] . " ";
            echo $eintrag['datum'] . " ";
            echo "</a> ";?>
            <a href="start.php?id=<?php echo $eintrag['ID']?>" class="btn btn-default">Start</a>
            <button type='button' class='btn btn-default'>edit</button>
            <a href="auswertung.php?id=<?php echo $eintrag['ID']?>" class="btn btn-default">Auswertung</a>
            <!-- Votings löschen -->
            <a href="do/vorlesung_delete.php?id=<?php echo $eintrag['ID']. '&' .'idvorlesung='.$ID_Vorlesung;?>" class="btn btn-default">Löschen</a>
    <?php
        }
    else{
        echo "<a href='voting.php?id=".$eintrag['ID']."' style='color:red'>";
        echo $eintrag['bezeichnung'] . " ";
        echo $eintrag['datum'] . " ";
        echo "</a> ";?>
        <a href="start.php?id=<?php echo $eintrag['ID']?>" class="btn btn-default">Stop</a>

<?php
    }
echo "</div>
        </div>";
}
else:
    echo "Es sind keine Votings Vorhanden";
endif;
?>

</div>
<div class="col-md-4">
    <div >
        <p><strong>Fügen sie eine neues Voting hinzu</strong></p>
    </div>

    <form class="form-horizontal" role="form" action="<?php $_SERVER['PHP_SELF'] ?>" method="post">
        <div class="form-group">
            <div class="col-sm-12">
                <input type="text" class="form-control" name="bezeichnung" placeholder="Bezeichnnung" id="bezeichnung" required>
            </div>
            <div class="col-sm-12">
                <input type="text" class="form-control" name="schluessel" placeholder="Schluessel" id="schluessel" required>
                <input type="hidden" value="1" name="votingcreate">
            </div>

        </div>


        <div class="form-group">
            <div class="col-sm-12">
                <button type="submit" class="btn btn-default">Voting hinzufügen</button>
            </div>
        </div>
    </form>
    <?php
   /* $postVoting=$_POST["votingcreate"];
    if (isset($postVoting)) {
        $bezeichnung = htmlspecialchars($_POST["bezeichnung"], ENT_QUOTES, "UTF-8");
        $schluessel= htmlspecialchars($_POST["schluessel"], ENT_QUOTES, "UTF-8");
        $vorlesungsId= htmlspecialchars($_GET["id"], ENT_QUOTES, "UTF-8");

        if (!empty ($bezeichnung)) {
            $votingInstnc = new voting();
            $voting = $votingInstnc->createVoting($bezeichnung, $schluessel, $vorlesungsId);

            echo "<div> Die Registrierung war erfolgreich!</div>";

            header('Location: vorlesung.php?id='.$ID_Vorlesung);
        }
        else {echo "<div> Registrierung nicht erfolgreich! Wenden Sie sich bitte an den Administrator.</div>";
            //header('Location: vorlesung.php'."?id=1");
        }
    }*/

    ?>
</div>
</div>
</body>
   
    <?php endif; ?>

</html>