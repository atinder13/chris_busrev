<?php 
ob_start();
session_start();
 
 require_once 'config/config.php';

require_once CLASSPATH.'DB_Functions.php';
$DB= new DB_Functions();

 $pagetitle="TripOn - About";  	  
	include_once('lib/header.php'); 
	?>

        <div class="container">
            <h1 class="page-title">About Us</h1>
        </div>




        <div class="container">
            <div class="row">
                <div class="col-md-10" style="text-align: justify;">
                    <p >TripON.ng is the first platform providing online bus reservations and ticket booking services for the Nigerian road travelers. We offer a wide selection of Bus Operators, giving our users the ability to search through numerous service providers. A search through our inventory of bus trips yields Bus Operator Name, Bus Terminal Name, Address, Departure Time, Bus Capacity, Seats Available (in real time), Seat Map (in real time), Route Map, Stop Points, etc. Finally, a user is able to make a ticket purchase from the comfort of his home, office or in transit as he may deem convenient, and at any time. We are passionate about transforming bus travels in Nigeria – with the recent high rate of adoption of mobile phones/devices technology, we are confident that a seamless integration of bus travels to mobile phone technology will lead to significant gains in efficiency and quality of life of Nigerians</p>
                </div>
            </div>
            <div class="gap"></div>
        </div>
       

 <div class="container">
    <div class="row">

  <div class="col-md-3" >
    <div class="list-group"  id="list-tab" role="tablist">
      <a class="list-group-item list-group-item-action active" id="list-home-list" data-toggle="list" href="#list-home" role="tab" aria-controls="home">Introduction</a>
      <a class="list-group-item list-group-item-action" id="list-profile-list" data-toggle="list" href="#profile" role="tab" aria-controls="profile">Problem</a>
      <a class="list-group-item list-group-item-action" id="list-messages-list" data-toggle="list" href="#list-messages" role="tab" aria-controls="messages">Benefits: Traveler</a>
      <a class="list-group-item list-group-item-action" id="list-settings-list" data-toggle="list" href="#list-settings" role="tab" aria-controls="settings">Benefits: Operator</a>
    </div>
  </div>
  <div class="col-md-7">
    <div class="tab-content" id="nav-tabContent">
      <div class="tab-pane active" style="text-align: justify;" id="list-home" role="tabpanel" aria-labelledby="list-home-list">

<p>From little towns and villages like Biu in Borno, Bokkos in Plateau, Igueben in Edo, Demsa in Adamawa, Gumel in Jigawa, Ikire in Osun to the large cities or metropolitans like Lagos, Kano, Abuja, Port Harcourt; road transportation remains the mode of transportation of choice for majority of the Nigerian public. Most goods are moved from place to place, around the country – from farms in the rural areas to consumers in cities and the urban centres; from factories to markets; from the petroleum refineries in the Niger Delta to the numerous petrol stations scattered across the country – predominantly by road.</p>

<p>Although there is no empirical study to support this, it is safe to state that majority of the 170 million Nigeria rely on buses for mass transit. The bus transportation system in Nigeria is a huge industry that cannot be ignored. Therefore as the population's behavioural habits change with the recent introduction and adoption of smartphones applications, market players must change along to remain relevant in the industry.</p>

<p>Gone have become the days when passengers would wake up before dawn to line up at the bus terminal in order to get a seat on the early-morning bus from Benin City to Lagos. In those days, once the first bus is filled and departs, all remaining passengers would wait for an afternoon bus or try out another bus operator. It was a loss-loss for both parties – the bus operator lacked adequate insight into the passenger behaviour, and could not convert these passengers into actual travellers. An opportunity lost! The passengers on the other hand suffered delays, frustration and disappointment. On the flip side and in today’s technology-driven world, an online bus reservation system will ensure that passengers can book their bus tickets, select the seats of their choice online, at any time and from anywhere, and head to the bus terminal with peace of mind, knowing that their seats are guaranteed. Also taking advantage of technology, the bus operator can immediately schedule another bus for this route upon finding that there is unusual influx of passengers. In some cases, it may be economically smart to re-route buses from dry routes to routes with unusual high influx of passengers.</p>

<p>The TripON online bus reservation system is an automated system for purchasing bus tickets. Passengers with access to the Internet can using this platform purchase their bus tickets online from anywhere in the world and at any time of the day or night without having to visit the bus terminal. Besides displaying an interactive seat map of the bus and giving passengers the opportunity to choose specific seats, this system also gives passengers the opportunity to choose certain buses that meet their preference. For example, a passenger may want a bus service whose offering includes A/C, TV/DVD, WIFI, Power Outlets, Cargo Space, Toilet, Newspapers, Meals etc. As in most other countries of the world, many Nigerians have become inseparable from their smartphones and other mobile devices. Besides the traditional communication for which the phones were originally designed, they are now being used for gaming, navigation, music, bank and other online transactions. Here lies the opportunity for bus operators.</p>

          </pre>
      </div>
      <div class="tab-pane" id="profile" role="tabpanel" aria-labelledby="list-profile-list"><p>Problem Content</p></div>
      <div class="tab-pane" id="list-messages" role="tabpanel" aria-labelledby="list-messages-list">
<p>Convenience: One of the greatest advantages an online bus reservation system offers is convenience. It is open 24 hours a day and 7 days a week, and allows passengers to make travel reservations, seat selection and online payments at anytime of the day or night, and from any geographic location. they can make reservation anytime and from anywhere. With TripON, you can book a bus ticket in the convenience of your home, office or even while you are in transit, by simply using a laptop or a smartphone or any electronic device connected to the Internet. By purchasing a bus ticket online, you also don't have to worry finding a parking spot at the travel agent or bus terminal, waiting for service or feeling pressured to book a bus ticket on the spot without thinking it through first or being pressured to give a tip at the ticket counter.</p>

<p>Prices: Booking a bus ticket using an Online Bus Reservation System such as TripON, gives the passenger the freedom to shop around for the best price. Passenger are presented with the scheduled trips of all the bus operators that service the chosen route, and they can make a cost-effective choice at their convenience. Passengers don't get this kind of freedom when booking bus ticket at the traditional ticket counter of a Bus Operator. </p>

<p>Exhaustive Search: Simply tell us your desired travel time window, we will present to you all matching road trip itineraries in a line-item fashion, including their planned Operator Name, Departure terminal, Departure time, Expected arrival time at destination, fare, route map, etc. For any itinerary, we will give you the opportunity to drilldown to the seat map of the vehicle, preview seat availability and make your seat reservations online. You will also be presented with a street/route map of the trip including expected stops. This will save you time and stress and make life easier for you.</p>

<p>Ticket Cancellation Online - If for any reason a passenger needs to cancel a booked ticket, the passenger can easily do this online with one click. </p>

<p>Cargo Booking - Cargo can be booked very easily and pick-up can be initiated.</p>

<p>Cargo Tracking - Once Cargo is booked user will get cargo tracking code with which the cargo can be tracked to have clear idea about when and where it can be picked up.</p>

<p>Passenger Real-time & 3D Vision: A modern bus reservation system such as TripON does not just facilitate the ticket booking process. It also makes the entire travel a fun-filled experience for the passenger. It provides an interesting feature - online bus live tracking, enabling passengers to track their exact geographic location at any point in time; notifications when the bus deviates from the planned schedule; it is capable of giving information about roadwork or traffic congestion ahead. The passenger of this generation does not accept being in an information blackout. The Bus Operator must be equal to the task of meeting the needs of this passenger. And only an online bus reservation system such as TripON can help fulfil this need.</p>

<p>Online bus ticket service does not only allows a user to get the arrival time, departure time and the fares of bus but it also allows a user to check the rating or reviews about the service of a particular travel agency.</p>

<p>Online Bus Reservation system also offers easy payment mechanism. Users may use credit cards, debit cards, Paypal, or other local payment gateways for payment. </p>

<p>Our online booking system will handle all aspects of your travel scheduling and ticket bookings. It will automatically ensure that bookings can only be received when you have availability. It will send out an automated email to the booking party as a confirmation of the booking. It will automatically update your availability when your booking has been processed. A good booking system will do all this. It will capture all relevant customer information during the booking process so that no further time is wasted asking for this information.</p>

<p>Bus Operator Ratings: The 21st century passenger wants a comfortable bus ride. He demands an easy and most convenient way to purchase the bus, availability of different bus options like express, luxurious, ability to select seats, etc. With TripON, users can provide ratings, reviews on the services you provide to differentiate you from the pack.</p> 

<p>On-board check-in: There are still places where passengers must go to the bus station to redeem or validate tickets they bought online. This can be done very easily in the bus. A modern reservation system requires drivers to have constant, real-time overview of their dynamically changing passenger manifest. A clear understanding of the status of passenger manifest allows drivers to reuse seats left by no-show passengers. Modern reservation system can free those seats automatically for other passengers to book for up-coming route segments.</p>

      </div>
      <div class="tab-pane" id="list-settings" role="tabpanel" aria-labelledby="list-settings-list">..jhf kcfnbvcjvbc nvfc.</div>
    </div>
  </div>

</div>
        </div>


 <?php include_once('lib/footer.php') ?>
</body>


<!-- Mirrored from remtsoy.com/tf_templates/traveler/demo_v1_7/about.html by HTTrack Website Copier/3.x [XR&CO'2014], Tue, 12 Mar 2019 19:46:49 GMT -->
</html>



