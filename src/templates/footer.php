<footer>
    <div class="footer-content">
        <div class="footer-nav">
            <a class="footer-title" href="index.php">Главная</a>
            <a class="footer-title" href="catalog.php">Каталог</a>
            <?php 
            if (isset($_SESSION['user_id'])) {
                echo "
                    <a class='footer-title' href='user/index.php'>Личный кабинет</a>
                ";
            } else {
                echo "
                    <a class='footer-title' href='authentication.php'>Личный кабинет</a>
                ";
            }
            ?>
            
        </div>
        <div class="docs">
            <a class="footer-title" href="">Документация</a>
            <p>Политика в отношении обработки персональных данных</p>
            <p>Устав</p>
            <p>Публичная оферта о заключении договора пожертвования</p>
        </div>
        <div class="info">
            <a href="https://xn--80ajheucvpfjy.xn--p1ai/"><img src="src/img/logo_main.svg" alt="Логотип коррекционного центра «Азимут»"></a>
            <p>© 2025 Автономная некоммерческая организация «Коррекционный центр «Азимут»</p>
            <p>Все права защищены</p>
        </div>
        <div class="contacts">
            <a class="footer-title" href="contacts.html">Контакты</a>
            <p>+7 (911) 681-96-41</p>
            <p>asimutcentr@gmail.com</p>
            <a href="https://vk.com/azimut_center29"><img src="src/img/vk-logo-svgrepo-com 1.svg" alt="Ссылка на соцсеть «Вконтакте»"></a>
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