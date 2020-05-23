<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script
        src="https://code.jquery.com/jquery-3.5.1.min.js"
        integrity="sha256-9/aliU8dGd2tb6OSsuzixeV4y/faTqgFtohetphbbj0="
        crossorigin="anonymous">
    </script>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">
    <script 
        src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js" 
        integrity="sha384-OgVRvuATP1z7JjHLkuOU7Xw704+h835Lr+6QL9UvYjZE3Ipu6Tp75j7Bh/kR0JKI" 
        crossorigin="anonymous">
    </script>
    <link rel="stylesheet" href="css/style.css">
    <link href="https://fonts.googleapis.com/css2?family=Roboto+Slab:wght@400;700&family=Russo+One&display=swap" rel="stylesheet">
    <title>Document</title>
</head>
<body>
    <div class="header">
        <div class="container">
            <div class="site-name-top-text">Аренда автомобилей</div>
            <div class="site-name-additional-text">Пассажирские, грузовые, спортивные</div>
        
            <div class="header-menu">
                <div class="row">
                    <div class="col-md-4">
                        <div class="menu-item important-text border-right-1">
                            <a href="all-cars.php">Главная</a>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="menu-item important-text border-right-1">
                            <a href="">Машины</a>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="menu-item important-text">
                            <?php
                                if($_SESSION["currentUserLogin"]){ 
                            ?>
                                <a href="">Личный кабинет</a>
                            <?php
                                }
                                else{ 
                            ?>
                                <a href="">Вход</a>
                            <?php
                                } 
                            ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="container">
        <div class="row">
            