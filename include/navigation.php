<?php
/**
 * Created by PhpStorm.
 * User: Mic
 * Date: 31.03.2016
 * Time: 14:12
 */
?>

<nav class="navbar navbar-inverse">
    <div class="container">
    <ul class="nav navbar-nav">
        <a class="navbar-brand" href="index.php">
            <span class="glyphicon glyphicon-stats" aria-hidden="true"></span>
        </a>
        <li>
            <a href="index.php" >home</a>


        </li>
        <li>
            <?php
            $admin=new dozent();
            $adminInstnc=$admin->getById($_SESSION['id']);
            if ($adminInstnc['ID_RECHTE'] == 2):
            ?>
                <a href="admin.php" >Accountverwaltung</a>
            <?php endif; ?>
        </li>
        <li>
            <a href="index.php" >test3</a>
        </li>
        <li>
            <a href="index.php" >test4</a>
        </li>
        <li>
            <a href="index.php" >test5</a>
        </li>
        <li>
            <a href="logout.php" >Logout</a>
        </li>
    </ul>
    </div>

</nav>
</div>
</nav>
