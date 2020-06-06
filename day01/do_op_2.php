#!/usr/bin/php
<?php
    if ($argc != 2)
    {
        echo "Incorrect Parameters\n";
        exit();
    }
    $str = str_replace(" ", "", $argv[1]);
    $a = intval($str);
    $operation = substr(substr($str, strlen((string)$a)), 0, 1);
    $b = substr(substr($str, strlen((string)$a)), 1);
    if(!(is_numeric($a)) || !(is_numeric($b))){
        echo "Syntax Error\n";
        exit();
    }
    else if ($b == 0 && ($operation == "%" || $operation == "/"))
    {
        echo "You can't divide on zero\n";
        exit();
    }
    switch ($operation){
        case ("+") :
            echo $a + $b."\n";
            break;
        case ("*") :
            echo $a * $b."\n";
            break;
        case ("-") :
            echo $a - $b."\n";
            break;
        case ("%") :
            echo $a % $b."\n";
            break;
        case ("/") :
            echo $a / $b."\n";
            break;
        default :
            echo "Syntax Error\n";
            exit();
    }
?>
