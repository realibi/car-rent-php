            </div>
        </div>


        <div class="b-popup" id="popup1">
            <div class="b-popup-content">
                <div class="row">
                <div class="col-12 tac">
                    <div class="regular-text">Вы уверены?</div><br><br>
                    <div class="regular-text left white">Модель машины:</div>
                    <div class="regular-text right white"><?php echo $data["model"] ?></div><br>
                    <div class="regular-text left white">Год выпуска:</div>
                    <div class="regular-text right white"><?php echo $data["year"] ?> г.</div><br>
                    <div class="regular-text left white">Пробег:</div>
                    <div class="regular-text right white"><?php echo $data["milleage"] ?> км</div><br>
                    <div class="regular-text left white">Цена:</div>
                    <div class="regular-text right white"><?php echo $data["price"] ?>/сутки</div><br><br>
                    <form action="logic.php" method="post">
                        <input hidden type="text" name="model" value="<?php echo $data["model"] ?>">
                        <div class="regular-text white">Кол-во дней аренды:</div>
                        <input type="number" name="days"><br><br>
                        <div class="regular-text white">Особые пожелания:</div>
                        <textarea rows="2"></textarea>
                        <br>
                        <input hidden type="text" name="autoId" value="<?php echo $data["id"] ?>">
                        <input hidden type="text" name="newRent" value="a">
                        <button type="submit" class="button">Оформить аренду</button><br>
                        <a class="okButton" href="javascript:PopUpHide()">Отмена</a>
                    </form>
                </div>
                </div>
            </div>
        </div>

        <script src="js/popup.js"></script>

        <br><br><br>

        <div class="footer">
            <br>
            <div class="container">
                <div class="row">
                    <div class="col-4"></div>
                    <div class="col-4">
                    <p class="regular-text center">Все права защищены</p>
                    </div>
                    <div class="col-4"></div>
                </div>
            </div>
        </div>
    </body>

</html>