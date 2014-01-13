<?php
/*
 * Created on 2014-1-9
 *
 * To change the template for this generated file go to
 * Window - Preferences - PHPeclipse - PHP - Code Templates
 */
  
 class ProjectDocuments {
 	
 	public $m_id;
 	public $m_title;
 	
 	public $m_requestRole;
 	public $m_lastApproveRole;
 	
 	private $m_status;
 	
 	private $m_statusArray;
 	 
 	function ProjectDocuments(){
 		$this->m_id = 0;
 		$this->m_title="";
 		$this->m_requestRole ="";
 		$this->m_lastApproveRole = "";
 		
 		$this->m_statusArray = array(
			"Wait",					// 等待操作
			"Request",				// 申请
	 		"Request_Level_1_1",	// 李萍核实
	 		"Request_Level_1_2",	// 鲁总审批
	 		"Request_Level_2",		// 陈总审批
	 		"Request_Level_3",		// 两位雷总任意一人审批
	 		"Request_Complete",		// 审批完成，拨款状态
	 		
	 		"Refusal",				// 申请被拒绝
 		);
 		
 		$this->m_status = $this->m_statusArray[0];
 	}
 	
 	public function getStatus(){
 		return $this->m_status;
 	}
 	
 	public function getStatusString(){
 		return getStatus();
 	}
 	
 	public function nextStatus(){
 		if( !$this->isStatusFinish() && !$this->isStatusRefusal() ){
 			$key = array_search($this->m_status,$this->m_statusArray);
 			$key += 1;
 			$this->m_status = $this->m_statusArray[$key];
 		}
 	}
 	public function isStatusRefusal(){
 		return $this->m_status == "Refusal";
 	}
 	public function isStatusFinish(){
 		return $this->m_status == "Request_Complete";
 	}
 	
 	public function valToArray($needid = true){
 		
 		$valArry = array(
 			"title" => $this->m_title,
 			"requestRole" => $this->m_requestRole,
 			"lastApproveRole" => $this->m_lastApproveRole,
 			"status" => $this->m_status,
 		);
 		
 		if($needid && $this->m_id != 0){
 			$valArry['id'] = $this->m_id;
 		}
 		
 		return $valArry;
 	}
 	
 	public function submit(){
 		require_once("ccDatabase.php");
 		
 		$db = ccDatabase::instance();
		
		if ( $db ){
			$resuleRow = false;
			if( $this->m_id != 0 ){ 
				$resuleRow = $db->select("pd",array("id"=>$this->m_id));
			}
			if ( !$resuleRow ){
				$db->insert("pd",$this->valToArray());
			}else {
				$db->update("pd", $this->valToArray(false), array("id"=>$this->m_id));
			}
			
	 		printf("<br/>%s<br/>", ccDatabase::$sql );
		}
 	}
 	
 	public static function readProjectDocuments($index){
 		require_once("ccDatabase.php");
		$db = ccDatabase::instance();
 		$resuleRow = $db->select("pd",array("id"=>$index));
 		print_r($resuleRow);
 		$pd = new ProjectDocuments();
 		if ( $resuleRow ){
 			$row = 0;
 			$pd->m_id = $resuleRow[$row]['id'];
 			$pd->m_title = $resuleRow[$row]['title'];
 			$pd->m_requestRole = $resuleRow[$row]['requestRole'];
 			$pd->m_lastApproveRole = $resuleRow[$row]['lastApproveRole'];
 			$pd->m_status = $resuleRow[$row]['status']; 	
 		}
 		return $pd;
 	}
 	
 }
 
 /*
 $pd = new ProjectDocuments();
 $pd->m_title = 'request one';
 //$pd->m_id = 1;
 $pd->m_requestRole = 'role1 ';
 $pd->m_lastApproveRole = 'approve role';
 $pd->nextStatus();
 $pd->submit();
 */
 
 ///*
 $pd = ProjectDocuments::readProjectDocuments(5);
 echo "<br/>";
 $pd->nextStatus();
 $pd->submit();
 print_r( $pd->valToArray() );
 //*/
?>
