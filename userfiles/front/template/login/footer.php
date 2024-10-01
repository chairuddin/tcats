
<div class="footer">
	<div class="container container-fluid">
		<div class="row">
		  <div class="col-xs-12  col-sm-12">
			<div class="footer__text--link">
			  <?php echo $web_config_footer;?>
			</div>
		  </div>
		</div>
	</div>
</div>

<!-- div wrapper end -->
</div>
<!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
<script type="text/javascript" src="<<<TEMPLATE_URL>>>/js/jquery.js"></script>
<!-- <script type="text/javascript" src="<<<TEMPLATE_URL>>>/js/jquery-ui.min.js"></script> -->
<script type="text/javascript" src="<<<TEMPLATE_URL>>>/js/bootstrap.min.js"></script>
<script type="text/javascript" src="<<<TEMPLATE_URL>>>/js/sweetalert2/sweetnpm.js"></script>
<script>
<?php 
echo $run_js_script1;
echo $run_js_script2;

$loader_gif=fileurl("asset/ajax-loader.gif");
echo "imgloader='$loader_gif';"

?>	
</script>

<?php
if(count($script_js)>0)
{
echo join("\r\n",$script_js);
}
$_SESSION['msg-session']="";
?>
<img src="<?php echo fileurl("asset/ajax-loader.gif")?>" width="16px" width="16px" style="display:none;"/>
</body>
</html>
