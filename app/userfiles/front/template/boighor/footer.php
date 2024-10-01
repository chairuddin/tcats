		
		<!-- //Footer Area -->
	
	</div>
	<!-- //Main wrapper -->
	<!-- Modernizer js -->
	<script src="<<<TEMPLATE_URL>>>/js/vendor/modernizr-3.5.0.min.js"></script>
	<!-- JS Files -->
	
	<script src="<?php echo $config['backendurl'];?>/template2/plugins/jquery/jquery.min.js"></script>
	<script src="<<<TEMPLATE_URL>>>/js/popper.min.js"></script>
	<script src="<<<TEMPLATE_URL>>>/js/bootstrap.min.js"></script>
	<script src="<<<TEMPLATE_URL>>>/js/plugins.js"></script>
	<script src="<<<TEMPLATE_URL>>>/js/active.js"></script>
	<script src="<?php echo $config['backendurl'];?>/template2/plugins/moment/moment.min.js"></script>
	<script src="<?php echo $config['backendurl'];?>/template2/plugins/daterangepicker/daterangepicker.js"></script>	
	<script src="<?php echo $config['backendurl'];?>/template2/plugins/jquery-validation/jquery.validate.min.js"></script>	
	<script src="<?php echo $config['backendurl'];?>/template2/plugins/sweetalert2/sweetalert2.min.js"></script>
	<script src="<?php echo $config['backendurl'];?>/template2/js/cleave.js?v=1"></script>
	<script>
		
	$('#modal-default').on('show.bs.modal', function (event) {
	  var button = $(event.relatedTarget) // Button that triggered the modal
	  var title = button.data('title') // Extract info from data-* attributes
	  var body = button.data('body') // Extract info from data-* attributes
	  var btn1 = button.data('btn1') // Extract info from data-* attributes
	  var btn1name = button.data('btn1name') // Extract info from data-* attributes
	  var btn2 = button.data('btn2') // Extract info from data-* attributes
	  var btn2name = button.data('btn2name') // Extract info from data-* attributes
	  // If necessary, you could initiate an AJAX request here (and then do the updating in a callback).
	  // Update the modal's content. We'll use jQuery here, but you could use a data binding library or other methods instead.
	  var modal = $(this)
	  modal.find('.modal-title').text(title)
	  modal.find('.modal-body').text(body)
	  modal.find('#btn1').attr("href",btn1)
	  modal.find('#btn1name').text(btn1name)
	  
	  if(btn2=='') {
		modal.find('#btn2').hide();
	  } else {
		modal.find('#btn2').attr("href",btn2)
		modal.find('#btn2name').text(btn2name)
	  }
	  
	//  modal.find('.modal-body input').val(recipient)
	});


	
	$(document).ready(function(){
		

				
	$(document).on("keypress", 'form', function (e) {
		var code = e.keyCode || e.which;
		if (code == 13) {
			e.preventDefault();
			return false;
		}
	});

});
  
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
