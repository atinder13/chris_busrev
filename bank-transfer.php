<?php 
if(empty($_GET['uid'])){
	die('No Direct Allowed');
}
ob_start();
session_start();
require_once 'config/config.php';

require_once CLASSPATH.'DB_Functions.php';
$DBUSER= new DB_Functions();

$extraStyle=array(ROOTURL.'css/app.min.css');
 $pagetitle="TripOn - Success payment"; 
 include_once('lib/header.php');
		$uid=urlencode($_GET['uid']);
		$Booking=$DBUSER->getBookingByUid($uid);
		
		if(count($Booking) <= 0 ){
			die('Something is wrong');
		}
			
	
		
		if($Booking['is_return'] == 'T'){
			$old_Booking=$DBUSER->getBookingByUid($Booking['returnUid']);
			$Old_Total=$old_Booking['total'];
		}
		else{
			$Old_Total=0;
		}
		$Muid=$Booking['uuid'];
	$Total=abs($Old_Total+$Booking['total']);
	$Mtotal=number_format($Total,2);
	  ?>

        <div class="gap"></div>


	<div class="success-page-container">
    <div class="obt-success-block">
        <div class="obt-success-block-header">
            <h1>Thank you for booking with us. </h1>
            <p>Our Bank Account Numbers have been sent to you via  email.</p>
        </div>
		<!-- 
        <div class="row booking-send-details">
            <form class="booking-resend ">
                <p class="txt-left booking-resend-text visible-xs">To Resend Bank Account Numbers, fill the fields below</p> 

                <p class=" booking-resend-text">Resend Bank <br class="hidden-xs hidden-sm"> Account Number</p>
                <div class=" booking-resend-input1 mgtp">
                    <input type="tel" id="acct_phone_request" placeholder="+ 234 81 234 567 89" class="form-control thank-you-input" value="1234567890">
                    <input type="hidden" id="booking_id" value="1308233">
                </div>
                <div class="booking-resend-input2 mgtp">
                    <input type="email" id="acct_email_request" placeholder="johndoe@example.com" class="form-control thank-you-input" value="cp@gmail.com">
                </div>
                <div class="booking-resend-button mgtp" id="resendbtn">
                    <div class="form-group send">
                        <button id="resend_acct_info" class="btn btn-primary" >RESEND</button>
                    </div>
                </div>
            </form>
          
        </div>
		-->
        <!-- bank sections -->
        <p class="booking-ensure">Please be sure to use your <span>Booking ID <?php echo $Muid ?></span> as reference when paying.</p>
        <div class="bank-dets-container">
            <!--Bank Details -->
            <div class="bank-dets">
                <div>
                    <div id="gtb" class="account-dets border-gtb">
                        <h5>GTBANK</h5>
                        <div class="text">
                            <p>Account Name: Hotel Booking Limited</p>
                            <p>Account Number: XXXXXXXX</p>
                            <p>Booking Reference: <?php echo $Muid ?></p>
                            <p>Booking Amount: ₦ <?php echo $Mtotal ?></p>
                        </div>
                    </div> 
                </div>

                <div>
                    <div id="diamond" class="account-dets border-diamond">
                        <h5>FIRST BANK</h5>
                        <div class="text">
                            <p>Account Name: Hotel Booking Limited</p>
                            <p>Account Number: XXXXXXXX</p>
                            <p>Booking Reference: <?php echo $Muid ?></p>
                            <p>Booking Amount: ₦ <?php echo $Mtotal ?></p>
                        </div>
                    </div>
                </div>

                <div>
                    <div id="access" class="account-dets border-access">
                        <h5>SKYE BANK</h5>
                        <div class="text">
                            <p>Account Name: Hotel Booking Limited</p>
                            <p>Account Number: XXXXXXXXX</p>
                            <p>Booking Reference:  <?php echo $Muid ?></p>
                            <p>Booking Amount: ₦ <?php echo $Mtotal ?></p>
                        </div>
                    </div>
                </div>

                <div>
                    <div id="zenith" class="account-dets border-zenith">
                        <h5>ZENITH BANK</h5>
                        <div class="text">
                            <p>Account Name: Hotel Booking Limited</p>
                            <p>Account Number: XXXXXXX</p>
                            <p>Booking Reference: <?php echo $Muid ?></p>
                            <p>Booking Amount: ₦ <?php echo $Mtotal ?></p>
                        </div>
                    </div>
                </div>

                <div>
                    <div id="uba" class="account-dets border-uba">
                        <h5>UBA BANK</h5>
                        <div class="text">
                            <p>Account Name: Hotel Booking Limited</p>
                            <p>Account Number: XXXXXXX</p>
                            <p>Booking Reference: <?php echo $Muid ?></p>
                            <p>Booking Amount: ₦ <?php echo $Mtotal ?></p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
      
      

        
    </div>

	            <div class="gap"></div>
</div>


        
     <?php include_once('lib/footer.php') ?>

</body>

</html>



