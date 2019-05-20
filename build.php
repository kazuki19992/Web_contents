<?php
//掲示板の追加処理を行う

if (isset($_POST["newbbs"])) {
  $newdbname = htmlspecialchars($_POST["newdbname"], ENT_QUOTES);
  $newdbname_kana = htmlspecialchars($_POST["newdbname_kana"], ENT_QUOTES);
  $db = new PDO("sqlite:list.db");
  $db->exec("INSERT INTO list (dbname, dbname_kana) VALUES ('$newdbname', '$newdbname_kana')");
  $name = "db/".$newdbname.".db";
  $db = new SQLite3($name);
  $sql = "CREATE TABLE bbs (id INTEGER PRIMARY KEY, hiduke TEXT, comment TEXT)";
  $res = $db -> query($sql);
  var_dump($res);

  //ファイルのモードを変更する
  chmod("db/".$newdbname.".db" , 0766);
  
  $db = null;
  echo "新しい掲示板「".$newdbname_kana."」を作りました。<br><br>";
  echo "<a href='index.php'>掲示板へ戻る</a>";
}
?>