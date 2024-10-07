    <script src="<<<TEMPLATE_URL>>>/asset/js/jquery-3.6.0.min.js"></script>   
    <script src="<<<TEMPLATE_URL>>>/asset/js/script.js"></script>
    <script
      src="<<<TEMPLATE_URL>>>/asset/js/bootstrap.bundle.min.js"></script>
    <script
      src="<<<TEMPLATE_URL>>>/asset/js/fontawesome.js"></script>
    <?php 
if($_SESSION['msg_toast']!="") {
	echo $_SESSION['msg_toast'];
	unset($_SESSION['msg_toast']);
}
?>
</script>
<?php echo $script_js;?>
  </body>
</html>