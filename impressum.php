<!DOCTYPE html>
<html lang="de">


<?php
require_once("include/header.php");
require_once("php/classes.php");

session_start();
?>


    <body>
    <?php require_once("include/navigation.php");
    ?>

    <div class="container">
        <?php
        //Breadcrumb
        echo"
        <div class='breadcrumb'>
        <i class='fa fa-angle-right'></i> <a href='index.php'> Vorlesungen</a> <i class='fa fa-angle-right'></i> Impressum
        </div>";
        echo"<h1>Impressum</h1>";
        echo "<div class='col-md-8'>";
        echo "Die Webseite enthält Verlinkungen zu anderen Webseiten („externe Links“). Diese Webseiten unterliegen der Haftung der jeweiligen Seitenbetreiber. Bei Verknüpfung der externen Links waren keine Rechtsverstöße ersichtlich. Auf die aktuelle und künftige Gestaltung der verlinkten Seiten hat der Anbieter keinen Einfluss. Die permanente Überprüfung der externen Links ist für den Anbieter ohne konkrete Hinweise auf Rechtsverstöße nicht zumutbar. Bei Bekanntwerden von Rechtsverstößen werden die betroffenen externen Links unverzüglich gelöscht.

<p> <strong> 3. Urheberrecht / Leistungsschutzrecht </strong>

Die auf dieser Webseite durch den Anbieter veröffentlichten Inhalte unterliegen dem deutschen Urheberrecht und Leistungsschutzrecht. Alle vom deutschen Urheber- und Leistungsschutzrecht nicht zugelassene Verwertung bedarf der vorherigen schriftlichen Zustimmung des Anbieters oder jeweiligen Rechteinhabers. Dies gilt vor allem für Vervielfältigung, Bearbeitung, Übersetzung, Einspeicherung, Verarbeitung bzw. Wiedergabe von Inhalten in Datenbanken oder anderen elektronischen Medien und Systemen. Dabei sind Inhalte und Rechte Dritter als solche gekennzeichnet. Das unerlaubte Kopieren der Webseiteninhalte oder der kompletten Webseite ist nicht gestattet und strafbar. Lediglich die Herstellung von Kopien und Downloads für den persönlichen, privaten und nicht kommerziellen Gebrauch ist erlaubt.

Diese Website darf ohne schriftliche Erlaubnis nicht durch Dritte in Frames oder iFrames dargestellt werden.
</p>
<h2>4. Keine Werbung</h2>

Die Verwendung der Kontaktdaten des Impressums zur gewerblichen Werbung ist ausdrücklich nicht erwünscht, es sei denn der Anbieter hatte zuvor seine schriftliche Einwilligung erteilt oder es besteht bereits eine Geschäftsbeziehung. Der Anbieter und alle auf dieser Website genannten Personen widersprechen hiermit jeder kommerziellen Verwendung und Weitergabe ihrer Daten.

<h2>5. Besondere Nutzungsbedingungen</h2>

Soweit besondere Bedingungen für einzelne Nutzungen dieser Website von den vorgenannten Nummern 1. bis 4. abweichen, wird an entsprechender Stelle ausdrücklich darauf hingewiesen. In diesem Falle gelten im jeweiligen Einzelfall die besonderen Bedingungen.

Quelle: Disclaimer powered by fachanwalt.de ";
        echo "</div>";

        echo "<div class='col-md-4' id='impressim_aside'> ";
        require_once("include/aside_impressum.php");
        echo "</div>";
        ?>

    </div>



                </div>

    </body>


</html>



