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
  <?php include('./header.php') ?>
  <div class="imageList">
    <a href="./imageDetail.php"><img src="../気球.jpeg" alt="投稿画像"></a>
    <a href="./imageDetail.php"><img src="../気球.jpeg" alt="投稿画像"></a>
    <a href="./imageDetail.php"><img src="../気球.jpeg" alt="投稿画像"></a>
    <a href="./imageDetail.php"><img src="../気球.jpeg" alt="投稿画像"></a>
    <a href="./imageDetail.php"><img src="../気球.jpeg" alt="投稿画像"></a>
    <a href="./imageDetail.php"><img src="../気球.jpeg" alt="投稿画像"></a>
    <a href="./imageDetail.php"><img src="../気球.jpeg" alt="投稿画像"></a>
    <a href="./imageDetail.php"><img src="../気球.jpeg" alt="投稿画像"></a>
    <a href="./imageDetail.php"><img src="../気球.jpeg" alt="投稿画像"></a>
</div>
</body>
</html>
