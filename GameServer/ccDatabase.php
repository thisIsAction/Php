<?php
/*
 * Created on 2014-1-7
 *
 * To change the template for this generated file go to
 * Window - Preferences - PHPeclipse - PHP - Code Templates
 */
  
class ccDatabase {
	public $conn;
	public static $sql;
	public static $_instance=null;
		
	private function __construct(){
		require_once('db.config.php');
		
		$this->conn = mysql_connect($dbConfig['host'],$dbConfig['user'],$dbConfig['password']);
		if ( !$this->conn )
		{
			die('Could not connect: ' . mysql_error());
		}
		
		if(!mysql_select_db($dbConfig['database'],$this->conn)){
			echo "";
		}
		mysql_query("set names utf8" , $this->conn);
	}
	public static function instance(){
		if(is_null(self::$_instance)){
			self::$_instance = new self;
		}
		return self::$_instance;
	}
	
	static function getWhere($condition){
		$where = '';
		if(!empty($condition)){
			foreach($condition as $k=>$v){
				if( strlen($where) != 0 )
					$where.= " and ";
				$where.=$k."='".$v."'";
			}
			
			if( strlen($where) ){
				$where='where '.$where;
			}
		}
		return $where;
	}
	
	
	/**
	 *
	 */
	public function select($table,$condition=array(),$field = array()){
		$where = self::getWhere($condition);
		$fieldstr = '';
		if(!empty($field)){
			
			foreach($field as $k=>$v){
				$fieldstr.= $v.',';
			}
			 $fieldstr = rtrim($fieldstr,',');
		}else{
			$fieldstr = '*';
		}
		self::$sql = "select {$fieldstr} from {$table} {$where}";		
		$result=mysql_query(self::$sql,$this->conn) or die("Invalid query: " . mysql_error());
		$resuleRow = array();
		$i = 0;
		while($row=mysql_fetch_assoc($result)){
			foreach($row as $k=>$v){
				$resuleRow[$i][$k] = $v;
			}
			$i++;
		}
		return $resuleRow;
	}
	/**
	 *
	 */
	 public function insert($table,$data){
	 	$values = '';
	 	$datas = '';
	 	foreach($data as $k=>$v){
	 		$values.=$k.',';
	 		$datas.="'$v'".',';
	 	}
	 	$values = rtrim($values,',');
	 	$datas   = rtrim($datas,',');
	 	self::$sql = "INSERT INTO  {$table} ({$values}) VALUES ({$datas})";
	 	
		if(mysql_query(self::$sql)){
			return mysql_insert_id();
		}else{
			return false;
		};
	 }
	 /**
	  * 
	  */
	public function update($table,$data,$condition=array()){
		$where = self::getWhere($condition);
		$updatastr = '';
		if(!empty($data)){
			foreach($data as $k=>$v){
				$updatastr.= $k."='".$v."',";
			}
			$updatastr = 'set '.rtrim($updatastr,',');
		}
		self::$sql = "update {$table} {$updatastr} {$where}";
		return mysql_query(self::$sql);
	}
	/**
	 *
	 */
	 public function delete($table,$condition){
	 	$where = self::getWhere($condition);
		self::$sql = "delete from {$table} {$where}";
		return mysql_query(self::$sql);
		
	 }
	
	public static function getLastSql(){
		echo self::$sql;
	}
}
?>
