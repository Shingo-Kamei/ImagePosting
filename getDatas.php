<?php
// 現在のURIを取得
// $_SERVERは、サーバーや実行環境に関する情報を含むスーパーグローバル変数
$uri = $_SERVER['REQUEST_URI'];

if(strpos($uri, 'imageDetail.php') !== false) {
    // クエリパラメータに設定した画像IDの値を取得
    $imageId = $_GET['id'];
    // DB接続情報を読み込み
    $sql = "SELECT * FROM images WHERE id = " . $imageId;


    $sth = $db->prepare($sql);
    $sth->execute();
    // fetchメソッドは、結果セットから1行を取得するためのメソッド(1つだけ取り出す)
    // fetchメソッドは、取得したデータを配列として返す
    $data['image'] = $sth->fetch();
} else {

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
}



return $data;
