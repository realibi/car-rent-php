<?php
    session_start();
    include("header.php"); 
    $conn = mysqli_connect('127.0.0.1:3306', 'root', '', 'car_rent_db')
    or die("Connection error");
    $id = $_GET["auto_id"];
    $sql = "SELECT * FROM autos where id=$id";
    $data = mysqli_fetch_assoc($conn->query($sql));

    if($data != null){
        $owner_id = 
        $sqlFindOwner = "SELECT * FROM users where id=";
        $owner = mysqli_fetch_assoc($conn->query($sql));
?>  
    <div class="col-12">
        <div class="title-text">Подробное описание машины</div>
        <br>
    </div>
    
    <div class="col-md-6 col-xs-12">
        <div class="img-block">
            <img src="<?php echo $data["img_src"]?>" alt="" style="width: 100%;">
        </div>
    </div>
    <div class="col-md-6 col-xs-12">
        <div class="info">
            <div class="important-text">Модель:</div> 
            <div class="regular-text right"><?php echo $data["model"]?></div>
        </div><br>
        <div class="info">
            <div class="important-text">Год выпуска:</div> 
            <div class="regular-text right"><?php echo $data["year"]?></div>
        </div><br>
        <div class="info">
            <div class="important-text">Пробег:</div> 
            <div class="regular-text right"><?php echo $data["milleage"]?> км</div>
        </div><br>
        <div class="info">
            <div class="important-text">Статус:</div> 
            <div class="regular-text right"><?php echo $data["status"]?></div>
        </div><br>
        <div class="info">
            <div class="important-text">Цена:</div> 
            <div class="regular-text right"><?php echo $data["price"]?>/сутки</div>
        </div><br><br><br>
        <?php
            if($data["status"] != "свободна"){
        ?>

            <div class="important-text tac">На данный момент машина уже в аренде! Дождитесь, пока она освободится.</div>

        <?php
            }elseif($_SESSION["currentUserFullName"] != null){
        ?>

                <button class="button">
                    <a class="buyButtonIndex" href="javascript:PopUpShow()">
                        Оформить аренду на имя <?php echo $_SESSION["currentUserFullName"] ?>
                    </a>
                </button>
                <!-- <a class="buyButtonIndex" href="javascript:PopUpShow()">ORDER A CALL FROM CONSULTANT</a> -->
        
        <?php
            }elseif($_SESSION["currentUserFullName"] == null){
        ?>

                <div class="important-text tac">Авторизуйтесь, чтобы оформить аренду этого авто!</div>
        
        <?php
            }
        ?>
    </div>
<?php
    }
    else{
?>
    <h1>error!</h1>
<?php
    }
?>

<?php
    include("footer.php"); 
?>