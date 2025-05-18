<?php
session_start();
require_once('server/_conn.php');

$sql_category = "SELECT * FROM `categories`";
?>

<!DOCTYPE html>
<html lang="ru">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="src/css/style.css?<?php echo time(); ?>" rel="stylesheet">
    <link rel="icon" type="image/png" href="src/img/favicon.png">
    <title>Магазимут — Новый товар</title>
</head>

<body>
    <?php
    require('./src/templates/admin_header.html');
    ?>
    <main>
        <form action="server/_newproduct.php" enctype="multipart/form-data" method="POST">
            <input name="product_name">
            <input name="product_description">
            <input name="product_pic" type="file">
            <select name="category_id"> 
                <!-- <?php
                    // $stmt = $mysqli->prepare($sql_category);
                    // $stmt->execute();
                    // $result = $stmt->get_result();
                    // if ($result-> num_rows > 0) {
                    //     while ($row=$result->fetch_assoc()) {
                    //         echo <<< HERE
                    //             <option value='$category_id'> {$row["category_name"]} </option>
                    //         HERE;
                    //     }
                    // }
                ?> -->
                <option value='1'> test </option>
            </select>
            <input name="product_price">
            <button type="submit">продолжить</button>
        </form>
    </main>
    <?php
        require('./src/templates/footer.php');
    ?>
    <script src="src/js/filters.js?<?php echo time(); ?>"></script>
</body>

</html>