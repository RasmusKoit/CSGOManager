<?php
/**
 * Created by IntelliJ IDEA.
 * User: raks4
 * Date: 05.03.2018
 * Time: 15:15
 */
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Add a server</title>
</head>
<body>
<form action="insert.php" method="post">
    <p>
        <label for="serverIP">Server IP:</label>
        <input type="text" name="server_ip" id="serverIP">

        <label for="serverPort">Port:</label>
        <input type="text" name="server_port" id="serverPort">
    </p>
    <input type="submit" value="Add Server">
</form>
</body>
</html>