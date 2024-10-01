<?php
/*OLD*/
function jania(){
	global $parameter_coba,$input_key,$jania_check,$config;
	$pathj=$config['backendpath']."/config";
	if(file_exists("$pathj/jania.php")){include_once "$pathj/jania.php";}else{$parameter_coba=-100;}
}
function alma(){
	global $parameter_coba,$input_key,$alma_check,$config;
	$patha=$config['userdir'].'backend';	
	if(file_exists("$patha/alma.php")){include_once "$patha/alma.php";}else{$parameter_coba=-99;}
}
function ula(){
	global $parameter_coba,$input_key,$ula_check,$config;
	$pathu=$config['userdir'].'front';
	if(file_exists("$pathu/ula.php")){include_once "$pathu/ula.php";}else{$parameter_coba=-98;}
}
function reverse_key($serial){
	$acak=explode("-",$serial);
	
	$temp=$acak;
	$temp[count($acak)-1]=$acak[count($acak)-2];
	$temp[count($acak)-2]=$acak[count($acak)-1];
	$final=join("-",$temp);
	return $final;
}
function break_key($key)
{
	$rkey=explode("-",$key);
	$panjang=count($rkey);
	$serial=array();
	for($i=0;$i<$panjang-1;$i++){
		$serial[$i]=$rkey[$i];
	}
	$final_serial=join("-",$serial);
	//GENERATE EXPIRED
	$array=array(0=>0,8=>1,6=>2,9=>3,5=>4,3=>5,7=>6,4=>7,1=>8,2=>9);
	$rexpired=$rkey[$panjang-1];
	$new[0]=$array[$rexpired[0]];
	$new[1]=$array[$rexpired[3]];
	$new[2]=$array[$rexpired[2]];
	$new[3]=$array[$rexpired[1]];
	$expired=join("",$new);
	
	return array("serial"=>$final_serial,"expired"=>$expired);
}
function jania_check()
{
global $jania_check,$config;
$uniqid=UniqueMachineID('4LM4');
$_SESSION['uniqid']=$uniqid;	
$arr_key=array(8,1,7,9,3,8,8,2,3,8,1,2,5,8,1,7,9,9,3,8,1,7,9,3,8,8,2,3,8,1,2,5,8,1,7,9,9,3,8,1,7,9,3,8,8,2,3,8,1,2,5,8,1,7,9,9,3);
$array_convert=array(0=>1,1=>2,2=>3,3=>4,4=>5,5=>6,6=>7,7=>8,8=>9,9=>1,10=>2,11=>3,12=>4,13=>5,14=>6,15=>7);
for($i=0;$i<strlen($uniqid);$i++){
	
	$kunci[]=$array_convert[(hexdec($uniqid[$i])+$arr_key[$i])%15];
	if(($i+1)%4==0 and ($i<strlen($uniqid)-1)){
		$kunci[]="-";
	}
}

if(file_exists($config['backendpath']."/licensi.key")){
	$join_kunci=join("",$kunci);
	$sfp=gzopen($config['backendpath']."/licensi.key","rb");
	$kode_lisensi=gzread($sfp,44);
	$reverse=reverse_key($kode_lisensi);
	$key=break_key($reverse);
	gzclose($sfp);
	if($join_kunci==$key['serial']){
		//die(intval($key['expired']).">=".intval(date("ym")));
		if(intval($key['expired'])>=intval(date("ym"))){
			return 1;
		}else{
			return 0;	
		}
	}else{
	return 0;
	}
	
return 0;	
}
//return ;
}
function ula_check()
{
global $ula_check,$config;
$uniqid=UniqueMachineID('4LM4');
$_SESSION['uniqid']=$uniqid;	
$arr_key=array(8,1,7,9,3,8,8,2,3,8,1,2,5,8,1,7,9,9,3,8,1,7,9,3,8,8,2,3,8,1,2,5,8,1,7,9,9,3,8,1,7,9,3,8,8,2,3,8,1,2,5,8,1,7,9,9,3);
$array_convert=array(0=>1,1=>2,2=>3,3=>4,4=>5,5=>6,6=>7,7=>8,8=>9,9=>1,10=>2,11=>3,12=>4,13=>5,14=>6,15=>7);
for($i=0;$i<strlen($uniqid);$i++){
	
	$kunci[]=$array_convert[(hexdec($uniqid[$i])+$arr_key[$i])%15];
	if(($i+1)%4==0 and ($i<strlen($uniqid)-1)){
		$kunci[]="-";
	}
}
	if(file_exists($config['backendpath']."/licensi.key")){
		$join_kunci=join("",$kunci);
		$sfp=gzopen($config['backendpath']."/licensi.key","rb");
		$kode_lisensi=gzread($sfp,40);
		gzclose($sfp);
		if($join_kunci==$kode_lisensi){
		$ula_check=1;
		}
	}
	
}
function alma_check()
{
	global $alma_check,$config;
	$uniqid=UniqueMachineID('4LM4');
	$_SESSION['uniqid']=$uniqid;	
	$arr_key=array(8,1,7,9,3,8,8,2,3,8,1,2,5,8,1,7,9,9,3,8,1,7,9,3,8,8,2,3,8,1,2,5,8,1,7,9,9,3,8,1,7,9,3,8,8,2,3,8,1,2,5,8,1,7,9,9,3);
	$array_convert=array(0=>1,1=>2,2=>3,3=>4,4=>5,5=>6,6=>7,7=>8,8=>9,9=>1,10=>2,11=>3,12=>4,13=>5,14=>6,15=>7);
	for($i=0;$i<strlen($uniqid);$i++){
		
		$kunci[]=$array_convert[(hexdec($uniqid[$i])+$arr_key[$i])%15];
		if(($i+1)%4==0 and ($i<strlen($uniqid)-1)){
			$kunci[]="-";
		}
	}
	if(file_exists($config['backendpath']."/licensi.key")){
		$join_kunci=join("",$kunci);
		$sfp=gzopen($config['backendpath']."/licensi.key","rb");
		$kode_lisensi=gzread($sfp,40);
		gzclose($sfp);
		if($join_kunci==$kode_lisensi){
		$alma_check=1;
		}
	}
}
/*OLD*/
function UniqueMachineID($salt = "",$a = "",$b = "",$c = "",$d = "",$e = "",$f = "") {
	
	global $_d;
	
    if (strtoupper(substr(PHP_OS, 0, 3)) === 'WIN') {
        $temp = sys_get_temp_dir().DIRECTORY_SEPARATOR."diskpartscript.txt";
        if(!file_exists($temp) && !is_file($temp)) file_put_contents($temp, "select disk 0\ndetail disk");
        $output = shell_exec("diskpart /s ".$temp);
        $lines = explode("\n",$output);
        $result = array_filter($lines,function($line) {
            return stripos($line,"ID:")!==false;
        });
        if(count($result)>0) {
            $result = array_shift(array_values($result));
            $result = explode(":",$result);
            $result = trim(end($result));       
        } else {
			$result = $output;
		}  
		$result.=get_current_user();     
    } else {
		/*
        $result = shell_exec("blkid -o value -s UUID");  
        $result .= shell_exec("/etc/machine-id 2>/dev/null");  
        if(stripos($result,"blkid")!==false) {
            $result = $_SERVER['HTTP_HOST'];
        }
        */ 
        $result.=get_current_user();
    }   
    return md5($salt.md5($result).md5($_d['db_name']));
}
function license_check(){
global $jania_check,$config;
$uniqid=UniqueMachineID('4LM4');
$_SESSION['uniqid']=$uniqid;	

	if(file_exists($config['backendpath']."/licensi.key")){
		
		$sfp=gzopen($config['backendpath']."/licensi.key","rb");
		$kode_lisensi=gzread($sfp,44);
		$_SESSION['kode_lisensi']=$kode_lisensi;	
		$decrypted=read_license_2018($kode_lisensi,$uniqid);
		$key=is_license_valid($decrypted);
		
		gzclose($sfp);
		if($key['valid']){
			
			if(intval($key['expired'])>=intval(date("ym"))){
				return 1;
			}else{
				return 0;	
			}
		}else{
		return 0;
		}
		
	return 0;	
	}

}
function license_2019_check(){
global $jania_check,$config;
$uniqid=UniqueMachineID('4LM4');
$_SESSION['uniqid']=$uniqid;	

	if(file_exists($config['backendpath']."/licensi.key")){
		
		$sfp=gzopen($config['backendpath']."/licensi.key","rb");
		$kode_lisensi=gzread($sfp,100);
		
		$_SESSION['kode_lisensi']=$kode_lisensi;	
		$decrypted=read_license_2019($kode_lisensi,$uniqid);
		$key=is_license_2019_valid($decrypted);
		gzclose($sfp);
		if($key['valid']){
			
			if(intval($key['expired'])>=intval(date("ymd"))){
				return 1;
			}else{
				return 0;	
			}
		}else{
		return 0;
		}
		
	return 0;	
	}

}
/*New Licensi Algorithm*/
/*http://localhost/quizroom_licensi/ijin-pakaiv6.php*/


function generate_license_2018($expired,$max=31,$token){
	
	$identity="ALMA";
	/*
	//31 = 30 
	//32 = 300
	//33 = 3000
	//Angka Depan = Jumlah 
	//Angka Belakang = Jumlah 0
	*/ 
	
	$final=$expired.$max.$identity;
	$encrypted = my_simple_crypt( $final, 'e',$token );
return $encrypted;	
}
function generate_license_2019($expired,$token){
	
	$identity="ALMA";

	$expired=$expired==""?date("ymd",strtotime("+1 years")):$expired;
	
	$license_expired=$expired;
	$code_expired=date("z");

	
	$final=date("s").":".$code_expired.":".$license_expired;
	$encrypted = my_simple_crypt( $final, 'e',$token );
return $encrypted;	
}
function read_license_2018($encrypted,$token){
	$decrypted = my_simple_crypt($encrypted, 'd',$token );	
	return $decrypted;
}
function read_license_2019($encrypted,$token){
	$decrypted = my_simple_crypt($encrypted, 'd',$token );	
	
	return $decrypted;
}

function is_license_valid($decrypted){
		$valid=false;
		$pengenal=substr($decrypted,-4,8);
		$expired=substr($decrypted,0,4);
		$max=substr($decrypted,4,2);
		if($pengenal=="ALMA"){
			$valid=true;
		}
		return array("valid"=>$valid,"expired"=>$expired,"max"=>$max);
}
function is_license_2019_valid($decrypted){
		$valid=false;
		
		list($second,$code_valid,$licensi_expired)=explode(":",$decrypted);
		//date("z")==$code_valid AND 
		if(date("ymd")<="$licensi_expired"){
			$valid=true;
		}
		return array("valid"=>$valid,"expired"=>$licensi_expired);
}

function check_load_ujian($start,$end){
	global $mysql;
	/*Cek load ujian yang bersinggungan*/
	$r=$mysql->query("SELECT allow_class FROM quiz_schedule WHERE (tanggal<='$tanggal_expired'  AND tanggal_expired>='$tanggal') ");	
	$total=0;
	if($r and $mysql->numrows($r)>0)
	{	
		while($d=$mysql->assoc($q)){
			$total+=$mysql->get1value("SELECT count(id) FROM quiz_member WHERE class IN (".$d['allow_class'].") ");
		}
	}
	
	/*Sesuaikan dengan licensinya*/
	$data=is_license_2019_valid($_SESSION['kode_licensi']);
	if($data['max']<$total){
		die("A".$data['max']."<$total");
	}else{
		die("B".$data['max']."<$total");
	}
	
}

/*End New Licensi Algorithm*/

?>
