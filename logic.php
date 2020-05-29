<?php
    session_start();
    $conn = mysqli_connect('127.0.0.1:3306', 'root', '', 'car_rent_db')
    or die("Connection error");

    if($_POST["registrationForm"]){
        register();
    }
    elseif($_POST["logInForm"]){
        $login = $_POST["login"];
        $password = $_POST["password"];
        logIn($login, $password);
    }
    elseif($_POST["logout"]){
        session_destroy();
        header('Location: index.php');
    }
    elseif($_POST["newRent"]){
        createOrder();
    }
    elseif($_POST["addCar"]){
        addCar();
    }
    elseif($_POST["acceptOrder"]){
        acceptOrder();
    }
    elseif($_POST["declineOrder"]){
        declineOrder();
    }

    function declineOrder(){
        global $conn;
        $orderId = $_POST["orderId"];
        $userId = $_POST["userId"];
        $rentStartTime = $_POST["rentStartTime"];
        $rentEndTime = $_POST["rentEndTime"];
        $autoId = $_POST["autoId"];

        $sqlToOrders = "DELETE FROM orders WHERE id=$orderId";
        if($conn->query($sqlToOrders)){
            header('Location: personal-page.php');
        }else{
            header('Location: personal-page.php');
        }
    }

    function acceptOrder(){
        global $conn;
        $orderId = $_POST["orderId"];
        $userId = $_POST["userId"];
        $rentStartTime = $_POST["rentStartTime"];
        $rentEndTime = $_POST["rentEndTime"];
        $autoId = $_POST["autoId"];
        $sqlToOrders = "UPDATE orders SET accepted=1 WHERE id=$orderId";
        $sqlToAutos = "UPDATE autos SET owner_id=$userId, rent_start_time='$rentStartTime', rent_end_time='$rentEndTime', status='занята' WHERE id=$autoId";

        if($conn->query($sqlToOrders)){
            if($conn->query($sqlToAutos)){
                header('Location: personal-page.php');
            }else{
                echo "error";
            }
        }else{
            echo "error";
        }
    }

    function addCar(){
        $model = $_POST["model"];
        $year = $_POST["year"];
        $milleage = $_POST["milleage"];
        $price = $_POST["price"];
        $number = $_POST["number"];

        $target_dir = "E:/OSPanel/OSPanel/domains/car-rent/img/"; //ПУТЬ ДЛЯ СОХРАНЕНИЯ ФОТО

        $uniqidForImageName = uniqid();
        $target_file = $target_dir . $uniqidForImageName . basename($_FILES["image"]["name"]);
        $uploadOk = 1;
        $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

        if(isset($_POST["submit"])) {
            $check = getimagesize($_FILES["image"]["tmp_name"]);
            if($check !== false) {
               // echo "File is an image - " . $check["mime"] . ".";
                $uploadOk = 1;
            } else {
               // echo "File is not an image.";
                $uploadOk = 0;
            }
        }

        if (file_exists($target_file)) {
            //echo "Sorry, file already exists.";
            $uploadOk = 0;
        }

        if ($_FILES["image"]["size"] > 50000000) {
            //echo "Sorry, your file is too large.";
            $uploadOk = 0;
        }

        if ($uploadOk == 0) {
            //echo "Sorry, your file was not uploaded.";
        } else {
            if (move_uploaded_file($_FILES["image"]["tmp_name"], $target_file)) {
               // echo "The file ". basename( $_FILES["image"]["name"]). " has been uploaded.";
            } else {
                //echo "Sorry, there was an error uploading your file.";
            }
        }

        $imageUrl = "img/" . $uniqidForImageName . basename($_FILES["image"]["name"]);
        $ownerId = $_SESSION["currentUserId"];

        $sql = "INSERT INTO autos(model, img_src, year, milleage, status, number, owner_id, price) VALUES('$model', '$imageUrl', $year, $milleage, 'свободна', '$number', $ownerId, $price)";
        global $conn;

        if($conn->query($sql)){
            header('Location: all-cars.php');
        }else{
            header('Location: personal-page.php');
        }
    }

    

    function createOrder(){
        global $conn;
        $autoId = $_POST["autoId"];
        $model = $_POST["model"];
        $days = $_POST["days"];
        $offsetDays = new DateInterval('P' . $days . 'D');
        $currentDateTime = date('Y-m-d');
        $curDate = new DateTime($currentDateTime);
        $offsetDate = $curDate->add($offsetDays);
        $offsetDate = $offsetDate->format('Y-m-d');
        $ownerId = $_SESSION["currentUserId"];
        $currentUserId = $_SESSION["currentUserId"];
        $currentUserFullName = $_SESSION["currentUserFullName"];
        //$sql = "UPDATE autos SET status='занята', rent_start_time='$currentDateTime', rent_end_time='$offsetDate', owner_id=$ownerId WHERE id=$autoId";
        $sql = "INSERT INTO orders(auto_id, auto_model, user_id, user_fullname, rent_start_time, rent_end_time) VALUES($autoId, '$model', $currentUserId, '$currentUserFullName', '$currentDateTime', '$offsetDate')";
        if($conn->query($sql)){
            header('Location: all-cars.php');
        }else{
            header('Location: index.php');
        }
    }

    function register(){
        global $conn;

        $fullname = $_POST["fullname"];
        $login = $_POST["login"];
        $password = $_POST["password"];

        $sqlToCheck = "SELECT * FROM users WHERE login='$login'";

        $sql = "insert into users(fullname, login, password, admin) VALUES('$fullname', '$login', '$password', 0)";
        
        $result = mysqli_query($conn, $sqlToCheck);
        $data = $result->fetch_assoc();

        if($data["id"]){
            header('Location: index.php');
        }else{
            if($conn->query($sql)){
                logIn($login, $password);
            }else{
                header('Location: index.php');
            }
        }
    }

    function logIn($login, $password){
        global $conn;

        $sql = "SELECT * FROM users where login='$login' and password='$password'";
        $data = mysqli_fetch_assoc($conn->query($sql));

        if($data != null){
            $_SESSION["currentUserLogin"] = $data["login"];
            $_SESSION["currentUserFullName"] = $data["fullname"];
            $_SESSION["currentUserId"] = $data["id"];
            $_SESSION["currentUserIsAdmin"] = $data["admin"];
            header('Location: index.php');
        }else{
            header('Location: index.php');
        }
    }
?>