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
$voting=$votingInstnc->getByKey($schluessel);
print_r($voting);


if(isset ($schluesselsent)) {
    echo $schluessel;
}



if (isset($_SESSION['id']) && $_SESSION['votingid']==$voting['ID']):
?>
<body>
</body>


<?php else: ?>

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