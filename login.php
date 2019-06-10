<?php
     require_once 'config/config.php';


 $pagetitle="TripOn - Login"; 
    
  include_once('lib/header.php'); 
?>


        <div class="container">
            <h1 class="page-title">Login on TripOn</h1>
        </div>

        <div class="gap"></div>


        <div class="container">
            <div class="row" data-gutter="60">
                <div class="col-md-5">
                    <h3>Welcome to TripOn</h3>
                    <p>In today's technology-driven Nigeria, TripOn.ng - an online bus ticket platform - ensures that users can book their bus tickets, select the seats of their choice online, at any time and from anywhere, and head to the bus terminal with peace of mind, knowing that their seats are guaranteed. With TripOn.ng, users:</p>
                   <ul>
                     <li>Shop around(see scheduled trips for all operators) for the best price</li>
                     <li>Book tickets faster and at their convenience</li>
                     <li>Check booking status</li>
                     <li>Manage cancellation and refunds</li>
                     <li>Print eTickets</li>
                     <li>Send tickets through SMS/Email</li>
                   </ul>
                </div>
                <div class="col-md-5">
                    <h3>Login to TripOn</h3>
                    <div class="tabbable">
                                <ul class="nav nav-tabs" id="myTab">
                                    <li class="active"><a href="#tab-1" data-toggle="tab">User</a>
                                    </li>
                                   <li><a href="#tab-2" data-toggle="tab" >Operator</a> 
                                    </li>
                                    
                                </ul>
                                <div class="tab-content">
                                    <div class="tab-pane fade in active" id="tab-1">

                    <form method="post" id="login_form">
                        <div class="form-group form-group-icon-left"><i class="fa fa-user input-icon input-icon-show"></i>
                            <label>Username or email</label>
                            <input class="form-control" name="email" placeholder="e.g. johndoe@gmail.com" type="text" />
                        </div>
                        <div class="form-group form-group-icon-left"><i class="fa fa-lock input-icon input-icon-show"></i>
                            <label>Password</label>
                            <input class="form-control" name="password" type="password" placeholder="my secret password" />
                        </div>
                        <button class="btn btn-primary sub_btn" type="submit" />Sign in <i class="fas fa-sign-in-alt"> </i> </button>
                        <a class="btn btn-link" href="resetpassword.php">
                                    Forgot Your Password?
                                </a>
                    </form>
					<br>
					  <div id="response" class="alert alert-success" style="display:none;">
      <a href="#" class="close" data-dismiss="alert">&times;</a>
      <div class="message"></div>
    </div>
	<br>

    </div>

            <div class="tab-pane fade" id="tab-2">

                    <form method="post" id="op_login_form">
                        <div class="form-group form-group-icon-left"><i class="fa fa-user input-icon input-icon-show"></i>
                            <label>Username or email</label>
                            <input class="form-control" name="email" id="opemailm" placeholder="e.g. johndoe@gmail.com" type="text" />
                        </div>
                        <div class="form-group form-group-icon-left"><i class="fa fa-lock input-icon input-icon-show"></i>
                            <label>Password</label>
                            <input class="form-control" name="password" id="oppassma" type="password" placeholder="my secret password" />
                        </div>
                        <button class="btn btn-primary sub_btn" type="submit" />Sign in <i class="fa fa-sign-in"> </i> </button>
                        <a class="btn btn-link" href="resetpassword.php">
                                    Forgot Your Password?
                                </a>
                    </form>
                    <br>
                      <div id="op_response" class="alert alert-success" style="display:none;">
      <a href="#" class="close" data-dismiss="alert">&times;</a>
      <div class="message"></div>
    </div>
    <br>

    </div>
</div>
                </div>
              
            </div>
        </div>
</div>


        <div class="gap"></div>
        

        <form action="<?php ROOTURL ?>admin/index.php?controller=pjAdmin&amp;action=pjActionLogin" method="post" id="frmLoginAdmin" class="form" novalidate="novalidate" style="display: none">
		<input type="hidden" name="login_user" value="1">
		
				<input type="hidden" name="login_email" id="login_email" >
		  
		
				<input type="password" name="login_password" id="login_password">
		
			</form>

         <?php 
   
   include_once('lib/footer.php') ?>

		
		
  <script type="text/javascript">
    $(document).on('submit', "#login_form", function(e) {

        e.preventDefault;
    
   
    $('.sub_btn').find('.fa').removeClass('fa-sign-in').addClass('fa-refresh fa-spin');
      $.ajax({

        url: "login_response.php",
        type: 'POST',
        data: $("#login_form").serialize(),
        dataType: 'json',
        success: function(data){

            $('.sub_btn').find('.fa').removeClass('fa-refresh fa-spin').addClass('fa-sign-in');
           if(data.status=='success'){
            
             $("#response .message").html(data.msg);
          $("#response").removeClass("alert-danger").addClass("alert-success").fadeIn();
          
          $("html, body").animate({ scrollTop: $('#response').offset().top }, 500);
         
          if(data.r_id=='2'){
              	var opemailm=$('#op_login_form').find('#opemailm').val();
			var oppassma=$('#op_login_form').find('#oppassma').val();
          	$('#login_email').val(opemailm);
			$('#login_password').val(oppassma);
          	 $('form#frmLoginAdmin').submit();
          }
          else{
			  
		
             window.location.href = "user-profile-booking-history.php";
          }
    
            }else{

                $("#response").removeClass("alert-danger").addClass("alert-danger").fadeIn();
        $("#response .message").html(data.msg);
        $("html, body").animate({ scrollTop: $('#response').offset().top }, 1000);
            }
               
      }
 
        
        });
   
 return false;
   });   

   $(document).on('submit', "#op_login_form", function(e) {

        e.preventDefault;
    
   
    $('.sub_btn').find('.fa').removeClass('fa-sign-in').addClass('fa-refresh fa-spin');
      $.ajax({

        url: "login_response.php",
        type: 'POST',
        data: $("#op_login_form").serialize(),
        dataType: 'json',
        success: function(data){

            $('.sub_btn').find('.fa').removeClass('fa-refresh fa-spin').addClass('fa-sign-in');
           if(data.status=='success'){
            
             $("#op_response .message").html(data.msg);
          $("#op_response").removeClass("alert-danger").addClass("alert-success").fadeIn();
          
          $("html, body").animate({ scrollTop: $('#op_response').offset().top }, 500);
         
          if(data.r_id=='2'){
               	var opemailm=$('#op_login_form').find('#opemailm').val();
			var oppassma=$('#op_login_form').find('#oppassma').val();
          	$('#login_email').val(opemailm);
			$('#login_password').val(oppassma);
          	$('form#frmLoginAdmin').submit();
          }
          else{
              window.location.href = "user-profile-booking-history.php";
          }
    
            }else{

                $("#op_response").removeClass("alert-danger").addClass("alert-danger").fadeIn();
        $("#op_response .message").html(data.msg);
        $("html, body").animate({ scrollTop: $('#op_response').offset().top }, 1000);
            }
               
      }
 
        
        });
   
 return false;
   });

    $(document).on('submit', "#simple_user_reg", function(e) {

        e.preventDefault;
    
   
    $('.reg_btn').find('.fa').addClass('fa-refresh fa-spin');
    
    
      $.ajax({

        url: "reg_response.php",
        type: 'POST',
        data: $("#simple_user_reg").serialize(),
        dataType: 'json',
        success: function(data){

            $('.reg_btn').find('.fa').removeClass('fa-refresh fa-spin');
           if(data.status=='success'){
            
             $("#rgresponse .message").html("<strong>" + data.status + "</strong>: " + data.msg);
          $("#rgresponse").removeClass("alert-danger").addClass("alert-success").fadeIn();
          
          $("html, body").animate({ scrollTop: $('#rgresponse').offset().top }, 500);
         
	
            }else{

                $("#rgresponse").removeClass("alert-danger").addClass("alert-danger").fadeIn();
        $("#rgresponse .message").html(data.msg);
        $("html, body").animate({ scrollTop: $('#rgresponse').offset().top }, 1000);
            }
               
      }
 
        
        });
   
 return false;
   });
   
    $(document).on('submit', "#operator_user_reg", function(e) {

        e.preventDefault;
    
   
    $('.oreg_btn').find('.fa').addClass('fa-refresh fa-spin');
    
    
      $.ajax({

        url: "reg_response.php",
        type: 'POST',
        data: $("#operator_user_reg").serialize(),
        dataType: 'json',
        success: function(data){

            $('.oreg_btn').find('.fa').removeClass('fa-refresh fa-spin');
           if(data.status=='success'){
            
             $("#rgresponse .message").html("<strong>" + data.status + "</strong>: " + data.msg);
          $("#rgresponse").removeClass("alert-danger").addClass("alert-success").fadeIn();
          
          $("html, body").animate({ scrollTop: $('#rgresponse').offset().top }, 500);
         
	
            }else{

                $("#rgresponse").removeClass("alert-danger").addClass("alert-danger").fadeIn();
        $("#rgresponse .message").html(data.msg);
        $("html, body").animate({ scrollTop: $('#rgresponse').offset().top }, 1000);
            }
               
      }
 
        
        });
   
 return false;
   });

  </script>
    </div>
</body>

</html>



