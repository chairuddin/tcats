<?php


function sinkronisasi_user($id,$username,$password,$name){
global $mysql;
$sqlpass="";
if($password!="")
{
	

	$wp_hasher = new PasswordHash(8, true);
	$hash= $wp_hasher->HashPassword( trim( $password ) );
	$sqlpass=",user_pass='$hash'";
}
$hariini=date("Y-m-d H:i:s");
$q="
INSERT INTO wp9s_users
SET 
ID=$id,
user_registered='$hariini',
user_login='$username',
user_nicename='$username',
user_email='$username@admin.com',
display_name='$username'
$sqlpass
ON DUPLICATE KEY 
UPDATE
user_login='$username',
user_nicename='$username',
user_email='$username@admin.com',
display_name='$username'
$sqlpass";
$mysql->query($q);
 
$user_id=$mysql->get1value("SELECT ID from wp9s_users WHERE user_login='$username'");
$sql1=<<<END
INSERT INTO `wp9s_usermeta` (`umeta_id`, `user_id`, `meta_key`, `meta_value`) VALUES (NULL, '$user_id', 'wp9s_capabilities', 'a:1:{s:13:"administrator";b:1;}')
END;
$mysql->query($sql1); 

$sql2=<<<END
INSERT INTO .`wp9s_usermeta` (`umeta_id`, `user_id`, `meta_key`, `meta_value`) VALUES (NULL, '$user_id', 'wp9s_user_level', '10')
END;

$mysql->query($sql2); 

$sql3=<<<END
INSERT INTO .`wp9s_usermeta` (`umeta_id`, `user_id`, `meta_key`, `meta_value`) VALUES (NULL, '$user_id', 'nickname', '$username')
END;

$mysql->query($sql3); 

}
// for($i=1;$i<500;$i++)
// {
// $sql="INSERT INTO `member` (`email`, `fullname`, `hp`, `alamat`, `password`, `authcode`, `status`, `regdate`, `level`) VALUES
// ('roemly@a$i,com', 'ciamik', '12312', 'slkjfslj', '', '', 0, '2014-05-01 22:25:18', 0)";
// $r=$mysql->query($sql);
// }
if($action=="upload_xls")
{
	
	
	$destination=filepath("user/".$_FILES['filename']['name']);
	$filename=$_FILES['filename']['name'];
	if (!move_uploaded_file($_FILES['filename']['tmp_name'], $destination)) {
		return _MAYBEPERMISSION;
	}else{
	
	$alamat=filepath("user/$filename");
	$objPHPExcel = PHPExcel_IOFactory::load($alamat);
	
	
	$dataArr = array();
	 
	foreach ($objPHPExcel->getWorksheetIterator() as $worksheet) {
		$worksheetTitle     = $worksheet->getTitle();
		$highestRow         = $worksheet->getHighestRow(); // e.g. 10
		$highestColumn      = $worksheet->getHighestColumn(); // e.g 'F'
		$highestColumnIndex = PHPExcel_Cell::columnIndexFromString($highestColumn);
		 
		for ($row = 1; $row <= $highestRow; ++ $row) {
			for ($col = 0; $col < $highestColumnIndex; ++ $col) {
				$cell = $worksheet->getCellByColumnAndRow($col, $row);
				$val = $cell->getValue();
				$dataArr[$row][$col] = $val;
			}
		}
	}
	unset($dataArr[1]);
	$already_exist=array();
	$success_input=array();
	foreach($dataArr as $val){
		$password=md5(sha1($val[1]));
		$password_wp=$val[1];
		$q=$mysql->query("INSERT INTO user set username='".cleanInput($val[0])."',password='".$password."',fullname='".cleanInput($val[2])."',level=0,status=1");
		
		if($q){
			$user_id=$mysql->get1value("SELECT id FROM user WHERE username='".cleanInput($val[0])."'");
			sinkronisasi_user($user_id,cleanInput($val[0]),$password_wp,cleanInput($val[2]));
			$success_input[]=cleanInput($val[2]);
		}else{
			
			if($val[2]!=""){
				$already_exist[]=cleanInput($val[2]);
			}
		}
    }
	
	if(count($already_exist)>0){
	$join_error="<ul><li>".join("</li><li>",$already_exist)."</ul></li>";
	redirecto("Gagal tambah user berikut karena username sudah terdaftar:<br/>$join_error","error","view");
	}
	else
	{
	$join_msg="<ul><li>".join("</li><li>",$success_input)."</ul></li>";	
	redirecto("Sukses menambahkan user:<br/>$join_msg","success","view");	
	}
	
	}
	
	
}
if($action=="download_xls")
{
error_reporting(E_ALL);
ini_set('display_errors', FALSE);
ini_set('display_startup_errors', FALSE);
date_default_timezone_set('Asia/Jakarta');
// Create new PHPExcel object
$objPHPExcel = new PHPExcel();

// Set document properties
$objPHPExcel->getProperties()->setCreator("websuka.com")
 ->setLastModifiedBy("websuka.com")
 ->setTitle("Ujian Online Berbasis Komputer")
 ->setSubject("Ujian Online Berbasis Komputer")
 ->setDescription("Ujian Online Berbasis Komputer")
 ->setKeywords("Ujian Online Berbasis Komputer")
 ->setCategory("Ujian Online Berbasis KOmputer");

$objPHPExcel->setActiveSheetIndex(0)
            ->setCellValue('A1',"Username")
            ->setCellValue('B1',"Password")
            ->setCellValue('C1',"Nama Lengkap");
	/*
	$q=$mysql->query("SELECT * FROM user WHERE level<=1 ");
	$no=2;
	while($d=$mysql->assoc($q))
	{
	$objPHPExcel->setActiveSheetIndex(0)
			->setCellValue('A'.$no,$d['username'])
			->setCellValue('B'.$no,$d['password'])
			->setCellValue('C'.$no,$d['fullname']);
	$no++;		
	}      
	*/      
	$no=2;
	$objPHPExcel->setActiveSheetIndex(0)
			->setCellValue('A'.$no,"ketik username tanpa spasi")
			->setCellValue('B'.$no,"ketik password")
			->setCellValue('C'.$no,"ketik nama lengkap User");
			
$filename="Template Login User";
$sheet_title="Data login quizroom";

// Rename worksheet
$objPHPExcel->getActiveSheet()->setTitle($sheet_title);
// Set active sheet index to the first sheet, so Excel opens this as the first sheet
$objPHPExcel->setActiveSheetIndex(0);


// Redirect output to a client’s web browser (Excel5)
header('Content-Type: application/vnd.ms-excel');
header('Content-Disposition: attachment;filename="'.$filename.'.xls"');
header('Cache-Control: max-age=0');
// If you're serving to IE 9, then the following may be needed
header('Cache-Control: max-age=1');

// If you're serving to IE over SSL, then the following may be needed
header ('Expires: Mon, 26 Jul 1997 05:00:00 GMT'); // Date in the past
header ('Last-Modified: '.gmdate('D, d M Y H:i:s').' GMT'); // always modified
header ('Cache-Control: cache, must-revalidate'); // HTTP/1.1
header ('Pragma: public'); // HTTP/1.0

$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel5');
$objWriter->save('php://output');
exit;


}
if($action=="save")
{
	if(Form::isValid("reguser",false) and $_POST['form']=='reguser') 
	{  
	$username=cleanInput($_POST['username'],"email");
	$ulogin=md5($_POST['username']);
	$fullname=cleanInput($_POST['fullname']);
	$email=cleanInput($_POST['email'],"email");
	$password_wp=$_POST['password'];
	$password=md5(sha1($_POST['password']));
	$password2=md5(sha1($_POST['password2']));
	/*VALIDASI*/
	if($password!=$password2)
	{
	redirecto("Password tidak sama","error","add");	
	}
		
	$r=$mysql->query("SELECT id FROM user WHERE username='$username' ");
	if($r and $mysql->numrows($r)>0)
	{
	redirecto(_USERNAMESAMA,"error","add");
	}
	/*END VALIDASI*/
	$level=cleanInput($_POST['level'],"numeric");
	$status=cleanInput($_POST['status'],"numeric");
	
	$sql="INSERT INTO user(username,email,ulogin,fullname,password,level,status,lastmodify) values ('$username','$email','$ulogin','$fullname','$password','$level','$status',NOW())";
	
	$r=$mysql->query($sql);
	if($r)
	{
	$user_id=$mysql->get1value("SELECT id FROM user WHERE username='$username'");
	sinkronisasi_user($user_id,$username,$password_wp,$fullname);	
	$action="view";
	}
	
	}
	else
	{
	$action="add";
	}
	
}

if($action=="update")
{
	$id=cleanInput($_POST['id'],'numeric');
	if(Form::isValid("updateuser",false) and $_POST['form']=='updateuser') 
	{  
	$username=cleanInput($_POST['username'],"email");
	$email=cleanInput($_POST['email'],"email");
	$ulogin=md5($_POST['username']);
	$fullname=cleanInput($_POST['fullname']);
	$password=$password2="";
	$r_update=array();
	/*VALIDASI*/
	$password_wp="";
	if($_POST['password']!='' or $_POST['password2']!='')
	{
		
		$password=md5(sha1($_POST['password']));
		$password2=md5(sha1($_POST['password2']));
		if($password!=$password2)
		{
		redirecto("Password tidak sama","error","edit/$id");
		}
		else
		{
		$password_wp=$_POST['password'];	
		$r_update[]="password='$password'";
		}
	}

		
	$r=$mysql->query("SELECT id FROM user WHERE username='$username' AND id<>$id");
	if($r and $mysql->numrows($r)>0)
	{
	redirecto(_USERNAMESAMA,"error","edit/$id");	
	}
	/*END VALIDASI*/
	
	$level=cleanInput($_POST['level'],"numeric");
	$status=cleanInput($_POST['status'],"numeric");
	
	$sql="UPDATE user set ";
	//$r_update[]="username='$username'";
	//$r_update[]="ulogin='$ulogin'";
	$r_update[]="email='$email'";
	$r_update[]="fullname='$fullname'";
	$r_update[]="level='$level'";
	$r_update[]="status='$status'";
	$r_update[]="lastmodify=NOW()";

	$sql.=join(",",$r_update);
	$sql.=" WHERE id=$id";
	$r=$mysql->query($sql);
	if($r)
	{
	$user_id=$mysql->get1value("SELECT id FROM user WHERE username='$username'");
	sinkronisasi_user($user_id,$username,$password_wp,$fullname);		
	Form::clearValues("updateuser"); 
	msg_warning(_BERHASILUPDATEUSER,"success");
	header("location:".backendurl("user/view"));
	exit();
	}
	else
	{
	msg_warning(_GAGALUPDATEUSER,"success");
	header("location:".backendurl("user/edit/$id"));
	exit();
	}
	
	}
	else
	{
	msg_warning(_GAGALUPDATEUSER,"success");
	header("location:".backendurl("user/edit/$id"));
	exit();
	}
}
if($action=="del")
{
if($_SESSION['s_level']<=0){redirecto(_TIDAKBERHAK,"error","view");}
$r=$mysql->query("SELECT * from user where id=$id");
$d=$mysql->assoc($r);if($_SESSION['s_level']<$d['level']){redirecto(_TIDAKBERHAK,"error","view");}
$sql="DELETE FROM user WHERE id=$id;			";
$r=$mysql->query($sql);
if($r)
{
	$sql1="DELETE FROM wp9s_users WHERE ID=$id";
	$r=$mysql->query($sql1);
	$sql2="DELETE FROM wp9s_usermeta WHERE user_id=$id";
	$r=$mysql->query($sql2);
	header("location:".backendurl("user/view"));
}
}
?>
