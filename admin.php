<!DOCTYPE html>
<html lang="de">


<?php
require_once("include/header.php");
require_once("php/classes.php");

session_start();
?>



<?php
$admin=new dozent();
$adminInstnc=$admin->getById($_SESSION['id']);
$userlist=$admin->getAll($_SESSION['id']);

if(!isset($_SESSION['login'])):
    header ('location: index.php');
    ?>

<?php else:?>
    <body>
    <?php require_once("include/navigation.php");
    ?>

    <div class="container">
        <h1> Accountverwaltung</h1>
        <h2> Mein Account</h2>
        <?php
        echo $adminInstnc['name'] ."<br>". $adminInstnc['vorname'] ."<br>".$adminInstnc['mail']."<br>".$adminInstnc['ID_RECHTE']."<br>";
        echo "<a href='do/admin_update.php?id=" . $user['ID'] . "&rights=1 'class='btn btn-success'>Daten ändern</a>";
        echo "<a href='do/admin_delete.php?id=" . $user['ID'] . "'class='btn btn-success'> Account Löschen</a>";
        if ($_SESSION['rights']>1){
        ?>

        <h2>Admin Area</h2>

        <?php
            foreach ($userlist as $user){
                echo $user['name'].$user['vorname'].$user['mail'].$user['ID_RECHTE'];
                if ($_SESSION['rights']>$user['ID_RECHTE']) {
                    if (empty($user['ID_RECHTE'])) {
                        echo "<a href='do/admin_update.php?id=" . $user['ID'] . "&rights=1' class='btn btn-success'>Freischalten</a>";
                    }
                    echo "<a href='do/admin_delete.php?id=" . $user['ID'] . "'class='btn btn-success'>Löschen</a>";

                    if ($user['ID_RECHTE']==1){
                        echo "<a href='do/admin_update.php?id=" . $user['ID'] . "&rights=2 'class='btn btn-success'>Grant Admin</a>";

                    } elseif($user['ID_RECHTE']>1) {
                        echo "<a href='do/admin_update.php?id=" . $user['ID'] . "&rights=1 'class='btn btn-success'>Take Admin</a>";
                    }

                }
                echo "<br>---<br>";
            }
        }
        ?>

    </div>

    </body>

<?php endif; ?>
</html>





