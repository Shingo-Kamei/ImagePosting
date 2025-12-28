<?php

include('./dbConfig.php');

$targetDirectory = './images/';
$imageId = $_GET['id'];

if(!empty($imageId)) {

    // プレースホルダーとは、SQL文の中で値を直接記述せずに、仮の値を設定する方法
    // 「:id」はプレースホルダー(仮の値)
    // プレースホルダーを使用することで、SQLインジェクション攻撃を防ぐことができる
    $sql = "SELECT file_name FROM images WHERE id = :id";
    $sth = $db->prepare($sql);
    // bindValueメソッドは、プレースホルダーに値をバインドするためのメソッド
    // 第一引数: プレースホルダー名
    // 第二引数: バインドする値
    // 第三引数: 値のデータ型(PDO::PARAM_INTは整数型を表す定数)
    $sth->bindValue(':id', $imageId, PDO::PARAM_INT);
    $sth->execute();
    $getImageName = $sth->fetch();

    if ($getImageName && !empty($getImageName['file_name'])) {

        // $getImageName['file_name']で画像名を取得し、unlink関数で画像ファイルを削除
        $deleteImage = unlink($targetDirectory . $getImageName['file_name']);

        if($deleteImage) {
            $deleteRecord = $db->prepare("DELETE FROM images WHERE id = :id");
            $deleteRecord->bindValue(':id', $imageId, PDO::PARAM_INT);
            $deleteRecord->execute();

            header('Location: ./html/index.php', true, 303);
            exit();
        }
    }
}
