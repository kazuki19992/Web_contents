<?php
    // Web APIを用いた天気アプリ
    
    //天気取得先のURL(ベース)
    $url = "http://weather.livedoor.com/forecast/webservice/json/v1";

    //XMLでの地点データ読み込み
    $xml = "./DB/primary_area.xml";
    $xmlData = simplexml_load_file($xml);

?>

<!DOCTYPE html>
<html lang="ja">
    <head>
        <title>NU-Weather</title>
        
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
                    <a class="nv_Link" href="../../"> <i class="fas fa-home"></i> HOMEへ </a>
                    <a class="nv_Link" href="../BBS/"> <i class="fas fa-list-ol"></i> 掲示板へ </a>
                    <a class="nv_Link" href="../BBS/PHP/Developer.php"> <i class="fas fa-code"></i> 開発者ページへ </a>
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

            <h1 class="title">NU-Weather</h1>
            <div class="info">天気情報をLivedoor社提供のWeb APIを利用し、取得しています。</div>
            <BR>

            </center>
        </header>

        