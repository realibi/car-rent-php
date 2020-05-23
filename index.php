<?php include("header.php") ?>

<div class="col-12">
    <div class="col-md-9">
        <div class="title-text">Главная</div>
    </div>
</div>

<div class="col-md-9">
    <img src="img/main.jpg" alt="" style="width: 100%;">
    <br><br>
    <div class="main-text">
    С каждым годом потребность в транспортных перевозках по стране возрастает все с большей интенсивностью. Мы давно уже живем в мире, где основным сердцем экономики являются логистические возможности и чем выше способность транспортного соединения между крупными городами, тем активнее они развиваются. Данная модель была открыта более 100 лет назад и влияние урбанизации на современные реалии с каждым новым десятилетием только укрепляется. 

 

Кроме развития технологий перевозок можно отчетливо наблюдать развитие автомобильной промышленности. С каждым годом личный транспорт все дальше отходит от характеристики “роскошь” и все ближе подбирается к простым обывателям в качестве обыкновенного средства передвижения. Однако далеко не все обладают возможностями приобрести свой личный транспорт, хотя надобностей в его наличии меньше не стало. В таких случаях на помощь приходят услуги аренда авто и данное решение по праву можно считать одним из наиболее оптимальных в условиях современных реалий.
    </div>
</div>

<div class="col-md-3">
    <div class="signinBlock tac">
        <br>
        <h4 class="important-text">Вход</h4>
        <form action="logic.php" method="post">
            <input type="text" name="login" placeholder="Логин"><br>
            <input type="text" name="password" placeholder="Пароль"><br>
            <input hidden type="text" name="logInForm" value="a"><br>
            <button type="submit">Войти</button>
        </form>
        <br><hr><br>
        <h4 class="important-text">Регистрация</h4>
        <form action="logic.php" method="post">
            <input type="text" name="fullName" placeholder="ФИО"><br>
            <input type="text" name="login" placeholder="Логин"><br>
            <input type="text" name="password" placeholder="Пароль"><br>
            <input hidden type="text" name="registrationForm" value="a"><br>
            <button type="submit">Зарегистрироваться</button>
        </form>
    </div>
</div>

<?php include("footer.php") ?>