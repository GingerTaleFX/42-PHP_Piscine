<?php

$passwd = "";
$file_exists = 0;
$tmp[] = '';

if($_POST && $_POST["submit"] === "OK" && $_POST["submit"] && $_POST["login"] && $_POST["oldpw"] && $_POST["newpw"]){
    $passwd = unserialize(file_get_contents("../private/passwd"));
    if ($passwd){
        foreach($passwd as $key => $value){
            if ($value["login"] === $_POST["login"] && $value["passwd"] === hash('whirlpool', $_POST["oldpw"])){
                $file_exists = 1;
                $passwd[$key]["passwd"] = hash('whirlpool', $_POST["newpw"]);
            }
        }
        if ($file_exists){
            file_put_contents("../private/passwd", serialize($passwd));
            echo "OK\n";
        }
        else {
            echo "ERROR\n";
        }
    } else{
        echo "ERROR\n";
    }
} else {
    echo "ERROR\n";
}
?>