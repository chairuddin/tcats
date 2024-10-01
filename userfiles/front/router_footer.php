<?php
/*FOOTER*/
	
	$q_block_layout=$mysql->query("SELECT * FROM footer_block_layout ORDER BY urutan");

	if($q_block_layout and $mysql->numrows($q_block_layout)>0)
	{
	echo "<footer>";	
	while($d_block_layout=$mysql->assoc($q_block_layout))
	{
	$style="";
	$le_style=array();
	/*extract style*/
	$one_value=array();
	
	//if($d_block_layout['style']!="")
	{						
		$cover="";
		if($d_block_layout['style']!="")
		{
			$list_style=explode(";",$d_block_layout['style']);
			foreach($list_style as $i_style)
			{
				list($var_style,$value_style)=explode(":",$i_style); 	
				$le_style[$var_style]=$value_style;
				if($value_style!="")
				{
				$one_value[$var_style]=$value_style;
				}
			}
		}
		
		if($le_style['color']=="" and $le_style['background-color']!="")
		{
		$le_style['color']=$colorscheme->setForeColor($le_style['background-color'],"","");	
		}
		if($one_value['background-color']!="" AND $d_block_layout['thumbnail']!="")
		{
			
			if($d_block_layout['thumbnail']!="" AND file_exists(filepath("footer_layout/large/".$d_block_layout['thumbnail'])))
			{
			$cover=" / cover ";
			$bgurl=fileurl("footer_layout/large/".$d_block_layout['thumbnail']);
			
			$le_style['background']=$one_value['background-color']." url(\"$bgurl\")   repeat scroll 0 0 $cover";
			unset($le_style['background-color']);
			}
			
		}
		
		if($one_value['background-color']=="" AND $d_block_layout['thumbnail']!="")
		{
			$bgurl=fileurl("footer_layout/large/".$d_block_layout['thumbnail']);
			
			if($d_block_layout['thumbnail']!="" AND file_exists(filepath("footer_layout/large/".$d_block_layout['thumbnail'])))
			{
			//$cover=" / cover ".$le_style['background-color'];
			$bgurl=fileurl("footer_layout/large/".$d_block_layout['thumbnail']);
			
			$le_style['background']="url(\"$bgurl\")   repeat scroll 0 0";
			
			}
		}
		
		/*
		 #services {
			background: #000 url("../images/services/bg_services.png") repeat scroll 0 0 / cover ;
			background:#000000 url("http://webblog.off/userfiles/file/webblog/footer_layout/large/paper-182218_1920-5627ace524c0c.jpg")   repeat scroll 0 0  / cover ;
		   background:url("http://webblog.off/userfiles/file/webblog/menu_layout/large/paper-182218_1920-5627ace524c0c.jpg")   repeat scroll 0 0;
		}
		* 
		 */ 
		
		
		
	
	
	}
	
	if(count($le_style)>0)
	{
		$final_style=array();
		foreach($le_style as $i_style => $v_style)
		{
			$final_style[]="$i_style:$v_style;";
		}
		
		$style=join("",$final_style);
	}
	/*end extract style*/	
	
	$alma_container_body="alma-container-body";	
	//if($d_block_layout['isfull']==1 or $d_template['isboxed']==1)
	if($d_template['isboxed']==0)
	{
	echo "<div class='container-fluid footer-footer  $alma_container_body' style='$style'>";
	$style="";
	$alma_container_body="";
	}
	//if($d_block_layout['isfull']==0 OR $d_block_layout['isfull']==1 OR $d_template['isboxed']==1	)
	{
	echo "<div class='container footer-footer $alma_container_body' style='$style'>";
	}
	$q_layout=$mysql->query("SELECT * FROM footer_layout WHERE id_block='".$d_block_layout['id']."' ORDER BY urutan");
	if($q_layout and $mysql->numrows($q_layout)>0)
	{
		
			$id_block=array();
			$index=0;
			
			while($d=$mysql->assoc($q_layout))
			{
				
				echo "<div class='row'>";
						$column=explode("_",$d['block']);
						$position=1;
						foreach($column as $i => $v)
						{
							if($i>0)
							{
								if($v=="col")$v=12;
								$class="col-sm-$v";
								echo "<div class='$class'>";
								$q_layout_item=$mysql->query("SELECT * FROM footer_layout_item WHERE id_layout='".$d['id']."' AND position=$position ORDER BY urutan");
								if($q_layout_item and $mysql->numrows($q_layout_item)>0)
								{
									while($d1=$mysql->assoc($q_layout_item))
									{
										$block_file=$config['userdir']."/backend/modul/block_".$d1['block']."/front.php";
										if(file_exists($block_file))
										{
											echo "<div class='widget-footer-border clearfix'>";
											include "$block_file";
											echo "</div>";
										}
									}
								}
								echo "</div>";
								$position++;
							}
						}
						
				
				echo "</div>";
				
			}
		
	}
	//if($d_block_layout['isfull']==0 OR $d_block_layout['isfull']==1 OR  $d_template['isboxed']==1){
	{
	echo "</div>";
	}
	//if($d_block_layout['isfull']==1 OR $d_template['isboxed']==1){
	if($d_template['isboxed']==0){
	echo "</div>";
	}
	}
	echo "</footer>";	
	}

/*END FOOTER*/	
?>
