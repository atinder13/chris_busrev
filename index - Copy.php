<?php 
ob_start();
session_start();
 
 require_once 'config/config.php';

require_once CLASSPATH.'DB_Functions.php';
$DB= new DB_Functions();
?>
<!DOCTYPE HTML>
<html>

<head>
    <title>Traveler</title>


    <meta content="text/html;charset=utf-8" http-equiv="Content-Type">
    <meta name="keywords" content="Template, html, premium, themeforest" />
    <meta name="description" content="Traveler - Premium template for travel companies">
    <meta name="author" content="Tsoy">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- GOOGLE FONTS -->
    <link href='http://fonts.googleapis.com/css?family=Roboto:400,300,100,500,700' rel='stylesheet' type='text/css'>
    <link href='http://fonts.googleapis.com/css?family=Open+Sans:400italic,400,300,600' rel='stylesheet' type='text/css'>
    <!-- /GOOGLE FONTS -->
    <link rel="stylesheet" href="css/bootstrap.css">
    <link rel="stylesheet" href="css/font-awesome.css">
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
	
	<link href="https://ajax.googleapis.com/ajax/libs/jqueryui/1.12.1/themes/smoothness/jquery-ui.css" rel="stylesheet"/>

</head>

<body>

   
   <?php 
   
   include_once('lib/header.php') ?>

        <div class="bg-holder">
            <div class="bg-mask-darken"></div>
            <div class="bg-parallax"></div>
            <!-- START GRIDROTATOR -->
            <div class="ri-grid" id="ri-grid">
                <ul>
                    <li>
                        <a href="#">
                            <img src="img/in_the_bokeh_forest_300x300.jpg" alt="Image Alternative text" title="In the bokeh forest" />
                        </a>
                    </li>
                    <li>
                        <a href="#">
                            <img src="img/our_coffee_miss_u_300x300.jpg" alt="Image Alternative text" title="Our Coffee miss u" />
                        </a>
                    </li>
                    <li>
                        <a href="#">
                            <img src="img/hotel_porto_bay_rio_internacional_rooftop_pool_300x300.jpg" alt="Image Alternative text" title="hotel PORTO BAY RIO INTERNACIONAL rooftop pool" />
                        </a>
                    </li>
                    <li>
                        <a href="#">
                            <img src="img/playstation_controller_300x300.jpg" alt="Image Alternative text" title="Playstation controller" />
                        </a>
                    </li>
                    <li>
                        <a href="#">
                            <img src="img/gaviota_en_el_top_300x300.jpg" alt="Image Alternative text" title="Gaviota en el Top" />
                        </a>
                    </li>
                    <li>
                        <a href="#">
                            <img src="img/196_365_300x300.jpg" alt="Image Alternative text" title="196_365" />
                        </a>
                    </li>
                    <li>
                        <a href="#">
                            <img src="img/end_of_the_day_300x300.jpg" alt="Image Alternative text" title="end of the day" />
                        </a>
                    </li>
                    <li>
                        <a href="#">
                            <img src="img/lack_of_blue_depresses_me_300x300.jpg" alt="Image Alternative text" title="lack of blue depresses me" />
                        </a>
                    </li>
                    <li>
                        <a href="#">
                            <img src="img/working_in_the_nature_300x300.jpg" alt="Image Alternative text" title="Working in the Nature" />
                        </a>
                    </li>
                    <li>
                        <a href="#">
                            <img src="img/bekohlicious_flower_300x300.jpg" alt="Image Alternative text" title="Bekohlicious Flower" />
                        </a>
                    </li>
                    <li>
                        <a href="#">
                            <img src="img/people_on_the_beach_300x300.jpg" alt="Image Alternative text" title="people on the beach" />
                        </a>
                    </li>
                    <li>
                        <a href="#">
                            <img src="img/sydney_harbour_300x300.jpg" alt="Image Alternative text" title="Sydney Harbour" />
                        </a>
                    </li>
                    <li>
                        <a href="#">
                            <img src="img/sweet_escape_300x300.jpg" alt="Image Alternative text" title="sweet escape" />
                        </a>
                    </li>
                    <li>
                        <a href="#">
                            <img src="img/street_300x300.jpg" alt="Image Alternative text" title="Street" />
                        </a>
                    </li>
                    <li>
                        <a href="#">
                            <img src="img/play_ball_300x300.jpg" alt="Image Alternative text" title="Play Ball" />
                        </a>
                    </li>
                    <li>
                        <a href="#">
                            <img src="img/el_inevitable_paso_del_tiempo_300x300.jpg" alt="Image Alternative text" title="El inevitable paso del tiempo" />
                        </a>
                    </li>
                    <li>
                        <a href="#">
                            <img src="img/bekohlicious_300x300.jpg" alt="Image Alternative text" title="Bekohlicious" />
                        </a>
                    </li>
                    <li>
                        <a href="#">
                            <img src="img/spidy_300x300.jpg" alt="Image Alternative text" title="Spidy" />
                        </a>
                    </li>
                    <li>
                        <a href="#">
                            <img src="img/sevenly_shirts_-_june_2012__2_300x300.jpg" alt="Image Alternative text" title="Sevenly Shirts - June 2012  2" />
                        </a>
                    </li>
                    <li>
                        <a href="#">
                            <img src="img/viva_las_vegas_300x300.jpg" alt="Image Alternative text" title="Viva Las Vegas" />
                        </a>
                    </li>
                    <li>
                        <a href="#">
                            <img src="img/the_best_mode_of_transport_here_in_maldives_300x300.jpg" alt="Image Alternative text" title="the best mode of transport here in maldives" />
                        </a>
                    </li>
                    <li>
                        <a href="#">
                            <img src="img/the_big_showoff-take_2_300x300.jpg" alt="Image Alternative text" title="The Big Showoff-Take 2" />
                        </a>
                    </li>
                    <li>
                        <a href="#">
                            <img src="img/a_turn_300x300.jpg" alt="Image Alternative text" title="a turn" />
                        </a>
                    </li>
                    <li>
                        <a href="#">
                            <img src="img/rail_road_300x300.jpg" alt="Image Alternative text" title="Rail Road" />
                        </a>
                    </li>
                    <li>
                        <a href="#">
                            <img src="img/new_york_at_an_angle_300x300.jpg" alt="Image Alternative text" title="new york at an angle" />
                        </a>
                    </li>
                    <li>
                        <a href="#">
                            <img src="img/waipio_valley_300x300.jpg" alt="Image Alternative text" title="waipio valley" />
                        </a>
                    </li>
                    <li>
                        <a href="#">
                            <img src="img/pink_flowers_300x300.jpg" alt="Image Alternative text" title="pink flowers" />
                        </a>
                    </li>
                    <li>
                        <a href="#">
                            <img src="img/cascada_300x300.jpg" alt="Image Alternative text" title="cascada" />
                        </a>
                    </li>
                    <li>
                        <a href="#">
                            <img src="img/a_dreamy_jump_300x300.jpg" alt="Image Alternative text" title="a dreamy jump" />
                        </a>
                    </li>
                    <li>
                        <a href="#">
                            <img src="img/foots_and_grass_300x300.jpg" alt="Image Alternative text" title="Foots and grass" />
                        </a>
                    </li>
                    <li>
                        <a href="#">
                            <img src="img/4_strokes_of_fun_300x300.jpg" alt="Image Alternative text" title="4 Strokes of Fun" />
                        </a>
                    </li>
                    <li>
                        <a href="#">
                            <img src="img/afro_300x300.jpg" alt="Image Alternative text" title="Afro" />
                        </a>
                    </li>
                    <li>
                        <a href="#">
                            <img src="img/sunny_wood_300x300.jpg" alt="Image Alternative text" title="sunny wood" />
                        </a>
                    </li>
                    <li>
                        <a href="#">
                            <img src="img/b_and_w_camera_300x300.jpg" alt="Image Alternative text" title="b and w camera" />
                        </a>
                    </li>
                    <li>
                        <a href="#">
                            <img src="img/drifting_days_300x300.jpg" alt="Image Alternative text" title="drifting days" />
                        </a>
                    </li>
                    <li>
                        <a href="#">
                            <img src="img/amaze_300x300.jpg" alt="Image Alternative text" title="AMaze" />
                        </a>
                    </li>
                    <li>
                        <a href="#">
                            <img src="img/pictures_at_the_museum_300x300.jpg" alt="Image Alternative text" title="Pictures at the museum" />
                        </a>
                    </li>
                    <li>
                        <a href="#">
                            <img src="img/the_hidden_power_of_the_heart_300x300.jpg" alt="Image Alternative text" title="The Hidden Power of the Heart" />
                        </a>
                    </li>
                    <li>
                        <a href="#">
                            <img src="img/street_yoga_300x300.jpg" alt="Image Alternative text" title="Street Yoga" />
                        </a>
                    </li>
                    <li>
                        <a href="#">
                            <img src="img/sorry_to_bust_your_bubble_300x300.jpg" alt="Image Alternative text" title="Sorry to Bust Your Bubble" />
                        </a>
                    </li>
                    <li>
                        <a href="#">
                            <img src="img/thyme_300x300.jpg" alt="Image Alternative text" title="Thyme" />
                        </a>
                    </li>
                    <li>
                        <a href="#">
                            <img src="img/flare_lens_flare_300x300.jpg" alt="Image Alternative text" title="Flare lens flare" />
                        </a>
                    </li>
                    <li>
                        <a href="#">
                            <img src="img/cup_on_red_300x300.jpg" alt="Image Alternative text" title="Cup on red" />
                        </a>
                    </li>
                    <li>
                        <a href="#">
                            <img src="img/old_no7_300x300.jpg" alt="Image Alternative text" title="Old No7" />
                        </a>
                    </li>
                    <li>
                        <a href="#">
                            <img src="img/new_year_greetings_300x300.jpg" alt="Image Alternative text" title="New Year Greetings" />
                        </a>
                    </li>
                    <li>
                        <a href="#">
                            <img src="img/gamer_chick_300x300.jpg" alt="Image Alternative text" title="Gamer Chick" />
                        </a>
                    </li>
                    <li>
                        <a href="#">
                            <img src="img/bridge_300x300.jpg" alt="Image Alternative text" title="Bridge" />
                        </a>
                    </li>
                    <li>
                        <a href="#">
                            <img src="img/bubbles_300x300.jpg" alt="Image Alternative text" title="Bubbles" />
                        </a>
                    </li>
                </ul>
            </div>
            <!-- END GRIDROTATOR -->
            <div class="bg-front full-center">
                <div class="container">
                    <div class="search-tabs search-tabs-bg">
                        <h1>Find Your Perfect Trip</h1>
                        <div class="tabbable">
                          
                            <div class="tab-content">
                                <div class="tab-pane fade in active" id="tab-2">
                                    <h2>Search for Best Buses</h2>
                                    <form action="search-results.php" onsubmit="return checkform()">
									
                                        <div class="tabbable">
                                           <ul class="nav nav-pills nav-sm nav-no-br mb10" id="flightChooseTab">
											 <li class="hreturn active" data-type="single"><a  data-toggle="tab">One Way</a>
                                                </li>
										   <li class="hreturn" data-type="round"><a href="#" data-toggle="tab">Round Trip</a>
                                                </li>
                                               
                                               
                                            </ul> 
			
                                            <div class="tab-content">
                                                <div class="tab-pane fade in active" id="flight-search-1">
                                                    <div class="row">
                                                        <div class="col-md-6">
                                                            <div class="row">
                                                                <div class="col-md-6">
                                                                    <div class="form-group form-group-lg form-group-icon-left"><i class="fa fa-map-marker input-icon"></i>
                                                                        <label>From</label>
                                             <input id="search-box" class="form-control required" placeholder="From City" type="text" name="from" oninput="clientSelOpt(this,'fromid','getFromCity')"  autocomplete="something" />
																	<input type="hidden" id="fromid"  name="fromid"> 
																   </div>
                                                                </div>
					
                                                                <div class="col-md-6">
                                                                    <div class="form-group form-group-lg form-group-icon-left"><i class="fa fa-map-marker input-icon"></i>
                                                                        <label>To</label>
                            <input id="search-to" class="form-control required" oninput="clientSelOpt(this,'toid','getToCity')" placeholder="To City" type="text" name="to"  autocomplete="something-new" />
							
							<input type="hidden" id="toid"  name="toid"> 
																		
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-6">
                                                            <div class="input-daterange" data-date-format="yyyy-mm-dd">
                                                                <div class="row">
                                                                    <div class="col-md-4">
                                                                  <div class="form-group form-group-lg form-group-icon-left"><i class="fa fa-calendar input-icon input-icon-highlight"></i>
                                                                            <label>Departing</label>
                                                             <input class="date-pick form-control required" name="start" type="text" />
                                                                 </div>
                                                                    </div>
                                                             
																   <div class="col-md-4 returndiv" style="display:none">
                                                                        <div class="form-group form-group-lg form-group-icon-left"><i class="fa fa-calendar input-icon input-icon-highlight"></i>
                                                                            <label>Returning</label>
                                                                            <input class="form-control required" name="end" type="text" value="" />
                                                                        </div>
                                                                    </div>
																	
                                                                    
                                                                </div>
                                                            </div>
															<div class="col-md-4">
                                                                        <div class="form-group form-group-lg form-group-select-plus">
                                                                            <label>Passngers</label>
                                                                            <div class="btn-group btn-group-select-num" data-toggle="buttons">
                                                                                <label class="btn btn-primary inputcl active" data-val="1">
                                                                                    <input type="radio" name="options" />1</label>
                                                                                <label class="btn btn-primary inputcl" data-val="2">
                                                                                    <input type="radio" name="options"  />2</label>
                                                                                <label class="btn btn-primary inputcl" data-val="3">
                                                                                    <input type="radio" name="options"  />3</label>
                                                                                <label class="btn btn-primary">
                                                                                    <input type="radio" name="options"  />3+</label>
                                                                            </div>
                                                                            <select class="form-control hidden" name="passengers">
                                                                                <option  value="1" selected="selected">1</option>
																				<option value="2">2</option>
																				<option value="3">3</option>
																				<option value="4" >4</option>
																				<option value="5">5</option>
																				<option value="6">6</option>
																				<option value="7">7</option>
																				<option value="8">8</option>
																				<option value="9">9</option>
																				<option value="10">10</option>
																				<option value="11">11</option>
																				<option value="12">12</option>
																				<option value="13">13</option>
																				<option value="14">14</option>
                                                                            </select>
                                                                        </div>
                                                                    </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            
                                            </div>
										<?php 
											$busTypes=$DB->busType();
											if($busTypes != false){
											?>
                                               <div class="tab-content" style="margin-bottom: 2rem;">
                                                <span style="vertical-align: sub;"><a href="javascript:void(0)" id="flip"><i class="fa fa-plus box-icon-border" style="float: left;margin-right: 1rem;"></i>Amenities</a></span>
                                                <br>
                                            </div>

<div class="tab-content" style="margin-bottom: 2rem; min-height: 10rem;display:none" id="panel">
    
     <div class="col-md-2">
								<?php 
								$i=1;
											foreach($busTypes as $Type){
												if($i % 4 == 0){
													
												echo '</div><div class="col-md-2">'	;
												}
													
											?>
                            <div class="checkbox checkbox-stroke">
                                <label>
                                    <input class="i-check" value="<?php echo $Type['id']?>"  name="bustypes[]" type="checkbox" /><?php echo ucfirst($Type['name']) ?></label>
                            </div>
                           
											<?php 
												$i++;
											} ?>
                        </div>
                        
                       
</div>
											<?php } ?>
<input type="hidden" name="isreturn" id="is_return" value="F">
                                        </div>
                                        <button class="btn btn-primary btn-lg" type="submit">Search for Bus</button>
                                    </form>
                                </div>
                                
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>



        <div class="container">
        </div>
        <div class="bg-color text-white">
            <div class="container">
                <div class="gap"></div>
                <div class="row row-wrap" data-gutter="120">
                    <div class="col-md-4">
                        <div class="thumb">
                            <header class="thumb-header"><i class="fa fa-thumbs-o-up box-icon-border round box-icon-white box-icon-big"></i>
                            </header>
                            <div class="thumb-caption">
                                <h4 class="thumb-title">Best Travel Agent</h4>
                                <p class="thumb-desc">Morbi semper fames lobortis ac hac penatibus quisque massa scelerisque proin dignissim est</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="thumb">
                            <header class="thumb-header"><i class="fa fa-lock box-icon-border round box-icon-white box-icon-big"></i>
                            </header>
                            <div class="thumb-caption">
                                <h4 class="thumb-title">Trust & Safety</h4>
                                <p class="thumb-desc">Viverra magna gravida accumsan enim integer faucibus velit leo laoreet platea senectus ullamcorper</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="thumb">
                            <header class="thumb-header"><i class="fa fa-dollar box-icon-border round box-icon-white box-icon-big"></i>
                            </header>
                            <div class="thumb-caption">
                                <h4 class="thumb-title">Best Price Guarantee</h4>
                                <p class="thumb-desc">At nec sit magnis enim nascetur platea molestie lobortis purus nunc tempor placerat</p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="gap gap-small"></div>
            </div>
        </div>
        <div class="container">
        </div>
        <div class="special-area">
            <div class="owl-carousel owl-slider owl-carousel-area" id="owl-carousel-slider">
                <div class="bg-holder full text-center text-white">
                    <div class="bg-mask"></div>
                    <div class="bg-img" style="background-image:url(img/el_inevitable_paso_del_tiempo_2048x2048.jpg);"></div>
                    <div class="bg-front full-center">
                        <div class="owl-cap">
                            <div class="owl-cap-weather"><span>+35</span><i class="im im-sun"></i>
                            </div>
                            <h1 class="owl-cap-title">Budapest</h1>
                            <div class="owl-cap-price"><small>from</small>
                                <h5>$700</h5>
                            </div><a class="btn btn-white btn-ghost" href="#"><i class="fa fa-angle-right"></i> Explore</a>
                        </div>
                    </div>
                </div>
                <div class="bg-holder full text-center text-white">
                    <div class="bg-mask"></div>
                    <div class="bg-img" style="background-image:url(img/196_365_2048x1365.jpg);"></div>
                    <div class="bg-front full-center">
                        <div class="owl-cap">
                            <div class="owl-cap-weather"><span>+26</span><i class="im im-rain"></i>
                            </div>
                            <h1 class="owl-cap-title">Paris</h1>
                            <div class="owl-cap-price"><small>from</small>
                                <h5>$2800</h5>
                            </div><a class="btn btn-white btn-ghost" href="#"><i class="fa fa-angle-right"></i> Explore</a>
                        </div>
                    </div>
                </div>
                <div class="bg-holder full text-center text-white">
                    <div class="bg-mask"></div>
                    <div class="bg-img" style="background-image:url(img/viva_las_vegas_2048x1365.jpg);"></div>
                    <div class="bg-front full-center">
                        <div class="owl-cap">
                            <div class="owl-cap-weather"><span>+29</span><i class="im im-sun"></i>
                            </div>
                            <h1 class="owl-cap-title">Las Vegas</h1>
                            <div class="owl-cap-price"><small>from</small>
                                <h5>$1100</h5>
                            </div><a class="btn btn-white btn-ghost" href="#"><i class="fa fa-angle-right"></i> Explore</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="container">
            <div class="gap"></div>
            <h2 class="text-center mb20">Top Travel Destinations</h2>
            <div class="row row-wrap">
                <div class="col-md-3">
                    <div class="thumb">
                        <header class="thumb-header">
                            <a class="hover-img curved" href="#">
                                <img src="img/the_journey_home_400x300.jpg" alt="Image Alternative text" title="the journey home" /><i class="fa fa-plus box-icon-white box-icon-border hover-icon-top-right round"></i>
                            </a>
                        </header>
                        <div class="thumb-caption">
                            <h4 class="thumb-title">Africa</h4>
                            <p class="thumb-desc">Hendrerit nam congue habitant maecenas tempus netus penatibus</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="thumb">
                        <header class="thumb-header">
                            <a class="hover-img curved" href="#">
                                <img src="img/people_on_the_beach_800x600.jpg" alt="Image Alternative text" title="people on the beach" /><i class="fa fa-plus box-icon-white box-icon-border hover-icon-top-right round"></i>
                            </a>
                        </header>
                        <div class="thumb-caption">
                            <h4 class="thumb-title">Australia</h4>
                            <p class="thumb-desc">Massa ridiculus ad parturient inceptos sit consequat penatibus</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="thumb">
                        <header class="thumb-header">
                            <a class="hover-img curved" href="#">
                                <img src="img/lack_of_blue_depresses_me_800x600.jpg" alt="Image Alternative text" title="lack of blue depresses me" /><i class="fa fa-plus box-icon-white box-icon-border hover-icon-top-right round"></i>
                            </a>
                        </header>
                        <div class="thumb-caption">
                            <h4 class="thumb-title">Greece</h4>
                            <p class="thumb-desc">Odio cras congue montes dictum facilisi posuere nunc</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="thumb">
                        <header class="thumb-header">
                            <a class="hover-img curved" href="#">
                                <img src="img/upper_lake_in_new_york_central_park_800x600.jpg" alt="Image Alternative text" title="Upper Lake in New York Central Park" /><i class="fa fa-plus box-icon-white box-icon-border hover-icon-top-right round"></i>
                            </a>
                        </header>
                        <div class="thumb-caption">
                            <h4 class="thumb-title">USA</h4>
                            <p class="thumb-desc">Massa inceptos conubia ridiculus neque aliquam commodo faucibus</p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="gap gap-small"></div>
        </div>



        <footer id="main-footer">
            <div class="container">
                <div class="row row-wrap">
                    <div class="col-md-3">
                        <a class="logo" href="index.html">
                            <img src="img/logo-invert.png" alt="Image Alternative text" title="Image Title" />
                        </a>
                        <p class="mb20">Booking, reviews and advices on hotels, resorts, flights, vacation rentals, travel packages, and lots more!</p>
                        <ul class="list list-horizontal list-space">
                            <li>
                                <a class="fa fa-facebook box-icon-normal round animate-icon-bottom-to-top" href="#"></a>
                            </li>
                            <li>
                                <a class="fa fa-twitter box-icon-normal round animate-icon-bottom-to-top" href="#"></a>
                            </li>
                            <li>
                                <a class="fa fa-google-plus box-icon-normal round animate-icon-bottom-to-top" href="#"></a>
                            </li>
                            <li>
                                <a class="fa fa-linkedin box-icon-normal round animate-icon-bottom-to-top" href="#"></a>
                            </li>
                            <li>
                                <a class="fa fa-pinterest box-icon-normal round animate-icon-bottom-to-top" href="#"></a>
                            </li>
                        </ul>
                    </div>

                    <div class="col-md-3">
                        <h4>Newsletter</h4>
                        <form>
                            <label>Enter your E-mail Address</label>
                            <input type="text" class="form-control">
                            <p class="mt5"><small>*We Never Send Spam</small>
                            </p>
                            <input type="submit" class="btn btn-primary" value="Subscribe">
                        </form>
                    </div>
                    <div class="col-md-2">
                        <ul class="list list-footer">
                            <li><a href="#">About US</a>
                            </li>
                            <li><a href="#">Press Centre</a>
                            </li>
                            <li><a href="#">Best Price Guarantee</a>
                            </li>
                            <li><a href="#">Travel News</a>
                            </li>
                            <li><a href="#">Jobs</a>
                            </li>
                            <li><a href="#">Privacy Policy</a>
                            </li>
                            <li><a href="#">Terms of Use</a>
                            </li>
                            <li><a href="#">Feedback</a>
                            </li>
                        </ul>
                    </div>
                    <div class="col-md-4">
                        <h4>Have Questions?</h4>
                        <h4 class="text-color">+1-202-555-0173</h4>
                        <h4><a href="#" class="text-color">support@traveler.com</a></h4>
                        <p>24/7 Dedicated Customer Support</p>
                    </div>

                </div>
            </div>
        </footer>

        <script src="js/jquery.js"></script>
		<script src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js"></script>
        <script src="js/bootstrap.js"></script>
        <script src="js/slimmenu.js"></script>
        <script src="js/bootstrap-datepicker.js"></script>
        <script src="js/bootstrap-timepicker.js"></script>
        <script src="js/nicescroll.js"></script>
        <script src="js/dropit.js"></script>
        <script src="js/ionrangeslider.js"></script>
        <script src="js/icheck.js"></script>
        <script src="js/fotorama.js"></script>
       
        <script src="js/typeahead.js"></script>
        <script src="js/card-payment.js"></script>
        <script src="js/magnific.js"></script>
        <script src="js/owl-carousel.js"></script>
        <script src="js/fitvids.js"></script>
        <script src="js/tweet.js"></script>
        <script src="js/countdown.js"></script>
        <script src="js/gridrotator.js"></script>
        <script src="js/custom.js"></script>
        <script src="js/switcher.js"></script>
		
    </div>
        <script> 
$(document).ready(function(){
  $("#flip").click(function(){
    $("#panel").fadeToggle();
  });
	

 });	
 $(".inputcl").click(function(){
	 
    $('select option[value="' + $(this).attr('data-val') +'"]').prop("selected", true);
  });
  
	 $(".hreturn").click(function(){
	
   var type=$(this).attr('data-type');
   $('.input-daterange, input.date-pick, .input-daterange input[name="start"], input.date-pick, .input-daterange, .date-pick-inline').datepicker('destroy');
 /*  $('input.date-pick, .input-daterange input[name="start"]').datepicker({format:'yyyy-mm-dd',autoclose:true}).datepicker('setDate','today');
	  */  
   if(type == 'round'){
	 
	$('input.date-pick, .input-daterange, .date-pick-inline').datepicker({
    //todayHighlight: true,
	format:'yyyy-mm-dd',
	startDate: 'today',
	autoclose:true,
	});
	   $('.returndiv').fadeIn();
   }
   else{
		
		
	    $('.returndiv').fadeOut();
   }
  });
	
	

	$('input.date-pick, .input-daterange input[name="start"]').datepicker({format:'yyyy-mm-dd',autoclose:true}).datepicker('setDate','today');

	//$('.input-daterange input[name="end"]').datepicker({format:'yyyy-mm-dd',autoclose:true,}).datepicker('setDate', '+7d');
	
    function clientSelOpt(t,main,action) {
    var id='#'+t.id;
	
       $(id).autocomplete({
  source: function( request, response ) {
   // Fetch data
   $.ajax({
    url: "cpresponse.php",
    type: 'post',
    dataType: "json",
    data: {
     search: request.term,action:action
    },
    success: function( data ) {
      response( $.map( data, function( item ) {

                        return {    label: item.label,
                                    value: item.label,
                                    mid: item.value,
                                   

                                    }
                    }));
    }
   });
  },
   change: function(event,ui) {
	   console.log('df');
   },
  select: function (event, ui) {
   // Set selection

   $(id).val(ui.item.label); // display the selected text
  $('#'+main).val(ui.item.mid); // save selected id to input
   return false;
  },
      
  
 }).focus(function () {
	
    $(this).autocomplete("search");
  }).autocomplete( "instance" )._renderItem = function( ul, item ) {


      return $( "<li>" )
        .append( "<div class='underline'><i class='fa fa-map-marker' aria-hidden='true'></i> " + item.label + "</div>" )
        .appendTo( ul );
    };


  }
  
    

	function checkform(){
	
	var type=$('#flightChooseTab').find('.active').attr('data-type');
	if(type == 'single'){
		var req='required';
		$('#is_return').val('F');
	}
	else{
		var req='required';
		$('#is_return').val('T');
	}
	
	 var errorCounter = validateForm(req);

	 if (errorCounter > 0) {
		
		return false;
	}
	else{
		return true;
	}
  }
  
	   function validateForm(cls) {
      // error handling
      var errorCounter = 0;
		var cs='.'+cls;
		
      $("."+cls).each(function(i, obj) {
		
          if($(this).val() === ''){
              $(this).parent().addClass("has-error");
              errorCounter++;
          } else{ 
              $(this).parent().removeClass("has-error"); 
          }


      });

      return errorCounter;
  }
</script>
</script>
</body>


</html>



