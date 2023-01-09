<?php 
    require_once('head.php');
    $isLoggedIn = isset($_SESSION["loggedin"]);
?>

<nav class="navbar mb-4 border-bottom">
    <div class="container">
        <a href="<?= ROOT ?>/index.php" class="navbar-brand">Home</a>
        <ul class="navbar-nav d-flex flex-row">
            <?php if($isLoggedIn): ?>
                <li class="nav-item">
                    <?php if($_SESSION["role"] == 1):?>
                        <a href="<?= ROOT ?>/cms/pages/options.php" class="nav-link">Edit</a>
                    <?php else: ?>
                        <a href="<?= ROOT ?>/cms/pages/messages.php" class="nav-link">Messages</a>
                    <?php endif; ?>
                </li>
                <li class="nav-item"><a href="<?= ROOT ?>/cms/auth/logout.php" class="nav-link">Logout</a></li>
            <?php else:?>
                <li class="nav-item">
                    <a href="<?= ROOT ?>/cms/auth/login.php" class="nav-link">
                        <i class="fa-solid fa-user"></i>Login
                    </a>
                </li>
            <?php endif;?>
        </ul>
    </div>
</nav>