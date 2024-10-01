function update_quiz_select(quiz_id) {
	datapost="quiz_id="+quiz_id;
	
	$.ajax({
				type: 'POST',
				url: '<<<THISURL>>>ajax/quiz_info',
				data: datapost,
				error: function() {
				},
				success: function(data) {
					$("#quiz_info").html(data);
				}
	
			});
}	
function set_kadaluarsa(){
	quiz_id=$("#quiz_id").val();
	exam_date=$("#exam_date").val();
	exam_time=$("#exam_time").val();
	datapost="quiz_id="+quiz_id+"&exam_date="+exam_date+"&exam_time="+exam_time;

	$.ajax({
			type: 'POST',
			url: '<<<THISURL>>>ajax/set_kadaluarsa',
			data: datapost,
			error: function() {
			},
			success: function(data) {
				$("#exam_time_expired").val(data);
			}

		});
		
		
	
}
$(function() {

	console.log('OK_011216');
	$("#div_kadaluarsa").hide();
	cek=$("#is_late").prop("checked");
	if(cek==false){
		$("#div_kadaluarsa").show();	
	}	
	$("#exam_date,#exam_time,#exam_date_expired,#exam_time_expired,.class_all,.class_select").focus(function(){
		quiz_id=$("#quiz_id").val();
		if(quiz_id==""){
			$("#quiz_id").focus();
			alert("Pilih soal uji terlebih dahulu");
			return false;
		}
	})
	$("#is_late").click(function(){	
		quiz_id=$("#quiz_id").val();
		if(quiz_id==""){
			$("#quiz_id").focus();
			alert("Pilih soal uji terlebih dahulu");
			return false;
		}
		cek=$(this).prop("checked");
		if(cek==true){
		$("#div_kadaluarsa").hide();	
		}else{
		$("#div_kadaluarsa").show();	
		}
		set_kadaluarsa();
	});
	
	
	$(".class_all").click(function(){
		cek=$(this).prop("checked");
		if(cek==true){
		$(".class_select").prop("checked",true);	
		}else{
		$(".class_select").prop("checked",false);		
		}
	});
	
	;

});
