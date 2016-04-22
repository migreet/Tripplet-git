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
require_once("include/header.php");
require_once("php/classes.php");

session_start();

//GETs & POSTs
$schluessel=$_POST['schluessel'];
$schluesselsent=$_POST['schluesselsent'];

//Instanzen
$votingInstnc = new voting();
$auswertungInstnc = new auswertung();
$voting=$votingInstnc->getByKey($schluessel); //ZU TUN::: Abfrage ob gleicher Schlüssel in der DB gerade aktiv ist!
$frageInstnc = new frage();
$frage = $frageInstnc->getByVotingId($voting['ID']);
$antwortInstnc = new antwort();
$fragerunde=$auswertungInstnc->frageRunde($voting['ID'], $_SESSION['id']);


if (isset($_POST["fragerunde"])) {
    $eintragID = htmlspecialchars($_POST['antwort'], ENT_QUOTES, "UTF-8");
    print_r ($fragerunde);
    echo $eintragID. "-" .$fragerunde['ID_FRAGE']. "-" .$_SESSION['id']. "-" .$eintragID;
    $auswertungInstnc->update($fragerunde['ID'], $_SESSION['id'], $eintragID);
    //header ('location:vote.php');
}


if (isset($_SESSION['id']) && $_SESSION['votingid']==$voting['ID']):

    $fragerunde=$auswertungInstnc->frageRunde($voting['ID'], $_SESSION['id']);
    $antwort = $antwortInstnc->getByFragenId($fragerunde['ID_FRAGE']);
    $countFragen=$auswertungInstnc->countFragen(0,$voting['ID'],$_SESSION['id']);
    $countfinished=$auswertungInstnc->countFragen(1,$voting['ID'],$_SESSION['id']);
    ?>

    <body>

    <div class="container">

        <h1>Fragerunde</h1>
        <?php echo $fragerunde['text']."<br>"; ?>
        <form method="post" action="<?php $_SERVER['PHP_SELF'] ?>" >
            <?php
            print_r( $_SESSION);
            foreach ($antwort as $eintrag) {

                echo "<input value='" . $eintrag['ID'] . "'type='radio' name='antwort'>". $eintrag['text'] . "<br />";

            }
            echo "<input type='hidden' value='1' name='fragerunde'>";
            ?>
            <input type="submit"> <br />
        </form>
        <?php echo "Beantwortete Fragen " .$countfinished ['COUNT(*)']; ?> <br>
        <?php echo "Gesamtfragen " .$countFragen['COUNT(*)']; ?> <br>

        <?php
        $anzahlFragen=$countFragen['COUNT(*)'];
        $anzahlFragenready=$countfinished ['COUNT(*)'];
        for ($i = 0; $i < $anzahlFragen; $i++)
        {if ($i<$anzahlFragenready) {
            echo "O" ;
        }

        elseif ($i==$anzahlFragenready) { //Grafiken einfügen für die Navi
            echo "x";
        }

        else {
            echo "o";
        }

        }

        ?>
    </div>

    </body>
<?php else:
    if (isset($schluesselsent)) {
        if ($schluessel==$voting['schluessel']){
            $_SESSION['id']= uniqid();
            $_SESSION['votingid']= $voting['ID'];
            foreach ($frage as $eintrag) {
                echo $eintrag['ID'];
                echo $eintrag['ID'];
                $auswertungInstnc->createAuswertung($eintrag['ID'],$_SESSION['id']);
            }
            //header ("location: vote.php");
        }
    }
    ?>

    <body>

    <div class="container">

        <h1>Schlüssel eingeben</h1>

        <form name="signinform" class="form-inline col-sm-offset-6" style="padding-top: 7px;" action="<?php $_SERVER['PHP_SELF'] ?>" method="post">
            <div class="form-group">
                <label class="sr-only" for="schluessel">Schlüssel</label>
                <input type="password" class="form-control" name="schluessel" id="schluessel" placeholder="Schlüssel" required>
                <input type="hidden" value="1" name="schluesselsent">
            </div>
            <button type="submit" name="login" class="btn btn-default">Einschreiben</button>
        </form>

    </div>

    </body>

<?php endif; ?>

</html>