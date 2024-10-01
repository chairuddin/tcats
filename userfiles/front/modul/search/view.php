<?php
echo "<div class='container alma-container-search container-search'>";
echo "<div class='row'>";
echo "<div class='col-md-12'>";
$_GET['s']=substr(strip_tags($_GET['s']),0,50);
$q_menu=$mysql->query("SELECT * FROM menu");
if($q_menu and $mysql->numrows($q_menu)>0)
{
	$found=false;
	while($d_menu=$mysql->assoc($q_menu))
	{
	$temp_search=array();	
	$q_layout=$mysql->query("SELECT * FROM menu_layout WHERE id_menu='".$d_menu['id']."' ORDER BY urutan");
	
	//untuk menghandle modul blog 
	$dinamic_modul=false;
	$dinamic_result=array();
	
	if($q_layout and $mysql->numrows($q_layout)>0)
	{
			$id_block=array();
			$index=0;
			
			while($d_layout_item=$mysql->assoc($q_layout))
			{
				$column=explode("_",$d_layout_item['block']);
				$position=1;
				foreach($column as $i => $v)
				{
					if($i>0)
					{
						
						$q_layout_item=$mysql->query("SELECT * FROM menu_layout_item WHERE id_layout='".$d_layout_item['id']."' AND position=$position ORDER BY urutan");
						if($q_layout_item and $mysql->numrows($q_layout_item)>0)
						{
							while($d1=$mysql->assoc($q_layout_item))
							{
								$block_file=$config['userdir']."/backend/modul/block_".$d1['block']."/search.php";
								if(file_exists($block_file))
								{
									include "$block_file";
								}
							}
						}
						
						$position++;
					}
				}
			
			}
		
	}
	$keyword=substr(strip_tags($_GET['s']),0,50);
	if(count($temp_search)>0)
	{
	
		
		$r_keyword=explode(" ",$keyword);
		
		$temp_found=array();
		foreach($r_keyword as $key => $search_keyword)
		{
			if(count($temp_search)>0)
			{
				
				foreach($temp_search as $temp_i =>$temp_search_content)
				{
					if($temp_search_content!="")
					{
						
						$cari=strpos(strtolower($temp_search_content),strtolower($search_keyword));
						if($cari!==false)
						{
							$found=true;
							
							$temp_found[]=substr($temp_search_content,0,100);
						}
					}
				}
			}
		}
		
		if($found)
		{
			echo "<h3><a href='".fronturl($d_menu['url_id']).".html'>".$d_menu['name_id']."</a></h3>";
			echo "<p>".join($temp_found)."...</p>";
		}	
	}
	//untuk menghandle modul blog dll
	if($dinamic_modul and count($dinamic_result)>0)
	{
		foreach($dinamic_result as $i=>$v)
		{
			echo "<h3><a href='".$v['url'].".html'>".$v['title']."</a></h3>";
			echo "<p>".$v['content']."</p>";
		}
	}
	
	
	}
	
	if(!$found)
	{
	echo "<p>Search \"$keyword\" Not Found</p>";
	}

}
echo "<br/><br/>";
echo "</div>";
echo "</div>";
echo "</div>";
?>
