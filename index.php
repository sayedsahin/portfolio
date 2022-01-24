<?php

use Symfony\Component\Dotenv\Dotenv;
require_once __DIR__.'/vendor/autoload.php';

$dotenv = new Dotenv();
$dotenv->load(__DIR__.'/.env');

require_once 'config/config.php';
include_once 'app/Systems/Utility.php';
$main = new \Systems\Core();