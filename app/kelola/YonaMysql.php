
<?php 

class YonaMysql {
    public $conn ;
    public function __construct() {
        global $mysql;
        $this->$conn=$mysql;
    } 
    public function query() {
        
    }
}