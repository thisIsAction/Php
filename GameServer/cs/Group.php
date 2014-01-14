<?php
/*
 * Created on 2014-1-14
 *
 * To change the template for this generated file go to
 * Window - Preferences - PHPeclipse - PHP - Code Templates
 */
 require_once('ccDatabase.php');
 class Group
 {
 	public $group_id;
 	public $group_name;
 	public $device_one;
 	public $device_two;
 	public $status_one;
 	public $status_two;
 	public $subject_id;
 	
 	public $myIndex;
 	
 	public static function isInGroup($id){
 		$result = ccDatabase::instance()->command("SELECT * FROM space WHERE devid_1='$id' OR devid_2='$id';");
 		if( !empty($result) ) return true;
 		return false;
 	}
 	
 	public static function createGroup($id){
 		
 		$result = ccDatabase::instance()->command("SELECT * FROM space WHERE devid_1='$id' OR devid_2='$id';");
 		if( !empty($result) )
 			return new Group($result[0] , $id);
 			
 		$result = ccDatabase::instance()->command('SELECT id FROM space WHERE devid_1 is not null AND devid_2 is null');
 		
 		if( !empty($result) )
 		{
 			$newid = $result[0]['id'];
 			ccDatabase::instance()->update('space',array('devid_2'=>$id), array('id'=>$newid));
 			$resultData = ccDatabase::instance()->select('space',array('id'=>$newid));
 			return new Group($resultData[0] , $id) ;
 		}

		ccDatabase::instance()->insert('space',array('devid_1'=>$id));
		//echo "Insert:" . ccDatabase::$sql;
		return false;
 	}
 	
 	public function Group($datas,$myid){
 		if (!empty($datas)){
 			$this->group_id = $datas['id'];
 			$this->group_name = $datas['name'];
 			$this->device_one = $datas['devid_1'];
 			$this->device_two = $datas['devid_2'];
 			$this->status_one = $datas['status_1'];
 			$this->status_two = $datas['status_2'];
 			$this->subject_id = $datas['subjet_id'];
 			
 			if( $myid == $this->device_one ){
 				$this->myIndex = 1;
 			}else{
 				$this->myIndex = 2;
 			}
 			
 		}
 	}
 	
 	public function isFull(){
 		return $this->device_one != null && $this->device_two != null;
 	}
 	
 	public function setStatus($status){
 		ccDatabase::instance()->update('space',array(
				"status_$this->myIndex"=>$status
				),array('id'=>$this->group_id));
 	}
 	
 	public function isAllReady(){
 		$resultArray = ccDatabase::instance()->command("select id from space where id=".
 			$this->group_id." AND status_1='ready' and status_2='ready';");
 		if( !empty($resultArray) )
 			return $resultArray[0]['id'] == $this->group_id;
 		return false;
 	}
 	
 	public function generateSubject(){
 		
 	}
 	
 };
 
?>
