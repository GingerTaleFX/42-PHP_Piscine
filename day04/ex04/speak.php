<?php
session_start();
date_default_timezone_set('Europe/Moscow');

$chat = '';

if(!$_SESSION['loggued_on_user']){
    echo "ERROR\n";
} else {
    if($_POST && $_POST['msg'])
    {
        if(!file_exists("../private/")){
            mkdir("../private");
        }
        if (!file_exists("../private/chat")){
            file_put_contents("../private/chat", null);
        }
        $chat = unserialize(file_get_contents("../private/chat"));
        $write = fopen("../private/chat", "w");
        // flock($write, LOCK_EX);
        $tmp['login'] = $_SESSION['loggued_on_user'];
        echo $_SESSION['loggued_on_user'];
        $tmp['time'] = time();
        $tmp['msg'] = $_POST['msg'];
        $chat[] = $tmp;
        file_put_contents("../private/chat", serialize($chat));
        // flock($write, LOCK_UN);
        fclose($write);
    }
}
?>
 <html>
    <head>
        <script langage="javascript">top.frames['chat'].location = 'chat.php';</script>
    </head>
    <body>
        <form action="speak.php" method="POST">
            <input type="text" name="msg" value=""/><input type="submit" name="submit" value="Send"/>
        </form>
    </body>
</html>