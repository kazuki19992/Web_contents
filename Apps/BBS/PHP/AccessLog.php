<?php
//アクセスログの出力
$filename = "./LOG/log.txt"; //ログファイル名
$time = date("Y/m/d H:i"); //アクセス時刻
$ip = getenv("REMOTE_ADDR"); //IPアドレス
$host = getenv("REMOTE_HOST"); //ホスト名
$referer = getenv("HTTP_REFERER"); //リファラ

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

if($referer == "") {
  $referer = "refererなし";
}
 
//ログ本文
$log = $time .",". $ip . ",". $host. ",". $referer ." , ". $Agent ."\n";
 
//ログ書き込み
file_put_contents($filename, $log, FILE_APPEND);