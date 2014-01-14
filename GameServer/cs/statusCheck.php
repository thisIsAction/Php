<?php
/*
 * Created on 2014-1-13
 *
 * To change the template for this generated file go to
 * Window - Preferences - PHPeclipse - PHP - Code Templates
 */
 function getStatus($id){
 	
 }
 
 function checkStatus($status){
 	if( empty($status) ) return false;
 	
 	$allStatus = array(
 		'ready' => true,
 		'finish' => true,
 	);
 	
 	return isset($allStatus) && $allStatus[$status];
 }
 
?>
