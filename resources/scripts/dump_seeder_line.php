<?php
$path = __DIR__ . '/../../database/seeders/DatabaseSeeder.php';
$lines = file($path, FILE_IGNORE_NEW_LINES);
$index = 68;
$line = $lines[$index];
echo "Line " . ($index + 1) . ": ";
foreach (preg_split('//u', $line, -1, PREG_SPLIT_NO_EMPTY) as $char) {
    $hex = bin2hex(iconv('UTF-8', 'UTF-8//IGNORE', $char));
    $display = $char === ' ' ? '[SP]' : $char;
    echo $display . '(' . $hex . ')';
}
echo "\n";
