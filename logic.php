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
        createRent();
    }
    elseif($_POST["addCar"]){
        addCar();
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

    function createRent(){
        global $conn;
        $autoId = $_POST["autoId"];
        $days = $_POST["days"];
        $offsetDays = new DateInterval('P' . $days . 'D');
        $currentDateTime = date('Y-m-d');
        $curDate = new DateTime($currentDateTime);
        $offsetDate = $curDate->add($offsetDays);
        $offsetDate = $offsetDate->format('Y-m-d');
        $ownerId = $_SESSION["currentUserId"];
        $sql = "UPDATE autos SET status='занята', rent_start_time='$currentDateTime', rent_end_time='$offsetDate', owner_id=$ownerId WHERE id=$autoId";
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

        $sql = "insert into users(fullname, login, password) VALUES('$fullname', '$login', '$password')";

        if($conn->query($sql)){
            logIn($login, $password);
        }else{
            header('Location: index.php');
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
            header('Location: index.php');
        }else{
            header('Location: index.php');
        }
    }
?>