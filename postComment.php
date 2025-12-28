<?php

include('./dbConfig.php');
$imageId = $_GET['image_id'];
$comment = $_POST['comment'];

// $_SERVER['REQUEST_METHOD']は、現在のリクエストメソッドを取得するためのスーパーグローバル変数
// POSTメソッドで送信されたかどうかを確認し、かつ$commentが空でないことを確認
if($_SERVER['REQUEST_METHOD'] == 'POST' && !empty($comment)) {
    $insert = $db->prepare("INSERT INTO comments (image_id, comment) VALUES (:image_id, :comment)");

    // 値をバインドする
    $insert->bindValue(':image_id', $imageId, PDO::PARAM_INT);
    $insert->bindValue(':comment', $comment, PDO::PARAM_STR);
    // SQL文を実行
    $insert->execute();

    if($insert) {
        // $_SERVER['HTTP_REFERER']は、直前のページのURLを取得するためのスーパーグローバル変数
        // bindValueメソッドは、プレースホルダーに値をバインドするためのメソッド
        $uri = $_SERVER['HTTP_REFERER'];
        header('Location: ' . $uri, true, 303);
        exit();
    } else {
        $uri = $_SERVER['HTTP_REFERER'];
        header('Location: ' . $uri, true, 303);
        exit();
    }
}
