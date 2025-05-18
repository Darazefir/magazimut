<?php
session_start();
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
        <div class="banner">
            <h1 class="banner-title">ПРОСТО <br> ДРУГОЙ <br> ВЗГЛЯД</p>
                <h6 class="banner-text">товары от <br> мастерской <br> «Азимут»</h6>
        </div>

        <div class="goal">
            <p>Мы рады представить вам уникальные изделия, созданные с любовью и заботой особенных детей. Каждый предмет — это не просто товар, а результат творчества, вдохновения и стремления к самовыражению.
                <br>Покупая наши изделия, вы не только поддерживаете талантливых детей, но и помогаете им развиваться, получать необходимые навыки и уверенность в себе.
                <br>Ваш вклад поможет создать безопасную и вдохновляющую среду для их обучения и творчества. Каждое изделие наполнено душой и индивидуальностью, что делает его поистине уникальным.
                <br>Каждая покупка — это шаг к переменам и возможность изменить жизнь к лучшему.
            </p>
            <h2 class="markered-pink">Спасибо за вашу поддержку! Вместе мы можем сделать мир ярче и добрее! </h2>
        </div>

        <div class="popular">
            <div class="card">
                <p class="price">299 ₽</p>
                <img>
            </div>
            <div class="card">
                <p class="price">299 ₽</p>
                <img>
            </div>
            <div class="card">
                <p class="price">299 ₽</p>
                <img>
            </div>
        </div>

        <div class="actions">
            <div class="card">
                <div class="card-img">
                    <img src="src/img/icon_heart1.svg">
                </div>
                <div class="card-text">
                    <h2>Дарите любовь</h2>
                    <p>Каждое изделие содержит частичку доброты</p>
                </div>
            </div>
            <div class="card">
                <div class="card-img">
                    <img src="src/img/icon_heart2.svg">
                </div>
                <div class="card-text">
                    <h2>Собирайте улыбки</h2>
                    <p>Наши мастера всегда рады Вашим позитивным отзывам</p>
                </div>
            </div>
            <div class="card">
                <div class="card-img">
                    <img src="src/img/icon_heart3.svg">
                </div>
                <div class="card-text">
                    <h2>Вдохновляйте надежду</h2>
                    <p>Все средства отправляются на развитие проекта</p>
                </div>
            </div>
        </div>
    </main>

    <?php
        require('./src/templates/footer.php');
    ?>
</body>

</html>