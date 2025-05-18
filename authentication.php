<?php
session_start();
?>

<!DOCTYPE html>
<html lang="ru">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="src/css/style.css?<?php echo time();?>" rel="stylesheet">
    <link rel="icon" type="image/png" href="src/img/favicon.png">
    <title>Магазимут — Вход</title>
</head>

<body>
    <?php
    if(isset($_SESSION['user_id'])) {
        require('./src/templates/auth_header.html');
    } else {
        require('./src/templates/header.html');
    }
    ?>

    <main>
        <div class="toggles">
            <button id="signup" class="unactive">РЕГИСТРАЦИЯ</button>
            <span>|</span>
            <button id="login">ВХОД</button>
        </div>

        <div class="registration" id="blockSignup">
            <form action="server/_registration.php" method="post">
                <input type="text" name="user_name" id="user_name" placeholder="Имя" required>
                <input type="text" name="user_phone" id="user_phone" placeholder="Телефон" required>
                <input type="email" name="user_email" id="user_email" placeholder="Электронная почта" required>
                <input type="password" name="user_pwd" id="user_pwd" placeholder="Пароль" required>
                <div class="agree">
                    <input type="checkbox" name="agree" id="agree" required>
                    <label>Я согласен с <a href="" style="color: #93B516">Политикой в отношении обработки персональных данных</a></label>
                </div>
                <button type="submit">Зарегистрироваться</button>
            </form>
            <div class="msg">
                <?php
                if (isset($_SESSION['msg']) && $_SESSION['msg'] > 0) {
                    $msg = $_SESSION['msg'];
                    $num = count($msg);
                    for ($i = 0; $i < $num; $i++) {
                        echo '<br>' . $msg[$i];
                    }
                }
                ?>
            </div>
        </div>

        <div class="login" id="blockLogin">
            <form action="server/_login.php" method="post">
                <input type="email" name="user_email" id="user_email" placeholder="Электронная почта" required>
                <input type="password" name="user_pwd" id="user_pwd" placeholder="Пароль" required>
                <button type="submit">Войти</button>
            </form>
        </div>
    </main>

    <?php
        require('./src/templates/footer.php');
    ?>
    <script src="src/js/buttons.js?<?php echo time(); ?>"></script>
</body>

</html>