#!/usr/bin/php
<?php
if ($argc != 2)
    return (0);

$arr = file('php://stdin');
unset ($arr[0]);

if ($argv[1] == "average")
{
    $g = 0;
    $c = 0;
    foreach ($arr as $value)
    {
        $tmp = explode(";", $value);
        if ($tmp[1] != '' && $tmp[2] != "moulinette")
        {
            $g += $tmp[1];
            $c++;
        }
    }
    if ($c > 0)
        echo $g / $c."\n";
}

if ($argv[1] == "average_user")
{
    asort($arr);
    foreach ($arr as $v)
    {
        $tmp = explode(";", $v);
        $list[$tmp[0]] = 0;
    }
    foreach ($list as $user => $key)
    {
        $g = 0;
        $c = 0;
        foreach ($arr as $v)
        {
            $tmp = explode(";", $v);
            if ($tmp[1] != '' && $tmp[0] == $user && $tmp[2] != "moulinette")
            {
                $g += $tmp[1];
                $c++;
            }
        }
        if ($c > 0)
            echo $user.":".($g / $c)."\n";
    }
}

if ($argv[1] == "moulinette_variance")
{
    asort($arr);
    foreach ($arr as $v)
    {
        $tmp = explode(";", $v);
        $list[$tmp[0]] = 0;
    }
    foreach ($list as $user => $key)
    {
        $g = 0;
        $c = 0;
        $m = 0;
        foreach ($arr as $v)
        {
            $tmp = explode(";", $v);
            if ($tmp[0] == $user && $tmp[1] != '' && $tmp[2] == "moulinette")
                $m = $tmp[1];
        }
        foreach ($arr as $v)
        {
            $tmp = explode(";", $v);
            if ($tmp[0] == $user && $tmp[1] != '' && $tmp[2] != "moulinette")
            {
                $g += $tmp[1] - $m;
                $c++;
            }
        }
        if ($c > 0)
            echo $user.":".($g / $c)."\n";
    }
}
?>