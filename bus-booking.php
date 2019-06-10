<?php 

ob_start();


	if(empty($_POST['bus_id']) || empty($_POST['from_location_id']) || empty($_POST['to_location_id']) ){
		die('<h3> No Direct Allowed</h3>');
	}
	
	
 $pagetitle="TripOn - Booking "; 
    include_once('lib/header.php') ?>

        <div class="gap"></div>
		<?php 
		if(($_POST['passenger']) <= 0){
			die('Please Select Min one passenger');
		}
	   require_once 'config/config.php';

	require_once CLASSPATH.'DB_Functions.php';
	$DBUSER= new DB_Functions();
	

	
	$isback = $_POST['isback'];
	
	if(isset($_COOKIE['first_booking']) && $isback == 'Y'){
		$OldData=json_decode($_COOKIE['first_booking']);	
	$Old_bus_id = $OldData->bus_id;
	$Old_ticket_id = $OldData->ticket_id ;
    $Old_from_location_id = $OldData->from_location_id ;
    $Old_to_location_id = $OldData->to_location_id ;
    $Old_pickup_text = $OldData->pickup_text ;
    $Old_return_text = $OldData->return_text ;
    $Old_startimes = $OldData->startimes ;
    $Old_endtimes = $OldData->endtimes ;
    $Old_passenger = $OldData->passenger ;
    $Old_route_id = $OldData->route_id ;
    $Old_seat_no = $OldData->seat_no ;
    $Old_seat_id = $OldData->seat_id ;
    $Old_startBoard = $OldData->startBoard ;
    $Old_endBoard = $OldData->endBoard ;
	
	$Old_seat_no_arr =explode(",",$OldData->seat_no);
	$Old_seat_id_arr =explode(",",$OldData->seat_id);
	
	$Old_starttime=strtotime($Old_startimes);
	$Old_endtime=strtotime($Old_endtimes);
	$Old_timetodisplay = ($Old_endtime - $Old_starttime);
	$Old_routetxt='From '.$Old_pickup_text.' To '.$Old_return_text;
	$Old_Tickets=$DBUSER->getTicketType($Old_from_location_id,$Old_to_location_id,$Old_bus_id);
	}
	else{
		$OldData=array();
	}
	
	$bus_id = $_POST['bus_id'];
	$ticket_id = $_POST['ticket_id'] ;
    $from_location_id = $_POST['from_location_id'] ;
    $to_location_id = $_POST['to_location_id'] ;
    $pickup_text = $_POST['pickup_text'] ;
    $return_text = $_POST['return_text'] ;
    $startimes = $_POST['startimes'] ;
    $endtimes = $_POST['endtimes'] ;
    $passenger = $_POST['passenger'] ;
    $route_id = $_POST['route_id'] ;
    $seat_no = $_POST['seat_no'] ;
    $seat_id = $_POST['seat_id'] ;
	
    $startBoard = $_POST['startBoard'];
    $endBoard = $_POST['endBoard'];
	$seat_no_arr =explode(",",$_POST['seat_no']);
	$seat_id_arr =explode(",",$_POST['seat_id']);
	
	$starttime=strtotime($startimes);
	$endtime=strtotime($endtimes);
	$timetodisplay = ($endtime - $starttime);
	$routetxt='From '.$pickup_text.' To '.$return_text;
	$Price=$DBUSER->ticketPrice($from_location_id,$to_location_id,$bus_id,$ticket_id);
	$Tickets=$DBUSER->getTicketType($from_location_id,$to_location_id,$bus_id);

				 
		?>		

        <div class="container">
            <div class="row">
                <div class="col-md-8">
				<?php 
				
				if(!isset($_SESSION['userId'])){
				?>
                    <h3>Customer</h3>
                    <p>Sign in to your <a href="#">Traveler account</a> for fast booking.</p>
                    <form>
                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>First & Last Name</label>
                                    <input class="form-control required" id="name-no" type="text" />
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>Phone Number</label>
                                    <input class="form-control required" id="phn-no" type="text" />
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>E-mail</label>
                                    <input class="form-control required" id="email-no" type="text" />
                                </div>
                            </div>
                        </div>
                        <div class="checkbox">
                            <label>
                                <input class="i-check" id="trvchk" type="checkbox" checked/>Create Traveler account <small>(password will be send to your e-mail)</small>
								
                            </label>
                        </div>
                    </form>
				<?php }
				else{
					echo  '<input class="form-control required" id="email-no" type="hidden" value="'.$_SESSION['email'].'" />';
					echo  '<input class="form-control required" id="name-no" type="hidden" value="'.$_SESSION['name'].'" />';
				}
	$startBoard = $_POST['startBoard'];
    $endBoard = $_POST['endBoard'];	
				?>
                    <div class="gap gap-small"></div>
                  
                    <div class="clearfix"></div>
                    <h3>Passengers</h3>
					<?php 
						if($isback == 'Y'){
					?>
					



                    <ul class="list booking-item-passengers" >
					<form method="post" id="booking_form">
					<input type="hidden" name="isback" value="<?php echo $isback ?>">
					<input type="hidden" name="action" value="bookbus" >
					<input type="hidden" name="ftotalval" class="ftotalval"  >
					<input type="hidden" name="ftaxtotalval" class="ftaxtotalval"  >
					<input type="hidden" name="ltotalval" class="ltotalval"  >
					<input type="hidden" name="ltaxtotalval" class="ltaxtotalval"  >

					<input type="hidden" name="passengertotal" value="<?php echo $Old_passenger ?>">
					
					<input type="hidden" name="route_id" value="<?php echo $Old_route_id ?>" >
					<input type="hidden" name="ticket_id" value="<?php echo $Old_ticket_id ?>" >
					
					<input type="hidden" name="startBoard" value="<?php echo $Old_startBoard ?>" >
					<input type="hidden" name="endBoard" value="<?php echo $Old_endBoard ?>" >

					<input type="hidden" name="return_passengertotal" value="<?php echo $passenger ?>">
					
					<input type="hidden" name="return_route_id" value="<?php echo $route_id ?>" >
					<input type="hidden" name="return_ticket_id" value="<?php echo $ticket_id ?>" >
					
					<input type="hidden" name="return_startBoard" value="<?php echo $startBoard ?>" >
					<input type="hidden" name="return_endBoard" value="<?php echo $endBoard ?>" >

					<?php
					
					
					for($i=1;$i<count($Old_seat_no_arr);$i++){
					?>
                        <li>
                            <div class="row">
							
							
								 <div class="col-md-1" >
                                    <div class="form-group">
                                        <label>Seat</label>
                                        <input class="form-control" type="text" value="<?php echo $Old_seat_no_arr[$i] ?>" readonly style="padding: 6px 7px;" />
										 <input type="hidden" name="seatno[]" value="<?php echo $Old_seat_no_arr[$i] ?>">
                                   <input type="hidden" name="seatid[]" value="<?php echo $Old_seat_id_arr[$i] ?>">
                                 
                                 
                                    </div>
                                </div>
								
								
								<div class="col-md-2">
										<div class="form-group">
										    <label for="exampleFormControlSelect1">Gender</label>
										    <select class="form-control required" name="passenger[]" >
										      <option value="">-Select-</option>
										      <option value="M">Male</option>
										      <option value="F">Female</option>
										    </select>
										  </div>
									</div>
									
                         
								
								
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label>First Name</label>
                                        <input class="form-control required" name="name[]" type="text" />
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label>Last Name</label>
                                        <input class="form-control required" name="surname[]" type="text" />
                                    </div>
                                </div>
								
						
									
                               <div class="col-md-1">
                                    <div class="form-group">
                                        <label>Age</label>
                                        <input class="form-control required" name="age[]" type="text" style="padding: 6px 7px;"/>
                                    </div>
                                </div>

                                		<div class="col-md-2">
										<div class="form-group">
						 <label for="exampleFormControlSelect1">Ticket Type</label>
										    <select class="form-control ticket-type required" >
										      <option value="">-Select-</option>
										      <?php 
										      foreach ($Old_Tickets as $Ticket) {
										     
										      ?>
										      <option value="1" data-price="<?php echo $Ticket['price'] ?>"><?php echo  $Ticket['ticket'] ?></option>
										     <?php } ?>
										    </select>
										  </div>
									</div>

                            </div>
                        </li>
					<?php 
					
					} ?>
					<h2>Return Tickets </h2>
					
					<?php
					
					
					for($i=1;$i<count($seat_no_arr);$i++){
					?>
                        <li>
                            <div class="row">
							
							
								 <div class="col-md-1" >
                                    <div class="form-group">
                                        <label>Seat</label>
                                        <input class="form-control" type="text" value="<?php echo $seat_no_arr[$i] ?>" readonly style="padding: 6px 7px;" />
										 <input type="hidden" name="return_seatno[]" value="<?php echo $seat_no_arr[$i] ?>">
                                   <input type="hidden" name="return_seatid[]" value="<?php echo $seat_id_arr[$i] ?>">
                                 
                                 
                                    </div>
                                </div>
								
								
								<div class="col-md-2">
										<div class="form-group">
										    <label for="exampleFormControlSelect1">Gender</label>
										    <select class="form-control required" name="return_passenger[]" >
										      <option value="">-Select-</option>
										      <option value="M">Male</option>
										      <option value="F">Female</option>
										    </select>
										  </div>
									</div>
									
                         
								
								
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label>First Name</label>
                                        <input class="form-control required" name="return_name[]" type="text" />
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label>Last Name</label>
                                        <input class="form-control required" name="return_surname[]" type="text" />
                                    </div>
                                </div>
								
						
									
                               <div class="col-md-1">
                                    <div class="form-group">
                                        <label>Age</label>
                                        <input class="form-control required" name="return_age[]" type="text" style="padding: 6px 7px;"/>
                                    </div>
                                </div>

                                		<div class="col-md-2">
										<div class="form-group">
						 <label for="exampleFormControlSelect1">Ticket Type</label>
										    <select class="form-control return-ticket-type required" >
										      <option value="">-Select-</option>
										      <?php 
										      foreach ($Tickets as $Ticket) {
										     
										      ?>
										      <option value="1" data-price="<?php echo $Ticket['price'] ?>"><?php echo  $Ticket['ticket'] ?></option>
										     <?php } ?>
										    </select>
										  </div>
									</div>

                            </div>
                        </li>
					<?php 
					
					} ?>
					</form>
                    </ul>
						<?php }
					else{
						?>
						 <ul class="list booking-item-passengers" >
					<form method="post" id="booking_form">
					<input type="hidden" name="isback" value="N">
					<input type="hidden" name="action" value="bookbus" >
						
					<input type="hidden" name="passengertotal" value="<?php echo $passenger ?>">
						<input type="hidden" name="ftotalval" class="ftotalval"  >
					<input type="hidden" name="ftaxtotalval" class="ftaxtotalval"  >
					<input type="hidden" name="route_id" value="<?php echo $route_id ?>" >
					<input type="hidden" name="ticket_id" value="<?php echo $ticket_id ?>" >
					<input type="hidden" name="startBoard" value="<?php echo $startBoard ?>" >
					<input type="hidden" name="endBoard" value="<?php echo $endBoard ?>" >

					<?php
					
					
					for($i=1;$i<count($seat_no_arr);$i++){
					?>
                        <li>
                            <div class="row">
							
							
								 <div class="col-md-1" >
                                    <div class="form-group">
                                        <label>Seat</label>
                                        <input class="form-control" type="text" value="<?php echo $seat_no_arr[$i] ?>" readonly style="padding: 6px 7px;" />
										 <input type="hidden" name="seatno[]" value="<?php echo $seat_no_arr[$i] ?>">
                                   <input type="hidden" name="seatid[]" value="<?php echo $seat_id_arr[$i] ?>">
                                 
                                 
                                    </div>
                                </div>
								
								
								<div class="col-md-2">
										<div class="form-group">
										    <label for="exampleFormControlSelect1">Gender</label>
										    <select class="form-control required" name="passenger[]" >
										      <option value="">-Select-</option>
										      <option value="M">Male</option>
										      <option value="F">Female</option>
										    </select>
										  </div>
									</div>
									
                         
								
								
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label>First Name</label>
                                        <input class="form-control required" name="name[]" type="text" />
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label>Last Name</label>
                                        <input class="form-control required" name="surname[]" type="text" />
                                    </div>
                                </div>
								
						
									
                               <div class="col-md-1">
                                    <div class="form-group">
                                        <label>Age</label>
                                        <input class="form-control required" name="age[]" type="text" style="padding: 6px 7px;"/>
                                    </div>
                                </div>

                                	<div class="col-md-2">
										<div class="form-group">
						 <label for="exampleFormControlSelect1">Ticket Type</label>
										    <select class="form-control ticket-type required" >
										      <option value="">-Select-</option>
										      <?php 
										      foreach ($Tickets as $Ticket) {
										     
										      ?>
										      <option value="1" data-price="<?php echo $Ticket['price'] ?>"><?php echo  $Ticket['ticket'] ?></option>
										     <?php } ?>
										    </select>
										  </div>
									</div>
                            </div>
                        </li>
					<?php 
					
					} ?>
					
					</form>
                    </ul>
					<?php } ?>
                    <div class="gap gap-small"></div>
                  <div class="row">
				  
                        <div class="col-md-6" style="border-right: 1px solid;">
                            <h4>Bank Transfer</h4>

                        <div class="row">
                            <img src="img/zenith_bank.png" alt="Image Alternative text" title="Image Title" class="col-md-3">
                            <img src="img/skye_bank.png" alt="Image Alternative text" title="Image Title" class="col-md-3">
                            <img src="img/first_bank.jpg" alt="Image Alternative text" title="Image Title" class="col-md-3">
                            <img src="img/uba_bank.png" alt="Image Alternative text" title="Image Title" class="col-md-3">
                        </div>
                        <br>
                            <p>Important: Our Bank Account Numbers will be sent to you via text message and email.</p><a class="btn btn-primary cashpayment">Proceed</a>	
                        </div>
                        <div class="col-md-6">
                            <h4>Online Payment</h4>
							<br><br> 
             <form method="POST" action="processPayment.php" id="paymentForm">
            <input type="hidden" name="amount" class="btotalval" value="" />
            <input type="hidden" name="payment_options" value="" /> <!-- Can be card, account, ussd, qr, mpesa, mobilemoneyghana  (optional) -->
            <input type="hidden" name="description" value="Bus Ticket Booking" /> <!-- Replace the value with your transaction description -->
            <input type="hidden" name="logo" value="http://52.38.56.164/bus_dev/img/logo-invert.png" /> <!-- Replace the value with your logo url (optional) -->
            <input type="hidden" name="title" value="Bus Ticket" /> <!-- Replace the value with your transaction title (optional) -->
            <input type="hidden" name="country" value="NG" /> <!-- Replace the value with your transaction country -->
            <input type="hidden" name="currency" value="NGN" /> <!-- Replace the value with your transaction currency -->
            <input type="hidden" name="email" id="ccemail"  /> <!-- Replace the value with your customer email -->
            <input type="hidden" name="firstname"  id="ccfirstname" /> <!-- Replace the value with your customer firstname (optional) -->
            <input type="hidden" name="lastname"  /> <!-- Replace the value with your customer lastname (optional) -->
            <input type="hidden" name="phonenumber" id="ccphonenumber" /> <!-- Replace the value with your customer phonenumber (optional if email is passes) -->
            <input type="hidden" name="pay_button_text" value="Complete Payment" /> <!-- Replace the value with the payment button text you prefer (optional) -->
            <input type="hidden" name="ref" id="ref"  /> 
	
        </form>
		<input class="btn btn-primary submitonline" type="submit" value="Proceed Payment">
                        </div>
                    </div>
					<br>
							 <div class="col-md-12">
            
      <div id="response" class="alert alert-success" style="display:none;">
      <a href="#" class="close" data-dismiss="alert">&times;</a>
      <div class="message"></div>
    </div>

        </div>
                </div>
				
				<?php 
				if($isback == 'Y'){
					?>
					<div class="col-md-4">
                    <div class="booking-item-payment">
                        <header class="clearfix">
                            <h5 class="mb0">Bus Details</h5>
                        </header>
                        <ul class="booking-item-payment-details">
                            <li>
                                <h5><?php echo $Old_pickup_text ?> - <?php echo  $Old_return_text ?></h5>
                                <div class="booking-item-payment-flight">
                                   <div class="row">
                                        <div class="col-md-8">
                                            <div class="booking-item-flight-details">
                                                <div class="booking-item-departure"><i class="fa fa-plane"></i>
                                                    <h5><?php echo date('H:i', strtotime($Old_startimes)); ?></h5>
                                                    <p class="booking-item-date"><?php echo date('D, M d', strtotime($Old_startimes)); ?></p>
                                                    <p class="booking-item-destination"><?php echo $Old_pickup_text ?></p>
                                                </div>
                                                <div class="booking-item-arrival"><i class="fa fa-plane fa-flip-vertical"></i>
                                                    <h5><?php echo date('H:i', strtotime($Old_endtimes)); ?></h5>
                                                    <p class="booking-item-date"><?php echo date('D, M d', strtotime($Old_endtimes)); ?></p>
                                                    <p class="booking-item-destination"><?php echo $Old_return_text ?></p>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="booking-item-flight-duration">
                                                <p>Duration</p>
                                                <h5><?php echo Jsonfoo($Old_timetodisplay) ?></h5>
                                            </div>
                                        </div>
                                    </div>
                                    <p><?php echo $pickup_text ?> - <?php echo  $return_text ?></p>
                                    <div class="row">
                                        <div class="col-md-8">
                                            <div class="booking-item-flight-details">
                                                <div class="booking-item-departure"><i class="fa fa-plane"></i>
                                                    <h5><?php echo date('H:i', strtotime($startimes)); ?></h5>
                                                    <p class="booking-item-date"><?php echo date('D, M d', strtotime($startimes)); ?></p>
                                                    <p class="booking-item-destination"><?php echo $pickup_text ?></p>
                                                </div>
                                                <div class="booking-item-arrival"><i class="fa fa-plane fa-flip-vertical"></i>
                                                    <h5><?php echo date('H:i', strtotime($endtimes)); ?></h5>
                                                    <p class="booking-item-date"><?php echo date('D, M d', strtotime($endtimes)); ?></p>
                                                    <p class="booking-item-destination"><?php echo $return_text ?></p>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="booking-item-flight-duration">
                                                <p>Duration</p>
                                                <h5><?php echo Jsonfoo($timetodisplay) ?></h5>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </li>
                           <li>
                                <h5>Bus (<?php echo $Old_passenger ?> Passengers) - <span style="font-size: 12px;"><?php echo $Old_pickup_text ?> to <?php echo  $Old_return_text ?></span></h5>
                                <ul class="booking-item-payment-price">
                                    <li>
                                        <p class="booking-item-payment-price-title"><?php echo $Old_passenger ?> Passengers</p>
                                        <p class="booking-item-payment-price-amount"> ₦<span class="ftotal"></span><small></small>
                                        </p>
                                    </li>
                                    <li>
                                        <p class="booking-item-payment-price-title">Taxes</p>
                                        <p class="booking-item-payment-price-amount">₦<span class="ftaxtotal"></span><small></small>
                                        </p>
                                    </li>
                                </ul>
                            </li> 
							<li>
                                <h5>Bus (<?php echo $passenger ?> Passengers) - <span style="font-size: 12px;"><?php echo $pickup_text ?> to <?php echo  $return_text ?></span></h5>
                                <ul class="booking-item-payment-price">
                                    <li>
                                        <p class="booking-item-payment-price-title"><?php echo $passenger ?> Passengers</p>
                                        <p class="booking-item-payment-price-amount"> ₦<span class="ltotal"></span></small>
                                        </p>
                                    </li>
                                    <li>
                                        <p class="booking-item-payment-price-title">Taxes</p>
                                        <p class="booking-item-payment-price-amount">₦<span class="ltaxtotal"></span>
                                        </p>
                                    </li>
                                </ul>
                            </li>
                        </ul>
                     
                        <p class="booking-item-payment-total">Total trip: <span>₦ <span class="btotal"></span></span>
                        </p>
                        </p>
                    </div>
                </div>
					<?php
				}
				else{
				?>
                <div class="col-md-4">
                    <div class="booking-item-payment">
                        <header class="clearfix">
						 
                            <h5 class="mb0"><?php echo $pickup_text ?> - <?php echo  $return_text ?></h5>
                        </header>
                        <ul class="booking-item-payment-details">
                            <li>
                                <h5>Bus Details</h5>
                                <div class="booking-item-payment-flight">
                                    <div class="row">
                                        <div class="col-md-8">
                                            <div class="booking-item-flight-details">
                                                <div class="booking-item-departure"><i class="fa fa-plane"></i>
                                                    <h5><?php echo date('H:i', strtotime($startimes)); ?></h5>
                                                    <p class="booking-item-date"><?php echo date('D, M d', strtotime($startimes)); ?></p>
                                                    <p class="booking-item-destination"><?php echo $pickup_text ?></p>
                                                </div>
                                                <div class="booking-item-arrival"><i class="fa fa-plane fa-flip-vertical"></i>
                                                    <h5><?php echo date('H:i', strtotime($endtimes)); ?></h5>
                                                    <p class="booking-item-date"><?php echo date('D, M d', strtotime($endtimes)); ?></p>
                                                    <p class="booking-item-destination"><?php echo $return_text ?></p>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="booking-item-flight-duration">
                                                <p>Duration</p>
                                                <h5><?php echo Jsonfoo($timetodisplay) ?></h5>
                                            </div>
                                        </div>
                                    </div>
                                 
                                </div>
                            </li>
                            <li>
                                <h5>Bus (<?php echo $passenger ?> Passengers)</h5>
                                <ul class="booking-item-payment-price">
                                    <li>
                                        <p class="booking-item-payment-price-title"><?php echo $passenger ?> Passengers</p>
                                        <p class="booking-item-payment-price-amount"> ₦<span class="ftotal"></span>
                                        </p>
                                    </li>
                                    <li>
                                        <p class="booking-item-payment-price-title">Taxes</p>
                                        <p class="booking-item-payment-price-amount">₦<span class="ftaxtotal"></span>
                                        </p>
                                    </li>
                                </ul>
                            </li>
                        </ul>
						
                        <p class="booking-item-payment-total">Total trip: <span>₦ <span class="btotal"></span></span>
                        </p>
                    </div>
                </div>
				<?php } ?>
            </div>
            <div class="gap"></div>
        </div>



 <?php include_once('lib/footer.php') ?>
	  <script type="text/javascript">


		
	    $(".submitonline").click(function (e) {
        e.preventDefault();
		
		
		   e.preventDefault();
      

    var errorCounter = validateForm();

    if (errorCounter > 0) {
      $('#clientinfo').slideDown('slow');
        $("#response").removeClass("alert-success").addClass("alert-danger").fadeIn();
        $("#response .message").html("<strong>Error</strong>: Please Fill Required Fields");
        $("html, body").animate({ scrollTop: $('#response').offset().top }, 1000);
    }

   
     else {
    
		var name= $("#name-no").val(); 
		var phn= $("#phn-no").val(); 
		var email= $("#email-no").val(); 
	
	 if($('#trvchk').prop("checked") == true){
              var trvchk='T';
     }
     else if($('#trvchk').prop("checked") == false){
              var trvchk='F';
     }
	
		<?php 
		if($isback == 'Y'){
			?>
 var pickup_id= '<?php echo $Old_from_location_id ?>';
 var return_id =  '<?php echo $Old_to_location_id ?>';
 var bus_id = '<?php echo $Old_bus_id ?>';
 var ticket_id= '<?php echo $Old_ticket_id ?>';
 
 var startdate= '<?php echo $Old_startimes ?>';
 var routetxt= '<?php echo $Old_routetxt ?>';
 var enddate= '<?php echo $Old_endtimes ?>';

 var return_pickup_id= '<?php echo $from_location_id ?>';
 var return_return_id =  '<?php echo $to_location_id ?>';
 var return_bus_id = '<?php echo $bus_id ?>';
 var return_ticket_id= '<?php echo $ticket_id ?>';
 
 var return_startdate= '<?php echo $startimes ?>';
 var return_routetxt= '<?php echo $routetxt ?>';
 var return_enddate= '<?php echo $endtimes ?>';
 
 var rData='&return_pickup_id='+return_pickup_id+'&return_return_id='+return_return_id+'&return_bus_id='+return_bus_id+'&return_ticket_id='+return_ticket_id+'&return_startdate='+return_startdate+'&return_routetxt='+return_routetxt+'&return_enddate='+return_enddate;
		<?php 
		}
	else{		
		?>
 var pickup_id= '<?php echo $from_location_id ?>';
 var return_id =  '<?php echo $to_location_id ?>';
 var bus_id = '<?php echo $bus_id ?>';
 var ticket_id= '<?php echo $ticket_id ?>';
 
 var startdate= '<?php echo $startimes ?>';
 var routetxt= '<?php echo $routetxt ?>';
 var enddate= '<?php echo $endtimes ?>';
 var rData='';
	<?php } ?>

    $.ajax({

        url: "cpresponse.php",
        type: 'POST',
        data: $("#booking_form").serialize()+'&fname='+name+'&phone='+phn+'&email='+email+'&regcheck='+trvchk+'&pickup_id='+pickup_id+'&return_id='+return_id+'&bus_id='+bus_id+'&ticket_id='+ticket_id+'&startdate='+startdate+'&enddate='+enddate+'&routetxt='+routetxt+'&PayMethod=online'+rData,
        dataType: 'json',
        success: function(data){
        
      if(data.status=="success"){
	
		  $('#ccfirstname').val(name);	
		  $('#ccemail').val(email);	
		  $('#ccphonenumber').val(phn);	
		  $('#ref').val(data.uid);	
   $('form#paymentForm').submit();
        }
            else{
               $("#response").removeClass("alert-success").addClass("alert-danger").fadeIn();;
        $("#response .message").html(data.msg);
        $("html, body").animate({ scrollTop: $('#response').offset().top }, 1000);  
            }
        
        },
        error:function(data){
          
          $("#response").removeClass("alert-success").addClass("alert-danger").fadeIn();;
        $("#response .message").html(data.msg);
        $("html, body").animate({ scrollTop: $('#response').offset().top }, 1000);  
        }
        
        });
     }
	 
      	  });
		  
		
	    $(".cashpayment").click(function (e) {
        e.preventDefault();
      

    var errorCounter = validateForm();

    if (errorCounter > 0) {
      $('#clientinfo').slideDown('slow');
        $("#response").removeClass("alert-success").addClass("alert-danger").fadeIn();
        $("#response .message").html("<strong>Error</strong>: Please Fill Required Fields");
        $("html, body").animate({ scrollTop: $('#response').offset().top }, 1000);
    }

   
     else {
    
		var name= $("#name-no").val(); 
		var phn= $("#phn-no").val(); 
		var email= $("#email-no").val(); 
	
	 if($('#trvchk').prop("checked") == true){
              var trvchk='T';
     }
     else if($('#trvchk').prop("checked") == false){
              var trvchk='F';
     }
	
		<?php 
		if($isback == 'Y'){
			?>
 var pickup_id= '<?php echo $Old_from_location_id ?>';
 var return_id =  '<?php echo $Old_to_location_id ?>';
 var bus_id = '<?php echo $Old_bus_id ?>';
 var ticket_id= '<?php echo $Old_ticket_id ?>';
 
 var startdate= '<?php echo $Old_startimes ?>';
 var routetxt= '<?php echo $Old_routetxt ?>';
 var enddate= '<?php echo $Old_endtimes ?>';

 var return_pickup_id= '<?php echo $from_location_id ?>';
 var return_return_id =  '<?php echo $to_location_id ?>';
 var return_bus_id = '<?php echo $bus_id ?>';
 var return_ticket_id= '<?php echo $ticket_id ?>';
 
 var return_startdate= '<?php echo $startimes ?>';
 var return_routetxt= '<?php echo $routetxt ?>';
 var return_enddate= '<?php echo $endtimes ?>';
 
 var rData='&return_pickup_id='+return_pickup_id+'&return_return_id='+return_return_id+'&return_bus_id='+return_bus_id+'&return_ticket_id='+return_ticket_id+'&return_startdate='+return_startdate+'&return_routetxt='+return_routetxt+'&return_enddate='+return_enddate;
		<?php 
		}
	else{		
		?>
 var pickup_id= '<?php echo $from_location_id ?>';
 var return_id =  '<?php echo $to_location_id ?>';
 var bus_id = '<?php echo $bus_id ?>';
 var ticket_id= '<?php echo $ticket_id ?>';
 
 var startdate= '<?php echo $startimes ?>';
 var routetxt= '<?php echo $routetxt ?>';
 var enddate= '<?php echo $endtimes ?>';
 var rData='';
	<?php } ?>

    $.ajax({

        url: "cpresponse.php",
        type: 'POST',
        data: $("#booking_form").serialize()+'&fname='+name+'&phone='+phn+'&email='+email+'&regcheck='+trvchk+'&pickup_id='+pickup_id+'&return_id='+return_id+'&bus_id='+bus_id+'&ticket_id='+ticket_id+'&startdate='+startdate+'&enddate='+enddate+'&routetxt='+routetxt+'&PayMethod=cash'+rData,
        dataType: 'json',
        success: function(data){
        
            if(data.status=="success"){
              $("#response").removeClass("alert-danger").addClass("alert-success").fadeIn();;
        $("#response .message").html(data.msg);
        $("html, body").animate({ scrollTop: $('#response').offset().top }, 1000);  
          
           window.setTimeout(function(){window.location.href = "bank-transfer.php?uid="+data.uid},1000);
            }
            else{
               $("#response").removeClass("alert-success").addClass("alert-danger").fadeIn();;
        $("#response .message").html(data.msg);
        $("html, body").animate({ scrollTop: $('#response').offset().top }, 1000);  
            }
        
        },
        error:function(data){
          
          $("#response").removeClass("alert-success").addClass("alert-danger").fadeIn();;
        $("#response .message").html(data.msg);
        $("html, body").animate({ scrollTop: $('#response').offset().top }, 1000);  
        }
        
        });
     }
    });

	
	   function validateForm() {
      // error handling
      var errorCounter = 0;

      $(".required").each(function(i, obj) {

          if($(this).val() === ''){
              $(this).parent().addClass("has-error");
              errorCounter++;
          } else{ 
              $(this).parent().removeClass("has-error"); 
          }


      });

      return errorCounter;
  }

  BothTicket();
 $(document).on('change', ".ticket-type", function(e) {
 	BothTicket();
 });
  $(document).on('change', ".return-ticket-type", function(e) {
 	BothTicket();
 });

  function totalTicket() {
  	var total=0;
  	$(".ticket-type").each(function() {
   		var psnger= $(this).find('option:selected').val();
   		var ticket= $(this).find('option:selected').attr('data-price');
   		if(isNaN(ticket)){
   			var t=0;
   		}
   		else{
   			var t=ticket;
   		}
   		total+=parseFloat(psnger*t);
	});

	return total;
  }

  function totalRTTicket() {
  	var total=0;
  	$(".return-ticket-type").each(function() {
   		var psnger= $(this).find('option:selected').val();
   		var ticket= $(this).find('option:selected').attr('data-price');
   		if(isNaN(ticket)){
   			var t=0;
   		}
   		else{
   			var t=ticket;
   		}
   		total+=parseFloat(psnger*t);
	});

	return total;
  }

  function BothTicket() {
  	var ftotal=totalTicket();
  	var fpsnger='<?php echo $passenger ?>';
  	var ftaxtotal=parseFloat(fpsnger*10);

  	<?php 
		if($isback == 'Y'){
	?>
	var ltotal=totalRTTicket();
  	var lpsnger='<?php echo $Old_passenger ?>';
  	var ltaxtotal=parseFloat(lpsnger*10);
	<?php } 
	else { ?>
	var ltotal=0;
  	var ltaxtotal=0;
	<?php } ?>

	var bothtax=parseFloat(ftaxtotal+ltaxtotal);
	var bothprice=parseFloat(ftotal+ltotal);
	var btotal=parseFloat(bothprice+bothtax);

	$('.ftotal').text(ftotal);
	$('.ftaxtotal').text(ftaxtotal);

	$('.ftotalval').val(ftotal);
	$('.ftaxtotalval').val(ftaxtotal);

	$('.ltotal').text(ltotal);
	$('.ltaxtotal').text(ltaxtotal);
	$('.ltotalval').val(ltotal);
	$('.ltaxtotalval').val(ltaxtotal);
	$('.btotal').text(btotal);
	$('.btotalval').val(btotal);
  }

	</script>
</body>

</html>

<?php 
 function Jsonfoo($seconds) {
  $t = round($seconds);
  return sprintf('%02dh %02dm', ($t/3600),($t/60%60));
}
?>

