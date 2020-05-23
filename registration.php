<?php include("header.php") ?>
    <h1>registration page</h1>
    <form action="logic.php" method="post">
        <input type="text" name="fullName" placeholder="fullName"><br>
        <input type="text" name="login" placeholder="login"><br>
        <input type="text" name="password" placeholder="password"><br>
        <input hidden type="text" name="registrationForm" value="a">
        <button type="submit">Register</button>
    </form>
<?php include("footer.php") ?>