<?php

require_once VIEW . DIRECTORY_SEPARATOR . 'header.html.php';
?>
    <table class="table table-striped table-hover">
        <thead class="table-dark">
        <tr>
            <th>#</th>
            <th>ID</th>
            <th>Pseudonym</th>
            <th>Email</th>
            <th>Created at</th>
            <th>Action</th>
        </tr>
        </thead>
        <tbody>
        <?php
        foreach ($users as $key => $user) :
            ?>
            <tr>
                <th><?= ++$key ?></th>
                <th><?= $user->getIdUser() ?></th>
                <td><?= $user->getPseudo() ?></td>
                <td><?= $user->getEmail() ?></td>
                <td><?= $user->getCreatedAt() ?></td>
                <td>
                    <ul class="nav">
                        <li class="nav-item me-2">
                            <a class="nav-link btn btn-primary text-light" href="/user/show/<?= $user->getIdUser() ?>">Show</a>
                        </li>
                        <li class="nav-item me-2">
                            <a class="nav-link btn btn-primary text-light" href="/user/edit/<?= $user->getIdUser() ?>">Edit</a>
                        </li>
                        <li class="nav-item me-2">
                            <a class="nav-link btn btn-danger text-light" href="/user/delete/<?= $user->getIdUser() ?>">Delete</a>
                        </li>
                    </ul>
                </td>
            </tr>
        <?php
        endforeach;
        ?>
        </tbody>
    </table>
<?php
require_once VIEW . DIRECTORY_SEPARATOR . "footer.html.php";
?>