<?php 
    session_start();
    $conn = mysqli_connect('127.0.0.1:3306', 'root', '', 'car_rent_db')
    or die("Connection error");

    $sql = "SELECT * FROM autos";
    $result = mysqli_query($conn, $sql);

    include("header.php"); 
    if($_SESSION["currentUserLogin"]){ 
?>
    <h3>hello</h3>
    
<?php 
    }
    else{
    echo "<h3>" . $_SESSION["currentUserLogin"] . "</h3>";
?>
    <h1>index page</h1>
    <a href="registration.php">registration</a><br>
    <a href="login.php">log in</a><br>
<?php
    }
?>

<link rel="stylesheet" href="https://code.getmdl.io/1.3.0/material.indigo-pink.min.css" />
<style>
    .demo-card-square.mdl-card {
        width: 320px;
        height: 320px;
    }
    .demo-card-square > .mdl-card__title {
        color: #fff;
        background:
        url('../assets/demos/dog.png') bottom right 15% no-repeat #46B6AC;
    }
</style>

<table border="1" width="100%">
        <tr>
            <th>№</th>
            <th>Фото</th>
            <th>Модель</th>
            <th>Год</th>
            <th>Пробег</th>
            <th>Статус</th>
            <th></th>
        </tr>

<?php
    for($i = 0; $i < mysqli_num_rows($result); $i++){
        $data = $result->fetch_assoc();
?>

    <tr>
        <td><?php echo $data["id"]?></td>
        <td><img src="<?php echo $data["img_src"]?>" alt="" style="width: 100px; height: auto;"></td>
        <td><?php echo $data["model"]?></td>
        <td><?php echo $data["year"]?></td>
        <td><?php echo $data["milleage"]?></td>
        <td><?php echo $data["status"]?></td> 
        <td>
            <form action="details.php" method="GET">
                <input hidden type="text" name="auto_id" value="<?php echo $data["id"]?>">
                <input hidden type="text" name="showAutoForm" value="a">
                <button type="submit" class="button">Подробнее</button>
            </form>
        </td>
    </tr>
<?php
    }
?>
    </table>

    <div class="demo-card-square mdl-card mdl-shadow--2dp">
        <div class="mdl-card__title mdl-card--expand">
            <h2 class="mdl-card__title-text">Update</h2>
        </div>
        <div class="mdl-card__supporting-text">
            Lorem ipsum dolor sit amet, consectetur adipiscing elit.
            Aenan convallis.
        </div>
        <div class="mdl-card__actions mdl-card--border">
            <a class="mdl-button mdl-button--colored mdl-js-button mdl-js-ripple-effect">
            View Updates
            </a>
        </div>
</div>
<?php include("footer.php") ?>