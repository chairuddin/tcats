<?php
if($web_config_exam_browser_only==1 ){
	$headers = apache_request_headers();
	$browser_key=$headers['X-SafeExamBrowser-RequestHash'];
	$safe_exam_browser=$browser_key!=""?true:false;
	//$valid=$mysql->get1value("SELECT id FROM quiz_exam_browser WHERE browser_key='$browser_key' and status=1");
	if($safe_exam_browser){
		header("location:".fronturl());
		exit();
	}
} elseif($web_config_exam_browser_only==2){	
	$headers = apache_request_headers();
	$browser_key=$headers['X-SafeExamBrowser-RequestHash'];
	$safe_exam_browser=$browser_key!=""?true:false;
		
	$isWebView = false;
	if((strpos($_SERVER['HTTP_USER_AGENT'], 'Mobile/') !== false) && (strpos($_SERVER['HTTP_USER_AGENT'], 'Safari/') == false)) :
	$isWebView = true;
	elseif(isset($_SERVER['HTTP_X_REQUESTED_WITH'])) :
	$isWebView = true;
	endif;

	if($isWebView OR $safe_exam_browser) {
		header("location:".fronturl());
		exit();
	}
} elseif($web_config_exam_browser_only==3){	
	$isWebView = false;
	if((strpos($_SERVER['HTTP_USER_AGENT'], 'Mobile/') !== false) && (strpos($_SERVER['HTTP_USER_AGENT'], 'Safari/') == false)) :
	$isWebView = true;
	elseif(isset($_SERVER['HTTP_X_REQUESTED_WITH'])) :
	$isWebView = true;
	endif;

	if($isWebView) {
		header("location:".fronturl());
		exit();
	}
	
} else {
	header("location:".fronturl());
	exit();
}
 
?>
<div class='container alma-container'>
<div class='row'>
<div class='col-md-12'>
<div class='msg-invalid-session'>
<?php
	echo $web_config_invalid_session;
?>
<div class='msg-invalid-session-button'>
	<a href="<?php echo fronturl();?>"><button onclick="">Refresh</button></a>
</div>
</div>

</div>
</div>
</div>


<?php
$style_css['quiz_start']=<<<END
<style>
.msg-invalid-session {
  border: 1px solid white;
  padding: 20px 30px;
  margin: 10px 40px;
  background-color: white;
  border-radius: 29px;
}
.msg-invalid-session-button {
  text-align:center;
}
</style>
END;

?>
