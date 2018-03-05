<?php
/**
 * Created by IntelliJ IDEA.
 * User: raks4
 * Date: 04.03.2018
 * Time: 19:50
 */

require __DIR__ . './SourceQuery/bootstrap.php';
use xPaw\SourceQuery\SourceQuery;


// Edit this ->
define( 'SQ_SERVER_ADDR', 'est.ialbhost.eu' );
define( 'SQ_SERVER_PORT', 27015 );
define( 'SQ_TIMEOUT',     1 );
define( 'SQ_ENGINE',      SourceQuery::SOURCE );
// Edit this <-

$Timer = MicroTime( true );

$Query = new SourceQuery( );

$Info    = Array( );
$Players = Array( );

try
{
    $Query->Connect( SQ_SERVER_ADDR, SQ_SERVER_PORT, SQ_TIMEOUT, SQ_ENGINE );
    //$Query->SetUseOldGetChallengeMethod( true ); // Use this when players/rules retrieval fails on games like Starbound
    $Info    = $Query->GetInfo( );
    $Players = $Query->GetPlayers( );




}
catch( Exception $e )
{
    $Exception = $e;
}
finally
{
    $Query->Disconnect( );
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
<pre><?php  echo $_GET["id"]?></pre>
<header>
    <h1>CS GO Manager!</h1>
    <span>Counter-Strike Global Offensive Server Manager</span>
</header>
<?php


/*print $Info['HostName'];
print SQ_SERVER_ADDR;
print $Info['GamePort'];
print $Info['Players'];*/
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
            <td><?php print SQ_SERVER_ADDR?></td>
            <td><?php print $Info['GamePort']?></td>

        </tr>
        <tr>
        </tbody>
    </table>

</body>
</html>
