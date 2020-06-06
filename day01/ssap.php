#!/usr/bin/php
<?php

    if ($argc > 1)
    {
        $array = array();
        unset($argv[0]);
        foreach ($argv as $val){
            $tmp = array_filter(explode(' ', $val));
            foreach ($tmp as $val2)
                $array[] = $val2;
        }
        sort($array);
        foreach ($array as $val)
            echo $val."\n";
    }
?>
