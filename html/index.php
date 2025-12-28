<!DOCTYPE html>
<html lang="ja">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="../style.css">
  <title>画像投稿アプリ</title>
</head>
<body>
<!--   // ファイルを読み込むときはincludeを使う
  // includeでdbConfig.phpを読み込む
  // dbConfig.phpにはDB接続のコードが書かれている
  // これにより、DB接続が確立される
  // header.phpも同様にincludeで読み込む
  // header.phpにはヘッダー部分のコードが書かれている
    -->
  <?php include('../dbConfig.php') ?>
  <?php include('../getDatas.php') ?>
  <?php include('./header.php') ?>
  <div class="imageList">
    <!-- // ($data as $image)は、$data配列の中身を1つずつ取り出して、$image変数に代入するという意味 -->
    <?php foreach($data as $image) { ?>
<!--       // 画像をクリックすると、imageDetail.phpに遷移し、画像の詳細情報が表示されるようにする
      // 画像のリンク先は、imageDetail.php?id=画像のIDとなるようにする
      // imageDetail.php?idの「?」以降はクエリパラメータと呼ばれ、画像のIDを渡すために使用される -->
      <a href="./imageDetail.php?id=<?php echo $image['id']; ?>"><img src="../images/<?php echo $image['file_name']; ?>" alt="投稿画像"></a>
    <?php } ?>
  </div>
</body>
</html>
