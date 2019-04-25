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

//ページングのための情報を取得
$name = "sqlite:".$dbname.".db";
$db = new PDO($name);
$thread = $db->query("SELECT COUNT(*) FROM bbs");
$posts = $thread -> fetchColumn(); //総件数取得
$view = 3; //1ページあたりの表示件数
$pcount = ceil($posts/$view); //ページ数
$plast = $posts % $view; //最終ページ件数

if ($page == "") {
    $page = $pcount;
}

//ページ移動のためのリンクを表示


?>

<!--以下HTMLの記述-->
<!DOCTYPE html>
<html lang="ja">
    <head>
        <title><?php echo $dbnamekana; ?></title>
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