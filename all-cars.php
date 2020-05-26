<?php 
    session_start();
    $conn = mysqli_connect('127.0.0.1:3306', 'root', '', 'car_rent_db')
    or die("Connection error");

    if($_GET["model"] != null){
        $model = $_GET["model"];
        $sql = "SELECT * FROM autos WHERE model like '$model' or model like '%$model' or model like '$model%' or model like '%$model%'";
    }else{
        $sql = "SELECT * FROM autos";
    }

    function checkRentDate($data){
        $rent_end_date = $data["rent_end_time"];
        $status = $data["status"];
        $date = new DateTime($rent_end_date);
        $currentDate = new DateTime("now");
        if($status != "свободна" && ($date < $currentDate)){
            $id = $data['id'];
            $sql = "UPDATE autos SET status='свободна' WHERE id=$id";
            global $conn;
            if(!$conn->query($sql)){
                echo "Произошла ошибка при обновлении данных о машине!";
            }
        }
    }
    
    $result = mysqli_query($conn, $sql);

    include("header.php"); 
?>

    <div class="col-12">
        <div class="title-text">Все машины</div>
        <br>
    </div>

    <div class="col-md-9">
        <div class="row">

        
<?php
    for($i = 0; $i < mysqli_num_rows($result); $i++){
        $data = $result->fetch_assoc();
        checkRentDate($data);
?>
        <div class="col-md-5 col-xs-12">
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
?>
        </div>
    </div>
    <div class="col-md-3">
        <div class="searchBlock tac">
            <br>
            <form action="all-cars.php" method="get">
                <h4 class="important-text">Поиск по модели</h4>
                <input type="text" name="model" ><br><br>
                <button type="submit">Поиск</button>
            </form>
        </div>
    </div>
<?php include("footer.php") ?>