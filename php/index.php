<?php
require __DIR__ . '../SourceQuery/bootstrap.php';
use xPaw\SourceQuery\SourceQuery;

// Edit this ->
define( 'SQ_SERVER_ADDR', '172.20.20.27' );
define( 'SQ_SERVER_PORT', 27015 );
define( 'SQ_TIMEOUT',     3 );
define( 'SQ_ENGINE',      SourceQuery::SOURCE );
// Edit this <-

$Timer = MicroTime( true );

$Query = new SourceQuery( );

$Info    = Array( );
$Rules   = Array( );
$Players = Array( );

try
{
    $Query->Connect( SQ_SERVER_ADDR, SQ_SERVER_PORT, SQ_TIMEOUT, SQ_ENGINE );
    //$Query->SetUseOldGetChallengeMethod( true ); // Use this when players/rules retrieval fails on games like Starbound

    $Info    = $Query->GetInfo( );
    $Players = $Query->GetPlayers( );
    #$Rules   = $Query->GetRules( );
}
catch( Exception $e )
{
    $Exception = $e;
}
finally
{
    $Query->Disconnect( );
}

$Timer = Number_Format( MicroTime( true ) - $Timer, 4, '.', '' );
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>CSGO Manager</title>

    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css">
    <link rel="stylesheet" href="style.css"/>
    <style type="text/css">
        .table {
            table-layout: fixed;
            border-top-color: #428BCA;
        }

        .table td {
            overflow-x: auto;
        }

        .table thead th {
            background-color: #428BCA;
            border-color: #428BCA !important;
            color: #FFF;
        }

        .info-column {
            width: 120px;
        }

        .frags-column {
            width: 80px;
        }
    </style>
</head>

<body>

<div class="container">
    <?php if( isset( $Exception ) ): ?>
        <div class="panel panel-primary">
            <div class="panel-heading"><?php echo Get_Class( $Exception ); ?> at line <?php echo $Exception->getLine( ); ?></div>
            <p><b><?php echo htmlspecialchars( $Exception->getMessage( ) ); ?></b></p>
            <p><?php echo nl2br( $e->getTraceAsString(), false ); ?></p>
        </div>
    <?php else: ?>
        <div class="row">
            <div class="col-sm-6">
                <table class="table table-bordered table-striped">
                    <thead>
                    <tr>
                        <th class="info-column">Server Info</th>
                        <th><span class="label label-<?php echo $Timer > 1.0 ? 'danger' : 'success'; ?>"><?php echo $Timer; ?>s</span></th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php if( Is_Array( $Info ) ): ?>
                        <?php foreach( $Info as $InfoKey => $InfoValue ): ?>
                            <tr>
                                <td><?php echo htmlspecialchars( $InfoKey ); ?></td>
                                <td><?php
                                    if( Is_Array( $InfoValue ) )
                                    {
                                        echo "<pre>";
                                        print_r( $InfoValue );
                                        echo "</pre>";
                                    }
                                    else
                                    {
                                        if( $InfoValue === true )
                                        {
                                            echo 'true';
                                        }
                                        else if( $InfoValue === false )
                                        {
                                            echo 'false';
                                        }
                                        else
                                        {
                                            echo htmlspecialchars( $InfoValue );
                                        }
                                    }
                                    ?></td>
                            </tr>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <tr>
                            <td colspan="2">No information received</td>
                        </tr>
                    <?php endif; ?>
                    </tbody>
                </table>
            </div>
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
        </div>
    <?php endif; ?>
</div>
</body>
</html>