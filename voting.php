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
$ID_Voting=$_GET['id'];


$postVoting=$_POST["votingcreate"];
if (isset($postVoting)) {
    $bezeichnung = htmlspecialchars($_POST["bezeichnung"], ENT_QUOTES, "UTF-8");
    $schluessel= htmlspecialchars($_POST["schluessel"], ENT_QUOTES, "UTF-8");
    $vorlesungsId= htmlspecialchars($_GET["id"], ENT_QUOTES, "UTF-8");

    if (!empty ($bezeichnung)) {
        $votingInstnc = new voting();
        $voting = $votingInstnc->createVoting($bezeichnung, $schluessel, $vorlesungsId);

        echo "<div> Die Registrierung war erfolgreich!</div>";

        header('Location: vorlesung.php?id='.$ID_Voting);
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
    $frageInstnc = new frage();
    $voting=$votingInstnc->getById($ID_Voting);
    ?>

    <div class="container">
        <h1> Voting <?php echo $voting['bezeichnung']; ?></h1>
        <div class="col-md-8">
            <?php


            echo "<p><strong>Fragen in diesem Voting</strong></p>";
            $voting = $frageInstnc->getByVotingId($ID_Voting);
            if (!empty ($voting)):
            foreach ($voting as $eintrag) {
            echo "
    <div class='list-entry'>
    <div class='col-md-7'>";

            echo "<a href='voting.php?id=".$eintrag['ID']."'>";
            echo $eintrag['text'] . " ";
            echo $eintrag['datum'] . " ";
            echo "</a>"; ?>
            <button type='button' class='btn btn-info'>edit</button>
            <button type="button" class="btn btn-danger">Löschen</button>
        </div>
    </div>
    <?php }
    else:
        echo "Es sind keine Fragen vorhanden";
    endif;
    ?>

    </div>
    <div class="col-md-4">
        <?php require_once('include/aside_voting.php');?>
    </div>
    </div>
    </body>

<?php endif; ?>

</html>