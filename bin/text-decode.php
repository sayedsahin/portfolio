<?php

require_once __DIR__ . '/../config/path.php';
require_once ROOT_PATH . '/vendor/autoload.php';
require ROOT_PATH . '/bootstrap/config.php';
require ROOT_PATH . '/bootstrap/container.php';



$table = 'socials'; //projects, abouts, socials
$column = 'icon'; //description, about_1, about_2, icon
$items = db()->table($table)->get();

$htmlS = [];
foreach ($items as $item) {
    $encoded_html = $item->{$column};
    if (!$encoded_html) {
        continue;
    }

    $updated = generated($column, $encoded_html, $table, $item->id);

    echo $updated. "\n";
}


function generated(string $column, string $encoded_html, string $table, int $id)
{
    $clean_text = str_replace('```', '', $encoded_html);

    $decoded_html = htmlspecialchars_decode($clean_text);


    $final_html = stripcslashes($decoded_html);


    // // $inserted = true;
    return db()->table($table)->where('id', $id)->update([
        $column => $final_html
    ]);
}


