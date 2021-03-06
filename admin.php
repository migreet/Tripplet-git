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
$adminInstnc=$admin->getById($_SESSION['user_id']);

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
    /**
    * Sicherheitscheck dass nicht-Admins nicht auf Accountverwaltung kommen
    */
    if ($_SESSION['rights']<2):
        header ('location: index.php');
    endif;
    require_once("include/navigation.php");
    ?>

    <div class="container">

        <!-- Breadcrumb -->
        <div class='breadcrumb'>
            <i class='fa fa-angle-right'></i> <a href='index.php'> Vorlesungen</a> <i class='fa fa-angle-right'></i> Accountverwaltung
        </div>

        <h1> Accountverwaltung</h1>
        <div class='col-md-4'>
            <div class="panel panel-default sidebar-left">
                <div class="panel-body">
                        <div class='col-md-6'>
                        <h5>Deine Accountdaten</h5>
                            <?php
                            /**
                             * Aktueller User wird an dieser Stelle ausgegeben
                             */
                            echo $adminInstnc['name'] ."<br>". $adminInstnc['vorname'] ."<br>".$adminInstnc['mail']."<br>".$adminInstnc['ID_RECHTE']."<br>";
                            ?>
                        </div>
                    </div>
            </div>
        <?php
        require_once('include/footer.php');
        ?>
        </div>


        <div class='col-md-8'>

            <?php
            if ($_SESSION['rights']>1):

            /**
             * Rechteprüfung und Ausgabe der zu überprüfenden User
             */
            foreach ($userlist as $user){
                echo "<div class='col-md-6'>";
                echo "<strong> " . $user['name']." ".$user['vorname']." </strong>".$user['mail']." ".$user['ID_RECHTE'] . " ";
                echo "</div>";
                echo "<div class='col-md-6'>";
                if ($_SESSION['rights']>$user['ID_RECHTE']):
                    if (empty($user['ID_RECHTE'])):
                        echo "<a href='do/admin_update.php?id=" . $user['ID'] . "&rights=1' class='btn btn-default'>freigeben</a>";
                    endif;

                    if ($user['ID_RECHTE']==1):
                        echo "<a href='do/admin_update.php?id=" . $user['ID'] . "&rights=2 'class='btn btn-default'>Admin!</a>";
                    endif;

                    echo "<a href='do/admin_delete.php?id=" . $user['ID'] . "'class='btn btn-default'>löschen</a>";

                else:
                    echo "<a href='' class='btn btn-default btn-doppel'>ACCESS DENIED!</a>";

                endif;
                echo "</div>" ;
            }
        endif;
        ?>

        </div>
    </div>
</div>
<?php

endif;
?>
</body>
</html>





