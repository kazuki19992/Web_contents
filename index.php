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

            // //正規表現を使用しURLの抽出を行う
            // $pattern = '(https?://[-_.!~*\'()a-zA-Z0-9;/?:@&=+$,%#]+)';
            
            // //正規表現にマッチしたURLを取得
            // $URL = preg_grep(string $pattern,$row["dbname_kana"]);

            


            $html .= "<div class=\"card\"> <div class=\"card-content\"><h5 class=\"metadata\">".$i.":名無しの学生:".$row['updtime']."</h5><p class=\"replytxt\">"
            .$row["dbname_kana"]."</p><BR><BR> <div class=\"card-action\"><a class=\"waves-effect waves-teal btn-flat\" href='del.php?dbname={$row["dbname"]}'>DELETE</a></div></div></div><BR>";
            
            // $html .= "<div class=\"bbslist\"><h5 class=\"metadata\">".$i.":名無しの学生:".$row['updtime']."</h5><p class=\"replytxt\">"
            // .$row["dbname_kana"]."</p> <a href='del.php?dbname={$row["dbname"]}'><span class=\"removebbs\">削除する</span></a></div><br>";




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
        <div class="input-field">
            <input id="bbsname" type="text" class="validate" name="newdbname_kana" value="">
            <label for="bbsname">新規レス</label>
        </div>
        <button class="btn waves-effect waves-light light-green darken-1" type="submit" name="newbbs""><i class="material-icons right">send</i>送る</button>
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
    
    $MSG = <<< END
            <div class="popup" id="js-popup">
                <div class="popup-inner">
                    <div class="close-btn" id="js-close-btn"><i class="fas fa-times"></i></div>
                        <h2>おすすめしていないブラウザのようです!</h2>
                        <p>このブラウザではベストな感じに表示されないかもしれないようです。<br>
                        もし、表示が崩れるようなことがあったら、以下のブラウザからアクセスしてみてください！</p>
                        <h4>推奨ブラウザ</h4>
                        <ul type = "disc">
                            <li> Google Chrome</li>
                            <li> Mozilla Firefox</li>
                            <li> Apple Safari<li>
                            <li> Opera</li>
                        </ul>
                    </div>
                <div class="black-background" id="js-black-bg"></div>
            </div>
END;

    $MSIE = <<< END
        <div class="popup" id="js-popup">
        <div class="popup-inner">
            <div class="close-btn" id="js-close-btn"><i class="fas fa-times"></i></div>
                <h3>まだIEなんかで消耗してるの?</h2>
                <p>IE使用ニキがいるってマ！？<BR>MSが使用を勧めないって言ってるからはやく乗り換えような！</p>
                <h4>推奨ブラウザ</h4>
                <ul type = "disc">
                    <li> Google Chrome</li>
                    <li> Mozilla Firefox</li>
                    <li> Apple Safari<li>
                    <li> Opera</li>
                </ul>
            </div>
        <div class="black-background" id="js-black-bg"></div>
        </div>
END;

?>

<!--以降 HTMLの記述へ -->

<!DOCTYPE html>
<html lang="ja">
    <head>
        <title>【学内専用】BBS</title>
        
        <meta charset="utf-8">
        <meta name"viewport" content="initial-scale=1.0">
        <meta name="theme-color" content="#ffb60f">
        <script type="text/javascript" src="./JS/func.js"></script>
        <!-- <link rel="stylesheet" href="CSS/style.css" media="all"> -->
        <link rel="stylesheet" href="CSS/style2.css" media="all">
        <link rel="stylesheet" href="CSS/style3.css" media="all">
        <link rel="stylesheet" href="CSS/HamburgerMenu.css" media="all">
        <link rel="stylesheet" href="CSS/SNS.css" media="all">
        <link href="https://use.fontawesome.com/releases/v5.6.1/css/all.css" rel="stylesheet">
        <link href="https://fonts.googleapis.com/css?family=M+PLUS+1p" rel="stylesheet">
        <link rel="shortcut icon" href="IMG/favicon.ico" />
        <link rel="stylesheet" href="CSS/Loading.css" media="all">

        <!-- Inport Google iCon Font -->
        <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
        <!--Import materialize.css-->
        <link type="text/css" rel="stylesheet" href="CSS/materialize.min.css"  media="screen,projection"/>

        <!--Let browser know website is optimized for mobile-->
        <meta name="viewport" content="width=device-width * 0.9, initial-scale=1.0"/>

        <link rel="stylesheet" href="CSS/style.css" media="all">


    </head>
    <!-- <body style="margin:5em,5em;"> -->
    <body class="indexb">
        <div id="indexphp">
        <!--JavaScript at end of body for optimized loading-->
        <script type="text/javascript" src="JS/materialize.min.js"></script>

        <!-- ローディングのアニメーション -->
        <!-- <div id="is-loading">
            <div id="loading">
                <img src="ローディング画像" alt="loadingなう" />
            </div>
        </div> -->

        <!-- 背景 -->
        <div class="area" >
            <ul class="circles">
                    <li></li>
                    <li></li>
                    <li></li>
                    <li></li>
                    <li></li>
                    <li></li>
                    <li></li>
                    <li></li>
                    <li></li>
                    <li></li>
            </ul>
        </div >

        <header>
            <div id="nav-drawer">
                <input id="nav-input" type="checkbox" class="nav-unshown">
                <label id="nav-open" for="nav-input"><span></span></label>
                <label class="nav-unshown" id="nav-close" for="nav-input"></label>
                <div id="nav-content">
                    <div id="UserInfo">
                        <div style="color:#ffffff;">
                            <center>
                                <BR>
                                <BR>
                                ようこそ。<BR>
                                <?php echo $browser; ?>さん。<BR>
                            </center>
                        </div>
                    </div>

                    <p class="nv_cts0"><i class="fas fa-folder"></i> Contents</p>
                    <a class="nv_Link" href="./WordPress/"> <i class="fab fa-wordpress"></i></i> WordPressへ </a>
                    <a class="nv_Link" href="https://github.com/kazuki19992/Web_contents"><i class="fab fa-github"></i> 開発用GitHubリポジトリ </a>
                    <BR>
                    <p class="nv_cts1"><i class="far fa-user"></i> 友人のページ</p>
                    <a class="nv_Link1" href="http://www.cse.ce.nihon-u.ac.jp/~u286120/"> <i class="fas fa-user-circle"></i></i></i> To 武田 佑樹</a>
                    <a class="nv_Link1" href="http://www.cse.ce.nihon-u.ac.jp/~u306024/"> <i class="fas fa-user-circle"></i></i></i> To 海老原 毅史</a>
                    <a class="nv_Link1" href="http://www.cse.ce.nihon-u.ac.jp/~u306062/"> <i class="fas fa-user-circle"></i></i></i> To 川村 怜央</a>
                    <a class="nv_Link1" href="http://www.cse.ce.nihon-u.ac.jp/~u306066/"> <i class="fas fa-user-circle"></i></i></i> To 久保木 駿</a>
                    <BR>
                    <p class="nv_cts2"><i class="fas fa-id-card"></i> コンタクト</p>
                    <a class="nv_Link2" href="https://twitter.com/Tech_Kazu"> <i class="fab fa-twitter"></i> フォローする</a>
                    <a class="nv_Link2" href="https://github.com/kazuki19992"> <i class="fab fa-github"></i> GitHubを見てみる</a>
                    <a class="nv_Link2" href="https://github.com/kazuki19992/Web_contents/issues"> <i class="fab fa-github"></i> GiuHubで不具合を報告する</a>
                    <a class="nv_Link2" href="mailto:kushida98@gmail.com"> <i class="fas fa-envelope"></i> メールで不具合を報告する</a>
                    <!-- <a class="nav_btn" href="https://twitter.com/Tech_Kazu">Follow</a> -->

                </div>
            <center>

            <h1 class="title">NU-BBS</h1>
            <div class="info">この掲示板の基幹部分は<a  href="https://qiita.com/torokko/items/8a07519782f01a68c627">このページ</a>を参考にしました。</div>
            <BR>
            <?php
            if($browser == 'Edge' || $browser == '不明なブラウザ'){
                echo $MSG;
            }else if($browser == 'Internet Explorer'){
                echo $MSIE;
            }
            ?>

            </center>
        </header>
            
        <div class="contents">
            <!-- <hr style="margin-top:15em;"> -->
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
                    <li>ブラウザ警告の実装</li>
                    <li>ハンバーガーメニューの実装</li>
                    <li>マテリアルデザインの採用</li>
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
            </div>
        </div>

    </body>
</html>
