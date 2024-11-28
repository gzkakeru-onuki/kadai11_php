<?php
// ログイン画面の場合
if ($title == 'ログイン画面') {
    $formContent = '
        <div class="form-input">
            <label for="mail">メールアドレス</label><br>
            <input id="mail" type="text" name="mail" placeholder="Nukizon@nukinuki.com" required><br>
            <div id="mailError" class="error"></div>
        </div>
        <div class="form-input">
            <label for="password">パスワード</label><br>
            <input id="password" type="password" name="password" placeholder="パスワードを入力" required><br>
            <div id="passwordError" class="error"></div>
        </div>';
} else if ($title == '商品登録画面' || '商品編集画面') {
    $formContent = '
        <div class="form-input">
            <label for="name">商品名</label><br>
            <input id="name" type="text" name="name" placeholder="商品名（例：チョコ山田ニキ太郎）" required><br>
            <div id="nameError" class="error"></div>
        </div>
        <div class="form-input">
            <label for="value">価格</label><br>
            <input id="value" type="text" name="value" placeholder="10000" required><br>
            <div id="valueError" class="error"></div>
        </div>
        <div class="form-input">
            <label for="category">カテゴリー</label><br>
            <select name="category" id="category" required>
                <option value="全て">全て</option>
                <option value="ブラックフライデー">ブラックフライデー</option>
                <option value="食べ物">食べ物</option>
                <option value="お酒">お酒</option>
                <option value="飲み物">飲み物</option>
                <option value="ガジェット">ガジェット</option>
                <option value="PC">PC</option>
            </select>
            <div id="categoryError" class="error"></div>
        </div>
        <div class="form-input">
            <label for="discount">割引額</label><br>
            <input id="discount" type="text" name="discount" placeholder="10000" required><br>
            <div id="discountError" class="error"></div>
        </div>
        <div class="form-input">
            <label for="review">レビュー</label><br>
            <input id="review" type="number" min="1" max="5" name="review" required><br>
            <div id="passwordConfirmError" class="error"></div>
        </div>
        <div class="form-input">
            <label for="image_path">商品画像</label><br>
            <input id="image_path" type="file" name="image" required><br>
            <div id="passwordConfirmError" class="error"></div>
        </div>
        ';
} else {
    // 登録画面の場合
    $formContent = '
        <div class="form-input">
            <label for="name">氏名</label><br>
            <input id="name" type="text" name="name" placeholder="氏名（例：Nukizon太郎）" required><br>
            <div id="nameError" class="error"></div>
        </div>
        <div class="form-input">
            <label for="mail">メールアドレス</label><br>
            <input id="mail" type="text" name="mail" placeholder="Nukizon@nukinuki.com" required><br>
            <div id="mailError" class="error"></div>
        </div>
        <div class="form-input">
            <label for="number">携帯電話番号</label><br>
            <input id="number" type="text" name="number" placeholder="08012345678" required><br>
            <div id="numberError" class="error"></div>
        </div>
        <div class="form-input">
            <label for="password">パスワード</label><br>
            <input id="password" type="password" name="password" placeholder="最低６文字必要です" required><br>
            <div id="passwordError" class="error"></div>
        </div>
        <div class="form-input">
            <label for="password_confirm">もう一度パスワードを入力してください</label><br>
            <input id="password_confirm" type="password" name="password_confirm" required><br>
            <div id="passwordConfirmError" class="error"></div>
        </div>';
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/reset.css">
    <link rel="stylesheet" href="../css/style.css">
    <title>Nukizon登録</title>
    <style>
        .error {
            color: red;
            font-size: 0.9em;
            margin-top: 5px;
        }
    </style>
</head>

<body>
    <div class="container">
        <h1 class="head">N<span>uki</span>zon.co.jp</h1>
        <div class="form-container">
            <h1 class="title"><?= $title; ?></h1>
            <form id="registrationForm" action="<?= $send; ?>" method="post" onsubmit="return validateForm()" enctype="multipart/form-data">
                <?php echo $formContent; ?>
                <div>
                    <input class="submitBtn" type="submit" value="次へ進む">
                </div>

                <div class="signin">
                    <p class="signin-link"><?php echo !empty($linktext) ? $linktext : 'アカウントがない方へ'; ?><a class="link" href="<?= $link; ?>"><?php echo !empty($signin) ? $signin : 'サインアップ'; ?></a></p>
                </div>
            </form>
        </div>
    </div>

    <script>
        function validateForm() {
            let valid = true;

            // 氏名のバリデーション
            var name = document.getElementById("name").value;
            var nameError = document.getElementById("nameError");
            if (name.trim() === "") {
                nameError.textContent = "氏名を入力してください";
                valid = false;
            } else {
                nameError.textContent = "";
            }

            // メールアドレスのバリデーション（正規表現）
            var mail = document.getElementById("mail").value;
            var mailError = document.getElementById("mailError");
            var emailPattern = /^[a-zA-Z0-9._-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,6}$/;
            if (!emailPattern.test(mail)) {
                mailError.textContent = "有効なメールアドレスを入力してください";
                valid = false;
            } else {
                mailError.textContent = "";
            }

            // 携帯電話番号のバリデーション（正規表現）
            var number = document.getElementById("number").value;
            var numberError = document.getElementById("numberError");
            var phonePattern = /^\d{10,11}$/; // 電話番号の場合
            if (!phonePattern.test(number)) {
                numberError.textContent = "有効な電話番号を入力してください（10〜11桁の数字）";
                valid = false;
            } else {
                numberError.textContent = "";
            }

            // パスワードのバリデーション
            var password = document.getElementById("password").value;
            var passwordError = document.getElementById("passwordError");
            if (password.length < 6) {
                passwordError.textContent = "パスワードは6文字以上である必要があります";
                valid = false;
            } else {
                passwordError.textContent = "";
            }

            // パスワード確認のバリデーション
            var passwordConfirm = document.getElementById("password_confirm").value;
            var passwordConfirmError = document.getElementById("passwordConfirmError");
            if (password !== passwordConfirm) {
                passwordConfirmError.textContent = "パスワードが一致しません";
                valid = false;
            } else {
                passwordConfirmError.textContent = "";
            }

            return valid;
        }
    </script>
</body>

</html>