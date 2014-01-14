<?php
/*
 * Created on 2014-1-14
 *
 * To change the template for this generated file go to
 * Window - Preferences - PHPeclipse - PHP - Code Templates
 */
 
 function GetDeviceID(){
	$fid = @$_POST["devid"];
	if( !isset($fid)  ){
		echo "Error:Null name";
		exit();
	}
 	return $fid;
 }
?>
