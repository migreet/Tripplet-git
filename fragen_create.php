<?php
/**
 * Created by PhpStorm.
 * User: Mic
 * Date: 05.04.2016
 * Time: 11:33
 */
?>

<body>
<?php
require_once("include/header.php");
require_once("php/classes.php");
session_start();

$frageInstnc = new frage(); //richtie Klasse!!!
?>

<div class="container">


    <h1> Fragen von Voting xyz</h1>
    <div class="col-md-8">
        <?php



        $fragen = $frageInstnc->getByVotingId($_GET ['id']); //hier richtige klasse!!! und VOTING ID
        if (!empty ($fragen)) {
            foreach ($fragen as $eintrag) {
                echo "<div class='list-entry'><a href=vorlesung.php?id=" . $eintrag['ID'] . ">"; //richtiger link!!
                echo $eintrag['bezeichnung'] . " "; //richtiger parameter??!!
                echo "</a> </div>";
            }
        }
        else {
            echo "Es sind keine Fragen vorhanden";
        }
        ?>
    </div>
    <div class="col-md-4">
        <div class="col-sm-12">
            <p><strong>Fügen sie eine neue Fragen zum Voting hinzu</strong></p>
        </div>

        <form class="form-horizontal" role="form" action="<?php $_SERVER['PHP_SELF'] ?>" method="post">
            <div class="form-group">
                <div class="col-sm-12">
                    <input type="text" class="form-control" name="frage1" placeholder="Frage 1" id="frage1" required>
                </div>
                <div class="col-sm-12">
                    <input type="text" class="form-control" name="frage2" placeholder="Frage 2" id="frage2" required>
                </div>
                <div class="col-sm-12">
                    <input type="text" class="form-control" name="frage3" placeholder="Frage 3" id="frage3" required>
                    <input type="hidden" value="1" name="fragencreate">
                </div>
            </div>


            <div class="form-group">
                <div class="col-sm-12">
                    <button type="submit" class="btn btn-default">Fragen hinzufügen</button>
                </div>
            </div>
        </form>
        <?php
        $postFragen=$_POST["fragencreate"];
        if (isset($postFragen)) {
            $frage1 = htmlspecialchars($_POST["frage1"], ENT_QUOTES, "UTF-8");


            if (!empty ($frage1)) {       //muss hier nicht noch ein OR hin mit den restlichen feldern??
                $frageInstnc = new frage(); //richtige klasse!!!!
                $frage = $frageInstnc->createVorlesung($bezeichnung, $_SESSION ['id']); //richtige funktion!!!!!

                echo "<div> Die Fragen wuden dem Voting erfolgreich hinzugefügt!</div>";
                header('Location: index.php');
            }
            else {echo "<div> Hinzufügen nicht erfolgreich! Wenden Sie sich bitte an den Administrator.</div>";}
        }

        ?>
    </div>

</div>


</body>
