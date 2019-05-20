<!-- PHPの記述を行う -->

<?php
    //掲示板リスト用PHP

    //データベースとの接続
    $db = new PDO("sqlite:list.db");

    //スレッド件数の取得
    $thread = $db -> query("SELECT COUNT(*) FROM list");
    $listcount = $thread -> fetchColumn();
    $thread -> closeCursor();

    //変数宣言
    $i = 1;
    $html = "";
    

    //掲示板が存在した場合リンクを表示
    if ($listcount > 0){
       
        //SQLを使用し、投稿順に並べる
        $thread = $db -> query("SELECT * FROM list WHERE flg = 0 ORDER BY updtime DESC");
        $list = $thread -> fetchAll(PDO::FETCH_ASSOC);

        foreach ($list as $row) {
            //リストの生成
            $html .= "<div class=\"bbslist\"><a href='bbs.php?dbname={$row["dbname"]}
            &dbname_kana={$row["dbname_kana"]}'>".$i.":"
            .$row["dbname_kana"]." (".$row['kensu'].") ".$row['updtime']."</a>".
            " <a href='del.php?dbname={$row["dbname"]}'><span class=\"removebbs\">削除する</span></a></div><br>";
            
            $i++;
        }
    }
    $db = null;

    //掲示板のスレッド数が10以下の場合、新規スレッド作成フォームを表示
    if($listcount <= 10){
        $listcount ++;
        $newdbname = "bbs".$listcount;
        
        //ヒアドキュメントでフォームを出力する
        $build = <<< EOF
        
        <form action="build.php" method="post">
        <input type="hidden" name="newdbname" value="{$newdbname}">
        名称 : <input type="text" name="newdbname_kana" value="">
        <input type="submit" name="newbbs" value="スレ立てする！">
        </form>
        
EOF;

//終端ID前にインデントを入れるとうまくいかないため
        
    }else{
        //スレッド数が規定数以上になった場合、エラーメッセージを表示
        $build = "Opps! これ以上掲示板は作れません。";
    }

?>

<!--以降 HTMLの記述へ -->

<!DOCTYPE html>
<html lang="ja">
    <head>
        <title>【学内専用】BBS</title>
        
        <meta charset="utf-8">
        <meta name"viewport" content="initial-scale=1.0">
        <link rel="stylesheet" href="CSS/style.css" media="all">

    </head>
    <body>
        <center>
        <h1>【学内専用】BBS</h1>
        <div class="info">この掲示板の基幹部分は<a  href="https://qiita.com/torokko/items/8a07519782f01a68c627">このページ</a>を参考にしました。</div>
        </center>

        <!-- 作成日の記述 -->
        <div align="right" class="date">
            <script>
                document.write("作成日：" + document.lastModified);
            </script>
        </div>
        <BR>

        <div class="func">
            <h3>実装済機能</h3>
            <ul type = "disc">
                <li>スレッドの新規作成</li>
                <li>スレッドの削除</li>
            </ul>
            ※スレッドの中身にアクセスすることはできません
        </div>

        <BR>
        <h3 class="bbslisttitle">現在有効になっているスレッド</h3>
        <?php echo $html; ?>
        <?php echo $build; ?>
        <p>作成者：u306065 櫛田一樹<br>
        Twitter：@Tech_Kazu</p>
    </body>
</html>
