<?php
/*
 * Created on 2014-1-13
 *
 * To change the template for this generated file go to
 * Window - Preferences - PHPeclipse - PHP - Code Templates
 */
 
 

function findDeviceID($id ){
	if($id == "123")
		return true;
	else
		return false;
}

function getStatus(){
	return "Not login";
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
 			echo "Already login";	
 		}else{
 			echo "Login scuess";
 		}
 	}
 	
 	
 	
 };
 
 
 
?>
