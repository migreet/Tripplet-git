<?php
/**
 * Created by PhpStorm.
 * User: Mic
 * Date: 05.04.2016
 * Time: 11:33
 * Fragen erstellen
 */
?>

<body>
<?php
require_once("include/header.php");
require_once("php/classes.php");

/**
 * GETs
 */
$postFragen=$_POST["fragencreate"];

/**
 * Instanzen
 */
$frageInstnc = new frage();

/**
 * Session wird gestartet
 */
session_start();
?>

<div class="container">
    <h1> Fragen von Voting xyz</h1>
    <div class="col-md-8">
        <?php
        /**
         *
         */
        $fragen = $frageInstnc->getByVotingId($_GET ['id']);
        if (!empty ($fragen)):
            foreach ($fragen as $eintrag) {
                echo "<div class='list-entry'><a href=vorlesung.php?id=" . $eintrag['ID'] . ">";
                echo $eintrag['bezeichnung'] . " ";
                echo "</a> </div>";
            }
        else:
            echo "Es sind keine Fragen vorhanden";
        endif;
        ?>

    </div>
    <div class="col-md-4">
        <div class="col-sm-12">
            <p><strong>F�gen sie eine neue Fragen zum Voting hinzu</strong></p>
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
                    <button type="submit" class="btn btn-default">Fragen hinzuf�gen</button>
                </div>
            </div>
        </form>

        <?php

        if (isset($postFragen)):
            $frage1 = htmlspecialchars($_POST["frage1"], ENT_QUOTES, "UTF-8");

            if (!empty ($frage1)):
                $frageInstnc = new frage();
                $frage = $frageInstnc->createVorlesung($bezeichnung, $_SESSION ['id']);

                echo "<div> Die Fragen wuden dem Voting erfolgreich hinzugef�gt!</div>";
                header('Location: index.php');

            else: echo "<div> Hinzuf�gen nicht erfolgreich! Wenden Sie sich bitte an den Administrator.</div>";
            endif;

        endif;
        ?>
    </div>

</div>


</body>
