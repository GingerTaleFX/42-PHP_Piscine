<?php
if ($_POST && $_POST["submit"] === "OK" && $_POST["submit"] && $_POST["login"] && $_POST["passwd"])
{
    $file_exists = 0;
    $tmp[] = '';
    if(!file_exists("../private")){
        mkdir("../private");
    }
    If(!file_exists("../private/passwd")){
        file_put_contents("../private/passwd", null);
    }
    $passwd = unserialize(file_get_contents("../private/passwd"));
    if ($passwd){
        foreach($passwd as $key => $value)
        {
            if ($value["login"] == $_POST["login"])
                $file_exists = 1;
        }
    }
    if ($file_exists){
        echo "ERROR\n";
    }
    else {
        $tmp["login"] = $_POST["login"];
        $tmp["passwd"] = hash('whirlpool', $_POST["passwd"]);
        $passwd[] = $tmp;
        file_put_contents("../private/passwd", serialize($passwd));
        echo "OK\n";
    }
}
else{
    echo "ERROR\n";
}
?>