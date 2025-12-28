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

$imageId = $_GET['id'];

// 画像が選択され、送信ボタンが押された場合
// POSTメソッドで送信されたかどうかを確認し、かつ$fileNameが空でないことを確認
if($_SERVER['REQUEST_METHOD'] == 'POST' && !empty($fileName)) {
    $arrImageTypes = array('jpg', 'jpeg', 'png', 'gif', 'pdf'); // 許可する画像の拡張子を配列で定義
    // in_array関数は、指定した値が配列の中に存在するかどうかを調べる関数
    // つまり、$fileTypeで取得した拡張子が、$arrImageTypes配列の中に存在するかどうかを確認している
    if(in_array($fileType, $arrImageTypes)) {
        // プレースホルダーとは、SQL文の中で値を直接記述せずに、仮の値を設定する方法
        // 「:id」はプレースホルダー(仮の値)
        // プレースホルダーを使用することで、SQLインジェクション攻撃を防ぐことができる
        $sql = "SELECT file_name FROM images WHERE id = :id";

        // prepareメソッドは、SQL文を準備するためのメソッド
        // prepareメソッドは、SQLインジェクション攻撃を防ぐために使用される
        $sth = $db->prepare($sql);

        // bindValueメソッドは、プレースホルダーに値をバインドするためのメソッド
        // 第一引数: プレースホルダー名
        // 第二引数: バインドする値
        // 第三引数: 値のデータ型(PDO::PARAM_INTは整数型を表す定数)
        // ここで画像IDをバインドしている
        $sth->bindValue(':id', $imageId, PDO::PARAM_INT);

        // executeメソッドは、準備されたSQL文を実行するためのメソッド
        // executeメソッドは、SQL文の実行時にパラメータをバインドするために使用される
        $sth->execute();

        // fetchメソッドは、結果セットから1行を取得するためのメソッド(1つだけ取り出す)
        // fetchメソッドは、取得したデータを配列として返す
        //  ここで画像名を取得している
        $getImageName = $sth->fetch();

        if ($getImageName && !empty($getImageName['file_name'])) {

            // unlink の結果を変数に入れる
            $deleteImage = unlink($targetDirectory . $getImageName['file_name']);

        } else {

            // レコードが無い or file_name が空の場合
            $deleteImage = false;
        }

        if($deleteImage) {
            $uploadImageForServer = move_uploaded_file($_FILES["file"]["tmp_name"], $targetFilePath);

        if($uploadImageForServer) {
            $update = $db->prepare("UPDATE images SET file_name = :file WHERE id = :id");
            $update->bindValue(':file', $fileName, PDO::PARAM_STR);
            $update->bindValue(':id', $imageId, PDO::PARAM_INT);
            $update->execute();

            header('Location: ./html/index.php', true, 303);
            exit();
            }
        }
    }
}

