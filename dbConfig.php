<?php
// DB接続情報
$dbName = 'mysql:host=localhost;dbname=imagePosting;charset=utf8';
$userName = 'root';

// DB接続
// PDOオブジェクトを生成
// PDOオブジェクト生成に失敗した場合は例外がスローされる
// PDOとはPHP Data Objectsの略で、PHPでデータベースに接続するための拡張モジュール
// PDOを使用することで、異なるデータベースに対して同じコードで接続・操作が可能になる
// \Throwable $th は、PHPの全てのエラーと例外をキャッチするためのインターフェース
try {
    $db = new PDO($dbName, $userName);
} catch (\Throwable $th) {
    exit();
}
