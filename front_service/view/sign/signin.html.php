<?php

require_once VIEW . DIRECTORY_SEPARATOR . 'header.html.php';
require_once VIEW . DIRECTORY_SEPARATOR . 'error_messages.html.php';
?>
    <form class="border border-1 rounded p-3" action="" method="post">
        <div class="mb-3">
            <label class="form-label" for="email">Email : </label>
            <input class="form-control" type="email" name="email" id="email" placeholder="Example : test@test.com">
        </div>
        <div class="mb-3">
            <label class="form-label" for="pwd">Password : </label>
            <input class="form-control" type="password" name="pwd" id="pwd" placeholder="Enter your password">
        </div>
        <button class="btn btn-primary" type="submit">Send</button>
        <button class="btn btn-light" type="reset">Reset</button>
    </form>
<?php
require_once VIEW . DIRECTORY_SEPARATOR . "footer.html.php";
?>