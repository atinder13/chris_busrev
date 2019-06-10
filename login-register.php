<?php
     require_once 'config/config.php';


 $pagetitle="TripOn - Register"; 
    
  include_once('lib/header.php'); 
?>

        <div class="container">
            <h1 class="page-title">Register on TripOn</h1>
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

                    <h3>New To TripOn?</h3>
                            <div class="tabbable">
                                <ul class="nav nav-tabs" id="myTab">
                                    <li class="active"><a href="#tab-1" data-toggle="tab">User</a>
                                    </li>
                                   <li><a href="#tab-2" data-toggle="tab" >Operator</a> 
                                    </li>
                                    
                                </ul>
                                <div class="tab-content">
                                    <div class="tab-pane fade in active" id="tab-1">
                                        <form method="post" id="simple_user_reg">
										  <input type="hidden" name="type" value="user">
                        <div class="form-group form-group-icon-left"><i class="fa fa-user input-icon input-icon-show"></i>
                            <label>Full Name</label>
                            <input class="form-control" name="name" placeholder="e.g. John Doe" type="text" />
                        </div>
                        <div class="form-group form-group-icon-left"><i class="fa fa-envelope input-icon input-icon-show"></i>
                            <label>Email</label>
                            <input class="form-control" name="email" placeholder="e.g. johndoe@gmail.com" type="text" />
                        </div> 
						
				
											
                     <div class="form-group">
                                                <label>Mobile</label>
                                                <input class="form-control" placeholder="+234" value="+234"  style="width: 18%; float: left; margin-right: 2%;" name="ccode" type="text">

                                                <input class="form-control" style="width:80%;" name="mobile" placeholder="XXXXXXXXXX" type="text">
                                            </div>
						
                        <div class="form-group form-group-icon-left"><i class="fa fa-lock input-icon input-icon-show"></i>
                            <label>Password</label>
                            <input class="form-control" name="password"  type="password" placeholder="my secret password" />
                        </div>
						
						  <div class="form-group"><i class="fa fa-lock input-icon input-icon-show"></i>

                                                <div class="checkbox checkbox-small">
                                                    <label>
                                                        <input class="i-check" type="checkbox" />I agree to the TripOn <a hreh="">Terms of Use and Privacy Policy</a></label>
                                                    </div>

                                                </div>
												
                        <button class="btn btn-primary reg_btn" type="submit" >Sign up <i class="fas fa-sign-in-alt"> </i> </button>

                    </form>

                                <br>
                      <div id="rgresponse" class="alert alert-success" style="display:none;">
      <a href="#" class="close" data-dismiss="alert">&times;</a>
      <div class="message"></div>
    </div>
    <br>
                                    </div>
                                    <div class="tab-pane fade" id="tab-2">
                                    
                                             <form method="post" id="operator_user_reg">
                                      <input type="hidden" name="type" value="op">
                        <div class="form-group form-group-icon-left"><i class="fa fa-user input-icon input-icon-show"></i>
                            <label>Company Name</label>
                            <input class="form-control" name="name" placeholder="e.g. John Doe" type="text" />
                        </div>
                        <div class="form-group form-group-icon-left"><i class="fa fa-envelope input-icon input-icon-show"></i>
                            <label>Email</label>
                            <input class="form-control" name="email" placeholder="e.g. johndoe@gmail.com" type="text" />
                        </div>
                        
                         <div class="form-group">
                                                <label>Mobile</label>
                                                <input class="form-control" placeholder="+234" value="+234"   style="width: 18%; float: left; margin-right: 2%;" name="ccode" type="text">

                                                <input class="form-control" style="width:80%;" name="mobile" placeholder="XXXXXXXXXX" type="text">
                                            </div>
                        
                        <div class="form-group form-group-icon-left"><i class="fa fa-lock input-icon input-icon-show"></i>
                            <label>Password</label>
                            <input class="form-control" type="password" name="password" placeholder="my secret password" />
                        </div>
                       
                        <button class="btn btn-primary oreg_btn" type="submit" > Sign up for Operator <i class="fa"> </i> </button>
                    </form>
                                                                     <br>
                      <div id="oprgresponse" class="alert alert-success" style="display:none;">
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
          window.location.href = "index.php";
    
            }else{

                $("#response").removeClass("alert-danger").addClass("alert-danger").fadeIn();
        $("#response .message").html(data.msg);
        $("html, body").animate({ scrollTop: $('#response').offset().top }, 1000);
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
            
             $("#oprgresponse .message").html("<strong>" + data.status + "</strong>: " + data.msg);
          $("#oprgresponse").removeClass("alert-danger").addClass("alert-success").fadeIn();
          
          $("html, body").animate({ scrollTop: $('#oprgresponse').offset().top }, 500);
         
    
            }else{

                $("#oprgresponse").removeClass("alert-danger").addClass("alert-danger").fadeIn();
        $("#oprgresponse .message").html(data.msg);
        $("html, body").animate({ scrollTop: $('#oprgresponse').offset().top }, 1000);
            }
               
      }
 
        
        });
   
 return false;
   });


  </script>
    </div>
</body>

</html>



