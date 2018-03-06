<?php
/**
 * Created by PhpStorm.
 * User: arti
 * Date: 3/6/18
 * Time: 2:18 PM
 */

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