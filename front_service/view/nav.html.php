<nav class="navbar navbar-expand-xl bg-dark navbar-dark fixed-top">
    <div class="container-fluid">
        <a class="navbar-brand" href="/">Wonderfull WebSite</a>
        <ul class="navbar-nav me-auto">
            <li class="nav-item"><a class="nav-link" href="/">Home</a>
                <?php
//                if (isset($_SESSION['user'])) :
                ?>
            <li class="nav-item"><a class="nav-link" href="/article/new">New article</a></li>
            <li class="nav-item"><a class="nav-link" href="/user">User list</a></li>
            <li class="nav-item"><a class="nav-link" href="/signout">Sign out</a></li>
            <?php
//            else :
                ?>
                <li class="nav-item"><a class="nav-link" href="/signup">Sign up</a></li>
                <li class="nav-item"><a class="nav-link" href="/signin">Sign in</a></li>
            <?php
//            endif;
            ?>
        </ul>
        <span class="navbar-text">Bonjour <?= (isset($_SESSION['user'])) ? $_SESSION['user']->getPseudo(
            ) : "invité mystère"; ?> !</span>
    </div>
</nav>