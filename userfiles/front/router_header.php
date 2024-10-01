<?php
/*FOOTER*/
echo "<section class=\"section_header\">";
	
	$q_block_layout=$mysql->query("SELECT * FROM header_block_layout ORDER BY urutan");

	if($q_block_layout and $mysql->numrows($q_block_layout)>0)
	{
		
	while($d_block_layout=$mysql->assoc($q_block_layout))
	{
		$style="";
	$le_style=array();
	/*extract style*/
	if($d_block_layout['style']!="")
	{						

		
		$cover="";
		$list_style=explode(";",$d_block_layout['style']);
		
		foreach($list_style as $i_style)
		{
			list($var_style,$value_style)=explode(":",$i_style); 	
			$le_style[$var_style]=$value_style;
		}
		
		if($le_style['background-color']!="" OR $d_block_layout['thumbnail']!="")
		{
			if($d_block_layout['thumbnail']!="" AND file_exists(filepath("menu_layout/large/".$d_block_layout['thumbnail'])))
			{
			$cover=" / cover ".$le_style['background-color'];
			$bgurl=fileurl("menu_layout/large/".$d_block_layout['thumbnail']);
			$le_style['background']="url(\"$bgurl\")   repeat scroll 0 0 $cover";
			}
		}
		
		if($le_style['color']=="" and $le_style['background-color']!="")
		{
		$le_style['color']=$colorscheme->setForeColor($le_style['background-color'],"","$color_2_dark");	
		}
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
	echo "<div class='container-fluid  $alma_container_body' style='$style'>";
	$style="";
	$alma_container_body="";
	}
	//if($d_block_layout['isfull']==0 OR $d_block_layout['isfull']==1 OR $d_template['isboxed']==1	)
	{
	echo "<div class='container $alma_container_body' style='$style'>";
	}
	$q_layout=$mysql->query("SELECT * FROM header_layout WHERE id_block='".$d_block_layout['id']."' ORDER BY urutan");
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
								$q_layout_item=$mysql->query("SELECT * FROM header_layout_item WHERE id_layout='".$d['id']."' AND position=$position ORDER BY urutan");
								if($q_layout_item and $mysql->numrows($q_layout_item)>0)
								{
									while($d1=$mysql->assoc($q_layout_item))
									{
										$block_file=$config['userdir']."/backend/modul/block_".$d1['block']."/front.php";
										if(file_exists($block_file))
										{
											echo "<div class='clearfix'>";
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
	}
echo "</section>";	
/*END FOOTER*/	
?>
