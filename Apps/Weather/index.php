<?php
    // Web APIを用いた天気アプリ
    

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

    // 天気取得先のURL(ベース)
    $url = "http://weather.livedoor.com/forecast/webservice/json/v1";

    // XMLでの地点データ読み込み
    $xml = "./DB/primary_area.xml";
    $xmlData = simplexml_load_file($xml);

    // Ver.1.0.0は福島固定
    $url .= "?city=070010";


    // JSON形式でデータを取得
    $json = file_get_contents($url, true);
    $json = json_decode($json, true);

    // Pub
    $title = $json['title'];    // 市区町村
    $description = $json['description']['text'];    //詳細情報
    $publicTime = $json['publicTime'];

    // Location
    $city = $json['location']['city'];  // 福島
    $area = $json['location']['area'];  // 東北
    $prefecture = $json['location']['prefecture'];  // 福島県
    $link = $json['link'];

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
        <div class="contents">
            <center>
                <h3> <?php echo($prefecture); ?> </h3>

                <!-- PHPで天気予報の取得 -->
                <?php
                    

                    //日付
                    $page = 0;

                    // 配列の宣言
                    // $dateLabel = array();
                    // $telop = array();
                    // $date = array();
                    // $min = array();
                    // $max = array();
                    // $mincelsius = array();
                    // $minfahrenheit = array();
                    // $maxcelsius = array();
                    // $maxfahrenheit = array();
                    // $image = array();


                    // 今日・明日・明後日の情報を表示
                    foreach($json['forecasts'] as $entry) {
                        $dateLabel = $entry['dateLabel'];       // 今日・明日・明後日
                        $telop = $entry['telop'];               // 天気
                        $date = $entry['date'];                 // 日付
                        $min = $entry['temperature']['min'];    // 最低気温
                        $max = $entry['temperature']['max'];    // 最高気温
                        $mincelsius = $entry['temperature']['min']["celsius"]; // 最低気温(摂氏)
                        $minfahrenheit = $entry['temperature']['min']["fahrenheit"]; //最低気温(華氏)
                        $maxcelsius = $entry['temperature']['max']["celsius"]; // 最高気温(摂氏)
                        $maxfahrenheit = $entry['temperature']['max']["fahrenheit"]; // 最高気温(華氏)
                        $image = $entry['image']["url"]; // お天気アイコン
                        
                        //NULL処理
                        if (!isset($min)) {
                            $mincelsius = "--";
                        }
                        if (!isset($max)) {
                            $maxcelsius = "--";
                        }
                        if (!isset($celsius)) {
                            $min = "--";
                        }
                        if (!isset($fahrenheit)) {
                            $min = "--";
                        }
                        
                        // お天気アイコンが絶望的すぎるので変更
                        if ($image == "http://weather.livedoor.com/img/icon/1.gif") { // 晴れ
                            $image = str_replace( "http://weather.livedoor.com/img/icon/1.gif", "./IMG/iCon/weather_icons-01.svg", $image);
                        }
                        else if ($image == "http://weather.livedoor.com/img/icon/2.gif") { // 晴れ時々曇り?
                            $image = str_replace( "http://weather.livedoor.com/img/icon/2.gif", "./IMG/iCon/weather_icons-17.svg", $image);
                        }
                        else if ($image == "http://weather.livedoor.com/img/icon/3.gif") { // 晴れ時々雨?
                            $image = str_replace( "http://weather.livedoor.com/img/icon/3.gif", "./IMG/iCon/weather_icons-30.svg", $image);
                        }
                        else if ($image == "http://weather.livedoor.com/img/icon/4.gif") { // 晴れ時々雪?
                            $image = str_replace( "http://weather.livedoor.com/img/icon/4.gif", "./IMG/iCon/weather_icons-26.svg", $image);
                        }
                        else if ($image == "http://weather.livedoor.com/img/icon/5.gif") { // 晴れのち曇り?
                            $image = str_replace( "http://weather.livedoor.com/img/icon/5.gif", "./IMG/iCon/weather_icons-17.svg", $image);
                        }
                        else if ($image == "http://weather.livedoor.com/img/icon/6.gif") { // 晴れのち雨?
                            $image = str_replace( "http://weather.livedoor.com/img/icon/6.gif", "./IMG/iCon/weather_icons-20.svg", $image);
                        }
                        else if ($image == "http://weather.livedoor.com/img/icon/7.gif") { // 晴れのち雪?
                            $image = str_replace( "http://weather.livedoor.com/img/icon/7.gif", "./IMG/iCon/weather_icons-26.svg", $image);
                        }
                        else if ($image == "http://weather.livedoor.com/img/icon/8.gif") { // 曇り
                            $image = str_replace( "http://weather.livedoor.com/img/icon/8.gif", "./IMG/iCon/weather_icons-16.svg", $image);
                        }
                        else if ($image == "http://weather.livedoor.com/img/icon/9.gif") { // 曇りときどき晴れ?
                            $image = str_replace( "http://weather.livedoor.com/img/icon/9.gif", "./IMG/iCon/weather_icons-17.svg", $image);
                        }
                        else if ($image == "http://weather.livedoor.com/img/icon/10.gif") { // 曇り時々雨?
                            $image = str_replace( "http://weather.livedoor.com/img/icon/10.gif", "./IMG/iCon/weather_icons-22.svg", $image);
                        }
                        else if ($image == "http://weather.livedoor.com/img/icon/11.gif") { // 曇り時々雪?
                            $image = str_replace( "http://weather.livedoor.com/img/icon/11.gif", "./IMG/iCon/weather_icons-31.svg", $image);
                        }
                        else if ($image == "http://weather.livedoor.com/img/icon/12.gif") { // 曇りのち晴れ?
                            $image = str_replace( "http://weather.livedoor.com/img/icon/12.gif", "./IMG/iCon/weather_icons-17.svg", $image);
                        }
                        else if ($image == "http://weather.livedoor.com/img/icon/13.gif") { // 曇りのち雨?
                            $image = str_replace( "http://weather.livedoor.com/img/icon/13.gif", "./IMG/iCon/weather_icons-45.svg", $image);
                        }
                        else if ($image == "http://weather.livedoor.com/img/icon/14.gif") { // 曇りのち雪?
                            $image = str_replace( "http://weather.livedoor.com/img/icon/14.gif", "./IMG/iCon/weather_icons-31.svg", $image);
                        }
                        else if ($image == "http://weather.livedoor.com/img/icon/15.gif") { // 雨
                            $image = str_replace( "http://weather.livedoor.com/img/icon/15.gif", "./IMG/iCon/weather_icons-14.svg", $image);
                        }
                        else if ($image == "http://weather.livedoor.com/img/icon/16.gif") { // 雨時々晴れ?
                            $image = str_replace( "http://weather.livedoor.com/img/icon/16.gif", "./IMG/iCon/weather_icons-23.svg", $image);
                        }
                        else if ($image == "http://weather.livedoor.com/img/icon/17.gif") { // 雨時々曇り?
                            $image = str_replace( "http://weather.livedoor.com/img/icon/17.gif", "./IMG/iCon/weather_icons-19.svg", $image);
                        }
                        else if ($image == "http://weather.livedoor.com/img/icon/18.gif") { // 雨時々雪?
                            $image = str_replace( "http://weather.livedoor.com/img/icon/18.gif", "./IMG/iCon/weather_icons-51.svg", $image);
                        }
                        else if ($image == "http://weather.livedoor.com/img/icon/19.gif") { // 雨のち晴れ?
                            $image = str_replace( "http://weather.livedoor.com/img/icon/19.gif", "./IMG/iCon/weather_icons-46.svg", $image);
                        }
                        else if ($image == "http://weather.livedoor.com/img/icon/20.gif") { // 雨のち曇り?
                            $image = str_replace( "http://weather.livedoor.com/img/icon/20.gif", "./IMG/iCon/weather_icons-19.svg", $image);
                        }
                        else if ($image == "http://weather.livedoor.com/img/icon/21.gif") { // 雨のち雪?
                            $image = str_replace( "http://weather.livedoor.com/img/icon/21.gif", "./IMG/iCon/weather_icons-51.svg", $image);
                        }
                        else if ($image == "http://weather.livedoor.com/img/icon/22.gif") { // 大雨
                            $image = str_replace( "http://weather.livedoor.com/img/icon/22.gif", "./IMG/iCon/weather_icons-54.svg", $image);
                        }
                        else if ($image == "http://weather.livedoor.com/img/icon/23.gif") { // 雪
                            $image = str_replace( "http://weather.livedoor.com/img/icon/23.gif", "./IMG/iCon/weather_icons-68.svg", $image);
                        }
                        else if ($image == "http://weather.livedoor.com/img/icon/24.gif") { // 雪時々晴れ?
                            $image = str_replace( "http://weather.livedoor.com/img/icon/24.gif", "./IMG/iCon/weather_icons-26.svg", $image);
                        }
                        else if ($image == "http://weather.livedoor.com/img/icon/25.gif") { // 雪時々曇り?
                            $image = str_replace( "http://weather.livedoor.com/img/icon/25.gif", "./IMG/iCon/weather_icons-31.svg", $image);
                        }
                        else if ($image == "http://weather.livedoor.com/img/icon/26.gif") { // 雪時々雨?
                            $image = str_replace( "http://weather.livedoor.com/img/icon/26.gif", "./IMG/iCon/weather_icons-51.svg", $image);
                        }
                        else if ($image == "http://weather.livedoor.com/img/icon/27.gif") { // 雪のち晴れ?
                            $image = str_replace( "http://weather.livedoor.com/img/icon/27.gif", "./IMG/iCon/weather_icons-32.svg", $image);
                        }
                        else if ($image == "http://weather.livedoor.com/img/icon/28.gif") { // 雪のち曇り?
                            $image = str_replace( "http://weather.livedoor.com/img/icon/28.gif", "./IMG/iCon/weather_icons-31.svg", $image);
                        }
                        else if ($image == "http://weather.livedoor.com/img/icon/29.gif") { // 雪のち雨?
                            $image = str_replace( "http://weather.livedoor.com/img/icon/29.gif", "./IMG/iCon/weather_icons-48.svg", $image);
                        }
                        else if ($image == "http://weather.livedoor.com/img/icon/30.gif") { // 大雪
                            $image = str_replace( "http://weather.livedoor.com/img/icon/30.gif", "./IMG/iCon/weather_icons-68.svg", $image);
                        }
                        
                        //文字列の中にある半角空白と全角空白をすべて削除・除去する
                        // $telop  = preg_replace("/( |　)/", "", $telop );


                        if($dateLabel == '今日'){
                            echo "<img src=\"".$image."\" id=\"Weather_icon\">";
                            // echo $telop;                        
                        ?>
                        
                            <div class="Weather_info">
                                <table id="weather_table">
                                    <tr>
                                        <td>
                                            <p class="Wea_info">
                                                最高気温：<?php echo $max; ?><BR>
                                            </p>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <p class="Wea_info">
                                                最低気温：<?php echo $min; ?><BR><BR>
                                            </p>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <p class="Wea_info">
                                                <left>
                                                    詳細情報：<BR>
                                                    <?php echo $description; ?>
                                                </left>
                                            </p>
                                        </td>
                                    </tr>
                                </table>
                            </div>
                        <?php
                        }
                    }
                ?>
            </center>
        </div>
    </body>
</html>



       
        