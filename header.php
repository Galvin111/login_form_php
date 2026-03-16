<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
} ?>
<header class="site-header">
    <div class="container header-inner">
        <a href="index.php" class="brand">Login Form</a>

        <nav class="nav-links">
            <a href="index.php">Home</a>

            <?php if (isset($_SESSION["name"])) { ?>
                <span class="nav-user">Welcome, <?php echo htmlspecialchars(
                    $_SESSION["name"],
                ); ?></span>
                <a href="logout.php">Logout</a>
            <?php } else { ?>
                <a href="login.php">Login</a>
            <?php } ?>
        </nav>
    </div>
</header>
