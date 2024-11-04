
<?php
if($action=="") {
    //periode data ujian
    $request_date1=$_REQUEST['date1']=$_REQUEST['date1']==""?date("01/m/Y"):$_REQUEST['date1'];
    $request_date2=$_REQUEST['date2']=$_REQUEST['date2']==""?date("d/m/Y"):$_REQUEST['date2'];

   
    list($xd,$xm,$xy)=explode("/",$_REQUEST['date1']);
	$date1="$xy-$xm-$xd";
	
	list($xd,$xm,$xy)=explode("/",$_REQUEST['date2']);
	$date2="$xy-$xm-$xd";
	
	

	$sql="

	SELECT 
		s.title,count(q.id) jumlah,q.course_material_id material_id
	FROM
		app_quiz_done q
    LEFT JOIN 
		app_course_material m ON q.course_material_id=m.id
	LEFT JOIN 
		app_course_sub s ON m.course_sub_id=s.id
    WHERE 
    	date_format(q.start_time,'%Y-%m-%d') 
    BETWEEN '$date1' 
    AND '$date2' 
    AND m.quiz_type='posttest'
	AND q.is_void=0
	GROUP BY q.course_material_id
	
	";
	
	/*
    $periode_data_ujian=$mysql->sql_get_assoc("
	SELECT quiz_title_id,count(id) jumlah,quiz_id  FROM app_quiz_done WHERE date_format(start_time,'%Y-%m-%d') BETWEEN '$date1' AND '$date2' GROUP BY course_material_id 
	");
	*/
	
    $periode_data_ujian=$mysql->sql_get_assoc($sql);
	
    
    //10 ujian terakhir
	/*
	$sql2="
	SELECT s.title,q.member_code,q.member_fullname,q.end_time
	FROM 
		app_quiz_done q
    LEFT JOIN 
		app_course_material m ON q.course_material_id=m.id
	LEFT JOIN 
		app_course_sub s ON m.course_sub_id=s.id
    WHERE 
    	date_format(q.start_time,'%Y-%m-%d') 
    BETWEEN '$date1' 
    AND '$date2' 
    AND m.quiz_type='posttest'
	ORDER BY q.id DESC
	LIMIT 10
	";
	*/
	$sql2="
	SELECT 
    q.*,
    (sum(kd.score)/count(kd.id_quiz_done)) avg_score,sub.title
    FROM 
    app_quiz_done q
    LEFT JOIN app_course_material m ON q.course_material_id=m.id
	LEFT JOIN app_course_sub sub ON sub.id=m.course_sub_id
    LEFT JOIN app_quiz_done_kd kd on kd.id_quiz_done=q.id
    WHERE 
    date_format(q.start_time,'%Y-%m-%d') 
    BETWEEN '$date1' 
    AND '$date2' 
    AND m.quiz_type='posttest'
    AND q.is_void=0
    GROUP BY q.id
    ORDER BY q.end_time DESC
	LIMIT 10
	";
    $data_ujian=$mysql->sql_get_assoc($sql2);


	//antrian ujian ulang
	$data_ujian_ulang=$mysql->sql_get_assoc(" 
	SELECT r.id,r.member_id,m.fullname,m.username,cs.title,r.created_at,quiz_done_id,(select count(id) FROM app_quiz_request WHERE member_id=r.member_id AND course_material_id=r.course_material_id AND approved_by>0)  retake
	FROM app_quiz_request r 
	LEFT JOIN quiz_member m ON m.id=r.member_id
	LEFT JOIN app_course_material cm ON cm.id=r.course_material_id
	LEFT JOIN app_course_sub cs ON cs.id=cm.course_sub_id
	WHERE r.approved_by=0 AND r.disapprove_by=0
	");

	$r_quiz_done=array();
	foreach($data_ujian_ulang as $i =>$data) {
		$r_quiz_done[]=$data['quiz_done_id'];
	}


	$score_ujian_ulang=array();
	$status_ujian_ulang=array();
	if(count($r_quiz_done)>0 ) {

	
		$join_quiz_done="'".join("','",$r_quiz_done)."'";
		$sql_ujian_ulang="
		SELECT 
		q.*,
		(sum(kd.score)/count(kd.id_quiz_done)) avg_score,sub.title
		FROM 
		app_quiz_done q
		LEFT JOIN app_course_material m ON q.course_material_id=m.id
		LEFT JOIN app_course_sub sub ON sub.id=m.course_sub_id
		LEFT JOIN app_quiz_done_kd kd on kd.id_quiz_done=q.id
		WHERE 
		q.id IN ($join_quiz_done)
		AND m.quiz_type='posttest'
		AND q.is_void=0
		GROUP BY q.id
		LIMIT 10
		";
		$data_ujian=$mysql->sql_get_assoc($sql2);
		foreach($data_ujian as $i => $d) {
			$score_ujian_ulang[$d['id']]=$d['avg_score'];
			$status_ujian_ulang[$d['id']]=($d['avg_score']<$d['kkm'])?'Tidak Kompeten':'Kompeten';
		}
	}

	

}

if($action=="data") {
	
	$category_id=$_GET['category_id'];	
	$column_order = array('a.id','a.title','c.title');
	$column_search = array('a.title','c.title','m.fullname','m.email','m.wa');
	$order = array('a.id' => 'DESC');
	$is_paid=$_GET['is_paid']=='unpaid'?'0':'1';
	if(isset($_POST['order'])) { // here order processing
		$order_by = " ORDER BY {$column_order[$_POST['order']['0']['column']]} {$_POST['order']['0']['dir']}";
	} else {
		$order = $order;
		
		$order_by = " ORDER BY id DESC ";
	}
	if ($_POST['length'] != -1 AND $_POST['length']!="") {
		$where_limit = "LIMIT {$_POST['start']}, {$_POST['length']}";
	}
	$i = 0;
	$sql_search=array();
	foreach ($column_search as $item) { // loop column 
		
		if($_POST['search']['value']) { // if datatable send POST for search
			
			$sql_search[]= " $item LIKE '%{$_POST['search']['value']}%' ";
		}
		$i++;
	}
	
	if(count($sql_search)>0){
	$sql_r[]=" ".join(" OR ",$sql_search)." ";
	}
	
	$sql=" 
	SELECT 
		a.id,
		a.title,
        a.created_date,
		a.total,
		a.category_id,
		c.title category,
		a.is_paid,
        a.time_limit,
        m.fullname,m.email
	FROM 
		app_order a
	LEFT JOIN app_category c ON c.id=category_id
    LEFT JOIN quiz_member m ON m.id=a.member_id
		";
	
	$sql.=" WHERE 1=1 AND a.is_paid='$is_paid' ";

	if(count($sql_r)>0){
		$sql.=" AND  (".join(" OR ",$sql_r).") ";
	}
	
	$result_total = $mysql->query($sql);
	$total=$mysql->num_rows($result_total);
	$sql .= " $order_by $where_limit";
	
	$result = $mysql->query($sql);
	
	$data = array();
	

	$gotopage = $_POST['start']/$_POST['length'];
	$no = $_POST['start'];
	while($d = $mysql->fetch_assoc($result)) {
		$no++;
		$row = array();
		
		$row[]=$no;
        $row[]=$d['created_date'];
        $row[]=$d['fullname'];
        $row[]=$d['title'];
		$row[]=$d['category'];
        $row[]=$d['is_paid']==0?'<span  class="badge badge-danger">Belum bayar</span>':'<span class="badge badge-success">Lunas</span>';
		$row[]=currency($d['total']);
        $row[]=$d['time_limit']==0?'Unlimited':$d['time_limit'].' Bulan';
		
        
		$action_edit='<a class="btn btn-success" href="'.backendurl("$modul/edit/".$d['id']).'"><i class="fas fa-check" aria-hidden="true"></i></a>';
		$action_delete='<a class="btn btn-danger"  title="Hapus order"
				data-toggle="modal" 
				data-target="#modal-default" 
				data-title="Hapus data" 
				data-body="Apakah anda yakin ingin menghapus data ini?"
				data-btn2=""
				data-btn2name=""
				data-btn1="'.backendurl("$modul/del/".$d['id']).'"
				data-btn1name="Hapus"
				>
				<i class="fas fa-trash"></i>
		</a>';
		
		$row[]='<div class="btn-group">'.$action_info.$action_edit.$action_delete.'</div>';
		
		$data[] = $row;
	}
	
	
	$output = array(
		"draw" => $_POST['draw'],
		"recordsTotal" => $total,
		"recordsFiltered" => $total,
		"data" => $data
	);
	die(json_encode($output));
}
?>