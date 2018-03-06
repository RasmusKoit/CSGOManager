<?php
/**
 * Created by IntelliJ IDEA.
 * User: raks4
 * Date: 04.03.2018
 * Time: 19:50
 */

require __DIR__ . '/SourceQuery/bootstrap.php';
use xPaw\SourceQuery\SourceQuery;


// Edit this ->
define( 'SQ_TIMEOUT',     1 );
define( 'SQ_ENGINE',      SourceQuery::SOURCE );
// Edit this <-

$Timer = MicroTime( true );

function getServerInfo($server_ip, $server_port) {
    $Query = new SourceQuery( );
    try
    {
        $Query->Connect( $server_ip, $server_port, SQ_TIMEOUT, SQ_ENGINE );
        //$Query->SetUseOldGetChallengeMethod( true ); // Use this when players/rules retrieval fails on games like Starbound
        return $Query->GetInfo( );
    }
    catch( Exception $e )
    {
        $Exception = $e;
    }
    finally
    {
        $Query->Disconnect( );
    }
}

function getServerPlayers($server_ip, $server_port) {
    $Query = new SourceQuery( );
    try
    {
        $Query->Connect( $server_ip, $server_port, SQ_TIMEOUT, SQ_ENGINE );
        //$Query->SetUseOldGetChallengeMethod( true ); // Use this when players/rules retrieval fails on games like Starbound
        return $Query->GetPlayers( );
    }
    catch( Exception $e )
    {
        $Exception = $e;
    }
    finally
    {
        $Query->Disconnect( );
    }
}

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


/*print $Info['HostName'];
print_r($Info);
print SQ_SERVER_ADDR;
print $Info['GamePort'];
print $Info['Players'];*/

?>
<?php
/* Attempt MySQL server connection. Assuming you are running MySQL
server with default setting (user 'root' with no password) */

include 'connectMysql.php';
// Check connection
if($link === false){
    die("ERROR: Could not connect. " . mysqli_connect_error());
}

// Attempt select query execution
$sql = "SELECT * FROM servers WHERE id=".$_GET["id"].";";
if($result = mysqli_query($link, $sql)){
    if(mysqli_num_rows($result) > 0){
        while($row = mysqli_fetch_array($result)){
            $Info = getServerInfo($row['server_ip'], $row['server_port']);
            $ip = $row['server_ip'];
        }
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

<form>
    <table class="form-table">
        <tbody>
        <tr>
            <td>Server name</td>
            <td>IP</td>
            <td>Port</td>
        </tr>
        <tr>
            <td><?php print $Info['HostName']?></td>
            <td><?php print $ip?></td>
            <td><?php print $Info['GamePort']?></td>

        </tr>
        <tr>
        </tbody>
    </table>

</body>
</html>
