<?php

session_start();
define('MSB_NL', "\r\n");
define('MSB_STRING', 0);
define('MSB_DOWNLOAD', 1);
define('MSB_SAVE', 2);
define('MSB_DELIMITER', "//");
//MSB_END untuk delimiter akhir sintak 
define('MSB_END', "<;>");
//MSB_TANDA untuk membuat tanda keaslian file yang akan di backup dan import
//define('MSB_TANDA', "#ASLI");
define('MSB_TANDA', "#GT3");

class MySQL_Backup
{	var $server = 'localhost';
	var $is_port = false;
	var $port = 3306;
	var $username = 'root';
	var $password = '';
	var $database = '';
	var $link_id = -1;
	var $connected = false;
	var $tables = array();
	var $drop_tables = true;
	var $drop_table = array();
	var $stand_in_view = true;
	var $struct_only = false;
	var $comments = false;
	var $backup_dir = '';
	var $fname_format = 'd_m_y__H_i_s';
	var $error = '';
	var $tabel_khusus=array();
	var $query_khusus=array();
	var $lock_khusus=array();
	var $sql_string=array();
	var $fp="";
	var $tempnama="";
	var $message="";
	var $queries=array();
	var $ada_data=false;
	var $use_gzip=true;
	var $nama_default="backup";
	var $kode_lokasi_login="";
	var $status_commit=true;
	function GetFileName()
	{
		$filename = $this->backup_dir;
		$filename .="/".$this->tempnama;
		return $filename;
	}
	function OpenFile()
	{
			$filename=$this->GetFileName();
			if($this->use_gzip)
			{
			 $this->fp = gzopen($filename,'w9');
			 
			}
			else
			{
			$this->fp = fopen($filename,'w');
			}
	}
	function WriteFile($value)
	{
	
		if($this->use_gzip)
		{
		gzwrite($this->fp, $value);
		}
		else
		{
		fwrite($this->fp, $value);
		}
		
	}
	function CloseFile()
	{
		if($this->use_gzip)
		{
		gzclose($this->fp);
		}
		else
		{
		fclose($this->fp);	

		}
		


	}
	function Download()
	{
		if($this->use_gzip)
		{
		$ext="gz";
		}
		else
		{
		$ext="bak";
		}
		$file = $this->GetFileName();

		//if($this->ada_data)
		{

//			if (file_exists($file)) 
			{

				header('Content-Description: File Transfer');
				header('Content-Type: application/octet-stream');
				header('Content-Disposition: attachment; filename='.$this->nama_simpan.".{$ext}");
				header('Content-Transfer-Encoding: binary');
				header('Expires: 0');
				header('Cache-Control: must-revalidate');
				header('Pragma: public');
				header('Content-Length: ' . filesize($file));
				ob_clean();
				flush();
				readfile($file);
				exit;
			}
		}	
	}
	function Execute($fname = '')
	{	
		$this->tempnama=$fname;
		if(strlen($fname)==0)
		{
			$this->tempnama=$this->nama_default;
		}
		ob_start();
		$this->_Proses();
		//$this->_Transaksi();
		echo '/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */'.MSB_END . MSB_NL;
		echo '/*!40101 SET SQL_MODE=@OLD_SQL_MODE */'.MSB_END . MSB_NL;
		echo '/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */'.MSB_END . MSB_NL;
		echo '/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */'.MSB_END . MSB_NL;
		echo '/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */'.MSB_END . MSB_NL;
		echo '/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */'.MSB_END . MSB_NL;
		echo '/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */'.MSB_END . MSB_NL;
		echo '/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */'.MSB_END . MSB_NL;
		$value=ob_get_clean();
		$this->OpenFile();
		$this->WriteFile($value);
		$this->CloseFile();
	}
  
	function _Connect()
	{	$value = false;
		if (!$this->connected)
		{	if($is_port)
			{	$host = $this->server . ':' . $this->port;
			}
			$this->link_id = mysqli_connect($host, $this->username, $this->password);
		}
		if ($this->link_id)
		{	if (empty($this->database))
			{	$value = true;
			}
			elseif ($this->link_id !== -1)
			{	$value = mysqli_select_db($this->link_id, $this->database );
			}
			else
			{	$value = mysqli_select_db($this->database);
			}
		}
		if (!$value)
		{	$this->error = mysqli_error();
			die($this->error);
		}
		return $value;
	}
	
	function _Query($sql)
	{	
	
		if ($this->link_id !== -1)
		{	
			$result = mysqli_query($this->link_id, $sql);
			if(!$result)
			{
			die(mysqli_error($this->link_id));
			}
		}
		else
		{	$result = mysqli_query($sql);
		}
		if (!$result)
		{	$this->error = mysqli_error($this->link_id);
		}
		return $result;
	}
	
	function _MultiQuery($sql)
	{
		if ($this->link_id !== -1)
		{	
			$result = mysqli_multi_query($this->link_id, $sql);
			if(!$result)
			{
			die(mysqli_error($this->link_id));
			}
		}
		else
		{	$result = mysqli_multi_query($sql);
		}
		if (!$result)
		{	$this->error = mysqli_error($this->link_id);
		}
		while (mysqli_next_result($this->link_id)) {;}
		
		return $result;	
	}
	
	function _GetTables()
	{	$value = array();
		
		if (!($result = $this->_Query("show full tables where Table_Type = 'BASE TABLE'")))
		{	return false;
		}
		while ($row = mysqli_fetch_row($result))
		{	if (empty($this->tables) || in_array($row[0], $this->tables))
			{	$value[] = $row[0];
			}
		}
		
		if (!($result = $this->_Query("show full tables where Table_Type = 'VIEW'")))
		{	return false;
		}
		while ($row = mysqli_fetch_row($result))
		{	if (empty($this->tables) || in_array($row[0], $this->tables))
			{	$value[] = $row[0];
			}
		}
		
		if (!sizeof($value))
		{	$this->error = 'No tables found in database.';
			return false;
		}
		return $value;
	}
	
	
	function _DumpTable($table)
	{	$is_tables = true;
		$is_views = false;
		//$value = '';
		/*
		$sql_lock='LOCK TABLES ' . $table . ' WRITE';
		//LOCK TAMBAHAN roemly
		if(count($this->lock_khusus[$table])>0)
		{
			foreach($this->lock_khusus[$table] as $id => $namatable)
			{
			$sql_lock.=",$namatable";
			}
		}
		
		$this->_Query($sql_lock);
		*/
		$result = $this->_Query('SHOW CREATE TABLE ' . $table);
		if (!$result)
		{	return false;
		}
		$row = mysqli_fetch_array($result);
		if($row['Create View'])
		{	$is_tables = false;
			$is_views = true;
		}
		
		if ($this->comments)
		{	echo '#' . MSB_NL;
			if($is_tables)
			{	echo '# Table structure for table `' . $table . '`' . MSB_NL;
			}
			if($is_views)
			{	echo '# View structure for view `' . $table . '`' . MSB_NL;
			}
			echo '#' . MSB_NL . MSB_NL;
		}
		if ($this->drop_table[$table])
		{	if($is_tables)
			{	echo 'DROP TABLE IF EXISTS `' . $table . '`'.MSB_END . MSB_NL;
			}
			
		
		if($is_views)
		{	if($this->stand_in_view and $this->drop_table[$table])
			{	echo 'DROP TABLE IF EXISTS `' . $table . '`'.MSB_END . MSB_NL;
			}
			echo 'DROP VIEW IF EXISTS `' . $table . '`'.MSB_END . MSB_NL;
		}
		$syntaxcreate = str_replace("\n", MSB_NL, $row[1]);
		$syntaxcreate = str_ireplace("CREATE TABLE", "CREATE TABLE IF NOT EXISTS", $syntaxcreate);
		
		if(substr_count($syntaxcreate, "auto_increment")>0)
		{	$syntaxcreate .= " AUTO_INCREMENT=1 ";
		}
		
		
		if($is_tables)
		{	
			echo str_replace("\n", MSB_NL, $syntaxcreate) . MSB_END;
		}
		elseif($is_views)
		{
			echo str_replace("\n", MSB_NL, $syntaxcreate) . MSB_END;
		}
		}
		//$value .= MSB_NL;
		//$this->WriteFile($value);
		//$value="";
		if (!$this->struct_only and !$is_views)
		{	if ($this->comments)
			{	echo '#' . MSB_NL;
				echo '# Dumping data for table `' . $table . '`' . MSB_NL;
				echo '#' . MSB_NL . MSB_NL;
				//$this->WriteFile($value);
				//$value="";
			}
			
			 $this->_GetInserts($table);
			
		}
		
		
		echo MSB_NL . MSB_NL;
		
	}
	function _GetInsertsQuery($query,$table)
	{	
		
		
		
		$result = $this->_Query($query);
		
		if (!$result )
		{	
		die($table.":gagal");
		}
		
		
		if (mysqli_num_rows($result)> 0)
		{	
			
		$this->ada_data=true;
			echo MSB_NL;
		//	$value.='/*!40000 ALTER TABLE `'.$table.'` DISABLE KEYS */;' . MSB_NL;
			while ($row = mysqli_fetch_assoc($result))
			{	$values = '';
			
				foreach ($row as $i =>$data)
				{	$values .= ($data==''?'NULL, ':'\'' . addslashes($data) . '\', ');
				$row[$i]=addslashes($data);
				}
				$values = substr($values, 0, -2);
				
				echo  'REPLACE INTO ' . $table . ' VALUES (' . $values . ')';
				echo MSB_END . MSB_NL;
				
				//$this->WriteFile($value);
				//$value="";
				
			}
		//	$value .='/*!40000 ALTER TABLE `'.$table.'` ENABLE KEYS */;' . MSB_NL;
		}

		
		
		//$this->WriteFile($value);
	//	return $value;
	}
	function _GetInserts($table)
	{	
		
		$query='SELECT * FROM ' . $table;
		
		$result = $this->_Query($query);
		
		if (!$result )
		{	
		die($table.":gagal");
		}
		
		
		if (mysqli_num_rows($result)> 0)
		{	
			
		$this->ada_data=true;
			echo MSB_NL;
		//	$value.='/*!40000 ALTER TABLE `'.$table.'` DISABLE KEYS */;' . MSB_NL;
			while ($row = mysqli_fetch_assoc($result))
			{	$values = '';
			
				foreach ($row as $i =>$data)
				{	$values .= ($data==''?'NULL, ':'\'' . addslashes($data) . '\', ');
				$row[$i]=addslashes($data);
				}
				$values = substr($values, 0, -2);
				
				echo  'REPLACE INTO ' . $table . ' VALUES (' . $values . ')';
				echo MSB_END . MSB_NL;
				
				//$this->WriteFile($value);
				//$value="";
				
			}
		//	$value .='/*!40000 ALTER TABLE `'.$table.'` ENABLE KEYS */;' . MSB_NL;
		}

		
		
		//$this->WriteFile($value);
	//	return $value;
	}
	
	function _Proses()
	{	echo '';

		if (!$this->_Connect())
		{	return false;
		}
		
		if($this->comments)
		{	echo '#' . MSB_NL;
			echo '# MySQL database dump' . MSB_NL;
			echo '#' . MSB_NL;
			echo '# Host: ' . $this->server . MSB_NL;
			echo '# Generated: ' . date('M j, Y') . ' at ' . date('H:i') . MSB_NL;
			echo '# MySQL version: ' . mysqli_get_server_info($this->link_id) . MSB_NL;
			echo '# PHP version: ' . phpversion() . MSB_NL;
			if (!empty($this->database))
			{	echo '#' . MSB_NL;
				echo '# Database: `' . $this->database . '`' . MSB_NL;
			}
			echo '#' . MSB_NL . MSB_NL . MSB_NL;
		}
		//pasang tanda pengenal file import
		echo MSB_TANDA.MSB_NL;
		//end pasang tanda pengenal file import
		echo '/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */'.MSB_END . MSB_NL;
		echo '/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */'.MSB_END . MSB_NL;
		echo '/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */'.MSB_END . MSB_NL;
		echo '/*!40101 SET NAMES utf8 */'.MSB_END . MSB_NL;
		echo '/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */'.MSB_END . MSB_NL;
		echo '/*!40103 SET TIME_ZONE=\'+00:00\' */'.MSB_END . MSB_NL;
		echo '/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */'.MSB_END . MSB_NL;
		echo '/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */'.MSB_END . MSB_NL;
		echo '/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE=\'NO_AUTO_VALUE_ON_ZERO\' */'.MSB_END . MSB_NL;
		echo '/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */'.MSB_END . MSB_NL;
		echo MSB_NL . MSB_NL;
	
		
		
		if (!($queries = $this->queries))
		{	return false;
		}
		
		
		
		foreach ($queries as $table =>$query)
		{	
			$this->_GetInsertsQuery($query,$table);
		}
		
		
	}
	
	
	function _CreateStandInView()
	{	$value = '';
		$result = $this->_Query('SHOW TABLE STATUS where Engine is null ');
		if (!$result )
		{	return false;
		}
		if (mysqli_num_rows($result) == 0)
		{	return $value;
		}
		$backtables = $this->_GetTables();
		while ($row = mysqli_fetch_row($result))
		{	$table = $row[0];
			if(in_array($table, $backtables))
			{	if ($this->comments)
				{	$value .= '#' . MSB_NL;
					$value .= '# Temporary table structure for view `' . $table . '`' . MSB_NL;
					$value .= '#' . MSB_NL. MSB_NL;
				}
				$value .= 'DROP TABLE IF EXISTS `' . $table . '`'.MSB_END . MSB_NL;
				$value .= 'DROP VIEW IF EXISTS `' . $table . '`'.MSB_END . MSB_NL;
				$value .= 'CREATE TABLE `' . $table . '` (' ;
			
				$result_fields = $this->_Query('DESCRIBE `' . $table . '`');
				$list_fields = '';
				while ($row_fields = mysqli_fetch_row($result_fields))
				{	$list_fields .= "`".$row_fields[0]."` ".$row_fields[1].", ". MSB_NL;
				}
				if(strlen($list_fields)>0)
				{	$list_fields = substr($list_fields, 0,-(2+strlen(MSB_NL)));
				}
				$value .= $list_fields ;
				$value .= ')'.MSB_END ;
				$value .= MSB_NL.MSB_NL;
				$this->WriteFile($value);
			}
			$value="";
		}
		
		return $value;
	}
	function Restore($fname)
	{
	/*  parameter input fname langsung dari input
	 * 	$fname=$_FILES['sqlfile']['tmp_name'];
	 *  note: restore hanya menerima .gz
	 */	
	
	if (!$this->_Connect())
	{	return false;
	}
	mysqli_autocommit ($this->link_id,false );
	$sukses = true;
	$ambilsisanya="";
	$perbaca=10000;
	$sfp=gzopen($fname,"rb");

	$cekasli=gzread($sfp,strlen(MSB_TANDA));
	if($cekasli!=MSB_TANDA)
	{
		$sukses=false;
		$this->message.="FILE SALAH \n";
	}
	
	while ($string = gzread($sfp,$perbaca) and $sukses) 
	{
		$templine="";
		$last=strripos($string,MSB_END);
		if(strlen($ambilsisanya)>0)
		{
				$templine.=$ambilsisanya;
				$ambilsisanya="";
		}
		//ambil posisi awal karakter delimiter(MSB_END) + panjang delimiter(MSB_END) 
		$lastposition=$last+strlen(MSB_END);
		$templine.=substr($string,0,$lastposition);
		$ambilsisanya=substr($string,$lastposition);
	
		
		if(strlen($templine)>0 and $last)
		{
			set_time_limit(30);
			//replace delimiter dari konstanta MSB_END menjadi ; sebelum di eksekusi
			$templine=str_replace(MSB_END,";",$templine);
			$sukses=$this->_MultiQuery($templine);
		}
		else
		{
		$ambilsisanya=$templine.$ambilsisanya;
		}
	}
	
	if(!$sukses)
	{
		mysqli_rollback($this->link_id);
		$this->message.="Gagal Restore \n";
		$sukses=false;
	}
	else
	{
		mysqli_commit($this->link_id);
	}
	mysqli_autocommit ($this->link_id,true);
	$this->status_commit=$sukses;
	gzclose($sfp);
	return $sukses;
	}
	
	function _Transaksi()
	{
	$tr=array('jual','returjual');
	$lokasi=$this->kode_lokasi_login."_";

	$trperiodetutup=$lokasi."trperiodetutup";
	$trsaldotutup=$lokasi."trsaldotutup";
	// $qry="SELECT Periode FROM $trperiodetutup order by Periode DESC limit 1 ";			
	// $restutup = $this->_Query($qry);
	// $periodetutup="";
	// if (mysqli_num_rows($result)> 0)
	// {
	// $row = mysqli_fetch_row($result)
	// $periodetutup=$row[0];
	// }
	
		foreach($tr as $val)
		{
				$tabel_header=$lokasi."d".$val;
				$tabel_detail=$lokasi."tr".$val;
		
		//describe table header		
		
		$result = $this->_Query('DESCRIBE ' . $tabel_header);
		$field_m=array();
		$i=0;
		while($d=mysqli_fetch_array($result))
		{
		if($d[0]=="IE")
		{
		continue;
		}
		else
		{
		$field_m[]=$d[0];
		}
		}
		
		$field_master=join(",",$field_m).",IE";
		//IE DITARUH BELAKANG
		//end describe
		
		//status jual
		$IEstatus=array("0"=>"1","1"=>"2");
		
		
		foreach($IEstatus as $iawal=>$iset)
		{
		$q="SELECT $field_master FROM $tabel_header WHERE IE='$iawal' ";
		$result1=$this->_Query($q);
		if (!$result1 ){die($tabel_header.":gagal");}
		if (mysqli_num_rows($result1)> 0)
		{
			$this->ada_data=true;
			echo MSB_NL;
			while ($row = mysqli_fetch_row($result1))
			{	
			
				if($iawal==1)
				{
				echo " UPDATE $tabel_header SET IE=2 WHERE NomorTr='".$row['1']."'";
				$this->_Query(" UPDATE $tabel_header SET IE=2 WHERE NomorTr='".$row['1']."'");//update diri sendiri
				echo MSB_END . MSB_NL;
				//$this->WriteFile($value);
				}
				else
				{
				$values = '';
				$skip_1=true;
				$jumdata=count($row)-1;
				$i=0;
				foreach ($row as $data)
				{	
					if($skip_1 or $i==$jumdata)
					{
					$skip_1=false;
					}
					else
					{
					$values .= ($data==''?'NULL, ':'\'' . addslashes($data) . '\', ');
					}
				$i++;	
				}
				$values = substr($values, 0,-2);
				echo ' REPLACE  INTO ' .$tabel_header. ' ('.$field_master.')  VALUES ((SELECT a.IDTr FROM (SELECT IDTr FROM '.$tabel_header.' t WHERE NomorTr="'.$row['1'].'") a),'.$values. ','.$iset.')'.MSB_END . MSB_NL;
				
				//$this->WriteFile($value);
				
				echo ' DELETE FROM ' .$tabel_detail. ' WHERE IDTr IN (SELECT a.IDTr FROM (SELECT IDTr FROM '.$tabel_header.' WHERE NomorTr="'.$row['1'].'") a )'.MSB_END.MSB_NL;
				//$this->WriteFile($value);
				
				//$value="";
					//DETAIL
					
					if(strlen($tabel_detail))
					{
					$q="SELECT t.* FROM $tabel_detail t INNER JOIN $tabel_header d ON t.IDTr=d.IDTr WHERE d.NomorTr='".$row[1]."'";	
					
					$r_detail = $this->_Query($q);
					if (mysqli_num_rows($r_detail)> 0)
					{
						while ($row_detail = mysqli_fetch_row($r_detail))
						{
						$values1 = '';
						$skip_1=true;
							foreach ($row_detail as $detail)
							{	
								if($skip_1)
								{
								$skip_1=false;
								}
								else
								{
								$values1 .= ($detail==''?'NULL, ':'\'' . addslashes($detail) . '\', ');
								}						
							}
							$skip_1=true;
		
							$values1 = substr($values1, 0, -2);
							echo 'INSERT  INTO ' . $tabel_detail . ' VALUES ((SELECT IDTr FROM '.$tabel_header.' WHERE NomorTr="'.$row['1'].'") ,'.$values1 . ')'.MSB_END . MSB_NL;
							//$this->WriteFile($value);
						}
					}
					
					}
					
					//END DETAIL
				}
				//$value="";
				
			}
		}
	//	$this->WriteFile($value);
		}	
		}
		//////////////////dlog//////////
		$dlog=$lokasi."dlog";
		$djual=$lokasi."djual";
		$dreturjual=$lokasi."dreturjual";
		$tabel_log=array("$djual"=>3,"$dreturjual"=>4);
		$IEstatus=array("0"=>"1","1"=>"2");
		foreach($tabel_log as $tabel_tr => $JT)
		{
		foreach($IEstatus as $iawal=>$iset)
		{
		$qlog="SELECT NomorTr,NomorBukti,Tanggal,MataUang,Nominal,JenisLog,JenisTransaksi,Keterangan,IDUbah,WaktuUbah,$iset IE FROM $dlog WHERE IE=$iawal AND JenisTransaksi=$JT";
				
		$result = $this->_Query($qlog);
		if (!$result ){die("dlog :gagal");}
		if (mysqli_num_rows($result)> 0)
		{
			$this->ada_data=true;
			echo MSB_NL;
			while ($row = mysqli_fetch_row($result))
			{
			if($iawal==1)
			{
			echo " UPDATE $dlog  SET IE=2 WHERE NomorTr='".$row['0']."'";
			$this->_Query(" UPDATE $dlog  SET IE=2 WHERE NomorTr='".$row['0']."'");//update diri sendiri
			echo MSB_END . MSB_NL;
			//$this->WriteFile($value);
			}
			else
			{	
			$join_val="'".join("','",$row)."'";
			echo  "REPLACE INTO $dlog (IDLog,NomorTr,NomorBukti,Tanggal,MataUang,Nominal,JenisLog,JenisTransaksi,Keterangan,IDUbah,WaktuUbah,IE) values ((SELECT IDLog FROM $dlog t WHERE NomorTr='".$row['0']."'),$join_val)".MSB_END . MSB_NL;
			//$this->WriteFile($value);
			//$value="";
			
			if($iawal==0)
			{
			echo " DELETE FROM $tabel_tr WHERE NomorTr='".$row['0']."' ".MSB_END . MSB_NL;
			//$this->WriteFile($value);
			//$value="";
			}
			}
			
			}
		}
		}
		
	}
	////////////////rekapsaldo
	$trekapsaldo=$lokasi."trekapsaldo";
	
	$qrekap="SELECT * FROM $trekapsaldo where periode>(SELECT max(periode) FROM $trperiodetutup)";
	//echo " DELETE FROM  $trekapsaldo ".MSB_END . MSB_NL;
	$rrekap = $this->_Query($qrekap);
		if (!$rrekap ){die("saldo rekap :gagal");}
		if (mysqli_num_rows($rrekap)> 0)
		{
			$rsaldo=array();	
			$frontsaldo=" REPLACE INTO  $trekapsaldo VALUES ";
			while($dr=mysqli_fetch_row($rrekap))
			{
				$join_value="'".join("','",$dr)."'";
				$rsaldo[]="($join_value)";
				if(count($rdetail)>100)
				{
				echo $frontsaldo.join(",",$rsaldo).MSB_END.MSB_NL;
				$rsaldo=array();
				}
			}
			if(count($rsaldo)>0)
			{
				echo $frontsaldo.join(",",$rsaldo).MSB_END.MSB_NL;
				$rsaldo=array();
			}
			
		}
	////////////////trperiodetutup
	$IEstatus=array("0"=>"1");
	
	foreach($IEstatus as $iawal=>$iset)
	{
	//////////periode tutup
		$qtup="SELECT Periode,StatusAktif,IDUbah,WaktuUbah,$iset IE FROM $trperiodetutup WHERE IE=$iawal ";
				
		$result = $this->_Query($qtup);
		if (!$result ){die("periodetutup :gagal");}
		if (mysqli_num_rows($result)> 0)
		{
			$this->ada_data=true;
			echo MSB_NL;
			while ($row = mysqli_fetch_row($result))
			{
			$join_val="'".join("','",$row)."'";
			echo "INSERT IGNORE INTO $trperiodetutup (IDPeriode,Periode,StatusAktif,IDUbah,WaktuUbah,IE) values ((SELECT IDPeriode FROM $trperiodetutup t WHERE Periode='".$row['0']."'),$join_val)".MSB_END . MSB_NL;
			
			
			//$this->WriteFile($value);
						
			//$value="";
			
			if($iawal==0)
			{
			$qsaldo="SELECT * FROM $trsaldotutup WHERE Periode='".$row[0]."'";
			
			$rsaldo = $this->_Query($qsaldo);
				if (!$rsaldo ){die("saldo tutup :gagal");}
				if (mysqli_num_rows($rsaldo)> 0)
				{
					$rdetail=array();
					$frontval=" INSERT IGNORE INTO  $trsaldotutup VALUES ";
					while($d=mysqli_fetch_row($rsaldo))
					{
					$join_value="'".join("','",$d)."'";
					$rdetail[]="($join_value)";
						if(count($rdetail)>100)
						{
						echo $frontval.join(",",$rdetail).MSB_END.MSB_NL;
						$rdetail=array();
						}
					//$this->WriteFile($value);
					//$value="";
					}
					if(count($rdetail)>0)
					{
						echo $frontval.join(",",$rdetail).MSB_END.MSB_NL;
						$rdetail=array();
					}
				}
			}
			
			}
		}
		}
	}
	
}
?>
