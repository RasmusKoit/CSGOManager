<?php
/**
 * Created by IntelliJ IDEA.
 * User: raks4
 * Date: 05.03.2018
 * Time: 10:58
 */

/* Attempt MySQL server connection. Assuming you are running MySQL
server with default setting (user 'root' with no password) */
$link = mysqli_connect("localhost", "www-data", "salakala", "servers");

// Check connection
if($link === false){
    die("ERROR: Could not connect. " . mysqli_connect_error());
}

// Attempt select query execution
$sql = "SELECT * FROM servers";
if($result = mysqli_query($link, $sql)){
    if(mysqli_num_rows($result) > 0){?>
        <table>
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Server IP</th>
                    <th>Server Port</th>
                    <th>Manage</th>
                </tr>
            </thead>
            <tbody>
                <?php while($row = mysqli_fetch_array($result)){?>
                <tr>
                    <td><?= $row['id'] ?></td>
                    <td><?= $row['server_ip'] ?></td>
                    <td><?= $row['server_port'] ?></td>
                    <td><a href="example.php?id=<?=$row['id']?>">Manage</a></td>
                </tr>
            <?php } ?>
            </tbody>

        </table>
<?php
    // Free result set
        mysqli_free_result($result);
    } else{
        echo "No records matching your query were found.";
    }
} else{
    echo "ERROR: Could not able to execute $sql. " . mysqli_error($link);
}

// Close connection
mysqli_close($link);
?>
