<?php
/**
 * Created by PhpStorm.
 * User: Andreas
 * Date: 22.06.2016
 * Time: 15:27
 */

require_once("include/header.php");
require_once("php/classes.php");

$antwortInstnc = new antwort();
$votingInstnc = new voting();
$frageInstnc = new frage();
$auswertungInstnc = new auswertung();


$ID_Frage=$_GET['id'];
$frage=$frageInstnc->getById($ID_Frage);

echo "<div id='beamer' class='container' id='beamer'>";

            $anzahlTeilnehmer=$auswertungInstnc->countTeilnehmer($frage['ID']);
            echo "<h2>" . $frage['text'] . "(" . $anzahlTeilnehmer['COUNT(*)'] . " Teilnehmer)"."</h2></br> ";

            ?>

            <!--Ausgabe der Antworten zu der passenden Frage-->

            <?php
            $antwort=$antwortInstnc->getByFragenId($frage['ID']);
            foreach ($antwort as $eintragFrage) {
                $anzahlAntworten=$auswertungInstnc->countAntworten($eintragFrage['ID']);
                $percent = 0;
                if(intval($anzahlTeilnehmer['COUNT(*)']!=0)) {
                $percent=round(100/intval($anzahlTeilnehmer['COUNT(*)'])*intval($anzahlAntworten['COUNT(*)']),2);
                }
                echo "<div class='col-md-12 beamer'><h3 class='col-md-6 h3-beamer'>".$eintragFrage['text'] ." (Stimmen: ". $anzahlAntworten['COUNT(*)']." | ".$percent."%)"."</h3> ";
                echo "
                <div class='col-md-6 progress' style='margin-top: 20px; margin-bottom: 10px;height:40px; padding-left: 0; padding-right: 0;'>
                    <div class='progress-bar progress-bar-info' role='progressbar' aria-valuenow='$percent' aria-valuemin='0' aria-valuemax='100' style='width: $percent%'>
                <span class='sr-only'>20% Complete</span>
                </div>
                </div>
                </div>
                ";

            }
            ?>
        </div>