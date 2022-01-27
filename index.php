<?php

require_once 'vendor/autoload.php';

$dotenv = new \Symfony\Component\Dotenv\Dotenv();
$dotenv->load('.env');

require_once 'config/config.php';
include_once 'app/Systems/Utility.php';
include_once 'app/Systems/Route.php';

// $main = new \Systems\Core();