<!-- PHPの記述を行う-->
<?php

if (isset($_GET["dbname"]) && isset($_GET["dbname_kana"])) {
    $dbname = htmlspecialchars($_GET["dbname"], ENT_QUOTES);
    $dbname_kana = htmlspecialchars($_GET["dbname_kana"], ENT_QUOTES);
    if (isset($_GET["page"])) {
      $page = htmlspecialchars($_GET["page"], ENT_QUOTES);
    } else {
      $page = "";
    }
  } else {
    header("Location: index.php");
  }

// ページングするための情報取得、設定
$name = "sqlite:db/".$dbname.".db";
$db = new PDO($name);
// var_dump($db);
// echo "<BR>";
// $sql="SELECT * FROM BBS";
// $stmt = $db->query($sql);
// var_dump($stmt->rowCount());
// echo "<BR>";
// if($stmt === false){
//   echo "stmtの中身はfalseです。<BR>";

// }

// //var_dump($stmt);
// if($stmt->fetchColumn() === 0){
//   $kensu = 0;
// }else{
//   $kensu = $stmt->fetchColumn();
// } // 総件数
// //var_dump($kensu);
// $hyouji = 3; // 1ページあたり表示件数
// $pcount = ceil($kensu/$hyouji); // 総ページ数
// $plast = $kensu % $hyouji; // 最終ページの件数
// if ($page == "") {
//   $page = $pcount;
// }

//ページ移動のためのリンクを表示
$link = "";
for ($i=1; $i<=$pcount; $i++) {
  $link .= "<a href=bbs.php?dbname=".$dbname."&dbname_kana=".$dbname_kana."&page=".$i.">".$i."</a>&nbsp;&nbsp;";
}

//ページ表示
// $stmt = $db->query("SELECT * FROM bbs LIMIT ($page-1)*$hyouji, $hyouji");
// var_dump($stmt);
// $html = "<h2 style='color:#ff0000;'>".$dbname_kana."</h2>";
// $list = $stmt->fetchAll(PDO::FETCH_ASSOC);
// foreach ($list as $row) {
//   $html .= $row["id"]." : ".$row["hiduke"]."<br>";
//   $html .= "<div id='commnet'>".$row["comment"]."</div><br><br>";
// }

//コメントにアンカーがあればアンカーに変換する
$html = anchor($dbname, $html);
$db = null;

// 総件数が1000件未満であれば投稿画面を表示する
if ($kensu < 1000) {
    $form = <<< EOF
    <form action="ins.php" method="post">
    <input type="hidden" name="dbname" value="{$dbname}">
    投稿内容:<br>
    <textarea name="comment" cols=100 rows=10></textarea><br>
    <input type="submit" name="ins" value="送信">
    </form>
    <br>
EOF;

} else {
    $form = "1000件以上は書き込めません。<br><br>";
}

  // コメント中にアンカーがあればアンカーリンクを付与する
function anchor($dbname, $comment) {
    $pattern = "/&gt;&gt;([0-9])+/";
    $replace = '<a href="link.php?dbname='.$dbname.'&num=$0">$0</a>';
    $comment = preg_replace($pattern, $replace, $comment);
    return $comment;
}


?>

<!--以下HTMLの記述-->
<!DOCTYPE html>
<html lang="ja">
    <head>
        <title><?php echo $dbname_kana; ?></title>
        <meta charset="UTF-8">
        <meta name="viewport" content="initial-scale=1.0">
       <link rel="stylesheet" href="style.css" media="all">
    </haed>
    <body>
        <?php echo $html; ?>
        <?php echo $form; ?>
        <?php echo $link; ?>
        <br>
        <br>
        <a href="index.php">掲示板に戻る</a>
    </body>
</html>