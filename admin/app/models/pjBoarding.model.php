<?php
/* 
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
 */
if (!defined("ROOT_PATH"))
{
	header("HTTP/1.1 403 Forbidden");
	exit;
}
class pjBoardingModel 
{
	private $conn;
 
    function __construct() {

         require_once MYCLASSPATH.'DB_Connect.php';
        // connecting to database
        $db = new Db_Connect();
		
        $this->conn = $db->connect('user');
    }
	
	   function __destruct() {
        $this->conn = $this->conn->close();
        $this->conn = null;
    }

		
	public function addBoarding($city_id,$boardings,$operator)
 {
	
   
  
	 $this->conn->autocommit(FALSE);
   
    $this->conn->begin_transaction();
    $error = array();
    
	
   
    for ($i=0; $i < count($boardings); $i++) { 
   $boarding=$boardings[$i];
  
   
  
      $sql2="INSERT INTO `bus_schedule_bus_boarding`(`city_id`, `boarding`,`operator_id`) VALUES ('$city_id','$boarding','$operator')";

      if($this->conn->query($sql2)){

      }
      else{
        $error[]=$this->conn->error;
      }

    }
	
	
				
					
	     if(count($error) > 0){
    $this->conn->rollback();
   
    return array('status'=>true,'msg'=>$error);
   }
   else{
  
   $this->conn->commit();
   return array('status'=>true);
  }
     
	
 }

 
	public function getBoarding($start,$end,$op=null)
	{
		$array = array();


	 $sql="SELECT bus_schedule_bus_boarding.*, t2.content as name,t3.name as opname FROM `bus_schedule_bus_boarding` LEFT OUTER JOIN bus_schedule_multi_lang AS t2 ON t2.model='pjCity' AND t2.foreign_id=bus_schedule_bus_boarding.city_id AND t2.field='name' AND t2.locale='1' LEFT OUTER JOIN bus_schedule_users AS t3 ON t3.id=bus_schedule_bus_boarding.operator_id AND t3.role_id='2'   WHERE 1=1 ";
	 if(isset($op)){
	 	 $sql.="AND bus_schedule_bus_boarding.operator_id='$op' ";
	 }
	 $sql.="GROUP BY bus_schedule_bus_boarding.`city_id`,bus_schedule_bus_boarding.`operator_id` LIMIT $start, $end";
		$result = $this->conn->query($sql);
	if ($result->num_rows > 0) {
	  
		while($row = $result->fetch_assoc()) {
			
			$array[]=$row;
		   
		}
	}
		
		return $array;
	}
 
	public function getBoardingByCityId($city,$opid)
	{
		$array = array();
		$city=$this->conn->real_escape_string($city);
		$opid=$this->conn->real_escape_string($opid);

	 $sql="SELECT * FROM `bus_schedule_bus_boarding` WHERE city_id='$city' AND operator_id='$opid' ";
	
	
	$result = $this->conn->query($sql);
	if ($result->num_rows > 0) {
	  
		while($row = $result->fetch_assoc()) {
			
			$array[]=$row;
		   
		}
	}
		
		return $array;
	}

	public function deleteBoardingByCityId($city,$opid)
	{
		
		$city=$this->conn->real_escape_string($city);
		$opid=$this->conn->real_escape_string($opid);

	 $sql="DELETE FROM `bus_schedule_bus_boarding` WHERE city_id='$city' AND operator_id='$opid' ";
	
	
	 if($this->conn->query($sql) === true){
		return false;
	 }
	 else{
	 	return false;
	 }

	}

	public function getBoardingTotal($op=null)
	{
		$array = array();

		 $sql="SELECT * FROM `bus_schedule_bus_boarding`   WHERE 1=1 ";

	 if(isset($op)){
	 	 $sql.="AND operator_id='$op' ";
	 }

	 $sql.="GROUP BY `city_id`,`operator_id`";
	
	  $get_all =$this->conn->query($sql)->num_rows;
	  return $get_all;
	}
		
		
	
	 public function uploadSlide($operator,$file) {

 $operator = $this->conn->real_escape_string($operator);
 $file = $this->conn->real_escape_string($file);
  $sql2 = "INSERT INTO bus_schedule_slide(operator_id,slide) VALUES ('$operator','$file') ON DUPLICATE KEY  UPDATE slide='$file' ";

  if($this->conn->query($sql2)){

    return true;
 
 
    }
    else{
      
      return false;
    }

 }	

  public function getSlide($operator) {

 $operator = $this->conn->real_escape_string($operator);
  $sql = "SELECT * FROM `bus_schedule_slide` WHERE operator_id='$operator' ORDER BY id desc LIMIT 1 ";

$result = $this->conn->query($sql);

	if ($result->num_rows > 0) {
	  
		$row = $result->fetch_assoc();
		return $row;
	}
	else{
		return array();
	}
		
		return $array;
 }

	
	
}
?>