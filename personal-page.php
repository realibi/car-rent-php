<?php 
    session_start();
    $conn = mysqli_connect('127.0.0.1:3306', 'root', '', 'car_rent_db')
    or die("Connection error");

    $currentUserId = $_SESSION["currentUserId"];

    include("header.php");
    if($_SESSION["currentUserIsAdmin"] == 1){
        $sql = "SELECT * FROM orders WHERE accepted=0";
        $sqlCurrentOrders = "SELECT * FROM orders WHERE accepted=1 AND rent_end_time >= CURDATE()";
        $result = mysqli_query($conn, $sql);
        $currentRent = mysqli_query($conn, $sqlCurrentOrders);
?>

<div class="title-text">Добавить новую машину</div>

<div class="col-12">
    
    <br>
    <form action="logic.php" method="post" enctype="multipart/form-data">
        <div class="row">
            <div class="col-md-6 col-xs-12">
                <div class="important-text">Фотография:</div><br><br>
                <div class="regular-text"><input type="file" name="image"></div><br><br><br>
                <div class="important-text">Модель</div><br><br>
                <div class="regular-text"><input type="text" name="model"></div><br><br><br>
    
                <div class="important-text">Год выпуска</div><br><br>
                <div class="regular-text"><input type="number" name="year"></div><br><br><br>
                <button type="submit" class="button w-50 tac">Готово</button>
            </div>
            <div class="col-md-6 col-xs-12">
            <div class="important-text">Пробег</div><br><br>
            <div class="regular-text"><input type="number" name="milleage"></div><br><br><br>

            <div class="important-text">Цена за сутки</div><br><br>
            <div class="regular-text"><input type="number" name="price"></div><br><br><br>

            <div class="important-text">Гос. номер автомобиля</div><br><br>
            <div class="regular-text"><input type="text" name="number"></div><br><br><br>
            </div>
        </div>
        <input hidden type="text" name="addCar" value="a">
    </form>

    <br><br><br><br>

    <div class="title-text">Новые события</div>

    <table width="100%" border="1" class="ordersTable">
        <tr>
            <th>ФИО Клиента</th>
            <th>Модель машины</th>
            <th>Желаемый день начала аренды</th>
            <th>Желаемый день конца аренды</th>
            <th></th>
            <th></th>
        </tr>
<?php
    for($i = 0; $i < mysqli_num_rows($result); $i++){
        $data = $result->fetch_assoc();
?>
        <tr>
            <td><?php echo $data["user_fullname"] ?></td>
            <td><?php echo $data["auto_model"] ?></td>
            <td><?php echo $data["rent_start_time"] ?></td>
            <td><?php echo $data["rent_end_time"] ?></td>
            <td>
                <form action="logic.php" method="post">
                    <input hidden type="text" name="userId" value="<?php echo $data["user_id"] ?>">
                    <input hidden type="text" name="autoId" value="<?php echo $data["auto_id"] ?>">
                    <input hidden type="text" name="rentStartTime" value="<?php echo $data["rent_start_time"] ?>">
                    <input hidden type="text" name="rentEndTime" value="<?php echo $data["rent_end_time"] ?>">
                    <input hidden type="text" name="orderId" value="<?php echo $data["id"] ?>">
                    <input hidden type="text" name="acceptOrder" value="a">
                    <button>Принять</button>
                </form>
            </td>
            <td><form action="logic.php" method="post">
                    <input hidden type="text" name="userId" value="<?php echo $data["user_id"] ?>">
                    <input hidden type="text" name="autoId" value="<?php echo $data["auto_id"] ?>">
                    <input hidden type="text" name="orderId" value="<?php echo $data["id"] ?>">
                    <input hidden type="text" name="declineOrder" value="a">
                    <button>Отклонить</button>
                </form></td>
        </tr>

<?php
    }
?>
    </table>

    <br><br><br><br>

    <div class="title-text">Текущие заказы</div>

    <table width="100%" border="1" class="ordersTable">
        <tr>
            <th>ФИО Клиента</th>
            <th>Модель машины</th>
            <th>День начала аренды</th>
            <th>День конца аренды</th>
        </tr>
<?php
    for($i = 0; $i < mysqli_num_rows($currentRent); $i++){
        $data = $currentRent->fetch_assoc();
?>
        <tr>
            <td><?php echo $data["user_fullname"] ?></td>
            <td><?php echo $data["auto_model"] ?></td>
            <td><?php echo $data["rent_start_time"] ?></td>
            <td><?php echo $data["rent_end_time"] ?></td>
        </tr>

<?php
    }
?>
    </table>

<?php
    }
    else{
        $sql = "SELECT * FROM autos WHERE owner_id=$currentUserId AND status='занята'";
        $result = mysqli_query($conn, $sql);
?>
    <style>
        .footer{
            position: absolute;
        }
    </style>

    <div class="title-text">В Вашей текущей аренде:</div>
    <br>

<?php
    for($i = 0; $i < mysqli_num_rows($result); $i++){
        $data = $result->fetch_assoc();
?>

    <div class="col-md-4 col-xs-12">
            <div class="demo-card-square mdl-card mdl-shadow--2dp">
                <div class="mdl-card__title mdl-card--expand">
                    <img src="<?php echo $data["img_src"]?>" alt="">
                </div>
                <div class="mdl-card__supporting-text">
                    <p class="important-text"><?php echo $data["model"]?></p> 
                </div>
                <div class="mdl-card__actions mdl-card--border">
                    <form action="details.php" method="GET">
                        <input hidden type="text" name="auto_id" value="<?php echo $data["id"]?>">
                        <input hidden type="text" name="showAutoForm" value="a">
                        <button type="submit" class="">Подробнее</button>
                    </form>
                </div>
            </div>
            <br><br>
    </div>

<?php
    }
}
?>
</div>

<?php
    include("footer.php");
?>