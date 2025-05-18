<?php
session_start();
$user_id = $_SESSION['user_id'];
$user_name = $_SESSION['user_name'];
require_once('../server/_conn.php');

$sql = "SELECT * FROM `apps`
JOIN `statuses` USING (`status_id`)
JOIN `products` USING (`product_id`)
JOIN `delivery` USING (`delivery_id`)
WHERE `user_id` = (?)";
?>

<!DOCTYPE html>
<html lang="ru">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="../src/css/style.css?<?php echo time(); ?>" rel="stylesheet">
    <link rel="icon" type="image/png" href="../src/img/favicon.png">
    <title>Магазимут — Личный кабинет</title>
</head>

<body>
    <header>
        <img src="../src/img/logo.svg">
        <div class="nav">
            <a href="../index.php">Главная</a>
            <a href="../catalog.php">Каталог</a>
            <a href="../doc.php">Документация</a>
            <a href="../contacts.php">Контакты</a>
        </div>

        <div class="dropdown" style="float:right;">
            <button class="dropbtn"><img src="../src/img/btn_lk.svg"></button>
            <div class="dropdown-content">
                <a href="index.php">Личный кабинет</a>
                <hr>
                <a href="#">Корзина</a>
                <hr>
                <a href="../server/_exit.php">Выйти</a>
            </div>
        </div>
    </header>

    <main>
            <h3>Добро пожаловать, <?php echo $user_name ?>!</h2>
            <p>Ваши покупки:</p>

            <?php
            $stmt = $mysqli->prepare($sql);
            if (!$stmt) {
                die("Ошибка подготовки запроса: " . $mysqli->error);
            }
            $stmt->bind_param("i", $user_id);
            $stmt->execute();
            $result = $stmt->get_result();

            if (!$result) {
                die("Query failed: " . $mysqli->error);
            }

            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    $product_name = $row['product_name'];
                    $product_pic = $row['product_pic'];
                    $product_price = $row['product_price'];
                    $status_name = $row['status_name'];
                    $delivery = $row['delivery_name'];

                    echo <<< HERE
                        <div class='app-item'>
                            <div class="good show">
                                <div class="card-img">
                                    <img src="../assets/products/{$product_pic}" alt="">
                                    </div>
                                <div class="card-text">
                                    $product_name
                                </div>
                                <div class="price">
                                    $product_price ₽
                                </div>
                            </div>
                            <div>
                                <p>Статус заказа: $status_name</p>
                                <p>Доставка: $delivery</p>
                                <p>Уточнить информацию:</p>
                                <p>+7 (911) 681-96-41</p>
                            </div>
                            
                        </div>
                    HERE;
                }
            } else {
                echo <<< HERE
                    <div class='app-item'>Покупок нет</div>
                HERE;
            }
            ?>
            
    </main>

    <footer>
        <div class="footer-content">
            <div class="footer-nav">
                <a class="footer-title" href="">Главная</a>
                <a class="footer-title" href="">Каталог</a>
                <a class="footer-title" href="">Личный кабинет</a>
            </div>
            <div class="docs">
                <a class="footer-title" href="">Документация</a>
                <p>Политика в отношении обработки персональных данных</p>
                <p>Устав</p>
                <p>Публичная оферта о заключении договора пожертвования</p>
            </div>
            <div class="info">
                <img src="../src/img/logo_main.svg" alt="Логотип коррекционного центра «Азимут»">
                <p>© 2025 Автономная некоммерческая организация «Коррекционный центр «Азимут»</p>
                <p>Все права защищены</p>
            </div>
            <div class="contacts">
                <a class="footer-title" href="">Контакты</a>
                <p>+7 (911) 681-96-41</p>
                <p>asimutcentr@gmail.com</p>
                <img src="../src/img/vk-logo-svgrepo-com 1.svg" alt="Ссылка на соцсеть «Вконтакте»">
            </div>
            <div class="adresses">
                <p>Архангельск <br>
                    Площадь Ленина, 4, 2 этаж,
                    офис 201</p>
                <p>Северодвинск <br>
                    ул.Карла Маркса, д.37</p>
            </div>
        </div>
    </footer>
    <script src="../src/js/buttons.js?<?php echo time(); ?>"></script>
</body>

</html>