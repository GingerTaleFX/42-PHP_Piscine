#!/usr/bin/php
<?php
if ($argc != 4 || $argc == 1)
    echo "Incorrect Parameters\n";
else{
    $a = trim($argv[1]);
    $b = trim($argv[3]);
    $sign = trim($argv[2]);
    if ($sign != "%" && $sign != "/" && $sign != "*" && $sign != "+" && $sign != "-")
        echo "Incorrect Parameters\n";
    if ($b == 0 && ($sign == "%" || $sign == "/"))
        echo "You can't divide on zero\n";
    else if ($sign == "+")
        echo $a + $b."\n";
    else if ($sign == "-")
        echo $a - $b."\n";
    else if ($sign == "*")
        echo $a * $b."\n";
    else if ($sign == "/")
        echo $a / $b."\n";
    else if ($sign == "%")
        echo $a % $b."\n";
}
?>
