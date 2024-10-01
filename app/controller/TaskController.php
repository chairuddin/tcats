<?php

Class TaskController {

    public $sql='';
    public  $organizedTasks=[];
    public function index() {
        
    }
	public function list_task_sql() {
        $sql=" 
            SELECT b.id,b.title,u.username,u.fullname,b.created_at,b.modified_at,p.title project_title,tt.title task_type_title,b.start_date,b.end_date,b.estimation,b.priority,b.status FROM task b 
            LEFT JOIN project p ON p.id=b.project_id
            LEFT JOIN user u ON u.id=b.assign_to
            LEFT JOIN task_type tt ON tt.id=b.task_type_id
            ";
        return $sql;
    }
    public function list_task_by_user() {
       global $mysql;
       $auth = new AuthController();
       $auth_id=$auth->AuthId();
   
       $this->sql=$this->list_task_sql();
       // $this->sql.=" WHERE u.id=$user_id  ";
       $this->sql.=$this->where(" u.id=$auth_id  ");
       $this->sql.=$this->and_where(" b.status<>'close' ");
       $this->sql.=$this->and_where(" b.status<>'resolve' ");
       
        return $this;
    }
    public function list_task_by_user_done() {
        global $mysql;
        $auth = new AuthController();
        $auth_id=$auth->AuthId();
    
        $this->sql=$this->list_task_sql();
        // $this->sql.=" WHERE u.id=$user_id  ";
        $this->sql.=$this->where(" u.id=$auth_id  ");
        $this->sql.=$this->and_where(" ( b.status='close' or b.status='resolve' )  ");
       
        
         return $this;
     }
    public function list_task_all() {
        global $mysql;
        $this->sql=$this->list_task_sql();
       // $this->sql.=" WHERE b.status<>'close' ";
     //  $this->sql.=$this->where(" b.status<>'close' ");
      // $this->sql.=$this->and_where(" b.status<>'resolve' ");
        return $this;
    }
    public function where($condition) {
        $this->sql.=" WHERE $condition ";
    }
    public function and_where($condition) {
        $this->sql.=" AND $condition ";
    }
    public function or_where($condition) {
        $this->sql.=" OR $condition ";
    }

    public function fetch_data() {
        global $mysql;
        $this->sql.=" ORDER BY b.start_date desc,FIELD(priority,'high','medium','low') ";
        $this->organizedTasks=$mysql->query_data($this->sql);
        return $this;
    }
    public function organize_by_date() {
        $organized_temp = [];
        foreach ($this->organizedTasks as $task) {
           
            $date = $task['start_date'];
            if (!isset($organized_temp[$date])) {
                $organized_temp[$date] = [];
            }
            $organized_temp[$date][] = $task;
        }
        return $organized_temp;

    }
    
}