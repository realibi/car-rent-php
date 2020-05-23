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

    
    $result = mysqli_query($conn, $sql);

    include("header.php"); 
?>

<style>
    .demo-card-square.mdl-card {
        width: 100%;
        height: 310px;
        border: 1px solid white;
        box-shadow: 0 0 20px darkgrey;
        border-radius: 3px;
        padding-left: 5%;
        background-color: white;
    }

    .demo-card-square.mdl-card:hover {
        width: 100%;
        height: 310px;
        border: 1px solid white;
        box-shadow: 0 0 20px #5d4940;
        border-radius: 3px;
        padding-left: 5%;
        transition: 0.5s;
        background-color: white;
    }

    .demo-card-square.mdl-card img{
        width: 95%;
        height: 200px;
        margin-top: 10px;
        margin-bottom: 15px;
    }

    .demo-card-square.mdl-card p{
        font-family: 'Roboto Slab', serif;
        font-size: 18px;
        font-weight: 700;
        padding-left: 3px;
    }

    .demo-card-square.mdl-card button{
        background-color: white;
        border: 1px solid white;
        color: #5d4940;
        font-weight: 700;
        padding: 0px;
        font-family: 'Roboto Slab', serif;
        padding-left: 3px;
    }

    .demo-card-square.mdl-card button:hover{
        background-color: white;
        border: 1px solid white;
        color: #a2857d;
        font-weight: 700;
        padding: 0px;
        font-family: 'Roboto Slab', serif;
        padding-left: 3px;
    }
</style>

    <div class="col-12">
        <div class="title-text">Все машины</div>
        <br>
    </div>

    <div class="col-md-9">
        <div class="row">

        
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