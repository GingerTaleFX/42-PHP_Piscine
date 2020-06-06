#!/usr/bin/php
<?php
    if ($argc == 2)
    {
        $ret = array_filter(explode(' ', $argv[1]));
        $str = "";
        foreach ($ret as $v)
            $str .= $v." ";
        echo trim($str)."\n";
    }
?>
