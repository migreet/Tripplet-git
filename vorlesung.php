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
        $bezeichnung = trim(stripslashes (htmlentities($_POST["bezeichnung"], ENT_QUOTES, "UTF-8")));
        $vorlesungsId= trim(stripslashes (htmlentities($_GET["id"], ENT_QUOTES, "UTF-8")));

        if (!empty ($bezeichnung)) {
            $votingInstnc = new voting();
            $voting = $votingInstnc->createVoting($bezeichnung, $vorlesungsId);

            echo "<div> Die Registrierung war erfolgreich!</div>";

            header('Location: vorlesung.php?id='.$ID_Vorlesung);
        }
        else {echo "<div> Es ist ein Fehler aufgetreten! Wenden Sie sich bitte an den Administrator.</div>";
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

//Rights Check
$usercheck=$vorlesungInstnc->userCheck($ID_Vorlesung);
print_r($usercheck) ;
?>

<div id="votingubersicht"  class="container">
    <?php
    //Breadcrumb
    echo"
    <div class='breadcrumb'>
        <i class='fa fa-angle-right'></i> <a href='index.php'>Vorlesungen</a> <i class='fa fa-angle-right'></i> Votingübersicht
    </div>";
    ?>
<h1> <?php echo $vorlesung['bezeichnung']; ?></h1>
    <div class="col-md-4 sidebar">

        <?php require_once('include/aside_vorlesung.php'); ?>
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

    <div class="col-md-8">
    <?php
    $voting = $votingInstnc->getByVorlesungsId($ID_Vorlesung);
if (!empty ($voting)):

    foreach ($voting as $eintrag) {
        echo "<div class='col-md-12'>
              <div class='col-md-4'>";
        //if (empty($eintrag['schluessel'])){
            echo $eintrag['bezeichnung'] . " ";

            echo "</div> ";
            echo " <div class='col-md-8'>";?>
            <a href="start.php?id=<?php echo $eintrag['ID']?>" class="btn btn-default">starten</a>
            <a href="voting.php?id=<?php echo $eintrag['ID']?>" type='button' class='btn btn-default'>bearbeiten</a>
            <a href="auswertung.php?id=<?php echo $eintrag['ID']?>" class="btn btn-default">Ergebnis</a>
            <!-- Votings loeschen -->
            <a href="do/vorlesung_delete.php?id=<?php echo $eintrag['ID']. '&' .'idvorlesung='.$ID_Vorlesung;?>" class="btn btn-default">löschen</a>
    <?php echo"</div>";
        echo "
        </div>";


}

else:
    echo "Es sind keine Votings Vorhanden";
endif;
?>

</div>

</div>
<?php require_once('include/footer.php'); ?>
</body>
   
    <?php endif; ?>

</html>