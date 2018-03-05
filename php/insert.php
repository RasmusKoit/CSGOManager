<?php
/**
 * Created by IntelliJ IDEA.
 * User: raks4
 * Date: 05.03.2018
 * Time: 10:25
 */

/* Attempt MySQL server connection. Assuming you are running MySQL
server with default setting (user 'root' with no password) */
$link = mysqli_connect("localhost", "root", "", "servers");

// Check connection
if($link === false){
    die("ERROR: Could not connect. " . mysqli_connect_error());
}

// Escape user inputs for security
$server_ip = mysqli_real_escape_string($link, $_REQUEST['server_ip']);
$server_port = mysqli_real_escape_string($link, $_REQUEST['server_port']);

// attempt insert query execution
$sql = "INSERT INTO servers (server_ip, server_port) VALUES ('$server_ip', '$server_port')";
if(mysqli_query($link, $sql)){
    echo "Records added successfully.";
} else{
    echo "ERROR: Could not able to execute $sql. " . mysqli_error($link);
}

// close connection
mysqli_close($link);
?>