<?php
/*
 * Created on 2014-1-13
 *
 * To change the template for this generated file go to
 * Window - Preferences - PHPeclipse - PHP - Code Templates
 */

require_once('cs/devid.php');
require_once("cs/Player.php");
$fid = GetDeviceID();
$player = new Player($fid);

$player->begin();
?>
