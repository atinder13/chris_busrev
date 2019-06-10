<?php

if(empty($_GET['user'])) {
	header('location:index.php');
}
require_once 'config/config.php';

require_once CLASSPATH.'DB_Functions.php';
$DBUSER= new DB_Functions();
require_once CLASSPATH.'Encryption.php';
$userid=urlencode($_GET['user']);
$user=Encryption::decode($userid);
$timez=urlencode($_GET['t']);
$time=Encryption::decode($timez);
$now=strtotime('now');
 $pagetitle="TripOn"; 
 include_once('lib/header.php'); ?>
	
	         <div class="row" data-gutter="60">
              




		<?php 
		
			 
    if($time > $now){
       
  
   if($DBUSER->isUserExisted($user)){
      ?>

        <div class="col-md-6 col-md-offset-3">
    <br>

      
 <div class="panel panel-success">
  <div class="panel-heading">Change Password</div>
  <div class="panel-body">
  

   
    
    <form method="post" id="changepass_form">
        <input type="hidden" name="action" value="changePass">
        <input type="hidden" name="email" value="<?php echo $user ?>">
  <fieldset>
   
         <div class="form-group">
      <label>New Password</label>
      <input type="password" class="form-control" id="newpass" name="newpass"  placeholder="New Password">
      
    </div>
  
         <div class="form-group">
      <label>Confirm Password</label>
      <input type="password" class="form-control" id="confpass" name="confpass"  placeholder="Confirm Password">
      
    </div>
  
    <button class="btn btn-primary sub_btn" type="submit" />Submit </button>
   
  </fieldset>
</form>
      
                <br>
                      <div id="response" class="alert alert-success" style="display:none;">
      <a href="#" class="close" data-dismiss="alert">&times;</a>
      <div class="message"></div>
    </div>
    <br>
    
  </div>
</div>
    </div>

      <?php
    
    } 
    else{
        ?>
          <div class="alert alert-danger">
            Email Not Found
        </div>
<?php
    }
    
      }
      else{
        ?>
        <div class="alert alert-danger">
  Link Expired
  Please Request New Link <a href="resetpassword.php">here</a>
</div>
        <?php
      }
		?>
	</center>
	</div>
	 <script src="js/jquery.js"></script>
        <script src="js/bootstrap.js"></script>
        

  <script type="text/javascript">
    $(document).on('submit', "#changepass_form", function(e) {

        e.preventDefault;
    
    
      $.ajax({

        url: "cpresponse.php",
        type: 'POST',
        data: $("#changepass_form").serialize(),
        dataType: 'json',
        success: function(data){

             if(data.status=='success'){
            
             $("#response .message").html(data.msg);
          $("#response").removeClass("alert-danger").addClass("alert-success").fadeIn();
          
          $("html, body").animate({ scrollTop: $('#response').offset().top }, 500);
       
        
         window.setTimeout(function(){window.location.href = "login-register.php";},500);

            }else{

                $("#response").removeClass("alert-danger").addClass("alert-danger").fadeIn();
        $("#response .message").html(data.msg);
        $("html, body").animate({ scrollTop: $('#response').offset().top }, 1000);
            }
               
      }
 
        
        });
   
 return false;
   });
  </script>

	</body>

</html>
