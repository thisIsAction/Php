<?php
/*
 * Created on 2014-1-14
 *
 * To change the template for this generated file go to
 * Window - Preferences - PHPeclipse - PHP - Code Templates
 */
 
 class Group
 {
 	public $group_id;
 	public $group_name;
 	public $device_one;
 	public $device_two;
 	
 	public static function createGroup($id){
 		require_once('ccDatabase.php');
 		$result = ccDatabase::instance()->command("SELECT * FROM space WHERE devid_1='$id' OR devid_2='$id';");
 		if( !empty($result) )
 			return new Group($result[0]);
 			
 		$result = ccDatabase::instance()->command('SELECT id FROM space WHERE devid_1 is not null AND devid_2 is null');
 		if( !empty($result) )
 		{
 			$newid = $result[0]['id'];
 			ccDatabase::instance()->update('space',array('devid_2'=>$id), array('id'=>$newid));
 			$resultData = ccDatabase::instance()->select('space',array('id'=>$newid));
 			return new Group($resultData[0]);
 		}

		ccDatabase::instance()->insert('space',array('devid_1'=>$id));
		return false;
 	}
 	
 	public function Group($datas){
 		if (!empty($datas)){
 			$this->group_id = $datas['id'];
 			$this->group_name = $datas['name'];
 			$this->device_one = $datas['devid_1'];
 			$this->device_two = $datas['devid_2'];
 		}
 	}
 	
 	public function isFull(){
 		return $this->device_one != null && $this->device_two != null;
 	}
 	
 	
 };
 
?>
