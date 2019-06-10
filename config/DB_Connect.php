<?php
class DB_Connect {
    private $conn;
 
    // Connecting to database
    public function connect($db='one') {
       
        require_once 'config.php';
	
			$this->conn = new mysqli(DB_HOST, DB_USER, DB_PASSWORD, DB_DATABASE);
          
        
       if ($this->conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
} 
        // return database handler
        return $this->conn;
    }
}
 
?>