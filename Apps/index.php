<!DOCTYPE html>
<?php
    // 永続的に上の階層へリダイレクト
    $url = '../index.php';
    header('Location: ' . $url, true , 301);

    // 出力を終了
    exit;
?>