<?php

    //掲示板への追加処理を行う
    if (isset($_POST["newbbs"])) {
        $newdbname = htmlspecialchars($_POST["newdbname"], ENT_QUOTES);
        $newdbname_kana = htmlspecialchars($_POST["newdbname_kana"], ENT_QUOTES);
        $db = new PDO("sqlite:list.db");
        $db->exec("INSERT INTO list (dbname, dbname_kana) VALUES ('$newdbname', '$newdbname_kana')");
        $name = $newdbname.".db";
        $db = new SQLite3($name);
        $db->exec("CREATE TABLE bbs (id INTEGER PRIMARY KEY, post_day TEXT, comment TEXT)");
        $db = null;
        echo "新しい掲示板「".$newdbname_kana."」を作りました。<br><br>";
        echo "<a href='index.php'>掲示板へ戻る</a>";
    }
?>