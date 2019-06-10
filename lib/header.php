<?php 
ob_start();



@session_start();


$Page= basename($_SERVER['PHP_SELF']);
$PageTitle=(isset($pagetitle)) ? $pagetitle : 'TripOn';
$Des=(isset($Des)) ? $Dec : "TripOn Bus Travel in Nigeria";
$keywords=(isset($keywords)) ? $keywords : "Bus, Travel, online booking, Nigeria";
?>
<!DOCTYPE HTML>
<html>

<head>
    <title><?php echo $PageTitle ?></title>


    <meta content="text/html;charset=utf-8" http-equiv="Content-Type">
    <meta name="keywords" content="<?php echo $keywords ?>" />
    <meta name="description" content="<?php echo $Des ?>">
    <meta name="author" content="CP Singh">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- GOOGLE FONTS -->
    <link href='http://fonts.googleapis.com/css?family=Roboto:400,300,100,500,700' rel='stylesheet' type='text/css'>
    <link href='http://fonts.googleapis.com/css?family=Open+Sans:400italic,400,300,600' rel='stylesheet' type='text/css'>
    <!-- /GOOGLE FONTS -->
    <link rel="stylesheet" href="css/bootstrap.css">
    <link rel="stylesheet" href="css/font-awesome.css">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.2/css/all.css" integrity="sha384-oS3vJWv+0UjzBfQzYUhtDYW+Pj2yciDJxpsK1OYPAYjqT085Qq/1cq5FLXAZQ7Ay" crossorigin="anonymous">
    <link rel="stylesheet" href="css/icomoon.css">
    <link rel="stylesheet" href="css/styles.css">
    <link rel="stylesheet" href="css/mystyles.css">
    <script src="js/modernizr.js"></script>

    <link rel="stylesheet" href="css/switcher.css" />
    <link rel="alternate stylesheet" type="text/css" href="css/schemes/bright-turquoise.css" title="bright-turquoise" media="all" />
    <link rel="alternate stylesheet" type="text/css" href="css/schemes/turkish-rose.css" title="turkish-rose" media="all" />
    <link rel="alternate stylesheet" type="text/css" href="css/schemes/salem.css" title="salem" media="all" />
    <link rel="alternate stylesheet" type="text/css" href="css/schemes/hippie-blue.css" title="hippie-blue" media="all" />
    <link rel="alternate stylesheet" type="text/css" href="css/schemes/mandy.css" title="mandy" media="all" />
    <link rel="alternate stylesheet" type="text/css" href="css/schemes/green-smoke.css" title="green-smoke" media="all" />
    <link rel="alternate stylesheet" type="text/css" href="css/schemes/horizon.css" title="horizon" media="all" />
    <link rel="alternate stylesheet" type="text/css" href="css/schemes/cerise.css" title="cerise" media="all" />
    <link rel="alternate stylesheet" type="text/css" href="css/schemes/brick-red.css" title="brick-red" media="all" />
    <link rel="alternate stylesheet" type="text/css" href="css/schemes/de-york.css" title="de-york" media="all" />
    <link rel="alternate stylesheet" type="text/css" href="css/schemes/shamrock.css" title="shamrock" media="all" />
    <link rel="alternate stylesheet" type="text/css" href="css/schemes/studio.css" title="studio" media="all" />
    <link rel="alternate stylesheet" type="text/css" href="css/schemes/leather.css" title="leather" media="all" />
    <link rel="alternate stylesheet" type="text/css" href="css/schemes/denim.css" title="denim" media="all" />
    <link rel="alternate stylesheet" type="text/css" href="css/schemes/scarlet.css" title="scarlet" media="all" />
    
      <?php 
  
  if(isset($extraStyle) && count($extraStyle) > 0){
  
  foreach($extraStyle as $script){ 
       echo '<link href="'.$script.'" rel="stylesheet"/>';
   
     }
      }
  ?>
  
    <link href="https://ajax.googleapis.com/ajax/libs/jqueryui/1.12.1/themes/smoothness/jquery-ui.css" rel="stylesheet"/>

</head>
<body>   
      <div class="global-wrap">

        <header id="main-header">
            <div class="header-top">
                <div class="container">
                    <div class="row">
                        <div class="col-md-8">
                            <a class="logo" href="index.php">
                                <img src="img/logo-invert.png" alt="Image Alternative text" title="Image Title" />
                            </a>
                        </div>
                       <!-- <div class="col-md-4 nav">
                    <ul class="slimmenu" id="slimmenu">
                        <li <?php echo ($Page == 'index.php' ) ? 'class=""' : '' ?>><a href="index.php">Manage Booking</a>
                        </li>
                        <li <?php echo ($Page == 'about.php' ) ? 'class=""' : '' ?>><a href="about.php">Travel Info</a>
                        </li>
                   
                    </ul>
                </div> -->
						<?php 
							
						 if(isset($_SESSION['email'])){
							 
						?>





                        <div class="col-md-4">
                            <div class="nav top-user-area clearfix">
                                <ul id="slimmenu" class="slimmenu top-user-area-list list list-horizontal list-border">
                                    <li class="top-user-area-avatar">
                                        <a href="user-profile-booking-history.php">
                                            <img class="origin round" src="img/amaze_40x40.jpg" alt="Image Alternative text" title="AMaze" />Hi, <?php echo $_SESSION['name'] ?></a>
                                    </li>
                                    <li><a href="logout.php">Log Out</a>
                                    </li>
                                    <li><a href="logout.php">Travel Info</a>
                                    </li>
                                   <!--  <li class="top-user-area-avatar">
                                        <a href="#">
                                            <img class="origin" style="height: 25px; border: 0px;" src="https://d19yo8val8huli.cloudfront.net/hotels/v7/img/flags/naira.svg" alt="Image Alternative text" title="AMaze" />
                                            <span style="font-size: large;vertical-align: middle;">₦</span></a>
                                    </li>  -->
                                   
                                </ul>
                            </div>
                        </div>
						 <?php }
							else{
								?>
								   <div class="col-md-4">
                            <div class="nav top-user-area clearfix">
                                <ul id="slimmenu" class="slimmenu top-user-area-list list list-horizontal list-border">
                                    <li class="top-user-area-avatar">
                                        <a href="#">
                                            <img class="origin round" src="img/amaze_40x40.jpg" alt="Image Alternative text" title="AMaze" />Hi, Guest</a>
                                    </li>
									<li><a href="login-register.php">Register</a>
                                    </li>
                                    <li><a href="login.php">Login</a>
                                    </li> 
                                    <li><a href="logout.php">Travel Info</a>
                                    </li>
									
                                    <!-- <li class="top-user-area-avatar">
                                        <a href="#">
                                            <img class="origin" style="height: 25px; border: 0px;" src="https://d19yo8val8huli.cloudfront.net/hotels/v7/img/flags/naira.svg" alt="Image Alternative text" title="AMaze" />
                                            <span style="font-size: large;vertical-align: middle;">₦</span></a>
                                    </li>  -->
                                   
                                </ul>
                            </div>
                        </div>
							<?php } ?>
                    </div>
                </div>
            </div>
          <!--   <div class="container" style="padding: 0px;">
                <div class="nav">
                    <ul class="slimmenu" id="slimmenu">
                        <li <?php echo ($Page == 'index.php' ) ? 'class="active"' : '' ?>><a href="index.php">Home</a>
                        </li>
                        <li <?php echo ($Page == 'about.php' ) ? 'class="active"' : '' ?>><a href="about.php">About us</a>
                        </li>
                      
                        <li><a href="seat_selection.php">Seat Selection</a>
                        </li>
                        <li <?php echo ($Page == 'flight-search-2.php' ) ? 'class="active"' : '' ?>><a href="flight-search-2.php">Bus Operators</a>
                        </li>
						
						<li <?php echo ($Page == 'contact-us.php' ) ? 'class="active"' : '' ?>><a href="contact-us.php">Contact</a>
                        </li>
					
                       
                   
                    </ul>
                </div>
            </div> -->
        </header>
