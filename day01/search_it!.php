#!/usr/bin/php
<?php
 if ($argc < 3)
     exit();
    $word = $argv[1];
    unset($argv[0], $argv[1]);
    $av = array_reverse($argv);
    foreach ($av as $value)
    {
        $tmp = explode(":", $value);
        if ($tmp[0] === $word)
        {
            echo $tmp[1]."\n";
            exit();
        }
    }
?>
