<?php
/*
 * Created on 2014-1-14
 *
 * To change the template for this generated file go to
 * Window - Preferences - PHPeclipse - PHP - Code Templates
 */
 
 require_once('cs/devid.php');
 require_once('cs/Group.php');
 $did = GetDeviceID();
 
 
 $group = Group::createGroup($did);
 
 if( !$group )
 {
 	echo "Insert to list";
 	exit();
 }
 
 if( $group->isFull() )
 {
 	echo 'Start game';
 }
 else
 {
 	echo 'wait other';
 }
 
?>
