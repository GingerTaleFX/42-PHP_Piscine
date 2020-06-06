#!/usr/bin/php
<?php
$new = "";

if ($argc > 1)
{
    $array = array_values(array_filter(explode(' ', $argv[1])));
    $array[count($array)] = $array[0];
    unset($array[0]);
    foreach ($array as $value)
        $new .= $value.' ';
    echo trim($new)."\n";
}
?>
