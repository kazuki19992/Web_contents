<!-- PHPの記述を行う -->

<?php
    //掲示板リスト用PHP

    //アクセスログ
    require('./PHP/AccessLog.php');
    //データベースとの接続
    $db = new PDO("sqlite:list.db");

    //スレッド件数の取得
    $thread = $db -> query("SELECT COUNT(*) FROM list");
    $listcount = $thread -> fetchColumn();
    $thread -> closeCursor();

    //変数宣言
    $i = $listcount;
    $html = "";
    

    //掲示板が存在した場合リンクを表示
    if ($listcount > 0){
       
        //SQLを使用し、投稿順に並べる
        $thread = $db -> query("SELECT * FROM list WHERE flg = 0 ORDER BY updtime DESC");
        $list = $thread -> fetchAll(PDO::FETCH_ASSOC);

        foreach ($list as $row) {
            //リストの生成
            // $html .= "<div class=\"bbslist\"><a href='bbs.php?dbname={$row["dbname"]}
            // &dbname_kana={$row["dbname_kana"]}'>".$i.":"
            // .$row["dbname_kana"]." (".$row['kensu'].") ".$row['updtime']."</a>".
            // " <a href='del.php?dbname={$row["dbname"]}'><span class=\"removebbs\">削除する</span></a></div><br>";
            
            // $dbname_kana = $row["dbname_kana"];
            // $html = <<< BBS
            // <div class=\"bbslist\"> 
            // $i：$row[updtime]<br>.$row[dbname_kana]</div><br>
// BBS;

            $html .= "<div class=\"bbslist\"><h5 class=\"metadata\">".$i.":名無しの学生:".$row['updtime']."</h5><p class=\"replytxt\">"
            .$row["dbname_kana"]."</p> <a href='del.php?dbname={$row["dbname"]}'><span class=\"removebbs\">削除する</span></a></div><br>";




            $i--;
        }
    }
    $db = null;

    //掲示板のスレッド数が10以下の場合、新規スレッド作成フォームを表示
    if($listcount <= 1024){
        $listcount ++;
        $newdbname = "bbs".$listcount;
        
        //ヒアドキュメントでフォームを出力する
        $build = <<< EOF
        
        <form action="build.php" method="post">
        <input type="hidden" name="newdbname" value="{$newdbname}">
        名称 : <input type="text" class="bbsname" name="newdbname_kana" value="">
        <input class="submit_txt" type="submit" name="newbbs" value="投稿する！！！">
        </form>
        
EOF;

//終端ID前にインデントを入れるとうまくいかないため
        
    }else{
        //スレッド数が規定数以上になった場合、エラーメッセージを表示
        $build = "レス数が1024を超えました。これ以上書き込むには削除してください";
    }


    //ブラウザの判定
    $Agent = strtolower($_SERVER['HTTP_USER_AGENT']);

    //ユーザーエージェント情報を元に判定
    if (strstr($Agent , 'edge')) {
        $browser='Edge';
    } elseif (strstr($Agent , 'trident') || strstr($Agent , 'msie')) {
        $browser='Internet Explorer';
    } elseif (strstr($Agent , 'chrome')) {
        $browser='Chrome';
    } elseif (strstr($Agent , 'firefox')) {
        $browser='Firefox';
    } elseif (strstr($Agent , 'safari')) {
        $browser='Safari';
    } elseif (strstr($Agent , 'opera')) {
        $browser='Opera';
    } else {
        $browser='不明なブラウザ';
    }
    

?>

<!--以降 HTMLの記述へ -->

<!DOCTYPE html>
<html lang="ja">
    <head>
        <title>【学内専用】BBS</title>
        
        <meta charset="utf-8">
        <meta name"viewport" content="initial-scale=1.0">
        <script type="text/javascript" src="./JS/func.js"></script>
        <link rel="stylesheet" href="CSS/style.css" media="all">
        <link rel="stylesheet" href="CSS/style2.css" media="all">
        <link rel="stylesheet" href="CSS/style3.css" media="all">
        <link href="https://use.fontawesome.com/releases/v5.6.1/css/all.css" rel="stylesheet">
        <link href="https://fonts.googleapis.com/css?family=M+PLUS+1p" rel="stylesheet">
        <link rel="shortcut icon" href="IMG/favicon.ico" />


    </head>
    <body>
        <center>
        <h1>【学内専用】BBS</h1>
        <div class="info">この掲示板の基幹部分は<a  href="https://qiita.com/torokko/items/8a07519782f01a68c627">このページ</a>を参考にしました。</div>
        <BR>
        <?php
        if($browser == 'chrome'){
            echo 'True';
            $MSG = <<< END
            <div class="popup" id="js-popup">
                <div class="popup-inner">
                    <div class="close-btn" id="js-close-btn"><i class="fas fa-times"></i></div>
                        <h2>Opps!! どうやらこのブラウザは使用をおすすめしていないようです</h2>
                        <p>どうやら このブラウザではベストな感じに表示されないかもしれないようです。<br>
                        もし、表示が崩れるようなことがあったら、以下のブラウザからアクセスしてみてください！</p>
                        <h4>推奨ブラウザ</h4>
                        <ul type = "disc">
                            <li> Google Chrome</li>
                            <li> Microsoft Edge</li>
                            <li> Mozilla Firefox</li>
                            <li> Apple Safari<li>
                            <li> Opera</li>
                        </ul>
                    </div>
                <div class="black-background" id="js-black-bg"></div>
            </div>
END;

            echo $MSG;
        }
        ?>
        </center>
        <hr>
        <!-- 作成日の記述 -->
        <div align="right" class="date">
            <script>
                document.write("作成日：" + document.lastModified);
            </script>
        </div>
        <BR>

        <div class="func">
            <h3>更新情報</h3>
            <ul type = "disc">
                <li>掲示板機能の暫定運用</li>
                <!--<li></li> -->
            </ul>
            
        </div>

        <BR>
        <h4 class="bbslisttitle">投稿する！</h4>
        <?php echo $build; ?>
        <h4 class="bbslisttitle">掲示板</h4>
        <?php echo $html; ?>
        <!-- <?php echo $build; ?> -->
        <h4 class="bbslisttitle">作成者・管理人情報</h4>
        u306065 櫛田一樹<br>
        <!-- Twitter：@Tech_Kazu</p> -->

        <a href="https://twitter.com/Tech_Kazu" class="btn-social-flat">
            <span class="btn-social-flat-icon btn-social-flat-icon--twitter"><i class="fab fa-twitter"></i></span>
            <span class="btn-social-flat-text">@Tech_Kazu</span>
        </a>

    </body>
</html>
