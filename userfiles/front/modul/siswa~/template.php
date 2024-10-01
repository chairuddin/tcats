<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<meta http-equiv="x-ua-compatible" content="ie=edge">
	<link rel="shortcut icon" href="<?php echo favicon();?>?<?php echo uniqid();?>"/>
	<title><?php echo $web_config_title; ?></title>

	<!-- Font Awesome Icons -->
	<link rel="stylesheet" href="<?php echo $config['backendurl'];?>/template2/plugins/fontawesome-free/css/all.min.css">
	<link rel="stylesheet" href="<?php echo $config['backendurl'];?>/template2/plugins/datatables-responsive/css/responsive.bootstrap4.min.css">
	<link rel="stylesheet" href="<?php echo $config['backendurl'];?>/template2/plugins/datatables-bs4/css/dataTables.bootstrap4.css">
	<link rel="stylesheet" href="<?php echo $config['backendurl'];?>/template2/plugins/bootstrap-colorpicker/css/bootstrap-colorpicker.min.css">
	<link href="<?php echo $config['backendurl'];?>/template2/plugins/gijgo/dist/modular/css/core.css" rel="stylesheet" type="text/css" />
	<link href="<?php echo $config['backendurl'];?>/template2/plugins/gijgo/dist/modular/css/timepicker.css" rel="stylesheet" type="text/css" />
	<link href="<?php echo $config['backendurl'];?>/template2/plugins/gijgo/dist/modular/css/datepicker.css" rel="stylesheet" type="text/css" /> 
	
	<!-- Theme style -->
	<link rel="stylesheet" href="<?php echo $config['backendurl'];?>/template2/dist/css/adminlte.min.css">
	<link rel="stylesheet" href="<?php echo $config['backendurl'];?>/template2/bower_components/select2/dist/css/select2.min.css">
	<link rel="stylesheet" href="<?php echo $config['backendurl'];?>/template2/plugins/select2/css/select2.min.css">
	<link rel="stylesheet" href="<?php echo $config['backendurl'];?>/template2/plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css">
	<link rel="stylesheet" href="<?php echo $config['backendurl'];?>/template2/plugins/sweetalert2-theme-bootstrap-4/bootstrap-4.min.css">
	<link rel="stylesheet" href="<?php echo $config['backendurl'];?>/template2/plugins/daterangepicker/daterangepicker.css">
	<link rel="stylesheet" href="<?php echo $config['backendurl'];?>/template2/plugins/fullcalendar/main.min.css">
	<link rel="stylesheet" href="<?php echo $config['backendurl'];?>/template2/plugins/fullcalendar-interaction/main.min.css">
	<link rel="stylesheet" href="<?php echo $config['backendurl'];?>/template2/plugins/fullcalendar-daygrid/main.min.css">
	<link rel="stylesheet" href="<?php echo $config['backendurl'];?>/template2/plugins/fullcalendar-timegrid/main.min.css">
	<link rel="stylesheet" href="<?php echo $config['backendurl'];?>/template2/plugins/fullcalendar-bootstrap/main.min.css">
  
  <!-- Google Font: Source Sans Pro -->
  <link href="<?php echo $config['backendurl'];?>/template2/dist/Source_Sans_Pro/font.css" rel="stylesheet">
  <style>
	 .brand-link {
		font-size: 9pt !important;
	 }
	.card-custom:not(.card-outline)>.card-header, .card-navy:not(.card-outline)>.card-header a {
	color: <?php echo $color_2_white;?>
	}

	.card-custom:not(.card-outline)>.card-header {
	background-color: <?php echo $color_1;?>;
	}
	 
	  <?php echo $style_css;?>
  </style>
<script>
cfg_app_url="<?php echo $config['backendurl'];?>";
cfg_tiny_url="<?php echo $config['tinyurl'];?>";
</script>

</head>
<body class="sidebar-mini">
<div class="wrapper">

  <!-- Navbar -->
  <nav class="main-header navbar navbar-expand border-bottom-0 text-sm  navbar-light navbar-white">
    <!-- Left navbar links -->
    <ul class="navbar-nav">
      <li class="nav-item">
        <a class="nav-link" data-widget="pushmenu" href="#"><i class="fas fa-bars"></i></a>
      </li>
      <li class="nav-item d-none d-sm-inline-block">
        <a href="<?php echo fronturl();?>" class="nav-link">Dashboard</a>
      </li>
    </ul>

  
    <!-- Right navbar links -->
    <ul class="navbar-nav ml-auto">
      <!-- Messages Dropdown Menu -->
     
      <!-- Notifications Dropdown Menu -->
      <li class="nav-item dropdown">
        <a class="nav-link" data-toggle="dropdown" href="#">
          <i class="far fa-user"></i>
          
        </a>
        <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
          <div class="dropdown-divider"></div>
          <a href="<?php echo fronturl("siswa/edit_password");?>" class="dropdown-item">
			<i class="fas fa-lock  mr-2"></i>  Edit Password</a>
          <a href="<?php echo fronturl("siswa/logout");?>" class="dropdown-item">
            <i class="fas fa-sign-out-alt mr-2"></i> Logout</a>
          
        </div>
      </li>

    </ul>
  </nav>
  <!-- /.navbar -->

  <!-- Main Sidebar Container -->
  <aside class="main-sidebar elevation-4 sidebar-light-primary">
    <!-- Brand Logo -->
    <a href="#" class="brand-link navbar-light">
		
	  <img src="<?php echo logo();?>" style="max-width:40px;max-height:40px;" alt="<?php echo $web_config_title; ?>" title="<?php echo $web_config_title; ?>" />
      <span class="brand-text font-weight-light"> 
		<?php echo $web_config_title; ?>
	  </span>
      
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
      <!-- Sidebar user panel (optional) -->
      <div class="user-panel mt-3 pb-3 mb-3 d-flex">
        
        <div class="info">
          <span style="font-size:8pt;"><?php echo $biodata['username'];?></span>
          <a href="#" class="d-block"><?php echo $biodata['fullname'];?></a>
        </div>
      </div>

      <!-- Sidebar Menu -->
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
          <?php
				$menu=new MenuSiswa("dashboard","Dashboard",0,"fa-calendar-alt");
				$menu=new MenuSiswa("riwayat","Riwayat",0,"fa-book");
				
				?>
		 
        </ul>
      </nav>
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
  </aside>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
			<!-- 
          <div class="col-sm-12">
            <h1 class="m-0 text-dark"><?php echo $form_title;?></h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
			<?php //echo $form_search; ?>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <div class="content">
      <div class="container-fluid">
        <div class="row">
         <div class="col-md-12">
			 <?php 
				
			echo $msg_warning;
			
			if($modul!="")
			{
			//$col_tambah=$col_back.$col_tambah;
			}
			//echo $col_tambah;
			?>
			<?php echo $maincontent;?>
			
		
			  <div class="modal fade" id="modal-default">
				<div class="modal-dialog">
				  <div class="modal-content">
					<div class="modal-header">
					  <h4 class="modal-title">Default Modal</h4>
					  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">&times;</span>
					  </button>
					</div>
					<div class="modal-body">
					  <p>One fine body&hellip;</p>
					</div>
					<div class="modal-footer justify-content-between">
					  <button type="button" class="btn btn-default" data-dismiss="modal">Batal</button>
					  <a id="btn1" href="#"><button type="button" id="btn1name" class="btn btn-primary">Btn1</button></a>
					  <a id="btn2" href="#"><button type="button" id="btn2name" class="btn btn-primary">Btn2</button></a>
					</div>
				  </div>
				  <!-- /.modal-content -->
				</div>
				<!-- /.modal-dialog -->
			  </div>
			  <!-- /.modal -->	
         </div> 
         </div>
        <!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->

  <!-- Control Sidebar -->
  <aside class="control-sidebar control-sidebar-dark">
    <!-- Control sidebar content goes here -->
    <div class="p-3">
      <h5>Title</h5>
      <p>Sidebar content</p>
    </div>
  </aside>
  <!-- /.control-sidebar -->

  <!-- Main Footer -->
</div>
<!-- ./wrapper -->



<!-- REQUIRED SCRIPTS -->

<!-- jQuery -->
<script src="<?php echo $config['backendurl'];?>/template2/plugins/jquery/jquery.min.js"></script>
<script src="<?php echo $config['backendurl'];?>/template2/plugins/jquery-ui/jquery-ui.min.js"></script>
<script src="<?php echo $config['backendurl'];?>/template2/plugins/moment/moment.min.js"></script>
<script src="<?php echo $config['backendurl'];?>/template2/plugins/daterangepicker/daterangepicker.js"></script>	
<script src="<?php echo $config['backendurl'];?>/template2/plugins/jquery-validation/jquery.validate.min.js"></script>	
<script src="<?php echo $config['backendurl'];?>/template2/js/tinymce/tinymce.min.js"></script>	
<!-- Load TinyMCE -->
        <script type="text/javascript">
		tinymce.init({
		selector: "textarea.usetiny",
		theme: "modern",
		plugins: [
			"advlist autolink autosave link image lists preview hr pagebreak responsivefilemanager eqneditor",
			"wordcount visualblocks code fullscreen  media nonbreaking",
			"save table contextmenu directionality textcolor paste"
		],
		external_plugins: {
			"responsivefilemanager": "<?php echo $config['backendurl']?>/template2/js/tinymce/plugins/responsivefilemanager/plugin.js"
		},
		content_css: "<?php echo $config['backendurl']?>/template2/js/tinymce/css/development.css",
		add_unload_trigger: false,
		autosave_ask_before_unload: false,
		filemanager_title:"Pengaturan File / Gambar",
		
		
		toolbar1: "formatselect fontsizeselect  |  bold italic underline forecolor backcolor | alignleft aligncenter alignright alignjustify | eqneditor preview code  fullscreen ",
		toolbar2: "responsivefilemanager image media  link unlink | bullist numlist outdent indent | table | hr removeformat | subscript superscript | ltr rtl",
		image_advtab: true,
		menubar: false,
		toolbar_items_size: "small",

	
		relative_urls : false,
		remove_script_host : true,
		convert_urls : true
	
	});
	
	tinymce.init({
		selector: "textarea.smalltiny",
		theme: "modern",
		plugins: [
			"advlist autolink autosave link image lists preview",
			"textcolor paste "
		],
		external_plugins: {
			"responsivefilemanager": "<?php echo $config['backendurl']?>/template2/js/tinymce/plugins/responsivefilemanager/plugin.js"
		},
		content_css: "<?php echo $config['backendurl']?>/template2/js/tinymce/css/development.css",
		add_unload_trigger: false,
		autosave_ask_before_unload: false,
		
		
		
		toolbar1: "formatselect fontsizeselect  |  bold italic underline forecolor backcolor | alignleft aligncenter alignright alignjustify | bullist numlist",
		image_advtab: false,
		menubar: false,
		toolbar_items_size: "small",
		relative_urls : false,
		remove_script_host : true,
		convert_urls : true
	
	});
	
        </script>
        <!-- /TinyMCE -->	
        
<!-- Bootstrap 4 -->
<!-- bootstrap color picker -->
<script src="<?php echo $config['backendurl'];?>/template2/plugins/bootstrap-colorpicker/js/bootstrap-colorpicker.min.js"></script>
<script src="<?php echo $config['backendurl'];?>/template2/plugins/fullcalendar/main.min.js"></script>
<script src="<?php echo $config['backendurl'];?>/template2/plugins/fullcalendar-daygrid/main.min.js"></script>
<script src="<?php echo $config['backendurl'];?>/template2/plugins/fullcalendar-timegrid/main.min.js"></script>
<script src="<?php echo $config['backendurl'];?>/template2/plugins/fullcalendar-interaction/main.min.js"></script>
<script src="<?php echo $config['backendurl'];?>/template2/plugins/fullcalendar-bootstrap/main.min.js"></script>
<script src="<?php echo $config['backendurl'];?>/template2/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<script src="<?php echo $config['backendurl'];?>/template2/plugins/datatables/jquery.dataTables.js"></script>
<script src="<?php echo $config['backendurl'];?>/template2/plugins/datatables-responsive/js/dataTables.responsive.min.js"></script>
<script src="<?php echo $config['backendurl'];?>/template2/plugins/datatables-responsive/js/responsive.bootstrap4.min.js"></script>
<script src="<?php echo $config['backendurl'];?>/template2/plugins/datatables-bs4/js/dataTables.bootstrap4.js"></script>
<script src="<?php echo $config['backendurl'];?>/template2/plugins/select2/js/select2.full.min.js"></script>
<script src="<?php echo $config['backendurl'];?>/template2/plugins/bs-custom-file-input/bs-custom-file-input.min.js"></script>
<script src="<?php echo $config['backendurl'];?>/template2/plugins/sweetalert2/sweetalert2.min.js"></script>
<script src="<?php echo $config['backendurl'];?>/template2/js/cleave.js?v=1"></script>
<script src="<?php echo $config['backendurl'];?>/template2/plugins/gijgo/dist/modular/js/core.js" type="text/javascript"></script>
<script src="<?php echo $config['backendurl'];?>/template2/plugins/gijgo/dist/modular/js/timepicker.js" type="text/javascript"></script>
<script src="<?php echo $config['backendurl'];?>/template2/plugins/gijgo/dist/modular/js/datepicker.js" type="text/javascript"></script>
<script src="<?php echo $config['backendurl'];?>/template2/plugins/chart.js/Chart.min.js" type="text/javascript"></script>


<!-- AdminLTE App -->
<script src="<?php echo $config['backendurl'];?>/template2/dist/js/adminlte.min.js"></script>
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


 $(function () {
   need_cookies=0;
    //Initialize Select2 Elements
    $('.select2').select2()

    //Initialize Select2 Elements
    $('.select2bs4').select2({
      theme: 'bootstrap4'
    })
    /*22 juni 2020 bugfix cookies dan localstorage tidak enabled*/
	if (navigator.cookieEnabled) {
		
	} else 
	{
		need_cookies=1;
	}
	if(need_cookies==1) {
		setTimeout(function(){
		Swal.fire({
			  title: 'Memerlukan Cookie',
			  text: "Cookie tidak diaktifkan pada browser Anda. Untuk melanjutkan ujian, aktifkan cookie dalam preferensi browser.",
			  icon: 'error',
			  showCancelButton: false,
			  confirmButtonColor: '#3085d6',
			  confirmButtonText: 'OK',
			}).then((result) => {
			  
			});
		},1000);
	}
});
  
 
	function maskNumericFields() {

	  document.querySelectorAll('.format-angka').forEach(element => {
		element.classList.add('text-right');
		new Cleave(element, {
		  numeral: true,
		  numeralPositiveOnly: true,
		  numeralDecimalMark: ',',
		  delimiter: '.',
		  numeralDecimalScale: 2
		});
	  });
	}
	
	$(document).ready(function(){
		maskNumericFields();
	});
				
	$(document).on("keypress", 'form', function (e) {
		var code = e.keyCode || e.which;
		if (code == 13) {
			e.preventDefault();
			return false;
		}
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
