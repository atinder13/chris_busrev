<?php
class DB_Functions {
 
    private $conn;
 
    // constructor
    function __construct() {
        require_once 'DB_Connect.php';
        // connecting to database
        $db = new Db_Connect();
        $this->conn = $db->connect('user');
    }
 
    // destructor
    function __destruct() {
        $this->conn = $this->conn->close();
        $this->conn = null;
    }

 
  public function UserLogin($email,$password) {
       $email=$this->conn->real_escape_string($email);
       //role_id=2 and
        $stmt = $this->conn->prepare("SELECT * FROM bus_schedule_users WHERE email = ? and password = AES_ENCRYPT(?, '".PJ_SALT."')  ");

        $stmt->bind_param("ss", $email,$password);
      $stmt->execute();
      $stmt->store_result();

       if ($stmt->num_rows > 0) {
            // user existed
        
         $stmt2 = $this->conn->prepare("SELECT * FROM bus_schedule_users WHERE email = ? and password = AES_ENCRYPT(?, '".PJ_SALT."') ");
         $stmt2->bind_param("ss", $email,$password);
          $stmt2->execute();
          $lastno = $stmt2->get_result()->fetch_assoc();
         $getEmail=$lastno['email'];
         $userId=$lastno['id'];
         $name=$lastno['name'];
         $status=$lastno['status'];
         $stmt2->close();
           
         
            return array('login_status'=>true,'email'=>$getEmail,'userId'=>$userId,'name'=>$name,'status'=>$status, 'role_id'=>$lastno['role_id'], 'countryCode'=>$lastno['countryCode'], 'phone'=>$lastno['phone'], 'created'=>$lastno['created'], 'last_login'=>$lastno['last_login'], 'is_active'=>$lastno['is_active'], 'ip'=>$lastno['ip']);
            
        } 
 
        else {
            // user not existed
            $stmt->close();
            
            return array('login_status'=>false);
        }
            
           
            
    
 }
 

 public function isUserExisted($email) {

        $stmt = $this->conn->prepare("SELECT * from bus_schedule_users WHERE email = ?");
 
        $stmt->bind_param("s", $email);
 
        $stmt->execute();
 
        $stmt->store_result();
 
        if ($stmt->num_rows > 0) {
            // user existed 
            $stmt->close();
            return true;
        } else {
            // user not existed
            $stmt->close();
            return false;
        }
      }

      public function resetPassword($email,$newpass)
      {
      
       $email=$this->conn->real_escape_string($email);
       $newpass=$this->conn->real_escape_string($newpass);
       $sql="UPDATE `bus_schedule_users` SET status='T', password=AES_ENCRYPT('$newpass','".PJ_SALT."')  WHERE email='$email' ";
       if($this->conn->query($sql) === true ){
          return true;
       }
       else{
        return false;
       }

      }

 public function isverifyUser($id) {

        $stmt = $this->conn->prepare("SELECT * from bus_schedule_users WHERE id = ? AND status='F' ");
    
        $stmt->bind_param("s", $id);
 
        $stmt->execute();
 
        $stmt->store_result();
 
        if ($stmt->num_rows > 0) {
            // user existed 
            $stmt->close();
            return true;
        } else {
            // user not existed
            $stmt->close();
            return false;
        }
    }
 


  public function storeUser($name, $email,$ccode,$mobile,$pass,$type=3) {
        
  
    $name=$this->conn->real_escape_string($name);
    $email=$this->conn->real_escape_string($email);
    $mobile=$this->conn->real_escape_string($mobile);
    $ccode=$this->conn->real_escape_string($ccode);
    $pass=$this->conn->real_escape_string($pass);
    $sql2 = "INSERT INTO bus_schedule_users(name, email,countryCode,phone,password,role_id,status) VALUES ('$name','$email','$ccode','$mobile',AES_ENCRYPT('$pass','".PJ_SALT."'),'$type','V')";
     

     if (($this->conn->query($sql2) === TRUE) ) 
     {
      $userid=$this->conn->insert_id;
        require_once CLASSPATH.'Encryption.php';
  $userenc=Encryption::encode($userid);
  $url=ROOTURL.'verify-user.php?user='.$userenc;
  $body             = file_get_contents('lib/email-temp.php');
  $body             = str_replace('{username}',$name, $body);
  $body             = str_replace('{url}',$url, $body);
  
  $this->SendMail($email,'You Have Been Successfully Registered!',$body);
      return array('status'=>true);
   }  
    else{
           
     return array('status'=>false,'message' => $this->conn->error);
  
   }
 
     
     
 
         
       
  }



  public function verifyUser($userId)
  {
  $sql2 = "UPDATE bus_schedule_users SET status='T' where id='$userId' ";
    

     if (($this->conn->query($sql2) === TRUE)) 
     {       
 
      return true;
 
 
    }
      else
      {
     return false;
      }
}

  public function updateProfile($name,$countryCode,$mobile,$userId)
  {
    $name=$this->conn->real_escape_string($name);
    $countryCode=$this->conn->real_escape_string($countryCode);
    $mobile=$this->conn->real_escape_string($mobile);
    
  $sql2 = "UPDATE bus_schedule_users SET name='$name',countryCode='$countryCode',phone='$mobile' where id='$userId' ";
    

     if (($this->conn->query($sql2) === TRUE)) 
     {       
 
      return true;
 
 
    }
      else
      {
     return false;
      }
}

    public function SendMail($email,$subject,$body) {
      require_once CLASSPATH.'mail/class.phpmailer.php';
    try {
  $mail = new PHPMailer(true); //New instance, with exceptions enabled

  
    $mail = new PHPMailer(true);
    $mail->IsSMTP();
    $mail->SMTPDebug = 0;
    $mail->SMTPAuth = true;
    $mail->SMTPSecure = 'ssl';
    $mail->Host = 'smtp.gmail.com';
    $mail->Port = 465;
    $mail->Username   = "dez.singh5@gmail.com";    
    $mail->Password   = "WAHEGURU@#";   
    
    $mail->SetFrom('dez.singh5@gmail.com');




    $to = $email;

       
   $mail->AddAddress($to);
      
    

    $mail->Subject  = $subject;

    $mail->AltBody    = "To view the message, please use an HTML compatible email viewer!"; // optional, comment out and test
    $mail->WordWrap   = 80; // set word wrap

    $mail->MsgHTML($body);

    $mail->IsHTML(true); // send as HTML

    $mail->Send();
        return true;
    } catch (phpmailerException $e) {
       // $e->errorMessage();
        return false;
}

  }

   public function checkuserisverify($email) {
 
        $stmt = $this->conn->prepare("SELECT id FROM bus_schedule_users WHERE email = ?");
 
        $stmt->bind_param("s", $email);
 
        if ($stmt->execute()) {
            $user = $stmt->get_result()->fetch_assoc();
            $stmt->close();
 
            // verifying user password
           
            $veriystatus = $user['status'];
            if($veriystatus != 'T')
            {
            return true;
            }
       
        else
        {
        return false;
        }
            
           
        } else {
            return false;
        }
    }
  

  
  public function getBusesRoutes($pickup_id,$return_id,$date,$busTypes=null,$dbtime=null,$operatorId){
  
  $pickup_id = $this->conn->real_escape_string($pickup_id);
  $return_id = $this->conn->real_escape_string($return_id);
  $date = $this->conn->real_escape_string($date);;
  $day_of_week = strtolower(date('l', strtotime($date)));
        
   $sql="SELECT t1.*, t2.content AS route, t3.seats_map, t3.seats_count,t4.name FROM bus_schedule_buses AS t1 LEFT OUTER JOIN bus_schedule_multi_lang AS t2 ON t2.model='pjRoute' AND t2.foreign_id=t1.route_id AND t2.field='title' AND t2.locale='1' LEFT OUTER JOIN bus_schedule_users AS t4 ON t1.operator_id=t4.id LEFT OUTER JOIN bus_schedule_bus_types AS t3 ON t3.id=t1.bus_type_id WHERE (t1.start_date <= '$date' AND '$date' <= t1.end_date) AND (t1.recurring LIKE '%$day_of_week%') AND t1.id NOT IN (SELECT TSD.bus_id FROM `bus_schedule_buses_dates` AS TSD WHERE TSD.`date` = '$date') AND (t1.route_id IN(SELECT TRD.route_id FROM `bus_schedule_route_details` AS TRD WHERE (TRD.from_location_id = '$pickup_id' AND TRD.to_location_id = '$return_id' ))) "; 
  
  if(isset($busTypes) && count($busTypes) > 0 ){
  $busTypearr = implode("','", $busTypes);
  $sql .= " and t1.bus_type_id IN ('".$busTypearr."') ";
    
  }

  if(isset($operatorId)){
    
   $operatorIdar = implode("','", $operatorId);
  $sql .= " and t1.operator_id IN ('".$operatorIdar."') ";
  }
    
  if(isset($dbtime) && count($dbtime) > 0 ){
  $sdptime1=explode("-",$dbtime[0]);
  
   $sql .=" AND ( t1.departure_time BETWEEN '$sdptime1[0]' AND '$sdptime1[1]' ";
  if(count($dbtime) > 2){
    for($d=1;$d < count($dbtime);$d++ ){
      
      $sdptime=explode("-",$dbtime[$d]);
      
      for($i=0;$i<count($sdptime);$i++){
        $sql .="  OR t1.departure_time BETWEEN '$sdptime[0]' AND '$sdptime[1]'  ";
      }
    }
    $sql.=" )";
  }
  else{
    $sql.=" )";
  }
  
  }
  
  
 $sql.= " ORDER BY route asc";    
  $result = $this->conn->query($sql);
  if ($result->num_rows > 0) {
    
    while($row = $result->fetch_assoc()) {
     
      $array[]=$row;
       
    }
  return $array;

  }
  else
  {
  return false;
  }

  } 

  

  public function getTicketType($pickup_id,$return_id,$bus_id,$ticketid=null,$price=null){
  
  $pickup_id = $this->conn->real_escape_string($pickup_id);
  $return_id = $this->conn->real_escape_string($return_id);
  $bus_id = $this->conn->real_escape_string($bus_id);
      
  $sql="SELECT t1.*, t2.seats_count, t3.content as ticket, t4.discount
FROM bus_schedule_prices AS t1
FORCE KEY (`ticket_id`)
LEFT JOIN bus_schedule_tickets AS t2 ON t1.ticket_id = t2.id
LEFT OUTER JOIN bus_schedule_multi_lang AS t3 ON t3.model='pjTicket' AND t3.foreign_id=t1.ticket_id AND t3.field='title' AND t3.locale='1'
LEFT JOIN bus_schedule_buses AS t4 ON t1.bus_id = t4.id
WHERE  t1.bus_id = '$bus_id'
AND t1.from_location_id = '$pickup_id'
AND t1.to_location_id = '$return_id'
AND is_return = 'F' ";
  
  if(isset($ticketid)){
  
     $ticketids = implode("','", $ticketid);
 echo $sql .= " and t1.ticket_id IN ('".$ticketids."') ";
  }
  
  if(isset($price)){
  
  $p = explode(";", $price);
  $sql .= " AND t1.price BETWEEN '$p[0]' AND '$p[1]' ";
  }
  
   $sql.=" ORDER BY ticket ASC";
  $result = $this->conn->query($sql);
  if ($result->num_rows > 0) {
    
    while($row = $result->fetch_assoc()) {
     
      $array[]=$row;
       
    }
  return $array;

  }
  else
  {
  return false;
  }

  }
    

  public function ticketPrice($pickup_id,$return_id,$bus_id,$ticketid){
  
  $pickup_id = $this->conn->real_escape_string($pickup_id);
  $return_id = $this->conn->real_escape_string($return_id);
  $bus_id = $this->conn->real_escape_string($bus_id);
      
  $sql="SELECT price FROM `bus_schedule_prices` WHERE  bus_id = '$bus_id' AND ticket_id = '$ticketid' AND from_location_id = '$pickup_id' AND to_location_id = '$return_id' LIMIT 1";
  
  $result = $this->conn->query($sql);
  if ($result->num_rows > 0) {
    
   $row = $result->fetch_assoc();
   $price= $row['price'];
     return $price;
  
  }
  else
  {
  return 0;
  }

  }
  
  
  public function getBookingTicket($bustype,$pickup_id,$return_id,$bus_id,$date){
  
  $bustype = $this->conn->real_escape_string($bustype);
  $pickup_id = $this->conn->real_escape_string($pickup_id);
  $return_id = $this->conn->real_escape_string($return_id);
  $bus_id = $this->conn->real_escape_string($bus_id);
  $date = $this->conn->real_escape_string($date);
      
  $sql="SELECT COUNT(DISTINCT t1.seat_id) as cnt_booked FROM bus_schedule_bookings_seats AS t1 WHERE t1.start_location_id IN($bustype,$pickup_id,$return_id) AND t1.booking_id IN(SELECT TB.id FROM `bus_schedule_bookings` AS TB WHERE (TB.status='confirmed' OR (TB.status='pending' AND UNIX_TIMESTAMP(TB.created) >= UNIX_TIMESTAMP(DATE_SUB(NOW(), INTERVAL 30 MINUTE)))) AND TB.bus_id = $bus_id AND TB.booking_date = '$date')";

  $result = $this->conn->query($sql);
  if ($result->num_rows > 0) {
    
    $row = $result->fetch_assoc();
     
    
  return $row['cnt_booked'];

  }
  else
  {
  return 0;
  }

  }
  
  public function getFromCity($keyword){
  
  $keyword=$this->conn->real_escape_string($keyword);
  $sql="SELECT t1.*, t2.content as name
FROM bus_schedule_cities AS t1
LEFT OUTER JOIN bus_schedule_multi_lang AS t2 ON t2.model='pjCity' AND t2.foreign_id=t1.id AND t2.field='name' AND t2.locale='1'
WHERE  t2.content LIKE '%$keyword%' AND t1.id IN(SELECT TRD.from_location_id FROM `bus_schedule_route_details` AS TRD) 
ORDER BY t2.content ASC  LIMIT 20"; 
  $result = $this->conn->query($sql);
  if ($result->num_rows > 0) {
    
    while($row = $result->fetch_assoc()) {
     
      $array[]=array("value"=>$row['id'],"label"=>$row['name']);
       
    }
  return $array;

  }
  else
  {
  return false;
  }

 }
  
  public function getToCity($keyword){
  
  $keyword=$this->conn->real_escape_string($keyword);
   $sql="SELECT t1.*, t2.content as name
FROM bus_schedule_cities AS t1
LEFT OUTER JOIN bus_schedule_multi_lang AS t2 ON t2.model='pjCity' AND t2.foreign_id=t1.id AND t2.field='name' AND t2.locale='1'
WHERE  t2.content LIKE '%$keyword%' AND t1.id IN(SELECT TRD.to_location_id FROM `bus_schedule_route_details` AS TRD) 
ORDER BY t2.content ASC"; 
  $result = $this->conn->query($sql);
  if ($result->num_rows > 0) {
    
    while($row = $result->fetch_assoc()) {
     
      $array[]=array("value"=>$row['id'],"label"=>$row['name']);
       
    }
  return $array;

  }
  else
  {
  return false;
  }

 }  
 
  public function busType(){
  

   $sql="SELECT t1.id, t1.seats_map, t1.seats_count, t1.status, t2.content as name FROM bus_schedule_bus_types AS t1 LEFT OUTER JOIN bus_schedule_multi_lang AS t2 ON t2.model='pjBusType' AND t2.foreign_id=t1.id AND t2.field='name' AND t2.locale='1' GROUP BY name ORDER BY name ASC LIMIT 25"; 
  $result = $this->conn->query($sql);
  if ($result->num_rows > 0) {
    
    while($row = $result->fetch_assoc()) {
     
      $array[]=$row;
       
    }
  return $array;

  }
  else
  {
  return false;
  }

 }
   
  public function busAmenitie($busid){
    
    $busid=$this->conn->real_escape_string($busid);
   $sql="SELECT * FROM `bus_schedule_amenitie` WHERE bus_id='$busid' LIMIT 25"; 
  $result = $this->conn->query($sql);
  if ($result->num_rows > 0) {
    
    while($row = $result->fetch_assoc()) {
     
      $array[]=$row;
       
    }
  return $array;

  }
  else
  {
  return array();
  }

 }
  
  public function classType($from,$to){
  
  $from=$this->conn->real_escape_string($from);
  $to=$this->conn->real_escape_string($to);
  
  $sql="SELECT t1.*, t3.content as ticket FROM bus_schedule_prices AS t1 FORCE KEY (`ticket_id`) LEFT OUTER JOIN bus_schedule_multi_lang AS t3 ON t3.model='pjTicket' AND t3.foreign_id=t1.ticket_id AND t3.field='title' AND t3.locale='1'  WHERE t1.from_location_id='$from' AND t1.to_location_id='$to' GROUP BY ticket ORDER BY ticket ASC LIMIT 5 "; 
  $result = $this->conn->query($sql);
  if ($result->num_rows > 0) {
    
    while($row = $result->fetch_assoc()) {
      
      $array[]=$row;
       
    }
  return $array;

  }
  else
  {
  return false;
  }

 }
    
  public function getRouteDetail($busId,$routeid){
  
  $busId=$this->conn->real_escape_string($busId);
  $routeid=$this->conn->real_escape_string($routeid);
  
    $sql="SELECT t1.*, t2.content as name, t3.departure_time, t3.arrival_time FROM bus_schedule_routes_cities AS t1 LEFT OUTER JOIN bus_schedule_multi_lang AS t2 ON t2.model='pjCity' AND t2.foreign_id=t1.city_id AND t2.field='name' AND t2.locale='1' LEFT JOIN bus_schedule_buses_locations AS t3 ON t3.bus_id='$busId' AND t3.location_id=t1.city_id WHERE route_id = '$routeid' ORDER BY t1.order ASC LIMIT 1000 "; 
  $result = $this->conn->query($sql);
  if ($result->num_rows > 0) {
    
    while($row = $result->fetch_assoc()) {
      
      $array[]=$row;
       
    }
  return $array;

  }
  else
  {
  return false;
  }

 }
      
  public function getBusSeat($bustype){
  
  $bustype=$this->conn->real_escape_string($bustype);
  
    $sql="SELECT t1.id, t1.bus_type_id, t1.width, t1.height, t1.top, t1.left, t1.name FROM bus_schedule_seats AS t1 WHERE bus_type_id = '$bustype' "; 
  $result = $this->conn->query($sql);
  if ($result->num_rows > 0) {
    
    while($row = $result->fetch_assoc()) {
      
      $array[]=$row;
       
    }
  return $array;

  }
  else
  {
  return false;
  }

 }
  
  
  public function addBooking($userid,$passengers,$seatnos,$seatids,$names,$surnames,$ages,$bus_id,$pickup_id,$return_id,$startdates,$routetxt,$enddates,$subtotal,$tax,$total,$route_id,$ticket_id,$startBoard,$endBoard,$PayMethod,$Bstatus,$fname,$email)
 {
  
   
    $uuid=$this->getUuid().$userid;
  
   $this->conn->autocommit(FALSE);
   
    $this->conn->begin_transaction();
    $error = array();
    
  $startdate=date('Y-m-d',strtotime($startdates));
  
  $starttime=date('H:i',strtotime($startdates));
  $enddate=date('Y-m-d',strtotime($enddates));
  $endtime=date('H:i',strtotime($enddates));
  $booking_time=$starttime.' - '.$endtime;
  $booking_datetime=$startdate.' '.$starttime;
  $stop_datetime=$enddate.' '.$endtime;
  $deposit=0;
    $sql="INSERT INTO `bus_schedule_bookings`(`uuid`,`user_id`, `bus_id`, `pickup_id`, `return_id`, `is_return`,  `booking_date`, `booking_time`, `booking_route`, `booking_datetime`, `stop_datetime`, `sub_total`, `tax`, `total`, `deposit`, `payment_method`,`startBoard`,`endBoard`,`c_title`,`c_fname`,`c_email`,`status`) value ('$uuid','$userid','$bus_id','$pickup_id','$return_id','F','$startdate','$booking_time','$routetxt','$booking_datetime','$stop_datetime','$subtotal','$tax','$total','$deposit','$PayMethod','$startBoard','$endBoard','Mr','$fname','$email','$Bstatus') ";


    if($this->conn->query($sql) === true){
    $bookId=$this->conn->insert_id;
    
    }
    else{
       $error[]=$this->conn->error;
    }
   $BookId=$bookId;

    for ($i=0; $i < count($seatnos); $i++) { 
   $passenger=$passengers[$i];
  
   $name=$names[$i];
   $seatno=$seatnos[$i];
   $seatid=$seatids[$i];
   $surname= $surnames[$i];
   
   $age=$ages[$i];
      $sql2="INSERT INTO `bus_schedule_bookings_items`(`uuid`,`seat_id`,`seat_no`, `userid`, `name`, `surname`, `age`,`gender`) VALUES ('$uuid','$seatid','$seatno','$userid','$name','$surname','$age','$passenger')";

      if($this->conn->query($sql2)){

      }
      else{
        $error[]=$this->conn->error;
      }

    }
  
  $location_pair = array();
  
  $location_arr = $this->getLocations($route_id, $pickup_id, $return_id);
  
  for($i = 0; $i < count($location_arr); $i++ )
  {
  $j = $i + 1;
    if($j < count($location_arr))
    {
      $location_pair[] = $location_arr[$i]['city_id'] . '-' . $location_arr[$j]['city_id'];
    }
  }
  
  $qty=count($seatids);
   $sqltick="INSERT INTO `bus_schedule_bookings_tickets`(`booking_id`, `ticket_id`, `qty`, `amount`, `is_return`) VALUES ('$BookId','$ticket_id','$qty','$subtotal','F') ";
    
   if($this->conn->query($sqltick)){

      }
      else{
        $error[]=$this->conn->error;
      }

    
    foreach($location_pair as $pair)
          {
            $_arr = explode("-", $pair);
            
             
              for ($i=0; $i < count($seatids); $i++) { 
              
                $booking_id = $BookId;
                $seat_id = $seatids[$i];
                $ticket_id = $ticket_id;
            
                $start_location_id = $_arr[0];
                $end_location_id = $_arr[1];
                $is_return = 'F';
            
               $sqlseat="INSERT INTO `bus_schedule_bookings_seats`(`booking_id`, `seat_id`, `ticket_id`, `start_location_id`, `end_location_id`, `is_return`) VALUES ('$booking_id','$seat_id','$ticket_id','$start_location_id','$end_location_id','$is_return') ";  
              
               if($this->conn->query($sqlseat)){

      }
      else{
        $error[]=$this->conn->error;
      }
    
              }
            
          }
        
          
       if(count($error) > 0){
    $this->conn->rollback();
   
    return array('status'=>true,'msg'=>$error);
   }
   else{
  
   $this->conn->commit();
   return array('status'=>true,'uuid'=>$uuid);
  }
     
  
 }
  
  public function addReturnBooking($userid,$passengers,$seatnos,$seatids,$names,$surnames,$ages,$bus_id,$pickup_id,$return_id,$startdates,$routetxt,$enddates,$subtotal,$tax,$total,$route_id,$ticket_id,$startBoard,$endBoard,$PayMethod,$Bstatus,$fname,$email,$returnUid)
 {
  
   
     $uuid=$this->getUuid().$userid;
   $this->conn->autocommit(FALSE);
   
    $this->conn->begin_transaction();
    $error = array();
    
  $startdate=date('Y-m-d',strtotime($startdates));
  
  $starttime=date('H:i',strtotime($startdates));
  $enddate=date('Y-m-d',strtotime($enddates));
  $endtime=date('H:i',strtotime($enddates));
  $booking_time=$starttime.' - '.$endtime;
  $booking_datetime=$startdate.' '.$starttime;
  $stop_datetime=$enddate.' '.$endtime;
  $deposit=0;
    $sql="INSERT INTO `bus_schedule_bookings`(`uuid`,`user_id`, `bus_id`, `pickup_id`, `return_id`, `is_return`,  `booking_date`, `booking_time`, `booking_route`, `booking_datetime`, `stop_datetime`, `sub_total`, `tax`, `total`, `deposit`, `payment_method`,`startBoard`,`endBoard`, `status`,`c_title`,`c_fname`,`c_email`,`returnUid`) value ('$uuid','$userid','$bus_id','$pickup_id','$return_id','T','$startdate','$booking_time','$routetxt','$booking_datetime','$stop_datetime','$subtotal','$tax','$total','$deposit','$PayMethod','$startBoard','$endBoard','$Bstatus','Mr','$fname','$email','$returnUid') ";

  

    if($this->conn->query($sql) === true){
    $bookId=$this->conn->insert_id;
    
    }
    else{
       $error[]=$this->conn->error;
    }
  
   $BookId=$bookId;
    for ($i=0; $i < count($seatnos); $i++) { 
   $passenger=$passengers[$i];
  
   $name=$names[$i];
   $seatno=$seatnos[$i];
   $seatid=$seatids[$i];
   $surname= $surnames[$i];
   
   $age=$ages[$i];
      $sql2="INSERT INTO `bus_schedule_bookings_items`(`uuid`,`seat_id`,`seat_no`, `userid`, `name`, `surname`, `age`,`gender`) VALUES ('$uuid','$seatid','$seatno','$userid','$name','$surname','$age','$passenger')";

      if($this->conn->query($sql2)){

      }
      else{
        $error[]=$this->conn->error;
      }

    }
  
  $location_pair = array();
  
  $location_arr = $this->getLocations($route_id, $pickup_id, $return_id);
  
  for($i = 0; $i < count($location_arr); $i++ )
  {
  $j = $i + 1;
    if($j < count($location_arr))
    {
      $location_pair[] = $location_arr[$i]['city_id'] . '-' . $location_arr[$j]['city_id'];
    }
  }
  
  $qty=count($seatids);
  $sqltick="INSERT INTO `bus_schedule_bookings_tickets`(`booking_id`, `ticket_id`, `qty`, `amount`, `is_return`) VALUES ('$BookId','$ticket_id','$qty','$subtotal','F') ";
    
   if($this->conn->query($sqltick)){

      }
      else{
        $error[]=$this->conn->error;
      }

    
    foreach($location_pair as $pair)
          {
            $_arr = explode("-", $pair);
            
             
              for ($i=0; $i < count($seatids); $i++) { 
              
                $booking_id = $BookId;
                $seat_id = $seatids[$i];
                $ticket_id = $ticket_id;
            
                $start_location_id = $_arr[0];
                $end_location_id = $_arr[1];
                $is_return = 'F';
            
               $sqlseat="INSERT INTO `bus_schedule_bookings_seats`(`booking_id`, `seat_id`, `ticket_id`, `start_location_id`, `end_location_id`, `is_return`) VALUES ('$booking_id','$seat_id','$ticket_id','$start_location_id','$end_location_id','$is_return') ";  
              
               if($this->conn->query($sqlseat)){

      }
      else{
        $error[]=$this->conn->error;
      }
    
              }
            
          }
        
          
       if(count($error) > 0){
    $this->conn->rollback();
   
    return array('status'=>true,'msg'=>$error);
   }
   else{
  
   $this->conn->commit();
    return array('status'=>true,'uuid'=>$uuid);
  }
     
  
 }

 

  public function addBookingUser($name, $email,$mobile) {
        
    $name=$this->conn->real_escape_string($name);
    $email=$this->conn->real_escape_string($email);
    $mobile=$this->conn->real_escape_string($mobile);
    $pass=$this->generateRandomString();
   
    $sql2 = "INSERT INTO bus_schedule_users(name, email,phone,password,role_id,status) VALUES ('$name','$email','$mobile',AES_ENCRYPT('$pass','".PJ_SALT."'),3,'T')";
     

     if (($this->conn->query($sql2) === TRUE) ) 
     {
      $userid=$this->conn->insert_id;


  $body ='your pass is:-'.$pass;
  
  $this->SendMail($email,'You Have Been Successfully Registered!',$body);
      return array('status'=>true,'uer_id'=>$userid);
   }  
    else{
           
     return array('status'=>false,'message' => $this->conn->error);
  
   }
 
     
     
 
         
       
  }

  public function addRouteRating($routeId, $rating,$review,$userid) {
        
    $routeId=$this->conn->real_escape_string($routeId);
    $rating=$this->conn->real_escape_string($rating);
    $review=$this->conn->real_escape_string($review);
    $userid=$this->conn->real_escape_string($userid);
   
    $sql2 = "INSERT INTO `bus_schedule_rating`(`user_id`, `route_id`, `rating`, `review`) VALUES ('$userid','$routeId','$rating','$review') ON DUPLICATE KEY  UPDATE status='1' ";
     

     if (($this->conn->query($sql2) === TRUE) ) 
     {
      
      return true;
   }  
    else{
           
     return false;
  
   }
 
     
     
 
         
       
  }

  
  public function getOrder($route_id, $city_id)
  {
    $route_id=$this->conn->real_escape_string($route_id);
    $city_id=$this->conn->real_escape_string($city_id);
  
    $sql="SELECT t1.route_id, t1.city_id, t1.order FROM bus_schedule_routes_cities AS t1 WHERE route_id = '$route_id' AND city_id = '$city_id' "; 
  $result = $this->conn->query($sql);
  if ($result->num_rows > 0) {
    
    $row = $result->fetch_assoc();
      
      $arr=$row;
  

  }
  
    return !empty($arr) ? $arr['order'] : null;
  }  

  public function userRouteRating($route_id, $userid)
  {
    $route_id=$this->conn->real_escape_string($route_id);
    $userid=$this->conn->real_escape_string($userid);
  
    $sql="SELECT * FROM `bus_schedule_rating` WHERE user_id='$userid' AND route_id='$route_id' ORDER BY id DESC  LIMIT 1 "; 
  $result = $this->conn->query($sql);
  if ($result->num_rows > 0) {
    
    $row = $result->fetch_assoc();
     return $row;
  }
   else{
    return array();
   } 
  
    
  }
  
  public function getBookingByUid($uid)
  {
  $uid=$this->conn->real_escape_string($uid);
    $sql="SELECT uuid,total,status,is_return,returnUid FROM bus_schedule_bookings  WHERE uuid = '$uid'  "; 
  $result = $this->conn->query($sql);
  if ($result->num_rows > 0) {
    
    $row = $result->fetch_assoc();
      
    return $row;
  
  }
  else{
      return array();
  }
    
  }
  
  
  public function getLocations($route_id, $pickup_id, $return_id)
  {
    $location_arr = array();

    $from_order = $this->getOrder($route_id, $pickup_id);
    $to_order = $this->getOrder($route_id, $return_id);
  $sql="SELECT t1.route_id, t1.city_id, t1.order FROM bus_schedule_routes_cities AS t1 WHERE  route_id = '$route_id' AND ($from_order <= t1.order AND t1.order <= $to_order) ";
  
    $result = $this->conn->query($sql);
  if ($result->num_rows > 0) {
    
    while($row = $result->fetch_assoc()) {
      
      $location_arr[]=$row;
       
    }
  }
    
    return $location_arr;
  }

    
  
  public function getLocationsArr($route_id, $pickup_id, $return_id)
  {
    $location_arr = array();

    $from_order = $this->getOrder($route_id, $pickup_id);
    $to_order = $this->getOrder($route_id, $return_id);
   $sql="SELECT t1.route_id, t1.city_id, t1.order FROM bus_schedule_routes_cities AS t1 WHERE  route_id = '$route_id' AND ($from_order <= t1.order AND t1.order <= $to_order) ";
  
    $result = $this->conn->query($sql);
  if ($result->num_rows > 0) {
    
    while($row = $result->fetch_assoc()) {
      
      $location_arr[]=$row['city_id'];
       
    }
  }
    
    return $location_arr;
  }
  
  public function getBoarding($city)
  {
 
     $city=$this->conn->real_escape_string($city);
        $array = array();
   $sql="SELECT * FROM `bus_schedule_bus_boarding` WHERE `city_id` = '$city' ORDER BY `city_id` ASC ";
  
    $result = $this->conn->query($sql);
  if ($result->num_rows > 0) {
    
    while($row = $result->fetch_assoc()) {
      
      $array[$row['operator_id']][]=$row;
       
    }
  }
    
    return $array;
  }

  
  public function bookedSeat($bus_id,$booking_datetime,$booking_end,$locationArr)
  {
    $bus_id=$this->conn->real_escape_string($bus_id);
    $booking_datetime=$this->conn->real_escape_string($booking_datetime);
    $booking_end=$this->conn->real_escape_string($booking_end);
    
  $locationArrs = implode("','",$locationArr);
    $location_arr=array();
   $sql="SELECT DISTINCT seat_id FROM bus_schedule_bookings_seats AS t1 WHERE t1.booking_id IN(SELECT TB.id FROM `bus_schedule_bookings` AS TB WHERE (TB.status='confirmed' OR (TB.status='pending' AND UNIX_TIMESTAMP(TB.created) >= UNIX_TIMESTAMP(DATE_SUB(NOW(), INTERVAL 30 MINUTE))))  AND TB.bus_id = '$bus_id' AND ((TB.booking_datetime BETWEEN '$booking_datetime' AND '$booking_end') OR (TB.stop_datetime BETWEEN '$booking_datetime' AND '$booking_end' ) OR ('$booking_datetime' BETWEEN TB.booking_datetime AND TB.stop_datetime ) OR ('$booking_end' BETWEEN TB.booking_datetime AND TB.stop_datetime ))) AND start_location_id IN('".$locationArrs."') ";
  
    $result = $this->conn->query($sql);
  if ($result->num_rows > 0) {
    
    while($row = $result->fetch_assoc()) {
      
      $location_arr[]=$row['seat_id'];
       
    }
  }
    
    return $location_arr;
  }
    
  public function getSlides()
  {
    
    
  
   $sql="SELECT MIN(bus_schedule_prices.price) AS minprice,bus_schedule_buses.operator_id,bus_schedule_users.name,bus_schedule_slide.slide FROM `bus_schedule_prices` LEFT JOIN bus_schedule_buses ON bus_schedule_buses.id=bus_schedule_prices.bus_id LEFT JOIN bus_schedule_slide ON bus_schedule_slide.operator_id=bus_schedule_buses.operator_id INNER JOIN bus_schedule_users ON bus_schedule_buses.operator_id=bus_schedule_users.id GROUP BY bus_schedule_buses.operator_id LIMIT 4 ";
  
  $result = $this->conn->query($sql);
  $array=array();
  if ($result->num_rows > 0) {
    
    while($row = $result->fetch_assoc()) {
      
      $array[]=$row;
       
    }
  }
    
    return $array;
  }
        
  public function getpopCity()
  {
    
    $sql="SELECT bus_schedule_bookings.id,bus_schedule_bookings.pickup_id,bus_schedule_bookings.return_id,COUNT(bus_schedule_bookings.pickup_id) AS most,t2.content as name,t3.content as rname FROM bus_schedule_bookings LEFT OUTER JOIN bus_schedule_multi_lang AS t2 ON t2.model='pjCity' AND t2.foreign_id=bus_schedule_bookings.pickup_id AND t2.field='name' AND t2.locale='1' LEFT OUTER JOIN bus_schedule_multi_lang AS t3 ON t3.model='pjCity' AND t3.foreign_id=bus_schedule_bookings.return_id AND t3.field='name' AND t3.locale='1' 
GROUP by bus_schedule_bookings.pickup_id ORDER BY most asc LIMIT 4 ";
  
  $result = $this->conn->query($sql);
  $array=array();
  if ($result->num_rows > 0) {
    
    while($row = $result->fetch_assoc()) {
      
      $array[]=$row;
       
    }
  }
    
    return $array;
  }
      
  public function getSlidesOp()
  {
    
    
  
   $sql="SELECT MIN(bus_schedule_prices.price) AS minprice,bus_schedule_prices.bus_id FROM `bus_schedule_prices` LEFT JOIN bus_schedule_buses ON bus_schedule_buses.id=bus_schedule_prices.bus_id  GROUP BY bus_schedule_prices.bus_id LIMIT 50";
  $result = $this->conn->query($sql);
  $array=array();
  if ($result->num_rows > 0) {
    
    while($row = $result->fetch_assoc()) {
      
      $array[$row['bus_id']]=$row;
       
    }
  }
    
    return $array;
  }
           
  public function getOperator()
  {
    
    
  
   $sql="SELECT bus_schedule_users.id, bus_schedule_users.name, MIN(bus_schedule_prices.price) AS minprice FROM `bus_schedule_users` LEFT JOIN bus_schedule_buses ON bus_schedule_buses.operator_id=bus_schedule_users.id LEFT JOIN bus_schedule_prices ON bus_schedule_buses.id=bus_schedule_prices.bus_id WHERE bus_schedule_users.role_id=2 GROUP BY bus_schedule_users.id LIMIT 20";
  $result = $this->conn->query($sql);
  $array=array();
  if ($result->num_rows > 0) {
    
    while($row = $result->fetch_assoc()) {
      
      $array[]=$row;
       
    }
  return $array;
  }
  else{
    return false;
  }
    
    
  }
  public function getUserProfile($Id)
  {
    
    
  $Id=$this->conn->real_escape_string($Id);
   $sql="SELECT `id`, `role_id`, `email`, `name`, `countryCode`, `phone`, `created`, `last_login`, `status`, `is_active`, `ip` FROM `bus_schedule_users` WHERE id='$Id' LIMIT 1";
  $result = $this->conn->query($sql);
  $array=array();
  if ($result->num_rows > 0) {
    
   $row = $result->fetch_assoc();
      
    
  return  $row;
  }
  else{
    return array();
  }
    
    
  }

    public function getUserPassword($Id,$Password)
  {
    
    
  $Id=$this->conn->real_escape_string($Id);
  $Password=$this->conn->real_escape_string($Password);
   $sql="SELECT * FROM bus_schedule_users WHERE id = '$Id' and password = AES_ENCRYPT('$Password', '".PJ_SALT."') ";
  $result = $this->conn->query($sql);

  if ($result->num_rows > 0) {
    
    return 1;
  }
  else{
    return 0;
  }
    
    
  }
      
        public function changePassword($id,$newpass)
      {
      
       $id=$this->conn->real_escape_string($id);
       $newpass=$this->conn->real_escape_string($newpass);
       $sql="UPDATE `bus_schedule_users` SET password=AES_ENCRYPT('$newpass','".PJ_SALT."')  WHERE id='$id' ";
       if($this->conn->query($sql) === true ){
          return true;
       }
       else{
        return false;
       }

      }

  public function operatorBusesf($operator)
  {
    
   $sql="SELECT t1.*, t2.content AS route FROM bus_schedule_buses AS t1 LEFT OUTER JOIN bus_schedule_multi_lang AS t2 ON t2.model='pjRoute' AND t2.foreign_id=t1.route_id AND t2.field='title' AND t2.locale='1' WHERE t1.operator_id = '$operator' ORDER BY route ASC LIMIT 0, 20 ";
  
  $result = $this->conn->query($sql);
  $array=array();
  if ($result->num_rows > 0) {
    
    while($row = $result->fetch_assoc()) {
      
      $array[]=$row;
       
    }
  }
    
    return $array;
  }
        
  public function operatorBuses($operator)
  {
    
   $sql="SELECT t1.*, t2.content AS route, t3.from_location_id, t3.to_location_id, t5.content AS fromtxt, t6.content AS totxt FROM bus_schedule_buses AS t1 LEFT OUTER JOIN bus_schedule_multi_lang AS t2 ON t2.model = 'pjRoute' AND t2.foreign_id = t1.route_id AND t2.field = 'title' AND t2.locale = '1' LEFT JOIN bus_schedule_route_details AS t3 ON t3.route_id = t1.route_id LEFT OUTER JOIN bus_schedule_multi_lang AS t5 ON t5.model = 'pjCity' AND t5.foreign_id = t3.from_location_id AND t5.field = 'name' AND t5.locale = '1' LEFT OUTER JOIN bus_schedule_multi_lang AS t6 ON t6.model = 'pjCity' AND t6.foreign_id = t3.to_location_id AND t6.field = 'name' AND t6.locale = '1' WHERE t1.operator_id = '11' ORDER BY route ASC";
  
  $result = $this->conn->query($sql);
  $array=array();
  if ($result->num_rows > 0) {
    
    while($row = $result->fetch_assoc()) {
      
      $array[]=$row;
       
    }
  }
    
    return $array;
  }
  
  public function generateRandomString($length = 10) {
    return substr(str_shuffle(str_repeat($x='ABCDEFGHIJKLMNOPQRSTUVWXYZ', ceil($length/strlen($x)) )),1,$length);
  }
  
  public function  getUuid()
  {
   return str_replace(".","",microtime(true)).rand(000,999);

  }
  
  public function confirmBooking($uid){
    $Booking=$this->getBookingByUid($uid);
    $sql="UPDATE `bus_schedule_bookings` SET status='confirmed' WHERE uuid='$uid' ";
    if($Booking['is_return'] == 'T'){
    $uuid1=$Booking['returnUid'];
    $sql.="UPDATE `bus_schedule_bookings` SET status='confirmed' WHERE uuid='$uuid1' "; 
    
    }
    
    if($this->conn->multi_query($sql)){

      return true;
       }
      else{
        
         return false;
      }
        
  } 
  
  public function deleteBooking($uid){
    $Booking=$this->getBookingByUid($uid);
    $sql="DELETE FROM `bus_schedule_bookings` WHERE uuid='$uid' ";
    if($Booking['is_return'] == 'T'){
    $uuid1=$Booking['returnUid'];
    $sql.="DELETE FROM `bus_schedule_bookings` WHERE uuid='$uuid1' "; 
    
    }
    
    if($this->conn->multi_query($sql)){

      return true;
       }
      else{
        
         return false;
      }
        
  }
 
    public function bookingHistory($search,$userId,$start,$end,$cancel=null){

   
  $array=array();

  $sql="SELECT t1.*, t2.departure_time, t2.arrival_time, t3.content as route_title, t4.content as from_location, t5.content as to_location FROM bus_schedule_bookings AS t1 LEFT OUTER JOIN bus_schedule_buses AS t2 ON t2.id=t1.bus_id LEFT OUTER JOIN bus_schedule_multi_lang AS t3 ON t3.model='pjRoute' AND t3.foreign_id=t2.route_id AND t3.field='title' AND t3.locale='1' LEFT OUTER JOIN bus_schedule_multi_lang AS t4 ON t4.model='pjCity' AND t4.foreign_id=t1.pickup_id AND t4.field='name' AND t4.locale='1' LEFT OUTER JOIN bus_schedule_multi_lang AS t5 ON t5.model='pjCity' AND t5.foreign_id=t1.return_id AND t5.field='name' AND t5.locale='1'  WHERE  t1.user_id='$userId'  "; 



   if (!empty($search)) {
    $search=$this->conn->real_escape_string($search);
    
  $sql.=" and t1.booking_route like '".$search."%'";

  }

   if (isset($cancel)) {
   
   $sql.=" and t1.cancelStatus != '0' ";

  }
  else{
   $sql.=" and t1.cancelStatus = '0' ";
  }

  $sql.=" ORDER BY booking_datetime DESC ";

   $query=$sql.' LIMIT ' . $start . ', ' . $end;

  $get_all =$this->conn->query($sql)->num_rows;
  $result = $this->conn->query($query);

  if ($result->num_rows > 0) {
    
     while($row=$result->fetch_assoc()){
       $data[]=$row;
     }

   return array("data"=>$data,'cTotal'=>$get_all) ;
  }
  else
  {
  return array("data"=>array(),'cTotal'=>0);
  }


}
  

  public function cancelBooking($id,$uid,$s=0){
  
    $sql="UPDATE `bus_schedule_bookings` SET cancelStatus='$s' WHERE uuid='$uid' AND id='$id' ";
 
    if($this->conn->multi_query($sql)){

      return true;
       }
      else{
        
         return false;
      }
        
  } 

}
 
 //
?>