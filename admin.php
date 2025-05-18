<?php
session_start();
require_once('server/_conn.php');
$sql = "SELECT * FROM `apps`
JOIN `statuses` USING (`status_id`)
JOIN `products` USING (`product_id`)
JOIN `delivery` USING (`delivery_id`)
JOIN `users` USING (`user_id`)";
?>

<!DOCTYPE html>
<html lang="ru">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="src/css/style.css?<?php echo time(); ?>" rel="stylesheet">
    <link rel="icon" type="image/png" href="src/img/favicon.png">
    <title>Магазимут — Панель администратора</title>
</head>

<body>
    <?php 
        require('./src/templates/admin_header.html');
    ?>
    <main>
        <!-- Таблица с вводом данных о заявках -->
        <table>
            <thead>
                <tr>
                    <th>Контактные данные</th>
                    <th>Товар</th>
                    <th>Статус</th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
                <?php
                $stmt = $mysqli->prepare($sql);
                if (!$stmt) {
                    die("Ошибка подготовки запроса: " . $mysqli->error);
                }
                $stmt->execute();
                $result = $stmt->get_result();
    
                if (!$result) {
                    die("Query failed: " . $mysqli->error);
                }
    
                if ($result-> num_rows > 0) {
                    while ($row=$result->fetch_assoc()) {
                        $app_id = $row['app_id'];
                        $name = $row['user_name'];
                        $phone = $row['user_phone'];
                        $delivery = $row['delivery_name'];
                        $product = $row['product_name'];
                        $status = $row['status_name'];

                        echo <<< HERE
                            <tr>
                                <td>
                                    <p>$name</p>
                                    <p>$phone</p>
                                    <p>$delivery</p>
                                </td>
                                <td>
                                    <p>$product</p>
                                </td>
                                <td>
                                    $status
                                </td>
                                <td>
                                    <form class="admin" action="server/_change.php" method="post">
                                        <input value="$app_id" name="app_id" hidden>
                                        <select name="status">
                                            <option selected disabled>Выберите</option>
                                            <option value="2">Готов</option>
                                            <option value="3">Получен</option>
                                            <option value="4">Отменен</option>
                                        </select>
                                        <button>Подтведить</button>
                                    </form>
                                </td>
                            </tr>
                        HERE;
                    }
            } else {
                echo "<tr>
                        <td> Завок пока нет</td>
                    </tr>";
            }
            ?>
            </tbody>
        </table>

    </main>

    <?php
        require('./src/templates/footer.php');
    ?>
</body>
</html>