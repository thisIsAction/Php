<?php
/*
 * Created on 2014-1-14
 *
 * To change the template for this generated file go to
 * Window - Preferences - PHPeclipse - PHP - Code Templates
 */
 
 require_once('cs/devid.php');
 require_once('cs/Group.php');
 require_once('cs/statusCheck.php');
 $did = GetDeviceID();
 $group = NULL;
 if( Group::isInGroup($did) )
 {
 	$group = Group::createGroup($did);
 }
 
 if( empty($group) ){
 	echo 'Error:Crate group failed.';
 	exit();
 }
 
 $sts = NULL;
 if ( isset($_POST['status'])){
 	$sts = @$_POST['status'];	
 }
  
 if( !checkStatus($sts) ){
 	echo 'Error:Not exist status'; 
 	exit();
 }
 
 switch($sts){
 	case 'ready':
 		$group->setStatus($sts);
 		echo 'Go:begin';
 		break;	
 	case 'begin':
 		if( $group->isAllReady() ){
 			$group->generateSubject();
 			echo 'Go:subject';
 		}else{
 			echo 'Wait:1';
 		}
 		break;
 	case 'subject':
 		
 		break;
 	default:break;
 }
 
?>
