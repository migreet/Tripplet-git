
<div class="navbar navbar-inverse">
    <div class="container">
        <ul class="nav navbar-nav">
            <a class="navbar-brand" href="index.php">
                <span class="glyphicon glyphicon-stats" aria-hidden="true"></span>
            </a>
            <li>
                <a href="index.php" >home</a>


            </li>
            <li>
                <a href="index.php" >teööööst2</a>
            </li>
            <li>

            </li>
            <li>
                <a href="index.php" >test4</a>
            </li>
            <li>
                <a href="index.php" >test5</a>
            </li>
            <li>

            </li>

            </li>

        </ul>
        <form name="loginform" class="form-inline col-sm-offset-6" style="padding-top: 7px;" action="<?php $_SERVER['PHP_SELF'] ?>" method="post">
            <div class="form-group">
                <label class="sr-only" for="mail">Emailadresse</label>
                <input type="text" class="form-control" name="mail" id="mail" placeholder="Emailadresse" required>
            </div>
            <div class="form-group">
                <label class="sr-only" for="passwort">Passwort</label>
                <input type="password" class="form-control" name="passwort" id="passwort" placeholder="Passwort" required>
                <input type="hidden" value="1" name="sentlogin">
            </div>
            <button type="submit" name="login" class="btn btn-default btn-login">Anmelden</button>
        </form>



    </div>


</nav>
</div>
<?php
if (isset($_POST["sentlogin"])) {
    $mail = $_POST["mail"];
    $passwort = hash("MD5", $_POST["passwort"]);
    $dozentInstnc = new dozent();
    $dozent = $dozentInstnc->getByMail($mail);

    if (!empty ($mail) && !empty ($passwort)) {

        if (!isset($_SESSION['login'])) {
            if($mail==$dozent['mail'] && $passwort==$dozent['passwort']){
            $_SESSION ['login'] = 1;
            $_SESSION ['mail'] = $mail;
            $_SESSION ['rights']=$dozent['ID_RECHTE'];
            $_SESSION ['id'] = $dozent['ID'];
            header('location:index.php');
        }
    }
    else {
        echo "Bitte geben sie Name Und Passwort ein.";
    }
}
}
?>
