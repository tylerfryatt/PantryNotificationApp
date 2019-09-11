<?php
/**
 * Created by PhpStorm.
 * User: Maryam Khan
 * Date: 6/8/2019
 * Time: 3:28 PM
 * Filename: navbar_content.php
 */
?>
<header><nav class="navbar navbar-expand-lg navbar-light bg-light">
        <a class="navbar-brand" href="index.php">CIS234a</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarText" aria-controls="navbarText" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarText">
            <ul class="navbar-nav mr-auto">
                <li class="nav-item active">
                    <a class="nav-link">Welcome, <?php echo $_SESSION['user_uid'] . '!'; ?></a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="index.php">Home</span></a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="includes/logout.inc.php">Logout</a>
                </li>
            </ul>
        </div>
    </nav></header>
