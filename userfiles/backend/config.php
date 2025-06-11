<?php

$config['default'] = "app_dashboard";
if ($modul == "") {
	$modul = $config['default'];
}
$lang = "id";
$list_lang = array("id");
$req_lang = array("id" => 0, "en" => 0); /*lang required*/
$lang = in_array($_SESSION['front_lang'], $list_lang) ? $_SESSION['front_lang'] : $lang;
/*WALI KELAS*
berhak mutasi grade siswa
/*END WALI KELAS*/

/*GURU*
guru hanya bisa input soal
* note : belum fix
/*END GURU*/

$id_user = $_SESSION['s_id'] + 0;
$level_user = $_SESSION['s_level'];
$config_wali_kelas = array();
$config_grade = array();
$is_wali_kelas = false;
$config_join_class = "";
//cek apakah wali kelas
$q = $mysql->query("SELECT class FROM quiz_wali_kelas WHERE id_user=$id_user ");
if ($q and $mysql->num_rows($q) > 0) {
	while ($d = $mysql->fetch_assoc($q)) {
		$config_wali_kelas[] = $d['class'];
		$is_wali_kelas = true;
	}
	//grade yang dipegang
	if (count($config_wali_kelas) > 0) {
		$config_join_class = "'" . join("','", $config_wali_kelas) . "'";
		$q = $mysql->query("SELECT grade FROM quiz_member WHERE class IN ($config_join_class) GROUP BY class ");
		if ($q and $mysql->num_rows($q) > 0) {
			while ($d = $mysql->fetch_assoc($q)) {
				$config_grade[] = $d['grade'];
				$is_wali_kelas = true;
			}
		}
		$config_join_grade = "'" . join("','", $config_grade) . "'";
	}
}






$r_modul["decoration"] = "Logo";
$r_modul["menu_layout"] = "Atur Layout";
$r_modul["footer_layout"] = "Atur Layout Footer";
$r_modul["quiz_ongoing"] = "Antrian ujian";
$r_modul["quiz_result"] = "Arsip";
$r_modul["quiz_master"] = "Master Soal";
$r_modul["quiz_member"] = "Peserta Ujian";
$r_modul["quiz_schedule"] = "Jadwal ujian";
$r_modul["quiz_tryout"] = "Buat ujian";
$r_modul["quiz_tryout_result"] = "Hasil ujian";
$r_modul["web_config"] = "Konfigurasi";
$r_modul["quiz_schedule"] = "Jadwal ujian";
$r_modul["template_option"] = "Warna Tema";
$r_modul["quiz_upload_wordx"] = "Upload Soal (docx)";
$r_modul["quiz_upload_msword"] = "Upload Soal (docx)";
//$r_modul["quiz_realtime"]="Ujian";


$form_title = $r_modul[$modul];
