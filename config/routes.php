<?php 	

use Controllers\AccountController;
use Controllers\DashboardController;
use Controllers\HomeController;
use Controllers\ImageController;
use Controllers\MessageController;
use Controllers\PasswordController;
use Controllers\ProjectController;
use Controllers\SiteController;
use Controllers\SocialController;
use Controllers\UserController;


$route->get('/', [HomeController::class, 'index']);
$route->post('/contact', [HomeController::class, 'contact']);

// Project Route
$route->get('/projects', [ProjectController::class, 'index']);

$route->get('/projects/create', [ProjectController::class, 'create']);
$route->post('/projects/store', [ProjectController::class, 'store']);
$route->post('/projects/image/store', [ImageController::class, 'store']);
$route->get('/projects/image/{id:\d+}/delete', [ImageController::class, 'delete']);

$route->get('/projects/{id:\d+}', [HomeController::class, 'project']);
$route->get('/projects/{id:\d+}/show', [ProjectController::class, 'show']);

$route->get('/projects/{id:\d+}/edit', [ProjectController::class, 'edit']);
$route->post('/projects/{id:\d+}/update', [ProjectController::class, 'update']);
$route->get('/projects/{id:\d+}/delete', [ProjectController::class, 'delete']);


$route->get('/dashboard', [DashboardController::class, 'index']);

$route->get('/password', [PasswordController::class, 'edit']);
$route->post('/password/update', [PasswordController::class, 'update']);

$route->get('/user', [UserController::class, 'edit']);
$route->post('/user/name', [UserController::class, 'name']);
$route->post('/user/email', [UserController::class, 'email']);
$route->post('/user/contact', [UserController::class, 'contact']);
$route->post('/user/info', [UserController::class, 'info']);
$route->post('/user/avatar', [UserController::class, 'avatar']);
$route->post('/user/about', [UserController::class, 'about']);
$route->post('/user/experience', [UserController::class, 'experience']);

$route->get('/site', [SiteController::class, 'edit']);
$route->post('/site', [SiteController::class, 'update']);

$route->get('/socials', [SocialController::class, 'index']);
$route->get('/socials/create', [SocialController::class, 'create']);
$route->post('/socials/create', [SocialController::class, 'store']);
$route->get('/socials/{id:\d+}/edit', [SocialController::class, 'edit']);
$route->post('/socials/{id:\d+}/edit', [SocialController::class, 'update']);
$route->get('/socials/{id:\d+}/delete', [SocialController::class, 'delete']);

$route->get('/messages', [MessageController::class, 'index']);
$route->get('/messages/new', [MessageController::class, 'new']);
$route->post('/messages/new', [MessageController::class, 'sendMessage']);
$route->post('/messages/reply', [MessageController::class, 'reply']);
$route->get('/messages/{id:\d+}', [MessageController::class, 'show']);
$route->get('/messages/{id:\d+}/delete', [MessageController::class, 'delete']);

// Account Route
$route->get('/login', [AccountController::class, 'index']);
$route->post('/login', [AccountController::class, 'login']);
$route->get('/logout', [AccountController::class, 'logout']);