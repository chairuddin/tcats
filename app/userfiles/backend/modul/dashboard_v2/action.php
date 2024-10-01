<?php
if($action=="") {

	$tc = new TaskController();
	//$list_task_by_user=$tc->list_task_by_user($auth_id)->fetch_data();
	$list_task_by_date=$tc->list_task_by_user()->fetch_data()->organize_by_date();
	$list_task_by_date_done=$tc->list_task_by_user_done()->fetch_data()->organize_by_date();
	//$list_task_by_date=$tc->list_task_all()->fetch_data()->organize_by_date();
	
	
	include "view_task_list.php";
}
if($action=="update_status") {
	$auth = new AuthController();
	$auth_id= $auth->AuthId();
	$now=date("Y-m-d H:i:s");

	$task_id=cleanInput($_POST['task_id']);
	$status=strtolower(cleanInput($_POST['status']));
	$update=$mysql->query("UPDATE task SET status='$status',modified_by='$auth_id',modified_at='$now' WHERE id='$task_id' ");
	if($update) {
		$insert_log=$mysql->query("INSERT INTO task_log SET task_id=$task_id,log='Change status to $status',created_by='$auth_id',created_at='$now' ");
		echo json_encode(array('status'=>'true','msg'=>'Success','update_at'=>getTimeDifference(date("Y-m-d H:i:s"))));
	} else {
		echo json_encode(array('status'=>'false','msg'=>'Failed','update_at'=>''));
	}
	die();
}
?>