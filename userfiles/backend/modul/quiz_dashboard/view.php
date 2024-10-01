   <div class="card">
              <div class="card-header">
                <h3 class="card-title">Browser Usage</h3>

                <div class="card-tools">
                  <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i>
                  </button>
                  <button type="button" class="btn btn-tool" data-card-widget="remove"><i class="fas fa-times"></i>
                  </button>
                </div>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <div class="row">
                  <div class="col-md-8">
                    <div class="chart-responsive">
                      <canvas id="pieChart" height="150"></canvas>
                    </div>
                    <!-- ./chart-responsive -->
                  </div>
                  <!-- /.col -->
                  <div class="col-md-4">
                    <ul class="chart-legend clearfix">
                      <li><i class="far fa-circle text-danger"></i> Chrome</li>
                      <li><i class="far fa-circle text-success"></i> IE</li>
                      <li><i class="far fa-circle text-warning"></i> FireFox</li>
                      <li><i class="far fa-circle text-info"></i> Safari</li>
                      <li><i class="far fa-circle text-primary"></i> Opera</li>
                      <li><i class="far fa-circle text-secondary"></i> Navigator</li>
                    </ul>
                  </div>
                  <!-- /.col -->
                </div>
                <!-- /.row -->
              </div>
              <!-- /.card-body -->
              <div class="card-footer bg-white p-0">
                <ul class="nav nav-pills flex-column">
                  <li class="nav-item">
                    <a href="#" class="nav-link">
                      United States of America
                      <span class="float-right text-danger">
                        <i class="fas fa-arrow-down text-sm"></i>
                        12%</span>
                    </a>
                  </li>
                  <li class="nav-item">
                    <a href="#" class="nav-link">
                      India
                      <span class="float-right text-success">
                        <i class="fas fa-arrow-up text-sm"></i> 4%
                      </span>
                    </a>
                  </li>
                  <li class="nav-item">
                    <a href="#" class="nav-link">
                      China
                      <span class="float-right text-warning">
                        <i class="fas fa-arrow-left text-sm"></i> 0%
                      </span>
                    </a>
                  </li>
                </ul>
              </div>
              <!-- /.footer -->
            </div>
            <!-- /.card -->

			<div class="container-fluid">
				<div class="row-fluid">
					<div class="span12">
						<div class="box box-color box-bordered lightred">
							<div class="box-title">
								<h3>
									<i class="icon-reorder"></i>
									Dashboard Ujian
								</h3>
							</div>
							<div class="box-content" id="ujian_realtime">
								<?php
								//cek sedang ujian  
								$hariini_long=date("Y-m-d H:i:s");
								$kondisi=" AND is_deleted=0 ";
								
								$q=$mysql->query("SELECT * FROM quiz_schedule WHERE id='$id'");
								if($q and $mysql->numrows($q)>0){
									
									$realtime_array=array();
									while($d=$mysql->assoc($q)){
										$r_quiz_info=json_decode($d['quiz_info'],true);
										
										$total_siswa="";
										if($d['allow_class']=="ALL")
										{
										$total_peserta=$mysql->get1value("SELECT IFNULL(COUNT(id),0) FROM quiz_member");
										$belum_ujian=$mysql->get1value("
										SELECT IFNULL(COUNT(id),0) FROM quiz_member 
										WHERE 
										id NOT IN(SELECT member_id FROM quiz_done WHERE schedule_id=".$d['id'].")");
										}
										else
										{
										$join_class=explode(",",$d['allow_class']);
										$join_class="'".join("','",$join_class)."'";
										$total_peserta=$mysql->get1value("SELECT IFNULL(COUNT(id),0) FROM quiz_member WHERE class IN ($join_class) ");
										$belum_ujian=$mysql->get1value("
										SELECT IFNULL(COUNT(id),0) FROM quiz_member 
										WHERE 
										id NOT IN(SELECT member_id FROM quiz_done WHERE schedule_id=".$d['id']." AND member_class IN ($join_class)) AND class IN ($join_class) ");										
										}
										
										$sedang_ujian=$mysql->get1value("SELECT IFNULL(COUNT(id),0) FROM quiz_done WHERE (is_done=0) AND schedule_id=".$d['id']);
										$reset_ujian=$mysql->get1value("SELECT IFNULL(COUNT(id),0) FROM quiz_done WHERE (is_done=3) AND schedule_id=".$d['id']);
										$sudah_ujian=$mysql->get1value("SELECT IFNULL(COUNT(id),0) FROM quiz_done WHERE is_done=1 AND schedule_id=".$d['id']);
										$realtime_array[$d['id']]=array("be"=>$belum_ujian,"re"=>$reset_ujian,"se"=>$sedang_ujian,"su"=>$sudah_ujian);
										$p_belum_ujian=round(($belum_ujian/$total_peserta)*100,1);
										$p_reset_ujian=round(($reset_ujian/$total_peserta)*100,1);
										$p_sedang_ujian=round(($sedang_ujian/$total_peserta)*100,1);
										$p_sudah_ujian=round(($sudah_ujian/$total_peserta)*100,1);
										
										$tanggal_ujian=date("Y-m-d",strtotime($d['tanggal']));
										$tanggal_expired=date("Y-m-d",strtotime($d['tanggal_expired']));
										
										echo "<div class=\"realtime-box\">";
										echo "<div class=\"realtime_title\">";
										$hari_sama=$tanggal_ujian==$tanggal_expired?1:0;
										if($hari_sama==1)
										{
											echo "<span class='realtime-limit-child'><i class='glyphicon-stopwatch'></i>
											".date("H:i",strtotime($d['tanggal']))." - ".date("H:i",strtotime($d['tanggal_expired'])).
											"</span>";
										}
										else
										{
											echo "<span class='realtime-limit-child'><i class='glyphicon-stopwatch'></i>
											".date("H:i",strtotime($d['tanggal']))." - ".tgl_indo(date("Y-m-d",strtotime($d['tanggal']))).
											"</span>";
											echo "<span class='realtime-limit-child'><i class='glyphicon-stopwatch'></i>
											".date("H:i",strtotime($d['tanggal_expired']))." - ".tgl_indo(date("Y-m-d",strtotime($d['tanggal_expired']))).
											"</span>";
										}
										echo "<span class='realtime-title-child'>[&nbsp;".$d['token']." ]&nbsp;".$r_quiz_info['code']." ".$r_quiz_info['title_id']."</span>";
										
										echo "</div>";		
										echo "
										<ul class=\"tiles tiles-center nomargin\">
											<li class=\"lightgrey has-chart\">
												<a href=\"".backendurl("quiz_realtime/?filter=belum_ujian&schedule_id=".$d['id'])."\"><span><div class=\"chart\" data-percent=\"$p_belum_ujian\" data-color=\"#ffffff\" data-trackcolor=\"#333333\">$p_belum_ujian%</div></span><span class='name indikator'>Belum Ujian $belum_ujian/$total_peserta</span></a>
											</li>
											<li class=\"blue has-chart\">
												<a href=\"".backendurl("quiz_ongoing/?filter=sedang_ujian&schedule_id=".$d['id'])."\"><span><div class=\"chart\" data-percent=\"$p_sedang_ujian\" data-color=\"#ffffff\" data-trackcolor=\"#5facf3\">$p_sedang_ujian%</div></span><span class='name indikator'>Sedang Ujian</br>$sedang_ujian</span></a>
											</li>
											<li class=\"orange has-chart\">
												<a href=\"".backendurl("quiz_ongoing/?filter=pending&schedule_id=".$d['id'])."\"><span><div class=\"chart\" data-percent=\"$p_sudah_ujian\" data-color=\"#ffffff\" data-trackcolor=\"#FEEB67\">$p_reset_ujian%</div></span><span class='name indikator'>Pending</br>$reset_ujian</span></a>
											</li>
											<li class=\"orange has-chart\">
												<a href=\"".backendurl("quiz_ongoing/?filter=sudah_ujian&schedule_id=".$d['id'])."\"><span><div class=\"chart\" data-percent=\"$p_sudah_ujian\" data-color=\"#ffffff\" data-trackcolor=\"#f96d6d\">$p_sudah_ujian%</div></span><span class='name indikator'>Sudah Ujian $sudah_ujian/$total_peserta</span></a>
											</li>
										</ul>";
										$d['allow_class']=explode(",",$d['allow_class']);
										$d['allow_class']=join(", ",$d['allow_class']);	
										echo "<div class=\"allow_class\">Kelas: ".$d['allow_class']."</div>";	
										echo "</div>";	
									}
									$realtime_array=json_encode($realtime_array);
									echo "<input id=\"realtime_hidden\" type=\"hidden\" value='$realtime_array' />";
								}else{
								echo '
								<div class="alert alert-info">
											<button type="button" class="close" data-dismiss="alert">×</button>
											<strong>Info!</strong> Tidak ada ujian yang aktif
										</div>
								';	
								
								}
								
								?>
							
								
							</div>
						</div>
					
					</div>
					
				</div>
				
			</div>

<br/>


<?php

$data_awal=join(",",$r_data_awal);
$style_css.=<<<END
<style>
.realtime-title-child {
  display: block;
  font-size: 12px;
  font-weight: bold;
  padding-top:5px;
}
.class_follow {
  padding-left: 8px;
}
.hariinni-title-child {
  display: block;
  height:28px;
  clear: both;
}
.hariinni-limit-child > span {
  display: block;
  width: 139px;
}


.allow_class {
  margin-left: 8px;
}
.realtime_title {
  margin-left: 8px;
}
.hariinni_title {
  border-bottom: 1px solid hsl(0, 0%, 81%);
  margin-bottom: 5px;
  overflow: hidden;
  padding: 3px;
  text-overflow: ellipsis;
  white-space: nowrap;
 
}
.hariinni-limit-child i {
  margin-right: 2px;
}
.hariinni-limit-child {
  padding: 2px;
  margin-right: 4px;
  display:block;
}
.realtime-limit-child {
  background-color: hsl(209, 73%, 55%);
  color: hsl(0, 0%, 100%);
  display: inline-block;
   padding:3px 5px 3px 3px;
   margin-right:3px;
}
.realtime-limit-child i {
  color: hsl(0, 0%, 100%);
  display: inline-block;
  text-align: center;
  width: 23px;
}
.realtime-box {
  border:1px solid #cecece;
  margin-bottom: 15px;
  padding: 15px;
}
.tiles.tiles-center{
text-align:left !important;
}
.name.indikator{line-height:14px;}
.tiles > li > a .name {
  bottom: 0;
  display: block;
  float: left;
  font-size: 11px !important;
  left: 0;
  padding: 3px 10px;
  position: absolute;
  right: 0;
  text-align: left;
}
</style>
END;
$dashboard_url=backendurl("quiz_dashboard");
$script_js.=<<<END
<script>
function realtime_ujian(){
datapost="realtime_array="+$("#realtime_hidden").val();
$.ajax({
	type: 'POST',
	url: '$dashboard_url/ajax/ujian_realtime/?id_jadwal=$id',
	data:datapost,
	error: function() {
	},
	success: function(data) {
	
	if(data!=1)
	{
	
		$("#ujian_realtime").html(data);
		if($(".chart").length > 0)
		{
			$(".chart").each(function(){
				var color = "#881302",
				el = $(this);
				var trackColor = el.attr("data-trackcolor");
				if(el.attr('data-color'))
				{
					color = el.attr('data-color');
				}
				else
				{
					if(parseInt(el.attr("data-percent")) <= 25)
					{
						color = "#046114";
					}
					else if(parseInt(el.attr("data-percent")) > 25 && parseInt(el.attr("data-percent")) < 75)
					{
						color = "#dfc864";
					}
				}
				el.easyPieChart({
					animate: 1000,
					barColor: color,
					lineWidth: 5,
					size: 80,
					lineCap: 'square',
					trackColor: trackColor
				});
			});
			
		}
	
		
	}
	t = setTimeout("realtime_ujian()",7000);
	}

});

}
$(document).ready(function() {
	var date = new Date();
	var d = date.getDate();
	var m = date.getMonth();
	var y = date.getFullYear();
	
if($("#ujian_realtime").length > 0){
	realtime_ujian();
}	

});

</script>
END;
?>
