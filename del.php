<?php
//掲示板の削除を行う
if (isset($_GET["dbname"])){
    $dbname = htmlspecialchars($_GET["dbname"],ENT_QUOTES);
    $db = new PDO("sqlite:list.db");
    $db -> exec("DELETE FROM list WHERE dbname='$dbname'");
    $name = "db/".$dbname.".db";

    //スレはファイルごとに存在するのでそれごと消す
    unlink($name);
    echo "削除しました。<BR>
    <BR>";
    echo "<a href='index.php'>掲示板へ戻る</a>";
}
?>