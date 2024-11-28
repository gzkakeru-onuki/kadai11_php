<?php
session_start();
ini_set("display_errors", 1);


include("../functions/funcs.php");
$pdo = db_conn();


//３．データ登録SQL作成
$sql = "SELECT * FROM products ORDER BY created_at DESC";
$stmt = $pdo->prepare($sql);
$status = $stmt->execute();

//４．データ登録処理後
if ($status == false) { // 登録処理にエラーがあれば
    sql_error($stmt);
}

$values =  $stmt->fetchAll(PDO::FETCH_ASSOC); //PDO::FETCH_ASSOC[カラム名のみで取得できるモード] 連想配列で全て入っている
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/reset.css">
    <link rel="stylesheet" href="../css/main.css">
    <title>Document</title>
</head>

<body>
    <div class="container">
        <div class="header">
            <div class="header-logo">
                <a href="./main.php">N<span>uki</span>zon.co.jp<br>
                    <div class="under"><span>U</span></div>
                </a>
            </div>

            <div class="header-search">
                <form action="./search.php" method="post">
                    <!-- ここはカテゴリとワードで絞り込み検索をする。　ワードは曖昧検索で -->
                    <select name="category" id="category">
                        <option value="全て">全て</option>
                        <option value="食べ物">食べ物</option>
                        <option value="お酒">お酒</option>
                        <option value="飲み物">飲み物</option>
                        <option value="ガジェット">ガジェット</option>
                        <option value="PC">PC</option>
                    </select>
                    <input class="search-input" type="text" name="name" placeholder="Nukizon.co.jpを検索"><button
                        class="searchBtn">検索</button>
                </form>
            </div>

            <div class="header-userinfo">
                <p>大貫翔さん<br>アカウントリスト</p>
            </div>
            <div class="header-cart">
                <img src="" alt="カート画像">
            </div>
        </div>

        <div class="headerUnder">

            <!-- ここにselect * from products where category = categoryみたいな感じで、カテゴリで絞り込み -->
            <ul class="under-list">
                <li class="category-list"><a href="./search.php?category=全て">全て</a></li>
                <li class="category-list"><a href="./search.php?category=ブラックフライデー">ブラックフライデーセール</a></li>
                <li class="category-list"><a href="./search.php?category=食べ物">食べ物</a></li>
                <li class="category-list"><a href="./search.php?category=お酒">お酒</a></li>
                <li class="category-list"><a href="./search.php?category=飲み物">飲み物</a></li>
                <li class="category-list"><a href="./search.php?category=ガジェット">ガジェット</a></li>
                <li class="category-list"><a href="./search.php?category=PC">PC</a></li>
            </ul>
        </div>

        <div class="products-container">
            <div class="products">
                <div class="search2">
                    <form action="search.php" method="post">
                        <p class="search-title">カスタマーレビュー</p>
                        <div>
                            <a href="./search.php?review=5">全て</a>
                        </div>
                        <div>
                            <a href="./search.php?review=4">★★★★☆</a>
                        </div>
                        <div>
                            <a href="./search.php?review=3">★★★☆☆</a>
                        </div>
                        <div>
                            <a href="./search.php?review=2">★★☆☆☆</a>
                        </div>
                        <div>
                            <a href="./search.php?review=1">★☆☆☆☆</a>
                        </div>
                    </form>
                    <br>

                    <form action="search.php" method="post">
                        <p class="search-title">価格</p>
                        <div>
                            <a href="./search.php?value=all">全て</a>
                        </div>
                        <div>
                            <a href="./search.php?value=30000">¥30,000以上</a>
                        </div>
                        <div>
                            <a href="./search.php?value=29999">¥30,000未満</a>
                        </div>
                        <div>
                            <a href="./search.php?value=9999">¥10,000未満</a>
                        </div>
                        <div>
                            <a href="./search.php?value=4999">¥5,000未満</a>
                        </div>
                        <div>
                            <a href="./search.php?value=1499">¥1,500未満</a>
                        </div>
                    </form>
                </div>

                <div class="products-list">
                    <!-- ここはForEachで商品情報を全て取って表示 -->
                    <?php foreach ($values as $value) { ?>
                        <div class="productsitem">
                            <img class="productsimg" src="<?= $value["image_path"]; ?>" alt="適当な">
                            <p class="productsname"><?= $value["name"]; ?></p>
                            <p class="productsvalue"><?= $value["value"]; ?></p>
                        </div>
                    <?php } ?>
                </div>
            </div>

            <div class="top"><a href="main.html">トップへ戻る</a></div>

            <div class="footer">
                <div class="footer-logo">
                    <a href="#">N<span>uki</span>zon</a>
                </div>
            </div>

        </div>

    </div>

</body>

</html>