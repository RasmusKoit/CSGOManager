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


include_once 'header.php';
?>

<header>
    <h1>CS GO Manager!</h1>
    <span>Counter-Strike Global Offensive Server Manager</span>
</header>
<?php

include_once 'functions.php';
// Check connection

$sql = "SELECT * FROM servers WHERE id=:id";
$servers = DB::run($sql, [':id' => $_GET['id']]);

// Attempt select query execution

$info = [];
if($servers->rowCount()){
    $serverData = $servers->fetch(PDO::FETCH_ASSOC);
    $Players = getServerPlayers($serverData['server_ip'], $serverData['server_port']);
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
</form>

    <div class="col-sm-6">
        <table class="table table-bordered table-striped">
            <thead>
            <tr>
                <th>Player <span class="label label-info"><?php echo count( $Players ); ?></span></th>
                <th class="frags-column">Frags</th>
                <th class="frags-column">Time</th>
            </tr>
            </thead>
            <tbody>
            <?php if( !empty( $Players ) ): ?>
                <?php foreach( $Players as $Player ): ?>
                    <tr>
                        <td><?php echo htmlspecialchars( $Player[ 'Name' ] ); ?></td>
                        <td><?php echo $Player[ 'Frags' ]; ?></td>
                        <td><?php echo $Player[ 'TimeF' ]; ?></td>
                    </tr>
                <?php endforeach; ?>
            <?php else: ?>
                <tr>
                    <td colspan="3">No players received</td>
                </tr>
            <?php endif; ?>
            </tbody>
        </table>
    </div>

<?php include_once 'footer.php' ?>