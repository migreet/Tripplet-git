    <!DOCTYPE html>
    <html lang="de">


    <?php
    require_once("php/classes.php");
    require_once("include/header.php");

    session_start();
    ?>



    <?php
    $admin=new dozent();
    $adminInstnc=$admin->getById($_SESSION['id']);
    $userlist=$admin->getAll();
    if(!isset($_SESSION['login']) or $_SESSION['rights'] <2):
        header ('location: index.php');
    ?>

    <?php else:?>
        <body>
        <?php require_once("include/navigation.php");
        ?>

        <div class="container">
            <h1> Accountverwaltung</h1>
            <?php
            print_r($_SESSION);
            foreach ($userlist as $user){
                echo $user['name'].$user['vorname'].$user['mail'].$user['ID_RECHTE'];
                if ($_SESSION['rights']>=2) {
                    if (empty($user['ID_RECHTE'])) {
                        echo "<a href='admin.php?id=" . $eintrag['ID'] . "'class='btn btn-success'>Freischalten</a>";
                    }
                        echo "<a href='admin.php?id=" . $eintrag['ID'] . "'class='btn btn-success'>L�schen</a>";

                    if ($_SESSION['rights']==3 && $user['ID_RECHTE']!=NULL){

                        echo "<a href='admin.php?id=" . $eintrag['ID'] . "'class='btn btn-success'>Grant Admin</a>";
                    }

                }
                echo "<br>---<br>";
            }
            ?>

        </div>

        </body>

    <?php endif; ?>

    </html>





