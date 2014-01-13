<?php
/*
 * Created on 2014-1-13
 *
 * To change the template for this generated file go to
 * Window - Preferences - PHPeclipse - PHP - Code Templates
 */

$fid = @$_POST["devid"];
if( !isset($fid)  ){
	echo "Error:Null name";
	exit();
}

require_once("Player.php");

$player = new Player($fid);

$player->begin();
?>
