<?php
/*
 * Created on 2014-1-13
 *
 * To change the template for this generated file go to
 * Window - Preferences - PHPeclipse - PHP - Code Templates
 */
 
 
 require_once('ccDatabase.php');

function findDeviceID($id ){
	$db = ccDatabase::instance();
	$resuleRow = $db->select('device',array("devid" => "$id"));
	if( !empty($resuleRow) )
		return true;
	else
		return false;
}
 
 class Player
 {
 	public $playerID;
 	
 	public function Player( $id ){
 		$this->playerID = $id;
 	}
 	
 	public function begin(){
 		if( findDeviceID($this->playerID) )
 		{
 			ccDatabase::instance()->update('device', array('status'=>'login_begin') ,array("devid" => "$this->playerID"));
 			echo "Already login";
 		}else{
 			ccDatabase::instance()->insert('device', array('status'=>'login_begin',"devid" => "$this->playerID"));
 			echo "Login scuess";
 		}
 	}
 	
 	
 };
 
 
 
?>
