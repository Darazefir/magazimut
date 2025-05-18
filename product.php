<?php
session_start();
require_once('server/_conn.php');
$sql_good_item = "SELECT * FROM `products`
JOIN `categories` USING (`category_id`) 
WHERE `product_id` = {$_GET['product']}";

if (isset($_SESSION['user_id'])) {
    $sql_user = "SELECT * FROM `users`
    WHERE `user_id` = {$_SESSION['user_id']}";
    $result = $mysqli->query($sql_user);
    $row = $result->fetch_assoc();
    $user_phone = $row['user_phone'];
}
?>

<!DOCTYPE html>
<html lang="ru">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="src/css/style.css?<?php echo time(); ?>" rel="stylesheet">
    <link rel="icon" type="image/png" href="src/img/favicon.png">
    <title>Магазимут — Особая полочка</title>
</head>

<body>
    <?php
    if (isset($_SESSION['user_id'])) {
        require('./src/templates/auth_header.html');
    } else {
        require('./src/templates/header.html');
    }
    ?>

    <main>
        <?php
        $result = $mysqli->query($sql_good_item);
        if ($result->num_rows === 0) {
            echo '<p>Такого товара нет</p>';
        } else {
            while ($row = $result->fetch_assoc()) {
                $product_id = $row['product_id'];
                $product_name = $row['product_name'];
                $product_description = $row['product_description'];
                $product_pic = $row['product_pic'];
                $category_name = $row['category_name'];
                $product_price = $row['product_price'];

                echo <<<HERE
                    <div class="unic-card">
                        <div class="unic-card-img">
                            <img src="{$product_pic}" alt="$product_name">
                        </div>
                        <div class="unic-card-content">
                            <div class="unic-text">
                                <h2>$product_name</h2>
                                <p>$product_description</p>
                            </div>
                            <div>
                                <button class="unic-filter">$category_name</button>
                            </div>
                            <div class="unic-buy">
                                <div class="unic-price">
                                    $product_price ₽
                                </div>
                                <button class="btn-buy" id="open">хочу купить</button>
                            </div>
                        </div>
                    </div>
                HERE;
            }
        }
        ?>
    </main>

    <?php
        require('./src/templates/footer.php');
    ?>

    <div id="modal" class="modal">
        <div class="modal-content">
            <span class="close">&times;</span>
            <h3>Оформление заказа</h3>
            <?php
            if (isset($_SESSION['user_id'])) {
                echo <<<HERE
            <form action="server/_app.php" method="post">
                <input name="product_id" value="{$_GET['product']}" hidden>
                <select name="delivery_id">
                    <option disabled>Способ получения </option>
                    <option value='1'>Самовывоз г. Архангельск</option>
                    <option value='2'>Самовывоз г. Северодвинск</option>
                    <option value='3'>Доставка</option>
                </select>
                <p>С Вами свяжутся для уточнения деталей заказа</p>
                <p>Условия доставки обсуждаются индивидуально</p>
                <button type="submit">продолжить</button>
            </form>
            HERE;
            } else {
                echo <<<HERE
            <p>Требуется <a href="authentication.php" style="color: #93B516">авторизация</a></p>
        HERE;
            }
            ?>
        </div>
    </div>
    <script src="src/js/modal.js?<?php echo time(); ?>"></script>
</body>

</html>