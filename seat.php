

      <style>
	.bs-available {background: #f34c2a none repeat scroll 0 0;color:#fff;}
	.bs-selected {background: #56ae33 none repeat scroll 0 0 !important;}
	.bs-booked {background: yellow none repeat scroll 0 0 !important;}
	
	</style>
	   <?php

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
   require_once 'config/config.php';

require_once CLASSPATH.'DB_Functions.php';
$DBUSER= new DB_Functions();

$bustype=urlencode($_POST['bustype']);
$uid=urlencode($_POST['uid']);
$route_id=urlencode($_POST['route_id']);
$pickup_id=urlencode($_POST['pickup_id']);
$return_id=urlencode($_POST['return_id']);
$bus_id=urlencode($_POST['bus_id']);
$startDate=urlencode($_POST['startDate']);
$endDate=urlencode($_POST['endDate']);
$seat=trim($_POST['seat']);

$BusSeats=$DBUSER->getBusSeat($bustype);
$Locations=$DBUSER->getLocationsArr($route_id, $pickup_id, $return_id);

$bookedSeat=$DBUSER->bookedSeat($bus_id,$startDate,$endDate,$Locations);

?>
		
   
	<input type="hidden" id="seat-uuid" value="<?php echo $uid ?>">
		<div class="bsMapHolder pjBsSeatsContainer" style="height: 334px;">
	
	<img id="map" src="<?php echo ROOTURL.'admin/'.$seat ?>" alt="" style="margin: 0; border: none; position: absolute; top: 0; left: 0; z-index: 500;width:auto" />
	<?php 
	foreach($BusSeats as $seat){
		
		
		?>
		
		<span rel="hi_<?php echo $seat['id']; ?>" class="rect empty <?php echo in_array($seat['id'], $bookedSeat) ? ' bs-booked' : ' bs-available yes-available'; ?>" data-id="<?php echo $seat['id']; ?>" data-name="<?php echo $seat['name']; ?>" style="width: <?php echo $seat['width']; ?>px; height: <?php echo $seat['height']; ?>px; left: <?php echo $seat['left']; ?>px; top: <?php echo $seat['top']; ?>px; line-height: <?php echo $seat['height']; ?>px"><span class="bsInnerRect" data-name="hi_<?php echo $seat['id']; ?>"><?php echo stripslashes($seat['name']); ?></span></span>
		<?php
	}
	
	
	}
	?>
</div> 
<div class="clearfix"> </div>
 <p style="text-align: center;">
                            <i class="fa fa-circle" style="color:blue;"></i>&nbsp;<span>Available</span>
                            &nbsp;&nbsp;&nbsp;<i class="fa fa-circle" style="color:yellow;"></i>&nbsp;<span>Occupied</span>
                        </p>
<div class="clearfix"> </div>

<button  class="btn btn-primary confirm-seat" data-id="<?php echo $uid ?>">Confirm</button>
<button  class="btn btn-danger pull-right close-seat"  data-id="<?php echo $uid ?>">Close</button>
<div class="clearfix"> </div>

