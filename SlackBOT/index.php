<?php
$body = file_get_contents('php://input');
$json = json_decode($body, true);

// 必要ないかもしれないが、一応Content-type指定
header('Content-type: text/plain; charset=utf-8');
echo $json['challenge'];
exit;

