<?php
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
        <p class="important-text">Модель:</p> 
        <p class="regular-text right"><?php echo $data["model"]?></p>
        <p class="important-text">Год выпуска:</p> 
        <p class="regular-text right"><?php echo $data["year"]?></p>
        <p class="important-text">Пробег:</p> 
        <p class="regular-text right"><?php echo $data["milleage"]?></p>
        <p class="important-text">Статус:</p> 
        <p class="regular-text right"><?php echo $data["status"]?></p>
        <button class="button">Оформить аренду</button>
    </div>
<?php
    }
    else{
?>
    <h1>error</h1>
<?php
    }
    include("footer.php"); 
?>