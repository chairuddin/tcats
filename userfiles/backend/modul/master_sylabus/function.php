<?php
function change_filename($full_file_name,$new_name) {
	$file_parts = pathinfo($full_file_name);
	return $new_name.'.'.$file_parts['extension'];
}
function table_competency(&$inner1,$data=array(),$example=0) {
	$styleTable = array('borderSize' => 6, 'borderColor' => '006699','cellMargin' => 0, 'cellMarginRight' => 0, 'cellMarginBottom' => 3, 'cellMarginLeft' => 3);
	$styleCell = array('valign' => 'top','align' => 'left','spaceAfter' => 0);
	$noSpace = array('spaceAfter' => 0,'spaceBefore' => 0);
	$inner1table=$inner1->addTable($styleTable);
	$inner1table->addRow();
	$inner1table->addCell(800)->addText("Kode",$styleCell,$noSpace);
	$inner1table->addCell(5000)->addText("Kompetensi Dasar",$styleCell,$noSpace);
	if(count($data)>0) {
		foreach($data as $d) {
			$inner1table->addRow();
			$inner1table->addCell(800)->addText($d['code'],$styleCell,$noSpace);
			$inner1table->addCell(5000)->addText($d['content'],$styleCell,$noSpace);
		}
	} else {
		if($example) {	
			$inner1table->addRow();
			$inner1table->addCell(800)->addText("1.1",$styleCell,$noSpace);
			$inner1table->addCell(5000)->addText("Contoh isian kompetensi dasar 1.1",$styleCell,$noSpace);
			$inner1table->addRow();
			$inner1table->addCell(800)->addText("2.1",$styleCell,$noSpace);
			$inner1table->addCell(5000)->addText("Contoh isian kompetensi dasar 2.1 ",$styleCell,$noSpace);
		} else {
			$inner1table->addRow();
			$inner1table->addCell(800)->addText("",$styleCell,$noSpace);
			$inner1table->addCell(5000)->addText(" ",$styleCell,$noSpace);
			$inner1table->addRow();
			$inner1table->addCell(800)->addText("",$styleCell,$noSpace);
			$inner1table->addCell(5000)->addText("",$styleCell,$noSpace);
		}
	}
	$inner1->addText('<w:br/>');
	$inner1->addText('<w:br/>');	
	
}
function table_indicator(&$inner1,$data=array(),$example=0) {
	$styleTable = array('borderSize' => 6, 'borderColor' => '006699','cellMargin' => 0, 'cellMarginRight' => 0, 'cellMarginBottom' => 3, 'cellMarginLeft' => 3);
	$styleCell = array('valign' => 'top','align' => 'left','spaceAfter' => 0);
	$noSpace = array('spaceAfter' => 0,'spaceBefore' => 0);

	$inner1table=$inner1->addTable($styleTable);
	$inner1table->addRow();
	$inner1table->addCell(800)->addText("Kode",$styleCell,$noSpace);
	$inner1table->addCell(5000)->addText("Indikator",$styleCell,$noSpace);
	if(count($data)>0) {
		foreach($data as $d) {
			$inner1table->addRow();
			$inner1table->addCell(800)->addText($d['code'],$styleCell,$noSpace);
			$inner1table->addCell(5000)->addText($d['content'],$styleCell,$noSpace);
		}
	} else {
		if($example) {
			$inner1table->addRow();
			$inner1table->addCell(800)->addText("1.1.1",$styleCell,$noSpace);
			$inner1table->addCell(5000)->addText("Contoh isian indikator 1.1.1",$styleCell,$noSpace);
			$inner1table->addRow();
			$inner1table->addCell(800)->addText("2.1.1",$styleCell,$noSpace);
			$inner1table->addCell(5000)->addText("Contoh isian indikator 2.1.1",$styleCell,$noSpace);
		} else {
			$inner1table->addRow();
			$inner1table->addCell(800)->addText("",$styleCell,$noSpace);
			$inner1table->addCell(5000)->addText("",$styleCell,$noSpace);
			$inner1table->addRow();
			$inner1table->addCell(800)->addText("",$styleCell,$noSpace);
			$inner1table->addCell(5000)->addText("",$styleCell,$noSpace);

		}
	}
	$inner1->addText('<w:br/>');
	$inner1->addText('<w:br/>');	
}
function upload_wordx_trimmer($string){
	
	$string	= strip_tags($string);
	$string = str_replace("&#xD;",'',$string);
	$string	= preg_replace('/\s+/', '', $string);
	$string	= trim($string);
	
	return $string;
}

function upload_wordx_cleaner($string){
	$string = str_replace("&#xD;",'',$string);
	$string = preg_replace('/\s\s+/', ' ', $string);
	$string = trim($string);
	
	return $string;
}
function get_sylabus($id) {
	global $mysql;
	$q=$mysql->query("SELECT id,row,id_master_sylabus,subject,allocation FROM sylabus_detail WHERE id_master_sylabus=$id");
	if($q and $mysql->num_rows($q)>0) {
		while($d=$mysql->fetch_assoc($q)) {
			$silabus[$d['row']]['subject']=$d['subject'];
			$silabus[$d['row']]['allocation']=$d['allocation'];
			$q1=$mysql->query("SELECT code,content FROM sylabus_detail_competency WHERE id_sylabus_detail=".$d['id']);
			if($q1 and $mysql->num_rows($q1)>0) {
				while($d1 = $mysql->fetch_assoc($q1)) {
					$silabus[$d['row']]['competency'][]=array('code'=>$d1['code'],'content'=>$d1['content']);
				}
			}
			
			$q2=$mysql->query("SELECT code,content FROM sylabus_detail_indicator WHERE id_sylabus_detail=".$d['id']);
			if($q2 and $mysql->num_rows($q2)>0) {
				while($d2 = $mysql->fetch_assoc($q2)) {
					$silabus[$d['row']]['indicator'][]=array('code'=>$d2['code'],'content'=>$d2['content']);
				}
			}
		}	
	}
	
	return $silabus;
}
function get_sylabus_identity($id) {
	global $mysql;
	$nama_sekolah = $mysql->get1value("SELECT title_id FROM web_config WHERE name='nama_sekolah'");
	$sql="
	SELECT 
		s.id,
		s.name,
		s.semester,
		s.id_level,
		s.id_lesson,
		s.id_major,
		s.id_teacher,
		s.year,
		l.name level,
		n.name lesson,
		m.name major,
		u.fullname teacher
	FROM 
		master_sylabus s 
	LEFT JOIN
		master_level l ON	s.id_level=l.id
	LEFT JOIN 
		master_lesson n ON s.id_lesson = n.id
	LEFT JOIN
		master_academic_major m ON s.id_major=m.id
	LEFT JOIN
		user u ON s.id_teacher=u.id
	WHERE s.id=$id
	";
	$query_silabus = $mysql->query($sql);
	$data_silabus = $mysql->assoc($query_silabus);


//array(12) { ["id"]=> string(1) "2" ["name"]=> string(12) "SILABUS COBA" ["semester"]=> string(1) "1" ["id_level"]=> string(1) "1" ["id_lesson"]=> string(1) "3" ["id_major"]=> string(1) "1" ["id_teacher"]=> string(1) "0" ["year"]=> string(9) "2020/2021" ["level"]=> string(1) "X" ["lesson"]=> string(5) "AGAMA" ["major"]=> string(3) "IPA" ["teacher"]=> NULL }


	$level=$data_silabus['level'];
	$semester=$data_silabus['semester'];
	$lesson=$data_silabus['lesson'];
	$teacher=$data_silabus['teacher'];
	$year=$data_silabus['year'];
	$major=$data_silabus['major'];
	return array('id'=>$data_silabus['id'],'nama_sekolah'=>$nama_sekolah,'level'=>$level,'semester'=>$semester,'lesson'=>$lesson,'teacher'=>$teacher,'year'=>$year,'major'=>$major);
}
function get_master_competency() {
	global $mysql;
	return $mysql->get_assoc('code','content','master_core_competency'," code asc ") ;
}
function show_sylabus($id) {
global $mysql,$silabus;
if(count($silabus)<=0) {
	$silabus=get_sylabus($id);
}

$data_silabus= get_sylabus_identity($id);

$data_kompentensi = get_master_competency();

$data_identitas = array(
'ID_SILABUS' => $data_silabus['id'],
'Nama Sekolah' => $data_silabus['nama_sekolah'],
'Mata Pelajaran' => $data_silabus['lesson'],
'Kelas/Semester' => $data_silabus['level'].'/'.$data_silabus['semester'],
'Program Studi' => $data_silabus['major'],
'Tahun Ajaran' => $data_silabus['year'],
);

ob_start();
echo '<table border="0" cellspacing="0" cellpadding="3">';
foreach($data_identitas as $label => $value) {
	echo '<tr><td>'.$label.'</td><td>:</td><td>'.$value.'</td></tr>';
}	
echo '</table>';
echo '<br/>';
echo 'Kompetensi Inti';
echo '<table border="0" cellspacing="0" cellpadding="3">';
foreach($data_kompentensi as $label => $value) {
	echo '<tr><td style="width:50px;" valign="top">'.$label.'</td><td valign="top">:</td><td valign="top">'.$value.'</td></tr>';
}	
echo '</table>';

echo '<table border="1" cellspacing="0" cellpadding="5">';
echo '<tr>
		<th>Kompetensi Dasar</th>
		<th>Indikator Pencapaian</th>
		<th>Materi Pokok</th>
		<th>Alokasi Waktu</th>
	</tr>';
foreach($silabus as $baris => $data) {
		
		
		echo '<tr>';
		echo '<td>';
		echo '<table>';
		if(count($data['competency'])>0) {
			foreach($data['competency'] as $x => $dk) {
				echo '<tr><td valign="top" align="left">'.$dk['code'].'</td><td valign="top" align="left">'.$dk['content'].'</td></tr>';
			}
		}
		
		echo '</table>';
		echo '</td>';
		echo '<td>';
		echo '<table>';
		if(count($data['indicator'])>0) {
			foreach($data['indicator'] as $x => $dk) {
				echo '<tr><td valign="top" align="left">'.$dk['code'].'</td><td valign="top" align="left">'.$dk['content'].'</td></tr>';
			}
		}
		
		echo '</table>';
		echo '</td>';
		echo '<td>'.$data['subject'].'</td>';
		echo '<td>'.$data['allocation'].'</td>';
		echo '</tr>';

	 
	}
echo '</table>';	
$pratinjau_silabus=ob_get_clean();	
return $pratinjau_silabus;

}
?>
