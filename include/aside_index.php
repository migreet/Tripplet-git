<?php
/**
 * Created by PhpStorm.
 * User: Mic
 * Date: 21.04.2016
 * Time: 20:25
 * Sidebar Index
 */

/**
 * Instanzen
 */
$vorlesungInstnc = new vorlesung();

/**
 * GETs
 */
$postVorlesung=$_POST["vorlesungcreate"];

/**
 * Sicherheitsabfrage
 */
if(!isset($_SESSION['login'])):
    header ('location: ../index.php');

else:
?>
<div class="panel panel-default">
    <div class="panel-body">
        <div class='sidebar-left'>

<?php
/**
 * wird ausgeführt wenn Formular abgeschickt
 */
    if (isset($postVorlesung)):
    $bezeichnung = trim(stripslashes (htmlentities($_POST["bezeichnung"], ENT_QUOTES, "UTF-8")));

        if (!empty ($bezeichnung)):
            $vorlesung = $vorlesungInstnc->createVorlesung($bezeichnung, $_SESSION ['user_id']);
            $getNot = "Die Vorlesung wurde erfolgreich angelegt!";
            header('Location: index.php?notification=' . $getNot);

        else: echo "<div> Anlegen der Vorlesung nicht erfolgreich! Wenden Sie sich bitte an den Administrator.</div>";
        endif;

    endif;
    ?>
            <div class="croc">
            <img src="img/snap-hi.svg">
            </div>
            <div class='side-text'>
                <p> Hi, ich bin Crock! Ich begleite dich durch die Seite!</br></br>
                    Hier siehst du deine Vorlesungen. Füge Vorlesungen hinzu indem du das Feld und den Button unten verwendest!</br>
                </p>
            </div>
            <div id="aside-index">
                <form name="registerform" id="aside-index" class="form-horizontal" role="form" action="<?php $_SERVER['PHP_SELF'] ?>" method="post">
                    <div class="form-group">
                        <input type="text" class="form-control" name="bezeichnung" placeholder="Bezeichnung" maxlength="10" required>
                        <input type="hidden" value="1" name="vorlesungcreate">
                        <button type="submit" name="registrieren" class="btn btn-default btn-max">Vorlesung hinzufügen</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<?php
endif;

require_once('include/footer.php');
?>
