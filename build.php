<?php
//掲示板の追加処理を行う

if (isset($_POST["newbbs"])) {
  $newdbname = htmlspecialchars($_POST["newdbname"], ENT_QUOTES);
  $newdbname_kana = htmlspecialchars($_POST["newdbname_kana"], ENT_QUOTES);
  $db = new PDO("sqlite:list.db");
  $db->exec("INSERT INTO list (dbname, dbname_kana) VALUES ('$newdbname', '$newdbname_kana')");
  // $name = "db/".$newdbname.".db";
  // $db = new SQLite3($name);
  // $sql = "CREATE TABLE bbs (id INTEGER PRIMARY KEY, hiduke TEXT, comment TEXT)";
  // $res = $db -> query($sql);
  // var_dump($res);

  //ファイルのモードを変更する
  // chmod("db/".$newdbname.".db" , 0766);
  
  //初期のデータを格納(削除可能)
  // 投稿日時等を取得する
  $w = date("w");
  $week_name = ["日", "月", "火", "水", "木", "金", "土"];
  $hiduke = date("Y-m-d H:i:s")."(".$week_name[$w].")";
  //$name = "sqlite:db/".$dbname.".db";
  //投稿処理
  //$db = new PDO($name);
  // $db->exec("INSERT INTO bbs (hiduke, comment) VALUES ('$hiduke', '掲示板が作成されました。')");
  //ここまで



  $db = null;
}
  //echo "新しい掲示板「".$newdbname_kana."」を作りました。<br><br>";
  ?>

  <!DOCTYPE HTML>
  <html>
  <head>
    <title>祝！投稿成功！</title>        
    <meta charset="utf-8">
    <link rel="stylesheet" href="CSS/style.css" media="all">
    <link rel="stylesheet" href="CSS/style2.css" media="all">
    <!--リダイレクト処理-->
    <meta http-equiv="refresh" content="3; url=./index.php">
  </head>
  <body>
  <?php
    echo "<p class=\"msg\">投稿しました！！</p>";
    echo "自動的に掲示板に戻ります。少し待っててね！";
  ?>
  </body>
</head>