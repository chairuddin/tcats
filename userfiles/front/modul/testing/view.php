<?php
$mem = new Memcached();
$mem->addServer("127.0.0.1", 11211);
 
$result = $mem->get("blah");
$data=array();



var_dump($result);
if ($result) {
    echo $result;
} else {
    echo "No matching key found yet. Let's start adding that now!";
    $q=$mysql->query("SELECT * FROM quiz_member limit 1 ");
	while($d=$mysql->assoc($q)){
		$data[]=$d;
	} 
	$mem->set("blah", $data) or die("Couldn't save anything to memcached...");
}

die();
?>
