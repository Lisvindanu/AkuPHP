<nav class="navbarhp">
    <a href="../index.php" class="navlinkhp">
        <i class="material-symbols-outlined nav-icon"> home </i>
        <span class="nav-text">Home</span>
    </a>
    <?php
    if (isset($_SESSION['submit']) && $_SESSION['submit'] === true) {
        echo '<a href="../tubes/php/logout.php" class="navlinkhp">
                <i class="material-symbols-outlined nav-icon"> account_circle </i>
                <span class="nav-text">Logout</span>
              </a>';
    } else {
        echo '<a href="../php/login.php" class="navlinkhp">
                <i class="material-symbols-outlined nav-icon"> account_circle </i>
                <span class="nav-text">User</span>
              </a>';
    }
    ?>
    <a href="../php/adminuser.php" class="navlinkhp">
        <i class="material-symbols-outlined nav-icon"> account_circle </i>
        <span class="nav-text">user</span>
    </a>
    <a href="../php/admin.php" class="navlinkhp">
        <i class="material-symbols-outlined nav-icon"> account_circle </i>
        <span class="nav-text">produk</span>
    </a>
</nav>