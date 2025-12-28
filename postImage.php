<?php
// DB接続情報を読み込み
// データベースと接続
include('./dbConfig.php');

//　ここから
// 画像の保存先を指定
// targetDirectoryは「imagesフォルダ」のこと
$targetDirectory = 'images/'; // アップロード先ディレクトリ
// $fileNameは画像名を取得
// $_FILESは、どこからでも呼び出せるスーパーグローバル変数(どこの関数からでも呼び出せる変数)
$fileName = basename($_FILES["file"]["name"]); // アップロードされたファイルの名前
// ドットで「$targetDirectory . $fileName」を繋げている
$targetFilePath = $targetDirectory . $fileName; // 保存先のフルパス
//　ここまでで「images/画像データ」というパスができた

//　拡張子を取得
$fileType = pathinfo($fileName, PATHINFO_EXTENSION); // ファイルの拡張子を取得

// 画像が選択され、送信ボタンが押された場合
// POSTメソッドで送信されたかどうかを確認し、かつ$fileNameが空でないことを確認
if($_SERVER['REQUEST_METHOD'] == 'POST' && !empty($fileName)) {
    $arrImageTypes = array('jpg', 'jpeg', 'png', 'gif', 'pdf'); // 許可する画像の拡張子を配列で定義
    // in_array関数は、指定した値が配列の中に存在するかどうかを調べる関数
    // つまり、$fileTypeで取得した拡張子が、$arrImageTypes配列の中に存在するかどうかを確認している
    if(in_array($fileType, $arrImageTypes)) {
        // 画像をサーバーにアップロード(保存)する(move_uploaded_file関数を使用)
        // 第一引数: アップロードされたファイルの一時的な保存場所($_FILES["file"]["tmp_name"])
        // 第二引数: 保存先のフルパス($targetFilePath)
        $postImageForServer = move_uploaded_file($_FILES["file"]["tmp_name"], $targetFilePath);

        // 画像がサーバーに正常にアップロードされた場合、DBに画像情報を保存(imagesテーブルにINSERT)
        // imagesテーブルのfile_nameカラムに画像名を保存
        //　保存する名前が文字列の場合は、シングルクォーテーション('')で囲む必要がある
        if($postImageForServer) {
            //読み込んだdbConfig.phpの$dbを使用して、クエリを実行
            // クラスのメソッドを呼び出す場合は「->」を使用
            $insert = $db->query("INSERT INTO images (file_name) VALUES ('".$fileName."')");
        }
    }
}

// header関数は、HTTPヘッダーを送信するための関数
// ここでは、画像投稿後にindex.phpにリダイレクトするために使用
header('Location: ' . './html/index.php', true, 303); // 画像投稿後、index.phpにリダイレクト
exit();
