<!DOCTYPE html>
<html>
<head>
<link rel="stylesheet" href="bootstrap.css">
</head>
<body>
<div class="container">
    <h1>Ganze Tabellen und einzelne Datensätze retrieven </h1>
	<p>Das ist die Grundlage für alle was wir sonst noch so vorhaben :) </p>

    <?php

        require_once("php/classes.php");
		
		echo "<p><strong>Dozenten anhand ihrer ID rauswerfen</strong></p>";
		$eintragManager = new dozent();
        $liste = $eintragManager->getById(1);
		echo $liste[ID]." ";
		echo $liste[name]." ";
		echo $liste[passwort]." ";
		echo $liste[rechte]."<br />";
		
		echo "<p><strong>Alle Dozenten rauswerfen</strong></p>";
        $eintragManager = new dozent();
        $liste = $eintragManager->getAll();
        foreach ($liste as $eintrag) {
            echo $eintrag[ID]." ";
            echo $eintrag[name]." ";
            echo $eintrag[passwort]." ";
			echo $eintrag[rechte]."<br />";
        }
		
		
		
		echo "<p><strong>Vorlesungen anhand ihrer Dozentenid rauswerfen</strong></p>";
		$eintragManager = new vorlesung();
        $liste = $eintragManager->getByDozentenId(1);
		echo $liste[ID]." ";
		echo $liste[bezeichnung]." ";
		echo $liste[ID_DOZENT]." ";
		
		echo "<p><strong>Vorlesungen anhand ihrer ID rauswerfen</strong></p>";
		$eintragManager = new vorlesung();
        $liste = $eintragManager->getById(1);
		echo $liste[ID]." ";
		echo $liste[bezeichnung]." ";
		echo $liste[ID_DOZENT]." ";
		
		
		echo "<p><strong>Alle Vorlesungen rauswerfen</strong></p>";
		$eintragManager = new vorlesung();
        $liste = $eintragManager->getAll();
        foreach ($liste as $eintrag) {
            echo "<p>"."$eintrag[ID]"."</p>";
            echo "<p>"."$eintrag[bezeichnung]"."</p>";
            echo "<p>"."$eintrag[ID_DOZENT]"."</p>";
        }
		
		echo "<p><strong>Votings anhand ihrer ID rauswerfen</strong></p>";
		$eintragManager = new voting();
        $liste = $eintragManager->getById(1);
		echo $liste[ID]." ";
		echo $liste[name]." ";
		echo $liste[passwort]." ";
		echo $liste[rechte]." ";
		
		echo "<p><strong>Votings anhand ihrer Vorlesungsid rauswerfen</strong></p>";
		$eintragManager = new voting();
        $liste = $eintragManager->getByVorlesungsId(1);
		echo $liste[ID]." ";
		echo $liste[ID_VORLESUNG]." ";
		
		
		echo "<p><strong>Alle Votings rauswerfen</strong></p>";
		$eintragManager = new voting();
        $liste = $eintragManager->getAll();
        foreach ($liste as $eintrag) {
            echo "<p>"."$eintrag[ID]"."</p>";
            echo "<p>"."$eintrag[schlüssel]"."</p>";
            echo "<p>"."$eintrag[ID_VORLESUNG]"."</p>";
        }
		
		echo "<p><strong>Fragen anhand ihrer ID rauswerfen</strong></p>";
		$eintragManager = new frage();
        $liste = $eintragManager->getById(1);
		echo $liste[ID]." ";
		echo $liste[name]." ";
		echo $liste[passwort]." ";
		echo $liste[rechte]." ";
		
		echo "<p><strong>Fragen anhand ihrer Votingid rauswerfen</strong></p>";
		$eintragManager = new frage();
        $liste = $eintragManager->getByVotingId(1);
		echo $liste[ID]." ";
		echo $liste[text]." ";
		echo $liste[ID_VOTING]." ";
		
		echo "<p><strong>Alle Fragen rauswerfen</strong></p>";
		$eintragManager = new frage();
        $liste = $eintragManager->getAll();
        foreach ($liste as $eintrag) {
            echo "<p>"."$eintrag[ID]"."</p>";
            echo "<p>"."$eintrag[text]"."</p>";
            echo "<p>"."$eintrag[ID_VOTING]"."</p>";
        }
		
		echo "<p><strong>Antworten anhand ihrer ID rauswerfen</strong></p>";
		$eintragManager = new antwort();
        $liste = $eintragManager->getById(1);
		echo $liste[ID]." ";
		echo $liste[ID_FRAGE]." ";
		echo $liste[text]." ";
		echo $liste[richtig]." ";
		
		echo "<p><strong>Antworten anhand ihrer Fragenid rauswerfen</strong></p>";
		$eintragManager = new antwort();
        $liste = $eintragManager->getByFragenId(1);
		echo $liste[ID]." ";
		echo $liste[ID_FRAGE]." ";
		echo $liste[text]." ";
		echo $liste[richtig]." ";
		
		
		echo "<p><strong>Alle Antworten rauswerfen</strong></p>";
		$eintragManager = new antwort();
        $liste = $eintragManager->getAll();
        foreach ($liste as $eintrag) {
            echo "<p>"."$eintrag[ID]"."</p>";
            echo "<p>"."$eintrag[ID_FRAGE]"."</p>";
            echo "<p>"."$eintrag[text]"."</p>";
			echo "<p>"."$eintrag[richtig]"."</p>";
        }
		
		echo "<p><strong>Auswertung anhand ihrer ID rauswerfen</strong></p>";
		$eintragManager = new auswertung();
        $liste = $eintragManager->getById(1);
		echo $liste[ID_FRAGE]." ";
		echo $liste[ID_ANTWORT]." ";
		echo $liste[SESSIONID_STUDENT]."<br />";
		
		echo "<p><strong>Auswertung anhand ihrer Fragenid rauswerfen</strong></p>";
		$eintragManager = new auswertung();
        $liste = $eintragManager->getByFragenId(1);
		echo $liste[ID_FRAGE]." ";
		echo $liste[ID_ANTWORT]." ";
		echo $liste[SESSIONID_STUDENT]."<br />";
		
		
		echo "<p><strong>Alle Auswertung rauswerfen</strong></p>";
		$eintragManager = new auswertung();
        $liste = $eintragManager->getAll();
        foreach ($liste as $eintrag) {
            echo "<p>"."$eintrag[ID_FRAGE]"."</p>";
			echo "<p>"."$eintrag[ID_ANTWORT]"."</p>";
            echo "<p>"."$eintrag[SESSIONID_STUDENT]"."</p>";
        }
		
		echo "<p><strong>Rechte anhand ihrer ID rauswerfen</strong></p>";
		$eintragManager = new rechte();
        $liste = $eintragManager->getById(1);
		echo $liste[ID]." ";
		echo $liste[bezeichnung]."<br />";
		
		
		echo "<p><strong>Alle Rechte rauswerfen</strong></p>";
		$eintragManager = new rechte();
        $liste = $eintragManager->getAll();
        foreach ($liste as $eintrag) {
            echo $eintrag[ID]." ";
            echo $eintrag[bezeichnung]."<br />";
        }
		
    ?>
</div>

</body>
</html>
