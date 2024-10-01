<?php
function check_session() {
    global $mysql;
    $data=array();
   if($_COOKIE['qr_token']!='') {
        $qr_token=$_COOKIE['qr_token'];
        $qr_token=cleanInput($qr_token);
        $q=$mysql->query(" SELECT id,username,email,fullname from quiz_member WHERE md5(token)=md5('$qr_token')");
        if($q and $mysql->num_rows($q)>0) {
            $data=$mysql->fetch_assoc($q);
        } else {
             header("location:".fronturl("login"));
        }
        
    
    } else {
        header("location:".fronturl("login"));
    }
    return $data;
}
function check_is_login() {
    global $mysql;
    
   if($_COOKIE['qr_token']!='') {
        $qr_token=$_COOKIE['qr_token'];
        $qr_token=cleanInput($qr_token);
        $q=$mysql->query(" SELECT id,username,email,fullname from quiz_member WHERE md5(token)=md5('$qr_token')");
        if($q and $mysql->num_rows($q)>0) {
            header("location:".fronturl());
            exit();
        } 
    
    } 
    return 1;
}

function month_three_digit($i)
{
	global $lang;
	if($lang=="id")
	$bulan=array("01"=>"Jan","02"=>"Feb","03"=>"Mar","04"=>"Apr","05"=>"Mei","06"=>"Jun","07"=>"Jul","08"=>"Agu","09"=>"Sep","10"=>"Okt","11"=>"Nov","12"=>"Des");
	else
	$bulan=array("01"=>"Januari","02"=>"Februari","03"=>"Maret","04"=>"April","05"=>"Mei","06"=>"Juni","07"=>"Juli","08"=>"Agustus","09"=>"September","10"=>"Oktober","11"=>"Nopember","12"=>"Desember");
	return $bulan[$i];
}
function tanggal($dd,$mm,$yy)
{
	global $lang;
	if($lang=="en")
	return month_three_digit($mm)." $dd,$yy";
	if($lang=="id")
	return $dd." ".month_three_digit($mm)." $yy";
}
function show_list_service()
{
global $mysql,$lang,$action;
ob_start();
$q=$mysql->query("SELECT id,url_$lang url,title_$lang title FROM service ORDER BY urutan ASC");

if($q and $mysql->numrows($q))
{
	
	while($d=$mysql->assoc($q))
	{	
		echo '<li><a href="'.fronturl("service/".$d['url'],1).'">'.$d['title'].'</a></li>';	
	}
	
}
return ob_get_clean();							
}
function show_list_tagline_service()
{
global $mysql,$lang,$action;
ob_start();
$q=$mysql->query("SELECT id,url_$lang url,tagline_$lang title FROM service ORDER BY urutan ASC");

if($q and $mysql->numrows($q))
{
	
	while($d=$mysql->assoc($q))
	{	
		echo '<li><a href="'.fronturl("service/".$d['url'],1).'">'.$d['title'].'</a></li>';	
	}
	
}
return ob_get_clean();							
}
function show_list_brand()
{
global $mysql,$lang,$action;
ob_start();

$q=$mysql->query("SELECT id,title_$lang title,thumbnail FROM brand ORDER BY urutan ASC");

if($q and $mysql->numrows($q))
{
	echo '<ul class="info pull-right">';     
	while($d=$mysql->assoc($q))
	{	
		echo '
		<li>
			<img src="'.fileurl("brand/large/".$d['thumbnail']).'" alt="'.$d["title"].'">		
		</li>';	
	}
		echo '</ul>';
}
return ob_get_clean();						
}

function show_list_about()
{
global $mysql,$lang,$action;
ob_start();
$q=$mysql->query("SELECT id,url_$lang url,title_$lang title FROM about ORDER BY urutan ASC");

if($q and $mysql->numrows($q))
{
	
	while($d=$mysql->assoc($q))
	{	
		echo '<li><a href="'.fronturl("about/".$d['url'],1).'">'.$d['title'].'</a></li>';	
	}
	
}
return ob_get_clean();						
}

/**/


function show_title()
{
return "titlenya";
}
function show_page_title()
{global $modul;
return modul_title($modul);
}
function show_copy()
{
global $web_config_footer;
return $web_config_footer;
}
function show_header()
{
global $web_config_tagline,$web_config_name;
ob_start();
$logo=logo();
$fronturl=fronturl();
echo <<<END
			<div id="logo">
				<div>
				<a href="$fronturl">
					<img src="$logo" alt="$web_config_name" title="$web_config_name" />
				</a>
				</div>
			</div>
			<div class="row">
			<div id="tagline" class="twelve column"><p>$web_config_tagline</p></div>
			</div>
END;
return ob_get_clean();
}


function favicon()
{
global $mysql,$file_url;
	$favicon="";
	$r=$mysql->query("SELECT * FROM decoration WHERE type='favicon'");
	if($r and $mysql->numrows($r))
	{
	$r_images=array();
	while($d=$mysql->assoc($r))
	{
	$favicon=$file_url."/decoration/".$d['basename'].".".$d['extension'];
	}
	}
return $favicon;
}
function logo()
{
global $mysql,$file_url;
$favicon="";
$r=$mysql->query("SELECT * FROM decoration WHERE type='logo'");
if($r and $mysql->numrows($r))
{
$r_images=array();
while($d=$mysql->assoc($r))
{
$favicon=$file_url."/decoration/".$d['basename'].".".$d['extension'];
}
}
return $favicon;
}
function logo_footer()
{
	global $mysql,$file_url;
	$favicon="";
	$r=$mysql->query("SELECT * FROM decoration WHERE type='logo_instansi'");
	if($r and $mysql->numrows($r))
	{
	$r_images=array();
	while($d=$mysql->assoc($r))
	{
	$favicon=$file_url."/decoration/".$d['basename'].".".$d['extension'];
	}
	}
return $favicon;
}

function show_widget_footer()
{
	global $CONTACT,$web_config_footer;
	ob_start();
	echo '
	<footer class="row">

					<div class="four column twitter-widget">
						<div class="back-title">
							<h2>Gallery</h2>
						</div>
						<div class="flicker-images">
							'.show_flicker_product().'
						</div>
					</div>

					<div class="four column contact-info">
						<div class="back-title">
							<h2>'.page_show_title(2).'</h2>
						</div>
						'.page_show_content(2).'

					</div>

					<div class="four column contact-info">
						<div class="back-title">
							<h2>Contact info</h2>
						</div>
						<p><img alt="" src="<<<TEMPLATE_URL>>>/images/phone.png"><span>'.$CONTACT['footer_telp'].'</span></p>
						<p><img alt="" src="<<<TEMPLATE_URL>>>/images/mail.png"><span><a href="mailto:'.$CONTACT['footer_email'].'">'.$CONTACT['footer_email'].'</a></span></p>
						<p><img alt="" src="<<<TEMPLATE_URL>>>/images/print.png"><span>'.$CONTACT['footer_fax'].'</span></p>
						<p><img alt="" src="<<<TEMPLATE_URL>>>/images/addres.png"><span>'.$CONTACT['footer_address'].'</span></p>
					</div>

					<article class="end-footer twelve column">
						'.$web_config_footer.'
					</article>

				</footer>';
	return ob_get_clean();
}

function page_show_content($id)
{
global $mysql,$lang;
$r=$mysql->query("SELECT * FROM page WHERE id=$id");
if($r and $mysql->numrows($r)>0)
{
$d=$mysql->assoc($r);
ob_start();
echo $d["content_$lang"];
return ob_get_clean();
}

}
function page_show_title($id)
{
global $mysql,$lang;
$r=$mysql->query("SELECT * FROM page WHERE id=$id");
if($r and $mysql->numrows($r)>0)
{
$d=$mysql->assoc($r);
ob_start();
echo $d["title_$lang"];
return ob_get_clean();
}

}

function register_user()
{
	
	global $nama,$kontak,$alamat,$email,$app_url,$TEXT;
	$host=str_replace("www.","",$_SERVER['HTTP_HOST']);
	$host=md5($host);
	$Month = 2592000 + time();//
	
	$nama=$_GET['nama'];
	$kontak=$_GET['kontak'];
	$alamat=$_GET['alamat'];
	$email=$_GET['email'];
	if($nama!="" and $kontak!="" and $alamat!="" and $email!="")
	{
	setcookie("{$host}_nama",$nama,$Month,'/');
	setcookie("{$host}_kontak",$kontak,$Month,'/');
	setcookie("{$host}_alamat",$alamat,$Month,'/');
	setcookie("{$host}_email",$email,$Month,'/');	
	}
	else
	{
		$nama="";
		$kontak="";
		$alamat="";
		$email="";
	}
	toggle_user();


}
function profil_user()
{
	global $nama,$kontak,$alamat,$email,$app_url,$TEXT;
	$host=str_replace("www.","",$_SERVER['HTTP_HOST']);
	$host=md5($host);
	
	$nama=$_COOKIE[$host.'_nama'];
	$kontak=$_COOKIE[$host.'_kontak'];
	$alamat=$_COOKIE[$host.'_alamat'];
	$email=$_COOKIE[$host.'_email'];
	toggle_user();
}

function toggle_user()
{	
	global $nama,$kontak,$alamat,$email,$app_url,$TEXT;
	ob_start();
	if($nama!="" and $kontak!="" and $alamat!="" and $email!="")
	{	
		echo '
						<h1>'.page_show_title(14).'</h1>
							<div id="form-order-content" class="twelve column">
								'.page_show_content(14).'
							</div>
							<form method="get" id="form_register">
					         <div id="register-bar" class="contact-info">
							<h3>'.$nama.'</h3>
							<p><img alt="" src="'.$app_url.'/images/phone.png"><span>'.$kontak.'</span></p>
							<p><img alt="" src="'.$app_url.'/images/mail.png"><span>'.$email.'</span></p>
							<p><img alt="" src="'.$app_url.'/images/addres.png"><span>'.$alamat.'</span></p>
							<input type="submit" value="Change">
						    </div>
							</form>
					 	
						
					    <script>
					    	update_form();
					    </script>';	
	
	
	}
	else
	{	
	
	echo '
						<h1>'.page_show_title(13).'</h1>
							<div id="form-order-content" class="twelve column">
								'.page_show_content(13).'
							</div>
							<form method="get" id="form_register">
					         <div id="register-bar" class="clearfix">
								<input type="text" required="required" name="nama" placeholder="Nama" value="">
								<input type="text" required="required" name="kontak" placeholder="Kontak" value="">
								<input type="text" required="required" name="alamat" placeholder="Alamat" value="">
								<input type="email" required="required" name="email" placeholder="Email" value="">
								<input type="submit" value="Register">
						    </div>
					    </form>
						
						
					    <script>
					    update_form();
					    </script>';	
	}
	
	echo ob_get_clean();
}
function show_button_lang()
{ global $lang;
	ob_start();
	echo "<i class='icon-flag'></i> &nbsp;<a href='";
	$join_url=build_url();
	if($lang=="id")
	{
		echo fronturl("en/$join_url")."'>GANTI KE INGGRIS";
	}
	else
	{
		echo fronturl("$join_url")."'>CHANGE TO INDONESIA";
	}
	echo "</a>";
	return ob_get_clean();
}

function child_menu($id)
{
	global $lang,$mysql;
	ob_start();
	$q=$mysql->query("SELECT * FROM menu WHERE parent=$id ORDER BY urutan");	
	if($q and $mysql->numrows($q)>0)
	{
		echo '<ul class="dropdown-menu">';
		while($d=$mysql->assoc($q))
		{
			$ob=child_menu($d['id']);
			if($ob!="")
			{
				echo '
				<li><a href="'.fronturl($d["url_$lang"]).'.html" class="dropdown-toggle" data-toggle="dropdown">'.$d["name_$lang"].' <b class="caret  caret-right"></b></a>
				'.$ob.'
				</li>';
			}
			else
			{
				echo '
				<li>
				<a href="'.fronturl($d["url_$lang"]).'.html">'.$d["name_$lang"].'</a>
				</li>';
			}
			$total++;
		}
		echo '</ul>';
	}
	return ob_get_clean();
}

////////////////////////
function url_screen($screen)
{
	$url=$_SERVER['REQUEST_URI'];
	$query = explode('?', $url); // Split the URL on `?` to get the query string
	parse_str($query[1], $data); // Parse the query string into an array
	$data['screen'] = $screen; // Replace item_id's value
	$url = $query[0].'?'.http_build_query($data); // rebuild URL
	return $url;
}
function front_pagination($screen='') {
	global $pages,$keyword;	
	global $modul,$action,$id;	
	if (!isset($screen))
	{
		$screen = 0;
	}
	
	
	$buildurl=array();
	if($modul!="")
	$buildurl[]=$modul;
	if($action!="")
	$buildurl[]=$action;
	
	if($id!=""){$buildurl[]=$id;}
	/*
	if($_GET['seg4']!="")
	$buildurl[]=$_GET['seg4'];
	if($_GET['seg5']!="")
	$buildurl[]=$_GET['seg5'];
	*/
	
	$pagurl=join("/",$buildurl);
	
	$hal.="<ul  class=\"pagination\">";
	if ($screen > 0){
		$prev = $screen>1?($screen - 1):$screen;
		//prev
		//$hal .=  "<li><a class=\"pagination--nav\" href=\"".fronturl("$pagurl/1",0,1)."\"><span class=\"glyphicon glyphicon-chevron-left\"></span></a></li>\r\n"; //&lt; 
		if ($prmtr=="") {
			$hal .=  "<li><a class=\"pagination--nav\" href=\"".url_screen($prev)."\"><span class=\"glyphicon glyphicon-chevron-left\"></span></a></li>\r\n"; //&lt; 
		} else {
			$hal .=  "<li><a class=\"pagination--nav\" href=\"".url_screen($prev)."\"><span class=\"glyphicon glyphicon-chevron-left\"></span></a></li>\r\n"; //&lt; 
			
		}
	}
	else
	{
		$hal .=  "<li><a class=\"pagination--nav\"><span class=\"glyphicon glyphicon-chevron-left\"></span></a></li>\r\n"; //&lt; 
	} 
	$diawal = ($pages<=5)?0:((($screen+1)==$pages)?$screen-3:(($screen==($pages-2))?$screen-2:(($screen >= 3)?$screen-1:0)));
	$diakhir = ($pages<=5)?$pages:(($screen==$pages-1)?0:(($screen==$pages-2)?($screen+2):($diakhir = ($screen=="1")?5:(($screen==0)?5:(($screen <= ($pages-2))?$screen+3:$pages)))));
	if($diakhir==0)$diakhir=$pages;
	
	//
	//$hal .= "<form name=\"pagination_form\" id=\"pagination_form\" action=\"$currentPaginationFile\" method=\"post\">";
	//$hal.="<select class=\"\" name=\"screen\" id=\"pagination_select\" onchange=\"pagination_form.submit()\">";
	for($i=1;$i<=$pages;$i++)
	{
		$selected=$screen==($i)?" class='active' ":"";
		//$hal.="<option value=\"".($i-1)."\" $selected>";
		//$pagurl=join("/",$buildurl).".html?screen=".$i;
		$hal.="<li>";
		$hal.="<a $selected href=\"".url_screen($i)."\">$i</a>";
		$hal.="</li>";
	}
	$pagurl=join("/",$buildurl);	
	
	if ($screen < $pages) 
	{
		$next = $screen + 1;
		if ($next < $pages ){
			if ($prmtr=="") {
				$hal .="<li><a class=\"pagination--nav\" href=\"".url_screen($next)."\"><span class=\"glyphicon glyphicon-chevron-right\"></span></a></li>";
			} else {
				$hal .="<li><a class=\"pagination--nav\" href=\"".url_screen($next)."\"><span class=\"glyphicon glyphicon-chevron-right\"></span></a></li>";
			}
			
			//$hal .="<li><a class=\"pagination--nav\" href=\"".fronturl("$pagurl/".($pages),0,1)."\"><span class=\"glyphicon glyphicon-chevron-right\"></span></a></li>";
			
		}
		else
		{
			//last
			$hal .="<li><a class=\"pagination--nav\" href=\"".url_screen($pages)."\"><span class=\"glyphicon glyphicon-chevron-right\"></span></a></li>";
			//$hal .="<li><a class=\"pagination--nav\" href=\"#\"><span class=\"glyphicon glyphicon-chevron-right\"></span></a></li>";
		}
	}
	else
	{
			//last
			$hal .="<li><a class=\"pagination--nav\" href=\"".url_screen($pages)."\"><span class=\"glyphicon glyphicon-chevron-right\"></span></a></li>";
	}
		
	$hal .="</ul>";
	return $hal;
}
function catstructure($sql)
{
global $cats,$mysql,$modul,$lang,$id_layout;

$cats = new categories();
$mycats = array();
$result = $mysql->query($sql);
while ($row = $mysql->assoc($result)) {
$mycats[] = array('id' => $row['id'], 'nama' => $row['name_id'], 'url_id' => $row['url_id'], 'parent' => $row['parent'], 'level' => 0);
}
$cats->get_cats($mycats);
ob_start();
echo "<ul class=\"nav  nav--filter\">";
 for ($i = 0; $i < count($cats->cats); $i++) 
 {
	if($cats->cats[$i]['parent']==0)
	{
		
		echo "<li>";
		echo "<a href='".fronturl("$modul/category/".$cats->cats[$i]['url_id'],0,1)."'>".$cats->cats[$i]['nama']."</a>";
		child($cats->cats[$i]['id']);
		echo "</li>";
	}
 }
echo "</ul>";

return ob_get_clean();
}
function child($id)
{
global $cats,$modul,$id_layout;
	echo "<ul class=\"subnav  nav--filter\">";
	for ($i = 0; $i < count($cats->cats); $i++) 
 	{
		if($cats->cats[$i]['parent']==$id)
		{
		$cat_id=$cats->cats[$i]['id'];
		echo "<li>";
		echo "<a href='".fronturl("$modul/category/".$cats->cats[$i]['url_id'],0,1)."'>".$cats->cats[$i]['nama']."</a>";
		child($cats->cats[$i]['id']);
		echo "</li>";
		}
		
	}
	echo "</ul>";

}
function header_msg($type,$value)
{
	global $msg_warning;
	$msg_warning="<span class='msg_warning $type'>$value</span>";
}

////////////////////////HEADER CART
function show_header_cart()
{
	global $mysql;
	ob_start();
	$no=0;
	if(count($_SESSION["cart"])>0)
	{
		$no=1;
		$subtotal=0;
		foreach($_SESSION["cart"] as $i => $v)
		{
			$q=$mysql->query("SELECT * FROM catalog WHERE url_id='$i'");
			if($q and $mysql->numrows($q)>0)
			{
			$d=$mysql->assoc($q);
			$r_thumb=explode(":",$d["thumb"]);
			$price=$v*$d['harga_jual'];
			echo '<div class="header-cart__product  clearfix  js--cart-remove-target">
				  <div class="header-cart__product__image">
					<img alt="Product in the cart" src="'.fileurl("catalog/small/".$r_thumb[0]).'" width="40" height="50" />
				  </div>
				  <div class="header-cart__product__image--hover">
					<div class="search-close">
					  <a href="#" class="js--remove-item" data-target=".js--cart-remove-target"><span class="glyphicon glyphicon-remove"></span></a>
					</div>
				  </div>
				  <div class="header-cart__product__title">
					<a class="header-cart__link" href="'.fronturl($modul."/detail/".$d['url_id']).'">'.$d['title_id'].'</a>
					<span class="header-cart__product_quantity">Qty: '.$v.'</span>
				  </div>
				  <div class="header-cart__product__price">
					Rp '.currency($price).'
				  </div>
				</div>
			  ';
			  $subtotal+=$price;
			}
		
		$no++;	
		}
	}
	
	$subtotal=currency($subtotal);
	$content_chart=ob_get_clean();
echo '
	<span class="header-cart__text--price"><span class="header-cart__text">CART</span>Rp '.$subtotal.'</span>
			  <a href="#" class="header-cart__items">
				<span class="header-cart__items-num">'.$no.'</span>
			  </a>
			  <!-- Open cart panel -->
			  <div class="header-cart__open-cart">
			  
				'.$content_chart.'
			  
				<hr class="header-cart__divider" />
				<div class="header-cart__product__box">
				  <span class="header-cart__product__subtotal">CART SUBTOTAL:</span>
				  <span class="header-cart__product__subtotal-price">'.$subtotal.'</span>
				</div>
				<a class="btn btn-even-more-dark" href="#">Procced to checkout</a>
			  </div>
';
			
		

}
function cms_title_search($title)
{
		ob_start();
		if($title!="")
        {
		 $r_title=explode(" ",$title);
		  $title1=$r_title[0];
		  unset($r_title[0]);
		  $title2=join(" ",$r_title);
		  
		  echo '
		  	<div class="row">
			  <div class="col-xs-12">
				<div class="block-title">
				  <h1><span class="light">'.$title1.'</span> '.$title2.'</h1>
			  	</div>
			  </div>
			</div>
		   ';
		  } 
		  return ob_get_clean();
}
function cms_message($type="warning",$msg="")
{

	ob_start();
	echo "<span class='$type'>$msg</span>";
	return ob_get_clean();
}
function cms_main_title($title)
{
	global $d;
		ob_start();
		if($title!="")
        {
		 $r_title=explode(" ",$title);
		  $title1=$r_title[0];
		  unset($r_title[0]);
		  $title2=join(" ",$r_title);
		  if($d['style']!="")
		  {
			$rnilai=explode(";",$d['style']);
			$attribut=array();
			foreach($rnilai as $i =>$v)
			{
			list($attr,$value)=explode(":",$v);
			$attribut[$attr]=$value;
			}
			if($attribut['color']!="")
			{
				$style=" style='color:".$attribut['color'].";'";
			}
		  }
		  
		  echo '
		  	<div class="row">
			  <div class="col-xs-12">
				<div class="block-title">
				  <h1'.$style.'><span class="light">'.$title1.'</span> '.$title2.'</h1>
			  	</div>
			  </div>
			</div>
		   ';
		  } 
		  return ob_get_clean();
}
function cms_title($title)
{
	global $d;
		ob_start();
		if($title!="")
        {
		 $r_title=explode(" ",$title);
		  $title1=$r_title[0];
		  unset($r_title[0]);
		  $title2=join(" ",$r_title);
		  if($d['style']!="")
		  {
			$rnilai=explode(";",$d['style']);
			$attribut=array();
			foreach($rnilai as $i =>$v)
			{
			list($attr,$value)=explode(":",$v);
			$attribut[$attr]=$value;
			}
			if($attribut['color']!="")
			{
				$style=" style='color:".$attribut['color'].";'";
			}
		  }
		  
		  echo '
		  	<div class="row">
			  <div class="col-xs-12">
				<div class="block-title">
				  <h2'.$style.'><span class="light">'.$title1.'</span> '.$title2.'</h2>
			  	</div>
			  </div>
			</div>
		   ';
		  } 
		  return ob_get_clean();
}
////////////////////////////
function breadcrumb($modul)
{
	global $mysql,$ishtml,$data_crumb;
	
	if($ishtml)
	{
		$q=$mysql->query("SELECT id,name_id,url_id,parent FROM menu WHERE url_id='$modul'");
		if($q and $mysql->numrows($q)>0)
		{	
		$d=$mysql->assoc($q);
		$data_crumb[]=array("name"=>$d["name_id"],"url"=>$d["url_id"]);
			if($d['parent']!=0)
			{
			menu_parent($d['parent']);
			}
		}
	//$data_crumb=array_reverse($data_crumb);	
	}
	else
	{
		
		$r_xparam=explode("/",$_GET['xparam']);
		if(count($r_xparam)>0)
		{
			foreach($r_xparam as $xx =>$vv)
			{
				$data_crumb[]=array("name"=>ucfirst(strtolower($vv)),"url"=>"#");
			}
		}
		
		if($_GET['s']!='')
		{
			$data_crumb[]=array("name"=>ucfirst(strtolower($_GET['s'])),"url"=>"#");
		}
		$data_crumb=array_reverse($data_crumb);	
		
	}
	
	/*home*/
	$use_breadcrumb=1;
	$q=$mysql->query("SELECT id,name_id,url_id,parent FROM menu WHERE urutan=1 OR urutan=0");
	if($q and $mysql->numrows($q)>0)
	{	
		$d=$mysql->assoc($q);
		$data_crumb[]=array("name"=>$d["name_id"],"url"=>$d["url_id"]);
		if($modul==$d["url_id"])
		{
			$use_breadcrumb=0;
		}
	}
	/*end home*/
	
	
	
	if($use_breadcrumb)
	{
	$data_crumb=array_reverse($data_crumb);
	echo '
	<div class="container contain-breadcrumb">
        <div class="row">
			<div class="col-sm-12">
			<ol class="breadcrumb">';
			$i=1;
			$jum=count($data_crumb);
			foreach($data_crumb as $x =>$v)
			{
				if($i==$jum and $ishtml)
				{
					$active="class='active'";
					$url=fronturl($v["url"].".html");
				}
				else 
				{
					$active="";
					$url="#";
				}
				
				if($i==1)
				{
					$url=fronturl($v["url"].".html");
				}
				echo '<li '.$active.'><i class="fa fa-angle-right"></i><a href="'.$url.'">'.$v["name"].'</a></li>';
			  
			  $i++;
			}
			  
	echo '		
			</ol>
		</div>
	</div>
	</div>';
	}
	
}
function menu_utama()
{
	global $mysql,$data_crumb;
	$q=$mysql->query("SELECT id,name_id,url_id,parent FROM menu WHERE urutan=1");
	if($q and $mysql->numrows($q)>0)
	{
		return $d['url_id'];
	}
}
function menu_parent($parent)
{
	global $mysql,$data_crumb;
	$q=$mysql->query("SELECT id,name_id,url_id,parent FROM menu WHERE id=$parent");
	if($q and $mysql->numrows($q)>0)
	{	
		$d=$mysql->assoc($q);
		$data_crumb[]=array("name"=>$d["name_id"],"url"=>$d["url_id"]);
		
	}
}
function search_url_block_utama($nama_block)
{
	global $mysql,$lang;
	
	$q=$mysql->query("SELECT id_layout FROM menu_layout_item WHERE block='$nama_block'");
	if($q and $mysql->numrows($q)>0)
	{
		list($id_layout)=$mysql->row($q);
		
		$q1=$mysql->query("SELECT id_menu FROM menu_layout WHERE id='$id_layout'");
		if($q1 and $mysql->numrows($q1)>0)
		{
			list($id_menu)=$mysql->row($q1);
			$q2=$mysql->query("SELECT url_$lang url FROM menu WHERE id='$id_menu'");	
			if($q2 and $mysql->numrows($q2)>0)
			{
				list($url)=$mysql->row($q2);
				return $url;
			}
		}
	}
	return 0;
}
function option_country()
{
	global $mysql,$country_select;
	
	ob_start();
		echo "<select name='country_select' id='country_select'  required='required' class='form-control'>";
		$q=$mysql->query("
SELECT * FROM (SELECT * FROM country WHERE id IN (	SELECT id from (SELECT id FROM country WHERE level=1  AND publish=1 ORDER BY id LIMIT 10) t) ORDER BY id) a
UNION ALL
SELECT * FROM (
SELECT * FROM country WHERE level=1 AND id NOT IN (	SELECT id from (SELECT id FROM country WHERE level=1  AND publish=1 ORDER BY id LIMIT 10) t) ORDER BY name_id) b
		
		");
		echo "<option value=''>Pilih Provinsi</option>";
		if($q and $mysql->numrows($q))
		{
			
			while($d=$mysql->assoc($q))
			{
				$selected=$country_select==$d['id']?"selected='selected'":"";
				echo "<option $selected value='".$d['id']."'>".$d['name_id']."</option>";
			}
		}
		echo "</select>";
	return ob_get_clean();	
}
function option_region()
{
	global $mysql,$region_select,$country_select;
	ob_start();
	echo "<select name='region_select' id='region_select'  required='required' class='form-control'>";
	echo "<option value=''>Semua Kota</option>";
	
	$q=$mysql->query("SELECT * FROM country WHERE Level=2 AND parent='$country_select'  AND publish=1 ORDER BY name_id");
	if($q and $mysql->numrows($q))
		{
			
			while($d=$mysql->assoc($q))
			{
				$selected=$region_select==$d['id']?"selected='selected'":"";
				echo "<option $selected value='".$d['id']."'>".$d['name_id']."</option>";
			}
		}
	echo "</select>";
	return ob_get_clean();	
}
function option_neighbourhood()
{
	global $mysql,$neighbourhood_select,$region_select,$country_select;
	ob_start();
		echo "<select name='neighbourhood_select' id='neighbourhood_select' class='form-control'  required='required'>";
		$region=$_POST['region_select'];
		$q=$mysql->query("SELECT * FROM country WHERE Level=3 AND parent='$region_select'  AND publish=1 ORDER BY name_id");
		echo "<option value=''>Semua Kecamatan</option>";
		if($q and $mysql->numrows($q))
		{
			while($d=$mysql->assoc($q))
			{
				$selected=$neighbourhood_select==$d['id']?"selected='selected'":"";
				echo "<option $selected value='".$d['id']."'>".$d['name_id']."</option>";
			}
		}
	echo "</select>";
	return ob_get_clean();	
}
?>
