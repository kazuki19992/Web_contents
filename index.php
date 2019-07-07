<?php

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
                        <li> その他Chromiumブラウザ</li>
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

//ログイン機能(初回False)
$loginflg = FALSE;


?>

<!--以降 HTMLの記述へ -->

<!DOCTYPE html>
<html lang="ja">
    <head>
        <title>NU-Apps</title>
        
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

        <!-- オートスクロール -->
        <script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.3.2/jquery.min.js"></script>
        <script type="text/javascript" src="./JS/autoscrool_newbbs.js"></script>


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
                                <div id="browser">
                                    <br><br><br><br><br><br>
                                    ようこそ。<?php echo $browser; ?>さん。<BR>
                                </div>
                            </center>
                        </div>
                    </div>

                    <p class="nv_cts0"><i class="fas fa-folder"></i> Contents</p>
                    <a class="nv_Link" href="./BBS/"> <i class="fas fa-list-ol"></i> 掲示板へ </a>
                    <a class="nv_Link" href="./BBS/PHP/Developer.php"> <i class="fas fa-code"></i> 開発者ページへ </a>
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

            <h1 class="title">NU-Apps</h1>
            <div class="info">おかえりなさい。<?php if($loginflg == FALSE){ echo("<u>ログインする</u>");} ?></div>
            <BR>
            <?php
            if($browser != 'Chrome' && $browser != 'Internet Explorer'){
                echo $MSG;
            }else if($browser == 'Internet Explorer'){
                echo $MSIE;
            }
            ?>

            </center>
        </header>