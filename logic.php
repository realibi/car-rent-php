<?php
    session_start();
    $conn = mysqli_connect('127.0.0.1:3306', 'root', '', 'car_rent_db')
    or die("Connection error");

    if($_POST["registrationForm"]){
        register();
    }elseif($_POST["logInForm"]){
        logIn();
    }

    function register(){
        global $conn;

        $fullName = $_POST["fullName"];
        
        $login = $_POST["login"];
        $password = $_POST["password"];

        $sql = "insert into users(fullName, login, password) VALUES('$fullName', '$login', '$password')";

        if($conn->query($sql)){
           echo "user added";
        }else{
           echo "something went wrong";
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
            $_SESSION["currentUserFullName"] = $data["fullName"];
            header('Location: index.php');
        }else{
            echo "ne ochen";
        }
    }
?>