<?php

require_once VIEW . DIRECTORY_SEPARATOR . 'header.html.php';
?>
    <article class="p-3 border border-1 rounded mb-3">
        <h3>Pseudonym : <?= filter_var($user->getPseudo(), FILTER_SANITIZE_FULL_SPECIAL_CHARS) ?></h3>
        <h5>Email : <?= filter_var($user->getEmail(), FILTER_SANITIZE_FULL_SPECIAL_CHARS) ?></h5>
        <h5>Created at : <?= $user->getCreatedAt() ?></h5>
        <hr>
        <ul class="nav">
            <li class="nav-item me-2">
                <a class="nav-link btn btn-primary text-light"
                   href="<?= sprintf("/user/edit/%d", $user->getIdUser()) ?>">Edit</a>
            </li>
            <li class="nav-item me-2">
                <a class="nav-link btn btn-danger text-light"
                   href="<?= sprintf("/user/delete/%d", $user->getIdUser()) ?>">Delete</a>
            </li>
        </ul>
    </article>
<?php
require_once VIEW . DIRECTORY_SEPARATOR . "footer.html.php";
?>