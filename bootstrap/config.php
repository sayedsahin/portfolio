<?php

declare(strict_types=1);

use App\Systems\Config\Config;
use App\Systems\Config\ConfigLoader;


$cacheFile = STORAGE_PATH . '/cache/config.php';

if (is_file($cacheFile)) {
    Config::load(ConfigLoader::loadFromCache($cacheFile));
} else {
    require ROOT_PATH . '/bootstrap/dotenv.php';

    // Load with cache
    $items = ConfigLoader::load(ROOT_PATH . '/config');
    Config::load($items);

    // create cache file
    if (config('app.debug') === false) {
        ConfigLoader::writeCache($cacheFile, $items);
    }
}

date_default_timezone_set((string) config('app.timezone', 'UTC'));
define('BASE_URL', (string) config('app.url', 'http://localhost'));

