<?php

use FrontApp\Controller\{ArticleController, SigninController, SignoutController, SignupController, UserController};

$router->map('GET', '/', function() {
    $articleController = new ArticleController();
    $articleController->index();
});
$router->map('GET|POST', '/article/new', function() {
    $articleController = new ArticleController();
    $articleController->new();
});
$router->map('GET', '/article/show/[i:id]', function(int $id) {
    $articleController = new ArticleController();
    $articleController->show($id);
});
$router->map('GET|POST', '/article/edit/[i:id]', function(int $id) {
    $articleController = new ArticleController();
    $articleController->edit($id);
});
$router->map('GET', '/article/delete/[i:id]', function(int $id) {
    $articleController = new ArticleController();
    $articleController->delete($id);
});
$router->map('GET|POST', '/signup', function () {
    $signupController = new SignupController();
    $signupController->index();
});
$router->map('GET|POST', '/signin', function () {
    $signinController = new SigninController();
    $signinController->index();
});
$router->map('GET', '/signout', function () {
    $signoutController = new SignoutController();
    $signoutController->index();
});
$router->map('GET', '/user', function () {
    $userController = new UserController();
    $userController->index();
});
$router->map('GET|POST', '/user/show/[*:id]', function ($id) {
    $userController = new UserController();
    $userController->show($id);
});
$router->map('GET|POST', '/user/edit/[*:id]', function ($id) {
    $userController = new UserController();
    $userController->edit($id);
});
$router->map('GET', '/user/delete/[*:id]', function ($id) {
    $userController = new UserController();
    $userController->delete($id);
});
