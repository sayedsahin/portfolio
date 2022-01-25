<?php

require_once __DIR__.'/vendor/autoload.php';

$dotenv = new \Symfony\Component\Dotenv\Dotenv();
$dotenv->load(__DIR__.'/.env');

require_once __DIR__.'/config/config.php';
include_once __DIR__.'/app/Systems/Utility.php';
// $d = (bool) IS_DEBUG;
// dd($d);
include_once __DIR__.'/app/Systems/Route.php';

// $main = new \Systems\Core();