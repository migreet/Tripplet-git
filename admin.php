    <!DOCTYPE html>
    <html lang="de">


    <?php require_once("include/header.php");
    require_once("php/classes.php");

    session_start();
    ?>



    <?php
    $admin=new dozent();
    $adminInstnc=$admin->getById($_SESSION['id']);
    $userlist=$admin->getAll();
    if(!isset($_SESSION['login']) or $adminInstnc['ID_RECHTE'] != 2):
        header ('location: index.php');
    ?>

    <?php else: ?>
        <body>
        <?php require_once("include/navigation.php");
        ?>

        <div class="container">
            <h1> Accountverwaltung</h1>
            <?php foreach ($userlist as $user){
                echo $user['name'].$user['vorname'].$user['mail'].$user['ID_RECHTE']."---<br>";
            }
            ?>

        </div>

        </body>

    <?php endif; ?>

    </html>





