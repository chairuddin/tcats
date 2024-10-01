<?php
class User  {
	
	public function get_cabang_login() {
		return $_SESSION['s_cabang'];
	}
	public function get_data_cabang() {
		global $mysql;
		$cabang_login = get_cabang_login();
		$data_cabang = array();
		if(count($cabang_login)>0) {
			$id_cabang = join(",",$cabang_login);
			$q = $mysql->query("SELECT id,nama FROM master_cabang WHERE id IN ($id_cabang)");
			if($q and $mysql->num_rows($q)) {
				while ($d = $mysql->fetch_assoc($q)) {
					$data_cabang[$d['id']]=$d['nama'];
				}
			}
		} 
		
		return $data_cabang;
		
	}
}
?>
