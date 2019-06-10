<?php

  include_once('LSession.php');
    
 $pagetitle="TripOn - Booking "; 
  $Profile=$DBUSER->getUserProfile($userId); 
    include_once('lib/header.php'); ?>
<style type="text/css">
    div#booking_table_paginate,#booking_table_filter{
        float: right;
    }
</style>

        <div class="container">
            <h1 class="page-title">Hi <?php echo $usernum ?> </h1>
        </div>




        <div class="container">
            <div class="row">
                <div class="col-md-3">
                    <aside class="user-profile-sidebar">
                        <div class="user-profile-avatar text-center">
                            <img src="img/amaze_300x300.jpg" alt="Image Alternative text" title="AMaze" />
                            <h5><?php echo $usernum ?></h5>
                        
                        </div>
                        <ul class="list user-profile-nav">
                             <li><a href="user-profile-booking-history.php"><i class="fa fa-clock-o"></i>Booking History</a></li>

                              <li><a href="cancelbooking.php"><i class="fa fa-clock-o"></i>Cancel Booking</a>
                            </li>

                          <li><a href="user-profile-settings.php"><i class="fa fa-cog"></i>Profile Settings</a>
                            </li> 
                           
                           <li><a href="change-password.php"><i class="fa fa-lock"></i>Change Password</a>
                            </li>
                           
                            
                        </ul>
                    </aside>
                </div>
                <div class="col-md-9">
                    <h3>Personal info</h3>
        
        <form class="form-horizontal" id="change_prfile" role="form">
          <input type="hidden" name="action" value="updateProfile">
          <div class="form-group">
            <label class="col-lg-2 control-label">Full name:</label>
            <div class="col-lg-8">
              <input class="form-control" name="name" type="text" placeholder="Name" value="<?php echo $Profile['name'] ?>">
            </div>
          </div>
          <div class="form-group">
            <label class="col-lg-2 control-label">Mobile:</label>
            <div class="col-lg-2">
              <input class="form-control" name="countryCode" placeholder="Country Code" type="text" value="<?php echo $Profile['countryCode'] ?>">
            </div>  <div class="col-lg-6">
              <input class="form-control" name="mobile" type="text" placeholder="Mobile" value="<?php echo $Profile['phone'] ?>">
            </div>
          </div>
         
          <div class="form-group">
            <label class="col-lg-2 control-label">Email:</label>
            <div class="col-lg-8">
              <input class="form-control" type="email" value="<?php echo $Profile['email'] ?>" readonly>
            </div>
          </div>
        
        
         
          
          <div class="form-group">
            <label class="col-md-2 control-label"></label>
            <div class="col-md-8">
              <input type="submit" class="btn btn-primary" value="Save Changes">
              <span></span>
             
            </div>
          </div>
        </form>
                     <div id="response" class="alert alert-success" style="display:none;">
      <a href="#" class="close" data-dismiss="alert">&times;</a>
      <div class="message"></div>
    </div>
    <br>
                </div>
            </div>
        </div>



        <div class="gap"></div>
        <?php include_once 'lib/footer.php'; ?>

            <script src="https://cdn.datatables.net/1.10.16/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.10.15/js/dataTables.bootstrap.min.js"></script>
<script type="text/javascript">
      $(document).ready(function(){
      $('[data-toggle="tooltip"]').tooltip(); 
    

         $(document).on('submit', "#change_prfile", function(e) {

        e.preventDefault;
  
      $.ajax({

        url: "cpresponse.php",
        type: 'POST',
        data: $("#change_prfile").serialize(),
        dataType: 'json',
        success: function(data){
            
                if(data.status=='success'){
            
                 $("#response").removeClass("alert-danger").addClass("alert-success").fadeIn();;
           $("#response .message").html(data.msg);
                }
                else{
                  $("#response").removeClass("alert-success").addClass("alert-danger").fadeIn();;
           $("#response .message").html(data.msg);
                }
      }
 
        
        });
  
 return false;
   });

   });

 
</script>
  

</body>

</html>



