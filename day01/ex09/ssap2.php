#!/usr/bin/php
<?php
    function ft_sorter($a, $b){
        $i = 0;
        $line = "abcdefghijklmnopqrstuvwxyz0123456789!\"
			#$%&'()*+,-./:;<=>?@[\]^_`{|}~";
        while (($i < strlen($a))|| ($i < strlen($b)))
        {
            $a_ind = stripos($line, $a[$i]);
            $b_ind = stripos($line, $b[$i]);
            if ($a_ind > $b_ind)
                return (1);
            else if ($a_ind < $b_ind)
                return (-1);
            else
                $i++;
        }
    }

    $arr = array();
    unset($argv[0]);
    foreach ($argv as $value)
    {
        $tmp = preg_split("/[\s]+/", trim($value));
        if ($tmp[0] != "")
            $arr = array_merge($arr, $tmp);

    }
    usort($arr, "ft_sorter");
    foreach ($arr as $value)
        echo $value."\n";
?>
