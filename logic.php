<?php
    session_start();
    $conn = mysqli_connect('127.0.0.1:3306', 'root', '', 'car_rent_db')
    or die("Connection error");

    if($_POST["registrationForm"]){
        register();
    }elseif($_POST["logInForm"]){
        logIn();
    }
    elseif($_POST["logout"]){
        session_destroy();
        header('Location: index.php');
    }
    elseif($_POST["newRent"]){
        createRent();
    }

    function createRent(){
        global $conn;
        $autoId = $_POST["autoId"];
        $currentDateTime = date('Y-m-d');
        $sql = "UPDATE autos SET status='занята', rent_start_time=$currentDateTime WHERE id=$autoId";
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
            $_SESSION["currentUserLogin"] = $data["login"];
            $_SESSION["currentUserFullName"] = $data["fullname"];
            header('Location: index.php');
        }else{
            header('Location: index.php');
        }
    }

    function logIn(){
        global $conn;

        $login = $_POST["login"];
        $password = $_POST["password"];

        $sql = "SELECT * FROM users where login='$login' and password='$password'";
        $data = mysqli_fetch_assoc($conn->query($sql));

        if($data != null){
            $_SESSION["currentUserLogin"] = $data["login"];
            $_SESSION["currentUserFullName"] = $data["fullname"];
            header('Location: index.php');
        }else{
            header('Location: index.php');
        }
    }
?>