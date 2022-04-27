<?php

require_once VIEW . DIRECTORY_SEPARATOR . 'header.html.php';
require_once VIEW . DIRECTORY_SEPARATOR . 'error_messages.html.php';
?>
    <form class="border border-1 rounded p-3" action="" method="post">
        <div class="mb-3">
            <label class="form-label" for="pseudo">Pseudonym : </label>
            <input class="form-control" type="text" id="pseudo" name="pseudo" placeholder="Your pseudonym" value="<?= isset($user) ? $user->getPseudo() : ""; ?>">
        </div>
        <div class="mb-3">
            <label class="form-label" for="email">Email : </label>
            <input class="form-control" type="email" id="email" name="email" placeholder="Example : test@test.com" value="<?= isset($user) ? $user->getEmail() : ""; ?>">
            <div id="emailHelp" class="form-text">We'll never share your email with anyone else.</div>
        </div>
        <div class="mb-3">
            <label class="form-label" for="pwd">Password : </label>
            <input class="form-control" type="password" id="pwd" name="pwd" placeholder="Enter your password">
        </div>
        <div class="mb-3">
            <label class="form-label" for="new_pwd">New password : </label>
            <input class="form-control" type="password" id="new_pwd" name="new_pwd"
                   placeholder="Set your new password">
        </div>
        <div class="mb-3">
            <label class="form-label" for="conf_new_pwd">Confirm new password : </label>
            <input class="form-control" type="password" id="conf_new_pwd" name="conf_new_pwd"
                   placeholder="Confirm your new password">
        </div>
        <button class="btn btn-primary" type="submit">Send</button>
        <button class="btn btn-light" type="reset">Reset</button>
    </form>
<?php
require_once VIEW . DIRECTORY_SEPARATOR . "footer.html.php";
?>