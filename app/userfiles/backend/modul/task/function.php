<?php
function option_project() {
    global $mysql;
    $option=array();
    $q=$mysql->query("SELECT id,title FROM project WHERE status<>'close' ORDER BY title");
    $option[]="Project List";
    if($q and $mysql->num_rows($q)>0) {
        while($d = $mysql->fetch_assoc($q)) {
            $option[$d['id']]=$d['title'];
        }
    }
    return $option;
}

function option_task_type() {
    global $mysql;
    $option=array();
    $q=$mysql->query("SELECT id,title FROM task_type  ORDER BY title");
    $option[]="Task Type";
    if($q and $mysql->num_rows($q)>0) {
        while($d = $mysql->fetch_assoc($q)) {
            $option[$d['id']]=$d['title'];
        }
    }
    return $option;
}

function option_user() {
    global $mysql;
    $option=array();
    $q=$mysql->query("SELECT id,username FROM user WHERE status=1 ORDER BY username");
    $option[]="Pilih User";
    if($q and $mysql->num_rows($q)>0) {
        while($d = $mysql->fetch_assoc($q)) {
            $option[$d['id']]=$d['username'];
        }
    }
    return $option;
}

function option_priority() {
    return array(''=>'Prioritas','low'=>"Low",'medium'=>'Medium','high'=>'High');
}
function option_task_status() {
    return array(''=>'Status','new'=>"New",'start'=>'Start','resolve'=>'Resolve','close'=>'Close');
}

?>