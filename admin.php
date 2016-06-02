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
        <?php
        //Breadcrumb
        echo"
        <div calss='breadcrumb'>
        <a href='index.php'>home</a>>Accountverwaltung
        </div>";
        ?>
        <h1> Accountverwaltung</h1>
        <h2> Mein Account</h2>
        <div class="panel panel-default">
            <div class="panel-body">
        <?php
        echo "<div class='col-md-6'>";
        echo $adminInstnc['name'] ."<br>". $adminInstnc['vorname'] ."<br>".$adminInstnc['mail']."<br>".$adminInstnc['ID_RECHTE']."<br>";
        echo "</div><div class='col-md-6'>";
        echo "<a href='do/admin_update.php?id=" . $user['ID'] . "&rights=1 'class='btn btn-default'>Daten ändern</a>";
        echo "<a href='do/admin_delete.php?id=" . $user['ID'] . "'class='btn btn-default'> Account Löschen</a>";
        echo "</div>
            </div>
        </div>";
        if ($_SESSION['rights']>1){
        ?>

        <h2>Admin Area</h2>
            <div class="list-group">
        <?php
            foreach ($userlist as $user){
                echo "<div class='list-group-item'><div class='col-md-6'>";
                echo $user['name'].$user['vorname'].$user['mail'].$user['ID_RECHTE'];
                echo "</div><div class='col-md-6'>";
                if ($_SESSION['rights']>$user['ID_RECHTE']) {
                    if (empty($user['ID_RECHTE'])) {
                        echo "<a href='do/admin_update.php?id=" . $user['ID'] . "&rights=1' class='btn btn-default'>Freischalten</a>";
                    }
                    echo "<a href='do/admin_delete.php?id=" . $user['ID'] . "'class='btn btn-default'>Löschen</a>";

                    if ($user['ID_RECHTE']==1){
                        echo "<a href='do/admin_update.php?id=" . $user['ID'] . "&rights=2 'class='btn btn-default'>Grant Admin</a>";

                    } elseif($user['ID_RECHTE']>1) {
                        echo "<a href='do/admin_update.php?id=" . $user['ID'] . "&rights=1 'class='btn btn-default'>Take Admin</a>";
                    }

                }
                echo "</div></div>";
            }
        }
        ?>

    </div>

    </body>

<?php endif; ?>
</html>





