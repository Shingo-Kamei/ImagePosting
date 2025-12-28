<?php
// DB接続情報を読み込み
$sql = "SELECT * FROM images ORDER BY create_date DESC";

// prepareメソッドは、SQL文を準備するためのメソッド
// prepareメソッドは、SQLインジェクション攻撃を防ぐために使用される
$sth = $db->prepare($sql);
// executeメソッドは、準備されたSQL文を実行するためのメソッド
// executeメソッドは、SQL文の実行時にパラメータをバインドするために使用される
$sth->execute();
// fetchAllメソッドは、結果セットから全ての行を取得するためのメソッド(全部取り出す)
// fetchAllメソッドは、取得したデータを配列として返す
$data = $sth->fetchAll();

return $data;
