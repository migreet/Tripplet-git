<?php
/**
 * Created by PhpStorm.
 * User: Andreas
 * Date: 22.06.2016
 * Time: 15:27
 */

require_once("include/header.php");
require_once("php/classes.php");

/**
 * Instanzen
 */
$antwortInstnc = new antwort();
$votingInstnc = new voting();
$frageInstnc = new frage();
$auswertungInstnc = new auswertung();

/**
 * GETs
 */
$ID_Frage=$_GET['id'];

/**
 * Session starten
 */
session_start();

$frage=$frageInstnc->getById($ID_Frage);

/**
 * Sicherheitsabfrage
 */
if(!isset($_SESSION['login'])):
    header ('location: index.php');

else:

    /**
     * Rights Check
     */
    $usercheck=$frageInstnc->userCheck($ID_Frage);
    if($usercheck['ID']!=$_SESSION['user_id']) {
        header ('location: index.php');
    }

    echo "<div id='beamer' class='container'>";
    $anzahlTeilnehmer=$auswertungInstnc->countTeilnehmer($frage['ID']);
    echo "<h2>" . $frage['text'] . "(" . $anzahlTeilnehmer['COUNT(*)'] . " Teilnehmer)"."</h2></br> ";

    /**
     * Ausgabe der Antworten zu der passenden Frage
     */
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
                        <div class='progress-bar progress-bar-info' role='progressbar' aria-valuenow='$percent' aria-valuemin='0' aria-valuemax='100' style='background-color:#55d6ba; width: $percent%'>
                            <span class='sr-only'>20% Complete</span>
                        </div>
                    </div>
            </div>
                    ";

                }

endif;
?>
