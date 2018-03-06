<?php
/**
 * Created by IntelliJ IDEA.
 * User: raks4
 * Date: 04.03.2018
 * Time: 19:50
 */

require __DIR__ . '/SourceQuery/bootstrap.php';
use xPaw\SourceQuery\SourceQuery;
include_once 'functions.php';
include_once 'database.php';

// Edit this ->
define( 'SQ_TIMEOUT',     1 );
define( 'SQ_ENGINE',      SourceQuery::SOURCE );
// Edit this <-

$Timer = MicroTime( true );

?>

<!DOCTYPE html>
<html lang="et">
<head>
    <meta charset="utf-8">
    <title>CSGO Manager</title>
    <link rel="stylesheet" href="../css/style.css"/>
    <link href="https://fonts.googleapis.com/css?family=Cabin:600" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Libre+Baskerville" rel="stylesheet">

</head>
<body>
<header>
    <h1>CS GO Manager!</h1>
    <span>Counter-Strike Global Offensive Server Manager</span>
</header>
<?php

?>
<?php

include_once 'functions.php';
// Check connection

$sql = "SELECT * FROM servers WHERE id=:id";
$servers = DB::run($sql, [':id' => $_GET['id']]);

// Attempt select query execution

$info = [];
if($servers->rowCount()){
    $serverData = $servers->fetch(PDO::FETCH_ASSOC);
    $info = getServerInfo($serverData['server_ip'], $serverData['server_port']);
    $info['server_ip'] = $serverData['server_ip'];
}

?>

<form>
    <table class="form-table">
        <tbody>
        <tr>
            <td>Server name</td>
            <td>IP</td>
            <td>Port</td>
        </tr>
        <tr>
            <td><?php print $info['HostName']   ?: '-'?></td>
            <td><?php print $info['server_ip']  ?: '-'?></td>
            <td><?php print $info['GamePort']   ?: '-'?></td>

        </tr>
        <tr>
        </tbody>
    </table>

</body>
</html>
