<!DOCTYPE html>
<html lang="de">
<body>

<?php
/**
 * Requires
 */
require_once("include/header.php");
require_once("php/classes.php");

/**
 * Instanzen
 */
$admin=new dozent();

/**
 * Session wird gestartet
 */
session_start();

/**
 * Aktuelleer User wird ausgelesen
 */
$adminInstnc=$admin->getById($_SESSION['id']);

/**
 * Userliste für Admin wird ausgelesen
 */
$userlist=$admin->getAll($_SESSION['id']);

/**
 * Sicherheitsabfrage
 */
if(!isset($_SESSION['login'])):
    header ('location: index.php');

else:
    require_once("include/navigation.php");
    ?>

    <div class="container">
        <?php
        /**
         * Breadcrumb
         */
        echo"
        <div class='breadcrumb'>
        <i class='fa fa-angle-right'></i> <a href='index.php'> Vorlesungen</a> <i class='fa fa-angle-right'></i> Accountverwaltung
        </div>";
        ?>
        <h1> Accountverwaltung</h1>
        <div class='col-md-4'>
        <div class="panel panel-default">
            <div class="panel-body">
        <?php
        /**
         * Aktueller User wird an dieser Stelle ausgegeben
         */
        echo "<div class='col-md-6'>";
        echo $adminInstnc['name'] ."<br>". $adminInstnc['vorname'] ."<br>".$adminInstnc['mail']."<br>".$adminInstnc['ID_RECHTE']."<br>";
        echo "</div><div class='col-md-6'>";
        echo "<a href='do/admin_update.php?id=" . $user['ID'] . "&rights=1 'class='btn btn-default'>Daten ändern</a>";
        echo "<a href='do/admin_delete.php?id=" . $user['ID'] . "'class='btn btn-default'> Account Löschen</a>";
        echo "</div>
            </div>
        </div></div> <div class='col-md-8'>";

        if ($_SESSION['rights']>1){
        ?>

        <?php
            /**
             * Rechteprüfung und Ausgabe der zu überprüfenden User
             */
            foreach ($userlist as $user){
                echo "<div class='col-md-6'>";
                echo $user['name'].$user['vorname'].$user['mail'].$user['ID_RECHTE'];
                echo "</div>";
                echo "<div class='col-md-6'>";
                if ($_SESSION['rights']>$user['ID_RECHTE']):
                    if (empty($user['ID_RECHTE'])):
                        echo "<a href='do/admin_update.php?id=" . $user['ID'] . "&rights=1' class='btn btn-default'>Freischalten</a>";
                    endif;

                    if ($user['ID_RECHTE']==1):
                        echo "<a href='do/admin_update.php?id=" . $user['ID'] . "&rights=2 'class='btn btn-default'>Grant Admin</a>";
                    endif;

                    echo "<a href='do/admin_delete.php?id=" . $user['ID'] . "'class='btn btn-default'>Löschen</a>";

                else:
                    echo "<a href='' class='btn btn-default btn-doppel'>ACCESS DENIED!</a>";

                endif;
                echo "</div>" ;
            }
        }
        ?>

    </div>
            </div>
            </div>
                <?php require_once('include/footer.php'); ?>
    </body>

<?php endif; ?>
</html>





