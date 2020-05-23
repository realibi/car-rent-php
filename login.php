<?php include("header.php") ?>
    <h1>log in page</h1>
    <form action="logic.php" method="post">
        <input type="text" name="login" placeholder="login"><br>
        <input type="text" name="password" placeholder="password"><br>
        <input hidden type="text" name="logInForm" value="a">
        <button type="submit">log in</button>
    </form>
<?php include("footer.php") ?>