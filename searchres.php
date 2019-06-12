<?php
ob_start();
session_start();
?>
   <li class="hidden-xs">
                                        <div class="booking-item-container" data-spy="affix" data-offset-top="175" style="text-align: center;">
                                            <div class="booking-item">
                                                <div class="row">

                                                    <div class="col-md-2">
                                                        <div class="booking-item-airline-logo">
														<h5>Bus</h5>
                                                        </div>
                                                    </div>
                                                    

                                                    <div class="col-md-3">
                                                        <div class="booking-item-flight-details">
                                                            <div class="booking-item-departure">
                                                                <h5>Departure</h5>
                                                                
                                                            </div>
                                                            <div class="booking-item-arrival">
                                                                <h5>Arrival</h5>
                                                                
                                                            </div>
                                                        </div>
                                                    </div>
                                                    
                                                   <!--  <div class="col-md-2">
                                                        <h5>Duration</h5>                                                  
                                                    </div> -->
                                                     <div class="col-md-1">
                                                        <h5>Rating</h5>                                                  
                                                    </div>

                                                      <div class="col-md-1">
                                                        <h5>Route</h5>                                                  
                                                    </div>

                                                    <div class="col-md-1">
                                                        <h5>Seats</h5>                                                  
                                                    </div>

                                                    <div class="col-md-2">
                                                        <h5>Fare</h5>
                                                       
                                                    </div>

                                                    <div class="col-md-2">
                                                        
                                                       
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </li>
<?php

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

   require_once 'config/config.php';

require_once CLASSPATH.'DB_Functions.php';
$DBUSER= new DB_Functions();

	$pickup_id=escape_string($_POST['pickup_id']);
	$return_id=escape_string($_POST['return_id']);
	
	$pickup_text=escape_string($_POST['fromtxt']);
	$return_text=escape_string($_POST['totxt']);
	$date=escape_string($_POST['dpdate']);
	$busTypes=(isset($_POST['busTypes'])) ? $_POST['busTypes'] : null;
	$classtype=(isset($_POST['classtype'])) ? $_POST['classtype'] : null ;
	$isreturn=escape_string($_POST['isreturn']);
	$isback=(isset($_POST['isback'])) ? 'Y' : 'N';
	$operatorId=(isset($_POST['operator'])) ? $_POST['operator'] : null ;

	$dptime=(isset($_POST['dptime'])) ? $_POST['dptime'] : null ;
	$price=(isset($_POST['price'])) ? $_POST['price'] : null ;
	$passengerid=(isset($_POST['passengerid'])) ? $_POST['passengerid'] : 0 ;
	$Url= ($isreturn == 'T') ? "return-search.php" : "bus-booking.php";
	$BusesRoutes=$DBUSER->getBusesRoutes($pickup_id,$return_id,$date,$busTypes,$dptime,$operatorId);
	if($BusesRoutes != false){
		
		$StartBoarding=$DBUSER->getBoarding($pickup_id);
		$EndBoarding=$DBUSER->getBoarding($return_id);

		foreach($BusesRoutes  as $Routes){
			
		$Tickets=$DBUSER->getTicketType($pickup_id,$return_id,$Routes['id'],$classtype,$price);
		$BookingTickets=$DBUSER->getBookingTicket($Routes['bus_type_id'],$pickup_id,$return_id,$Routes['id'],$date);
		$BookingTicket= ($BookingTickets > 0) ? $BookingTickets : 0;
		$SeatAvab=$Routes['seats_count']-$BookingTicket;
		$startimes=$date.' '.$Routes['departure_time'];
		$endtimes=$date.' '.$Routes['arrival_time'];
		$starttime=strtotime($startimes);
		$endtime=strtotime($endtimes);
		$timetodisplay = ($endtime - $starttime);
		$busAmenitie=$DBUSER->busAmenitie($Routes['id']);
		if($Tickets != false){
		
		?>
			<li>
                                        <div class="booking-item-container" style="text-align: center;">
                                            <div class="booking-item viewed">
                                                <div class="row">
                                                    <div class="col-md-2 col-xs-12 text-center">
                                                        <div class="booking-item-airline-logo">
                                                            <img src="img/american-airlines.jpg" alt="Image Alternative text" title="Image Title">
                                                            <p><?php echo $Routes['name'] ?></p>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-3 col-xs-8">
                                                        <div class="booking-item-flight-details">
                                                            <div class="booking-item-departure">
                                                                <!-- <i class="fa fa-arrow-circle-up" style="font-size: 3rem; float: left; padding: 1px;"></i> -->
                                                                <h5><span class="visible-xs">Departure</span><?php echo  
																date('H:i', strtotime($Routes['departure_time']));
																?></h5>
                                                               <!--  <p class="booking-item-date"><?php 
																//echo date('D, M d', strtotime($date));
																?></p>
                                                                <p class="booking-item-destination"><?php  //echo $pickup_text ?></p> -->
                                                            </div>
                                                            <div class="booking-item-arrival">
                                                               <!--  <i class="fa fa-arrow-circle-down" style="font-size: 3rem; float: left; padding: 1px;"></i> -->

                                                                <h5><span class="visible-xs">Arrival</span><?php echo  
																date('H:i', strtotime($Routes['arrival_time']));
																?></h5>
                                                                
																	<!-- <p class="booking-item-date"><?php 
																//echo date('D, M d', strtotime($date));
																?>
																</p>
                                                                <p class="booking-item-destination"><?php  //echo $return_text ?></p> -->
                                                            </div>
                                                        </div>
              


                                                    </div>
                                                 
											<!-- <div class="col-md-2 col-xs-6">
                                                        <h5><span class="visible-xs">Duration</span><?php echo Jsonfoo($timetodisplay) ?></h5>
                                                    </div> -->

    <div class="col-md-1 col-xs-4">
         <div class="booking-item-rating" style="border: 0px;">
         	<?php
         		if(isset($_SESSION['userId'])){
         			$cls="rating-user";
         		}
         		else{
         			$cls="";
         		}
         	?>

         	<h5><span class="booking-item-rating-number <?php echo $cls ?>" data-route="<?php echo $Routes['route_id'] ?>">Route</span>4.7</h5>
           


                                </div>
    </div>

    											<div class="col-md-1 col-xs-4">
                                                        <h5><span class="visible-xs">Route</span><a class="popup-text route-details" href="#small-dialog<?php echo $Routes['id'] ?>" data-effect="mfp-zoom-out" data-bus="<?php echo $Routes['id'] ?>" data-route="<?php echo $Routes['route_id'] ?>" ><i class="fa  fa-road"></i></a></h5>

                                                        <div id="small-dialog<?php echo $Routes['id'] ?>" class="mfp-with-anim mfp-hide mfp-dialog" style="max-width: 850px; max-height: auto; "></div>                                                  
                                                    </div>

                                                   

                                                    <div class="col-md-1 col-xs-4">
                                                        <h5><span class="visible-xs">Seats</span><?php echo $SeatAvab ?> left</h5>                                                  
                                                    </div>

                                                    <div class="col-md-2 col-xs-4">
													<span class="visible-xs">Fare</span>
												<?php 
													if($Tickets != false){
			
														foreach($Tickets as $Ticket){
															?>
													<span class="booking-item-price">  ₦<?php echo abs($Ticket['price']) ?> <small><?php echo $Ticket['ticket'] ?></small> </span> <br>
													<?php
															
														}
													}
													?>


													</div>




												<div class="col-md-2 col-xs-12">
													<?php 
													if($SeatAvab >= 0){
														?>
													<button class="btn btn-primary view-seat-ng"> View Seat</button>
													<br>
													<a href="#" target="_blank" data-toggle="modal" data-target="#cancellation">Cancel Policy </a>	
												<?php 
												}
												else{
													?>
													<button class="btn btn-danger" > Sold Out</button>
													<?php
												}
												?>		
													</div>






                                                </div>

                                            <div class="row __footer_row">
                                                 <div class="col-xs-6">
                                                    <ul class="booking-item-features booking-item-features-rentals booking-item-features-sign">
													<?php 
													if(count($busAmenitie) > 0){

														foreach ($busAmenitie as $Amenitie) {
															
													if(strtolower($DBAmenities[$Amenitie['amId']]) == 'sleeper'){
														?>
														 <li rel="tooltip" data-placement="top" title="Sleeper" data-original-title="Sleeper"  data-toggle="tooltip" ><i class="im im-bed"></i>
                                                        </li>
														<?php 
													}

													if(strtolower($DBAmenities[$Amenitie['amId']]) == 'wifi'){
														?>
														 <li rel="tooltip" data-placement="top" title="WIFI" data-original-title="WIFI"  data-toggle="tooltip" ><i class="im im-wi-fi"></i>
                                                        </li>
														<?php 
													}

													
													if(strtolower($DBAmenities[$Amenitie['amId']]) == 'ac'){
														?>
														 <li rel="tooltip" data-placement="top" title="AC"  data-toggle="tooltip" data-original-title="AC"><i class="im im-air"></i> </li>
														<?php 
													}
													if(strtolower($DBAmenities[$Amenitie['amId']]) == 'bedrooms'){
														?>
														 <li rel="tooltip" data-placement="top" title="AC"  data-toggle="tooltip" data-original-title="AC"><i class="im im-air"></i> </li>
														<?php 
													}

													if(strtolower($DBAmenities[$Amenitie['amId']]) == 'bathrooms'){
														?>
														<li rel="tooltip" data-placement="top" title="Bathroom"  data-toggle="tooltip" data-original-title="Bathroom"><i class="im im-shower"></i>
                                                        </li>
														<?php 
													}

													
													if(strtolower($DBAmenities[$Amenitie['amId']]) == 'audio'){
															?>
															<li rel="tooltip" data-placement="top" title="Audio System"  data-toggle="tooltip" data-original-title="Audio System"><i class="fa fa-headphones"></i>
                                                        </li>
															<?php 
														}


														}
													}

													

													?>
													
                                                      	
                                                       
                                                        
														
                                                    </ul>
                                                </div>

                                 				
                                 					

                                            </div>

                                            </div>
                                            <div class="booking-item-details">
                                                <div class="row">

                <div class="row" style="margin: 0px;">
                    
                    <div class="col-md-6">
                        <h4 class="seatmodal" style="margin-left: 20px;cursor: pointer;color: #ed8323;" data-type="<?php echo $Routes['bus_type_id'] ?>" data-uid="uuidinput<?php echo $Routes['id'] ?>" data-seat="<?php echo $Routes['seats_map'] ?>"  data-bus="<?php echo $Routes['id'] ?>" data-pic="<?php echo $pickup_id ?>" data-start="<?php echo $startimes ?>" data-end="<?php echo $endtimes ?>"	data-ret="<?php echo $return_id ?>" data-route="<?php echo $Routes['route_id'] ?>"> <div class="i-check">
                                                <label>
                                                    <input class="i-check" type="checkbox"  name="bustypes[]" />
                                                </label>
                                            </div> Choose your seat <small id="uuidinput<?php echo $Routes['id'] ?>-text"> </small></h4> 
                       
                       
                   
                      
                        <p>
						<form method="post" action="<?php echo $Url ?>" onsubmit="return checkbooking('uuidinput<?php echo $Routes['id'] ?>')">
						
						 <h4>Boarding Point</h4>
                        <select class="form-control" name="startBoard">
                                    <option>Select</option>
									<?php 
									
		
									if(count($StartBoarding[$Routes['operator_id']]) > 0){
										foreach($StartBoarding[$Routes['operator_id']] as $startBoard){
								
											echo "<option value='".$startBoard['id']."'>".$startBoard['boarding']."</option>";
										}
										
									?>
                                   
                                   
									<?php } ?>
                                </select>
                        <div class="gap gap-small"></div>
                        <h4>Drop-off Points</h4>
                        <select class="form-control" name="endBoard">
                                    <option>Select</option>
                                  <?php 
									
									if(count($EndBoarding[$Routes['operator_id']]) > 0){
										foreach($EndBoarding[$Routes['operator_id']] as $endBoard){
											echo "<option value='".$endBoard['id']."'>".$endBoard['boarding']."</option>";
										}
										
									?>
                                   
                                   
									<?php } ?>
                                </select>
								
						<input type="hidden" name="jsondata" value='<?php echo json_encode($_POST); ?>' >
						<input type="hidden" name="isback" value='<?php echo $isback ?>' >
						<input type="hidden" name="bus_id" value="<?php echo $Routes['id'] ?>" >
						<input type="hidden" name="ticket_id" value="<?php echo count($Tickets) ?>" >	
						<input type="hidden" name="seat_no" value="X" id="uuidinput<?php echo $Routes['id'] ?>">	
						<input type="hidden" name="seat_id" value="X" id="uuidinput<?php echo $Routes['id'] ?>-main">	
						<input type="hidden" name="from_location_id" value="<?php echo $pickup_id ?>" >
						<input type="hidden" name="to_location_id" value="<?php echo $return_id ?>" >
						
						<input type="hidden" name="to_location_id" value="<?php echo $return_id ?>" >
						<input type="hidden" name="pickup_text" value="<?php echo $pickup_text ?>" >
						<input type="hidden" name="return_text" value="<?php echo $return_text ?>" >
						
						<input type="hidden" name="startimes" value="<?php echo $startimes ?>" >
						<input type="hidden" name="endtimes" value="<?php echo $endtimes ?>" >
				
						<input type="hidden" name="return_text" value="<?php echo $return_text ?>" >
						<input type="hidden" name="route_id" value="<?php echo $Routes['route_id'] ?>" >
						
						<input type="hidden" name="passenger" class="passengersel" value="<?php echo $passengerid ?>" >
                            <br><button type="submit" class="btn btn-primary book-tripc" data-from="">Book your trip</button>
                        
						</form>
						 
						</p>
                    </div>
                </div>
                
           
                                                </div>
                                            </div>
                                        </div>
                                    </li>
		<?php
		 }
		}
	 }
	 else{
		 echo "<h5 class='text-danger'>No Bus Found </h5>";
	 }
	}

 function escape_string($data) {
  $data = trim(htmlentities(strip_tags($data)));

  if (get_magic_quotes_gpc())
    $data = stripslashes($data);

  return $data;
 }
 
   function Jsonfoo($seconds) {
  $t = round($seconds);
  return sprintf('%02dh %02dm', ($t/3600),($t/60%60));
}

 ?>
