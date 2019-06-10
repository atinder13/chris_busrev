<?php


  include_once('Lsession.php');
    
 $pagetitle="TripOn - Booking "; 
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
                    
                    <h3>Change Password</h3>
        
        <form class="form-horizontal" role="form" id="change_password_frm" method="post">
          <input type="hidden" name="action" value="changeUserPassword">
          <div class="form-group">
            <label class="col-lg-3 control-label">Current Password:</label>
            <div class="col-lg-9">
              <input class="form-control" name="oldpassword" type="password" >
            </div>
          </div>
          <div class="form-group">
            <label class="col-lg-3 control-label">New Password:</label>
            <div class="col-lg-9">
              <input class="form-control" name="newpass" type="password" >
            </div>
          </div>
         
          <div class="form-group">
            <label class="col-lg-3 control-label">Confirm Password:</label>
            <div class="col-lg-9">
              <input class="form-control" name="confirmpass" type="password"  >
            </div>
          </div>
        
        
         
          
          <div class="form-group">
            <label class="col-md-3 control-label"></label>
            <div class="col-md-9">
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
    


         $(document).on('submit', "#change_password_frm", function(e) {

        e.preventDefault;
  
      $.ajax({

        url: "cpresponse.php",
        type: 'POST',
        data: $("#change_password_frm").serialize(),
        dataType: 'json',
        success: function(data){
            
                if(data.status=='success'){
            
                 $("#response").removeClass("alert-danger").addClass("alert-success").fadeIn();;
           $("#response .message").html(data.msg);
          
           $('#change_password_frm')[0].reset();
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



