<?php

    $passwd_file = '';

    function auth($login, $passwd){
        if(!$login || !$passwd){
            return false;
        }
        $passwd_file = unserialize(file_get_contents("../private/passwd"));
        if ($passwd_file)
        {
            foreach($passwd_file as $key => $value){
                if ($value["login"] === $login && $value["passwd"] === hash('whirlpool', $passwd)){
                    return true;
                }
            }
        }
        return false;
    }

?>