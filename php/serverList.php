<?php
/**
 * Created by IntelliJ IDEA.
 * User: raks4
 * Date: 05.03.2018
 * Time: 10:58
 */
include 'database.php';

// Attempt select query execution
$sql = "SELECT * FROM servers";
$servers = DB::run($sql);
if($servers->rowCount()){?>
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
                <?php while($row = $servers->fetch(PDO::FETCH_ASSOC)){?>
                <tr>
                    <td><?= $row['id'] ?></td>
                    <td><?= $row['server_ip'] ?></td>
                    <td><?= $row['server_port'] ?></td>
                    <td><a href="example.php?id=<?=$row['id']?>">Manage</a></td>
                </tr>
            <?php } ?>
            </tbody>
        </table>
<?php } ?>
