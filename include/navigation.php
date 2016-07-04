<!-- Navigation eingeloggt-->

<nav class="navbar navbar-inverse">
    <div class="container">
        <ul class="nav navbar-nav" style="float: right">
            <?php
            if ($_SESSION['rights']<1):
                echo "<li>
                        <a href="admin.php">Accountverwaltung</a>
                      </li>";
            endif; ?>
            <li>
                <a href="logout.php">Logout</a>
            </li>
        </ul>
    </div>
</nav>
<div class="nav-abstand">
</div>

