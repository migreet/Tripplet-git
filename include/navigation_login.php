<?php
/**
* Created by PhpStorm.
* User: Andreas
* Date: 02.05.2016
* Time: 23:22
* Navigation ausgeloggt
*/

/**
* Instanzen
*/
$dozentInstnc = new dozent();

?>

<nav class="navbar navbar-inverse">
    <div class="container">
        <form name="loginform" class="form-inline col-sm-offset-6" style="padding-top: 7px;"
              action="<?php $_SERVER['PHP_SELF'] ?>" method="post">
            <div class="form-group">
                <label class="sr-only" for="mail">Emailadresse</label>
                <input type="text" class="form-control" name="mail" id="mail" placeholder="Emailadresse" required>
            </div>
            <div class="form-group">
                <label class="sr-only" for="passwort">Passwort</label>
                <input type="password" class="form-control" name="passwort" id="passwort" placeholder="Passwort"
                       required>
                <input type="hidden" value="1" name="sentlogin">
            </div>
            <button type="submit" name="login" class="btn btn-default btn-login">Anmelden</button>
        </form>
    </div>
</nav>
<div class="nav-abstand">
</div>

<?php
/**
 * Bei augefüllten Passwortfeld wird Passwort gehashed und validiert
 */
if (isset($_POST["sentlogin"])):
    $mail = $_POST["mail"];
    $passwort = hash("MD5", trim(stripslashes (htmlentities($_POST["passwort"]))));
    $dozent = $dozentInstnc->getByMail($mail);

    /**
     * Passwort und Zugang wird überprüft, Session wird erstellt
     * Bei Falscheingabe Weiterleitung auf Index
     */
    if (!empty ($mail) && !empty ($passwort) && $dozent['ID_RECHTE']!= NULL):

        if (!isset($_SESSION['login'])):

            if($mail==$dozent['mail'] && $passwort==$dozent['passwort']):
            $_SESSION ['login'] = 1;
            $_SESSION ['mail'] = $mail;
            $_SESSION ['rights']=$dozent['ID_RECHTE'];
            $_SESSION ['user_id'] = $dozent['ID'];
                $_SESSION['id']= uniqid();
            header('location:index.php');

            else:
                header('location:index.php?notification='."0");
            endif;

        endif;

    endif;

endif;

?>
