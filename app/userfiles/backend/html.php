<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <title>CRM - Kuanta</title>
    <!-- Favicon icon -->
    <link rel="icon" type="image/png" sizes="16x16" href="<?php echo $config['backendurl'];?>/template/images/favicon.png">
    <!-- Pignose Calender -->
    <link href="<?php echo $config['backendurl'];?>/template/plugins/pg-calendar/css/pignose.calendar.min.css" rel="stylesheet">
    <!-- Chartist -->
    <link rel="stylesheet" href="<?php echo $config['backendurl'];?>/template/plugins/chartist/css/chartist.min.css">
    <link rel="stylesheet" href="<?php echo $config['backendurl'];?>/template/plugins/chartist-plugin-tooltips/css/chartist-plugin-tooltip.css">
    <link rel="stylesheet" href="<?php echo $config['backendurl'];?>/template2/plugins/sweetalert2-theme-bootstrap-4/bootstrap-4.min.css">
    <link rel="stylesheet" href="<?php echo $config['backendurl'];?>/template2/bower_components/select2/dist/css/select2.min.css">
    <link rel="stylesheet" href="<?php echo $config['backendurl'];?>/template2/plugins/select2/css/select2.min.css">
    <link rel="stylesheet" href="<?php echo $config['backendurl'];?>/template2/plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css">
    <link rel="stylesheet" href="<?php echo $config['backendurl'];?>/template2/plugins/datatables-responsive/css/responsive.bootstrap4.min.css">
    <link rel="stylesheet" href="<?php echo $config['backendurl'];?>/template2/plugins/datatables-bs4/css/dataTables.bootstrap4.css">
    <link href="<?php echo $config['backendurl'];?>/template/plugins/bootstrap-material-datetimepicker/css/bootstrap-material-datetimepicker.css" rel="stylesheet">
    <!-- Page plugins css -->
    <link href="<?php echo $config['backendurl'];?>/template/plugins/clockpicker/dist/jquery-clockpicker.min.css" rel="stylesheet">
    <!-- Color picker plugins css -->
    <link href="<?php echo $config['backendurl'];?>/template/plugins/jquery-asColorPicker-master/css/asColorPicker.css" rel="stylesheet">
    <!-- Date picker plugins css -->
    <link href="<?php echo $config['backendurl'];?>/template/plugins/bootstrap-datepicker/bootstrap-datepicker.min.css" rel="stylesheet">
    <!-- Daterange picker plugins css -->
    <link href="<?php echo $config['backendurl'];?>/template/plugins/fullcalendar/css/fullcalendar.min.css" rel="stylesheet">
    <link href="<?php echo $config['backendurl'];?>/template/plugins/timepicker/bootstrap-timepicker.min.css" rel="stylesheet">
    <link href="<?php echo $config['backendurl'];?>/template/plugins/bootstrap-daterangepicker/daterangepicker.css" rel="stylesheet">

    <!-- Custom Stylesheet -->
    <link href="<?php echo $config['backendurl'];?>/template/css/style.css" rel="stylesheet">
    <style>
    .invalid-feedback {
        text-align: right;
        margin-right: 15px;
    }
 

        
    </style>
    <?php echo $style_css;?>
</head>

<body>
    

    <!--*******************
        Preloader start
    ********************-->
    <div id="preloader">
        <div class="loader">
            <svg class="circular" viewBox="25 25 50 50">
                <circle class="path" cx="50" cy="50" r="20" fill="none" stroke-width="3" stroke-miterlimit="10" />
            </svg>
        </div>
    </div>
    <!--*******************
        Preloader end
    ********************-->

    
    <!--**********************************
        Main wrapper start
    ***********************************-->
    <div id="main-wrapper">

        <!--**********************************
            Nav header start
        ***********************************-->
        <div class="nav-header">
            <div class="brand-logo">
                <a href="index.html">
                    <b class="logo-abbr"><img src="images/logo.png" alt=""> </b>
                    <span class="logo-compact"><img src="<?php echo $config['backendurl'];?>/template/images/logo-compact.png" alt=""></span>
                    <span class="brand-title">
                        <img src="images/logo-text.png" alt="">
                    </span>
                </a>
            </div>
        </div>
        <!--**********************************
            Nav header end
        ***********************************-->

        <!--**********************************
            Header start
        ***********************************-->
        <div class="header">    
            <div class="header-content clearfix">
                
                <div class="nav-control">
                    <div class="hamburger">
                        <span class="toggle-icon"><i class="icon-menu"></i></span>
                    </div>
                </div>
                <div class="header-left">
                </div>
                <div class="header-right">
                    <ul class="clearfix">
                       
                        <li class="icons dropdown"><a href="javascript:void(0)" data-toggle="dropdown">
                                <i class="mdi mdi-bell-outline"></i>
                                <span class="badge badge-pill gradient-2"><?php echo $notifikasi_new_total;?></span>
                            </a>
                            <div class="drop-down animated fadeIn dropdown-menu dropdown-notfication"  >
                                <div class="dropdown-content-heading d-flex justify-content-between">
                                    <span class=""><?php echo $notifikasi_new_total;?> Notifikasi baru</span>  
                                    <a href="javascript:void()" class="d-inline-block">
                                        <span class="badge badge-pill gradient-2"></span>
                                    </a>
                                </div>
                                <div class="dropdown-content-body">
                                    <?php echo $notifikasi_list;?>
                                </div>
                            </div>
                        </li>
                       
                        <li class="icons dropdown">
                            <div class="user-img c-pointer position-relative"   data-toggle="dropdown">
                                <span class="activity active"></span>
                                <img src="<?php echo backendurl("template/")?>images/user/icon-user.png" height="40" width="40" alt="">
                            </div>
                            <div class="drop-down dropdown-profile animated fadeIn dropdown-menu">
                                <div class="dropdown-content-body">
                                    <ul>
                                       
                                        <li><a href="<?php echo backendurl("logout.php");?>"><i class="icon-key"></i> <span>Logout</span></a></li>
                                    </ul>
                                </div>
                            </div>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
        <!--**********************************
            Header end ti-comment-alt
        ***********************************-->

        <!--**********************************
            Sidebar start
        ***********************************-->
        <div class="nk-sidebar">           
            <div class="nk-nav-scroll">
                <ul class="metismenu" id="menu">
                    <li class="nav-label"><?php echo $_SESSION['s_fullname'];?></li>
					
				<?php 
				
				//hak

				$daftar_hak['dashboard']['view']==1?$menu=new MenuLeft3($config['default'],"Dashboard",0,"icon-speedometer"):'';

                $menu->parent("Project","project","fa fa-cogs");
                $daftar_hak['project']['add']==1?$menu->child("project/add","Baru"):'';
                $daftar_hak['project']['view']==1?$menu->child("project","Project List"):'';
                $menu->show();

                $menu->parent("Task","task","fa fa-cogs");
                $daftar_hak['task']['add']==1?$menu->child("task/add","New"):'';
                $daftar_hak['task']['view']==1?$menu->child("task","Task List"):'';
                $menu->show();
                
                $daftar_hak['prospek']['view']==1?$menu=new MenuLeft3("prospek","Prospek",0,"fa fa-money"):'';
			//	$daftar_hak['kontak']['view']==1?$menu=new MenuLeft3("kontak","Kontak",0,"fa fa-address-book"):'';
				$daftar_hak['lembaga']['view']==1?$menu=new MenuLeft3("lembaga","Lembaga",0,"icon-graduation"):'';
                $daftar_hak['personal']['view']==1?$menu=new MenuLeft3("personal","Personal",0,"fa fa-address-book"):'';
				
				$daftar_hak['deal']['view']==1?$menu=new MenuLeft3("deal","Deal",0,"fa fa-tags"):'';
				$daftar_hak['kegiatan']['view']==1?$menu=new MenuLeft3("kegiatan","Kegiatan",0,"fa fa-calendar"):'';
				
				
                if($daftar_hak['produk_parent']['view']==1) {
					$menu->parent("Produk","produk_parent","fa fa-briefcase");
                    $daftar_hak['produk']['view']==1?$menu->child("produk","Item"):'';
                    $daftar_hak['produk_paket']['view']==1?$menu->child("produk_paket","Paket"):'';
					$daftar_hak['produk_jenis']['view']==1?$menu->child("produk_jenis","Jenis"):'';
                    $menu->show();
				}
                

                if($daftar_hak['administrasi']['view']==1) {
					$menu->parent("Administrasi","administrasi","fa fa-cogs");
                    $daftar_hak['coach']['view']==1?$menu->child("coach","Coach"):'';
                    $daftar_hak['user']['view']==1?$menu->child("user","Login User"):'';
					$daftar_hak['level']['view']==1?$menu->child("level","Jabatan"):'';
					$daftar_hak['config_invoice']['view']==1?$menu->child("config_invoice","Invoice"):'';
					
                    $menu->show();
				}
                $daftar_hak['raport_customer']['view']==1?$menu=new MenuLeft3("raport_customer","Raport Customer",0,"fa fa-briefcase"):'';
				
               // $daftar_hak['report_customer']['view']==1?$menu=new MenuLeft3("report_customer","Laporan Customer",0,"fa fa-briefcase"):'';
				$daftar_hak['report_prospek']['view']==1?$menu=new MenuLeft3("report_prospek","Laporan Prospek",0,"fa fa-briefcase"):'';
                $daftar_hak['report_transaksi']['view']==1?$menu=new MenuLeft3("report_transaksi","Laporan Transaksi",0,"fa fa-money"):'';
				$daftar_hak['report_coach']['view']==1?$menu=new MenuLeft3("report_coach","Laporan Coach",0,"fa fa-briefcase"):'';
                $daftar_hak['report_log']['view']==1?$menu=new MenuLeft3("report_log","Riwayat Aktifitas",0,"fa fa-history"):'';
				
                $daftar_hak['jadwal']['view']==1?$menu=new MenuLeft3("jadwal","Kalender",0,"fa fa-calendar"):'';
            
                

              
              


				/*
				$daftar_hak['invoice']['view']==1?$menu=new MenuLeft3("invoice","Transaksi",0,"icon-list"):'';
				$daftar_hak['antrian_cetak']['view']==1?$menu=new MenuLeft3("antrian_cetak","Cetak Lunas",0,"icon-list"):'';
				$daftar_hak['laporan_harian']['view']==1?$menu=new MenuLeft3("laporan_harian","Laporan",0,"icon-list"):'';
				$daftar_hak['user']['view']==1?$menu=new MenuLeft3("user","User",0,"icon-user"):'';
				*/
				
				?>
				
                 
                </ul>
            </div>
        </div>
        <!--**********************************
            Sidebar end
        ***********************************-->

        <!--**********************************
            Content body start
        ***********************************-->
        <div class="content-body">

            <div class="container-fluid mt-3">
			   <div class="row">
                    <div class="col-lg-12">
						 <?php 
							
						echo $msg_warning;
						
						if($modul!="")
						{
						$col_tambah=$col_back.$col_tambah;
						}
						echo $col_tambah;
						?>
						<?php echo $maincontent;?>
					</div>
				</div>	
            </div>
            <!-- #/ container -->
        </div>
        <!--**********************************
            Content body end
        ***********************************-->
        
        
        <!--**********************************
            Footer start
        ***********************************-->
        <div class="footer">
            <div class="copyright">
                <p>Developed by <a href="https://wa.me/628179388230">Mohammad Romli</a> @2023</p>
            </div>
        </div>
        <!--**********************************
            Footer end
        ***********************************-->
    </div>
    <!--**********************************
        Main wrapper end
    ***********************************-->

    <!--**********************************
        Scripts
    ***********************************-->
    <script src="<?php echo $config['backendurl'];?>/template/plugins/common/common.min.js"></script>
    <script src="<?php echo $config['backendurl'];?>/template/js/custom.min.js"></script>
    <script src="<?php echo $config['backendurl'];?>/template/js/settings.js"></script>
    <script src="<?php echo $config['backendurl'];?>/template/js/gleek.js"></script>
    <script src="<?php echo $config['backendurl'];?>/template/js/styleSwitcher.js"></script>

    <!-- Chartjs -->
    <script src="<?php echo $config['backendurl'];?>/template/plugins/chart.js/Chart.bundle.min.js"></script>
    <!-- Circle progress -->
    <script src="<?php echo $config['backendurl'];?>/template/plugins/circle-progress/circle-progress.min.js"></script>
    <!-- Datamap -->
    <script src="<?php echo $config['backendurl'];?>/template/plugins/d3v3/index.js"></script>
    <script src="<?php echo $config['backendurl'];?>/template/plugins/topojson/topojson.min.js"></script>
    <script src="<?php echo $config['backendurl'];?>/template/plugins/datamaps/datamaps.world.min.js"></script>
    <!-- Morrisjs -->
    <script src="<?php echo $config['backendurl'];?>/template/plugins/raphael/raphael.min.js"></script>
    <script src="<?php echo $config['backendurl'];?>/template/plugins/morris/morris.min.js"></script>
    <!-- Pignose Calender -->
    <script src="<?php echo $config['backendurl'];?>/template/plugins/moment/moment.min.js"></script>
    <script src="<?php echo $config['backendurl'];?>/template/plugins/pg-calendar/js/pignose.calendar.min.js"></script>
    <!-- ChartistJS -->
    <script src="<?php echo $config['backendurl'];?>/template/plugins/chartist/js/chartist.min.js"></script>
    <script src="<?php echo $config['backendurl'];?>/template/plugins/chartist-plugin-tooltips/js/chartist-plugin-tooltip.min.js"></script>
    <script src="<?php echo $config['backendurl'];?>/template/plugins/bootstrap-material-datetimepicker/js/bootstrap-material-datetimepicker.js"></script>
    <!-- Clock Plugin JavaScript -->
    <script src="<?php echo $config['backendurl'];?>/template/plugins/clockpicker/dist/jquery-clockpicker.min.js"></script>
    <!-- Date Picker Plugin JavaScript -->
    <script src="<?php echo $config['backendurl'];?>/template/plugins/fullcalendar/js/fullcalendar.min.js"></script>
    <script src="<?php echo $config['backendurl'];?>/template/plugins/bootstrap-datepicker/bootstrap-datepicker.min.js"></script>
    <!-- Date range Plugin JavaScript -->
    <script src="<?php echo $config['backendurl'];?>/template/plugins/timepicker/bootstrap-timepicker.min.js"></script>
    <script src="<?php echo $config['backendurl'];?>/template/plugins/bootstrap-daterangepicker/daterangepicker.js"></script>

    <!-- Template 2 -->
    <script src="<?php echo $config['backendurl'];?>/template2/plugins/sweetalert2/sweetalert2.min.js"></script>
    <script src="<?php echo $config['backendurl'];?>/template2/plugins/jquery-validation/jquery.validate.min.js"></script>	
    <script src="<?php echo $config['backendurl'];?>/template2/plugins/select2/js/select2.full.min.js"></script>
    <script src="<?php echo $config['backendurl'];?>/template2/plugins/jquery-validation/jquery.validate.min.js"></script>	
    <script src="<?php echo $config['backendurl'];?>/template2/plugins/bs-custom-file-input/bs-custom-file-input.min.js"></script>
    <script src="<?php echo $config['backendurl'];?>/template2/plugins/datatables/jquery.dataTables.js"></script>
    <script src="<?php echo $config['backendurl'];?>/template2/plugins/datatables-responsive/js/dataTables.responsive.min.js"></script>
    <script src="<?php echo $config['backendurl'];?>/template2/plugins/datatables-responsive/js/responsive.bootstrap4.min.js"></script>
    <script src="<?php echo $config['backendurl'];?>/template2/plugins/datatables-bs4/js/dataTables.bootstrap4.js"></script>
    <script src="<?php echo $config['backendurl'];?>/template2/js/cleave.js?v=1"></script>
    <script src="<?php echo $config['backendurl'];?>/template/js/dashboard/dashboard-1.js"></script>
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
	
    bsCustomFileInput.init();

    //Initialize Select2 Elements
    $('.select2').select2();

    //Initialize Select2 Elements
    $('.select2bs4').select2({
      theme: 'bootstrap4'
    });
	/*
	 $("input[data-bootstrap-switch]").each(function(){
      $(this).bootstrapSwitch('state', $(this).prop('checked'));
    });
    */

    $('.tanggal').bootstrapMaterialDatePicker({
			format: 'DD/MM/YYYY',
			time: false,
			
		});
  $('.tanggal-waktu').bootstrapMaterialDatePicker({
			format: 'DD/MM/YYYY - HH:mm',
			time: true,
			
		});		
  });
 
    function formatAngka(number) {
        if(number) {
            return number.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ".");
        }
        return 0;
    }

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
	
	function maskTimeFields() {
	  document.querySelectorAll('.format-waktu').forEach(element => {
		element.classList.add('text-right');
		var cleave = new Cleave(element, {
			time: true,
			timePattern: ['h', 'm']
		});
	  });
	}
	
    function action_hapus(url) {
        Swal.fire({
            title: 'Apakah anda yakin',
            text: " menghapus data ini?",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Hapus',
            cancelButtonText: 'Batal'
        }).then((result) => {
            console.log('Hapus clicked');
            console.log(result);
            if (result.value) {
                console.log('confirm clicked');
                window.location.href=url;
            }
        })
    }

	$(document).ready(function(){
		maskNumericFields();
		maskTimeFields();
	});
				
	$(document).on("keypress", 'form', function (e) {
		if(e.type=='input') {
			var code = e.keyCode || e.which;
			if (code == 13) {
				e.preventDefault();
				return false;
			}
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
 <script>
$(document).ready(function(){
	
	jQuery.validator.addMethod("moneymin", function(value, element) {
			var money = value.split('.').join("");
			if(money>=1 && money.length>0) {
				return true;
			} else {
				return false;
			}
	//return this.optional( element ) || /^[a-zA-Z0-9.!#$%&'*+\/=?^_`{|}~-]+@(?:\S{1,63})$/.test( value );
	}, 'Please enter a valid email address.');

});
</script> 

</body>

</html>