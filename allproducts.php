<?php
session_start();
require_once('server/_conn.php');
$sql_goods = "SELECT * FROM `products`";
$sql_filters = "SELECT * FROM `categories`";
?>

<!DOCTYPE html>
<html lang="ru">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="src/css/style.css?<?php echo time(); ?>" rel="stylesheet">
    <link rel="icon" type="image/png" href="src/img/favicon.png">
    <title>Магазимут — Список товаров</title>
</head>

<body>
    <?php
    require('./src/templates/admin_header.html');
    ?>
    <main>
        <a href="newproduct.php"><button class="newproduct">Создать новый товар</button></a>
        <div id="filters">
            <button class="filter active" onclick="filterSelection('all')">Все товары</button>
            <?php
            $result = $mysqli->query($sql_filters);
            if ($result->num_rows != 0) {
                while ($row = $result->fetch_assoc()) {
                    $category_id = $row['category_id'];
                    $category_name = $row['category_name'];
                    echo <<<HERE
                                <button class='filter' onclick="filterSelection('$category_id')">
                                    {$category_name}
                                </button>
                            HERE;
                }
            }
            ?>
        </div>
        <!-- Таблица с вводом данных о заявках -->
        <div class="all-goods">
            <?php
            $result = $mysqli->query($sql_goods);
            if ($result->num_rows === 0) {
                echo '<p>Нет товаров</p>';
            } else {
                while ($row = $result->fetch_assoc()) {
                    $product_id = $row['product_id'];
                    $product_name = $row['product_name'];
                    $product_description = $row['product_description'];
                    $product_pic = $row['product_pic'];
                    $category_id = $row['category_id'];
                    $product_price = $row['product_price'];

                    echo <<<HERE
                        <div class="good {$category_id} show">
                            <div class="card-img">
                                <img src="{$product_pic}" alt="">
                             </div>
                            <div class="card-text">
                                <p>$product_name</p>
                            </div>
                            <div class="price">
                                $product_price ₽
                            </div>
                            <form class="delete" action="server/_delete.php" method="post">
                                <input name="product_id" hidden value="$product_id">
                                <button type="submit">Удалить</button>
                            </form>
                        </div>
                    HERE;
                }
            }
            ?>

        </div>

    </main>
    <?php
        require('./src/templates/footer.php');
    ?>
    <script src="src/js/filters.js?<?php echo time(); ?>"></script>
</body>

</html>