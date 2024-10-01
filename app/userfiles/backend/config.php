<?php




$lang="id";
$list_lang=array("id");
$req_lang=array("id"=>0,"en"=>0); /*lang required*/
$lang=in_array($_SESSION['front_lang'],$list_lang)?$_SESSION['front_lang']:$lang;

$daftar_hak = daftar_hak();

$config['default']=$daftar_hak['dashboard']['view']==1?"dashboard_v2":'';
if($modul==""){$modul=$config['default'];}

$id_user_login=$_SESSION['s_id'];
//$id_cabang=$_SESSION['s_cabang'][0];
$id_cabang=1;//harcode
list($nama_cabang,$alamat_cabang)=$mysql->fetch_row($mysql->query("SELECT nama,alamat FROM master_cabang WHERE id=$id_cabang "));
$form_title=$r_modul[$modul];
$master_hak_akses=array();

$notifikasi_new_total=notifikasi_new_total();
$notifikasi_list=notifikasi_list_show();
/* Harcode nanti diganti otomatis*

$daftar_hak['dashboard']['view']=1;
$daftar_hak['dashboard']['add']=1;
$daftar_hak['dashboard']['edit']=1;
$daftar_hak['dashboard']['del']=1;

$daftar_hak['deal']['add']=1;
$daftar_hak['deal']['view']=1;
$daftar_hak['deal']['edit']=1;
$daftar_hak['deal']['del']=1;

$daftar_hak['invoice']['add']=1;
$daftar_hak['invoice']['view']=1;
$daftar_hak['invoice']['edit']=1;
$daftar_hak['invoice']['del']=1;

$daftar_hak['jadwal']['add']=1;
$daftar_hak['jadwal']['view']=1;
$daftar_hak['jadwal']['edit']=1;
$daftar_hak['jadwal']['del']=1;

$daftar_hak['kegiatan']['add']=1;
$daftar_hak['kegiatan']['view']=1;
$daftar_hak['kegiatan']['edit']=1;
$daftar_hak['kegiatan']['del']=1;


$daftar_hak['kontak']['view']=1;
$daftar_hak['lembaga']['add']=1;
$daftar_hak['lembaga']['view']=1;
$daftar_hak['lembaga']['edit']=1;
$daftar_hak['lembaga']['del']=1;

$daftar_hak['coach']['add']=1;
$daftar_hak['coach']['view']=1;
$daftar_hak['coach']['edit']=1;
$daftar_hak['coach']['del']=1;

$daftar_hak['level']['add']=1;
$daftar_hak['level']['view']=1;
$daftar_hak['level']['edit']=1;
$daftar_hak['level']['del']=1;

$daftar_hak['produk_parent']['view']=1;
$daftar_hak['produk_jenis']['add']=1;
$daftar_hak['produk_jenis']['view']=1;
$daftar_hak['produk_jenis']['edit']=1;
$daftar_hak['produk_jenis']['del']=1;

$daftar_hak['produk']['add']=1;
$daftar_hak['produk']['view']=1;
$daftar_hak['produk']['edit']=1;
$daftar_hak['produk']['del']=1;

$daftar_hak['produk_paket']['add']=1;
$daftar_hak['produk_paket']['view']=1;
$daftar_hak['produk_paket']['edit']=1;
$daftar_hak['produk_paket']['del']=1;

$daftar_hak['prospek']['add']=1;
$daftar_hak['prospek']['view']=1;
$daftar_hak['prospek']['edit']=1;
$daftar_hak['prospek']['del']=1;
$daftar_hak['prospek']['list']=1;



$daftar_hak['prospek']['view']=1;
$daftar_hak['deal']['view']=1;
$daftar_hak['produk']['view']=1;
$daftar_hak['coach']['view']=1;
$daftar_hak['user']['view']=1;
$daftar_hak['administrasi']['view']=1;
$daftar_hak['level']['view']=1;
$daftar_hak['config_invoice']['view']=1;
$daftar_hak['laporan']['view']=1;
$daftar_hak['jadwal_kegiatan']['view']=1;
$daftar_hak['report_customer']['view']=1;
$daftar_hak['report_prospek']['view']=1;
$daftar_hak['report_coach']['view']=1;
/* End harcode nanti diganti otomatis*/

$master_hak_akses[]=array("title"=>"Dashboard","modul"=>"dashboard","hak"=>array("income"=>"Pendapatan","call"=>"Prospek","view"=>"Lihat","add"=>"Add","edit"=>"Edit","del"=>"Hapus"));	
$master_hak_akses[]=array("title"=>"Prospek","modul"=>"prospek","hak"=>array("view"=>"Lihat","add"=>"Add","edit"=>"Edit","del"=>"Hapus"));	
$master_hak_akses[]=array("title"=>"Lembaga","modul"=>"lembaga","hak"=>array("view"=>"Lihat","add"=>"Add","edit"=>"Edit","del"=>"Hapus"));	
$master_hak_akses[]=array("title"=>"Personal","modul"=>"personal","hak"=>array("view"=>"Lihat","add"=>"Add","edit"=>"Edit","del"=>"Hapus"));
$master_hak_akses[]=array("title"=>"Deal","modul"=>"deal","hak"=>array("view"=>"Lihat","add"=>"Add","edit"=>"Edit","del"=>"Hapus"));	
$master_hak_akses[]=array("title"=>"Invoice","modul"=>"invoice","hak"=>array("view"=>"Lihat","add"=>"Add","edit"=>"Edit","del"=>"Hapus"));	
$master_hak_akses[]=array("title"=>"Invoice Lunas","modul"=>"antrian_cetak","hak"=>array("view"=>"Lihat","add"=>"Add","edit"=>"Edit"));	
$master_hak_akses[]=array("title"=>"Kegiatan","modul"=>"kegiatan","hak"=>array("view"=>"Lihat","add"=>"Add","edit"=>"Edit","del"=>"Hapus"));	
$master_hak_akses[]=array("title"=>"Jadwal","modul"=>"jadwal","hak"=>array("view"=>"Lihat","add"=>"Add","edit"=>"Edit","del"=>"Hapus"));	

$master_hak_akses[]=array("title"=>"Produk Parent","modul"=>"produk_parent","hak"=>array("view"=>"Lihat"));	
$master_hak_akses[]=array("title"=>"Produk","modul"=>"produk","hak"=>array("view"=>"Lihat","add"=>"Add","edit"=>"Edit","del"=>"Hapus"));	
$master_hak_akses[]=array("title"=>"Paket","modul"=>"produk_paket","hak"=>array("view"=>"Lihat","add"=>"Add","edit"=>"Edit","del"=>"Hapus"));	
$master_hak_akses[]=array("title"=>"Jenis Produk","modul"=>"produk_jenis","hak"=>array("view"=>"Lihat","add"=>"Add","edit"=>"Edit","del"=>"Hapus"));	
$master_hak_akses[]=array("title"=>"Coach","modul"=>"coach","hak"=>array("view"=>"Lihat","add"=>"Add","edit"=>"Edit","del"=>"Hapus"));	

$master_hak_akses[]=array("title"=>"Raport Customer","modul"=>"raport_customer","hak"=>array("view"=>"Lihat"));	
//$master_hak_akses[]=array("title"=>"Laporan Customer","modul"=>"report_customer","hak"=>array("view"=>"Lihat"));	
$master_hak_akses[]=array("title"=>"Laporan Prospek","modul"=>"report_prospek","hak"=>array("view"=>"Lihat"));	
$master_hak_akses[]=array("title"=>"Laporan Transaksi","modul"=>"report_transaksi","hak"=>array("view"=>"Lihat"));
$master_hak_akses[]=array("title"=>"Laporan Log","modul"=>"report_log","hak"=>array("view"=>"Lihat"));	
$master_hak_akses[]=array("title"=>"Laporan Coach","modul"=>"report_coach","hak"=>array("view"=>"Lihat"));	

$master_hak_akses[]=array("title"=>"Administrasi","modul"=>"administrasi","hak"=>array("view"=>"Lihat"));	
$master_hak_akses[]=array("title"=>"Login User","modul"=>"user","hak"=>array("view"=>"Lihat","add"=>"Tambah","edit"=>"Edit","del"=>"Hapus"));	
$master_hak_akses[]=array("title"=>"Level","modul"=>"level","hak"=>array("view"=>"Lihat","add"=>"Tambah","edit"=>"Edit","del"=>"Hapus"));	


$master_hak_akses[]=array("title"=>"Project","modul"=>"project","hak"=>array("view"=>"Lihat","add"=>"Tambah","edit"=>"Edit","del"=>"Hapus"));	
$master_hak_akses[]=array("title"=>"Task","modul"=>"task","hak"=>array("view"=>"Lihat","add"=>"Tambah","edit"=>"Edit","del"=>"Hapus"));	


if($action=='add' or $action=='edit' or $action=='del') {
	if($daftar_hak[$modul][$action]!=1) {
		sweetalert2("warning","Anda tidak memiliki akses",backendurl()) ;
	}
}

?>
