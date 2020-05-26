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

        $uploaddir = 'E:/ospanel/ospanel/domains/car-rent/img/'; //physical address of uploads directory

        $uploadfile = $uploaddir . basename($_FILES['image']['name']);
        move_uploaded_file($_FILES['image']['name'], $uploadfile)

        $imgSrc = "img/" . $_FILES['image']['tmp_name'];

        $sql = "INSERT INTO autos(model, img_src, year, milleage, status, number, owner_id, price) VALUES('$model', )";
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