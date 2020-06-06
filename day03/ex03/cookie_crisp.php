<?php

if($_GET)
{
    switch ($_GET["action"]) {
        case ("set") :
            if (($_GET["name"]) && ($_GET["value"]))
                setcookie($_GET["name"], $_GET["value"], time() + 3600);
            break;
        case("get") :
            if (!$_COOKIE)
                break;
            if ($_GET["name"] && ($_COOKIE[$_GET["name"]]))
                echo $_COOKIE[$_GET["name"]] . "\n";
            break;
        case ("del") :
            if ($_GET["name"])
                setcookie($_GET["name"], '', time() - 3600);
            break;
        default :
            break;
    }
}
?>