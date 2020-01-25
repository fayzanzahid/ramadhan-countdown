<?php
/**
 * @package ramadhan-countdown
 * @version 2.0
 */
/*
Plugin Name: Daily Prayer (Salah) and Ramadhan Countdown
Plugin URI: http://xpertsol.org/ramadhan-countdown
Description: Countdown Alerts for Daily Prayers with Sehr and Aftar in Ramadan.
Version: 2.5
Author: Xpert Solution
Author URI: http://xpertsol.org/
*/


add_action('admin_menu', 'rcsixs_ramdahan_menu');
add_shortcode( 'rcsixs_ramadhan_countdown' , 'rcsixs_countdown_sc' );

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

if (!is_admin()) { add_action("wp_enqueue_scripts", "rcsixs_jquery_enqueue", 11); }


function rcsixs_jquery_enqueue() {
    wp_deregister_script('jquery');
    wp_enqueue_script('jquery');    
    wp_register_script('jquery-flipclock', plugin_dir_url( __FILE__ )."includes/flipclock.js", false, null);
    wp_enqueue_script('jquery-flipclock');
}




function rcsixs_ramdahan_menu(){

add_menu_page( 'Ramadhan Countrown', 'Ramadhan Countdown', 'manage_options', 'rcsixs-ramadhan-countdown', 'rcsixs_main_pageac');
}

function rcsixs_main_pageac(){
	if ( !is_admin( ) )  {
		wp_die( __( 'You do not have sufficient permissions to access this page.' ) );
	}

echo rcsixs_about_plugin();

}



function rcsixs_header_pages()
{
    ?>
     <style>
    <?php include 'includes/flipclock.css'; ?>
 </style>
 
 
 <style>
 
.clock_ram{
	
	padding-top:25px;

	
}
.popup_ram h4{
	
	padding-top:20px;
	
}


 
.popup_ram{
  	width:485px;

  background:#CCC;
bottom: 20px; 

  left: -380px;
  position:fixed;
  border-radius:5px;
  box-shadow: 0px 25px 10px -15px rgba(0, 0, 0, 0.05);
  transition: 0.5s;
	z-index:99999999999;
-webkit-backface-visibility: hidden;
}


.message{
    
    font-size:15px; 
    padding-bottom:10px;   
    border-radius:5px; 
    box-shadow:0 0 11px 1px black;
}

.message tr{
    
    border-top:1px solid #000;
        border-bottom:1px solid #000;
}



@media only screen and (max-width: 500px) {

.popup_ram{
  	width:313px;
  min-height:210px;
  background:#CCC;
    bottom: 20px; 

  left: -380px;
  position:fixed;
  border-radius:5px;
  box-shadow: 0px 25px 10px -15px rgba(0, 0, 0, 0.05);
  transition: 0.5s;
	z-index:99999999999;
-webkit-backface-visibility: hidden;
}



.flip-clock-label{
font-size:15px !important;
}


.clock_ram {
    zoom: 0.65;
    -moz-transform: scale(0.65);
	padding-top:35px;

    
}

.message{
    
    font-size:12px; 
    padding-bottom:10px;   
    border-radius:5px; 
    box-shadow:0 0 11px 1px black;
}




}






.close{
  position:absolute;
  top: 5px;
  right: 5px;
  width: 20px;
  height: 20px;
  cursor:pointer;
  z-index:500;
}

.ns-close {
    width: 20px;
    height: 20px;
    position: absolute;
    right: 4px;
    top: 4px;
    overflow: hidden;
    text-indent: 100%;
    cursor: pointer;
    -webkit-backface-visibility: hidden;
    backface-visibility: hidden;
}

.ns-close:hover, 
.ns-close:focus {
    outline: none;
}

.ns-close::before,
.ns-close::after {
    content: '';
    position: absolute;
    width: 3px;
    height: 60%;
    top: 50%;
    left: 50%;
    background: #1f8b4d;
}

.ns-close:hover::before,
.ns-close:hover::after {
    background: #fff;
}

.ns-close::before {
    -webkit-transform: translate(-50%,-50%) rotate(45deg);
    transform: translate(-50%,-50%) rotate(45deg);
}

.ns-close::after {
    -webkit-transform: translate(-50%,-50%) rotate(-45deg);
    transform: translate(-50%,-50%) rotate(-45deg);
}

@-moz-keyframes bounce {
  0%, 20%, 50%, 80%, 100% {
    -moz-transform: translateY(0);
    transform: translateY(0);
  }
  40% {
    -moz-transform: translateY(-30px);
    transform: translateY(-30px);
  }
  60% {
    -moz-transform: translateY(-15px);
    transform: translateY(-15px);
  }
}
@-webkit-keyframes bounce {
  0%, 20%, 50%, 80%, 100% {
    -webkit-transform: translateY(0);
    transform: translateY(0);
  }
  40% {
    -webkit-transform: translateY(-30px);
    transform: translateY(-30px);
  }
  60% {
    -webkit-transform: translateY(-15px);
    transform: translateY(-15px);
  }
}
@keyframes bounce {
  0%, 20%, 50%, 80%, 100% {
    -moz-transform: translateY(0);
    -ms-transform: translateY(0);
    -webkit-transform: translateY(0);
    transform: translateY(0);
  }
  40% {
    -moz-transform: translateY(-30px);
    -ms-transform: translateY(-30px);
    -webkit-transform: translateY(-30px);
    transform: translateY(-30px);
  }
  60% {
    -moz-transform: translateY(-15px);
    -ms-transform: translateY(-15px);
    -webkit-transform: translateY(-15px);
    transform: translateY(-15px);
  }
}

.arrow {
  position: fixed;
  bottom: 50px;
  left: 50%;
  margin-left: -20px;
  width: 20px;
  height: 20px;
  background-image: url(data:image/svg+xml;base64,PD94bWwgdmVyc2lvbj0iMS4wIiBlbmNvZGluZz0iVVRGLTgiPz4NCjwhLS0gR2VuZXJhdG9yOiBBZG9iZSBJbGx1c3RyYXRvciAxNi4wLjAsIFNWRyBFeHBvcnQgUGx1Zy1JbiAuIFNWRyBWZXJzaW9uOiA2LjAwIEJ1aWxkIDApICAtLT4NCjwhRE9DVFlQRSBzdmcgUFVCTElDICItLy9XM0MvL0RURCBTVkcgMS4xLy9FTiIgImh0dHA6Ly93d3cudzMub3JnL0dyYXBoaWNzL1NWRy8xLjEvRFREL3N2ZzExLmR0ZCI+DQo8c3ZnIHZlcnNpb249IjEuMSIgaWQ9IkxheWVyXzEiIHhtbG5zPSJodHRwOi8vd3d3LnczLm9yZy8yMDAwL3N2ZyIgeG1sbnM6eGxpbms9Imh0dHA6Ly93d3cudzMub3JnLzE5OTkveGxpbmsiIHg9IjBweCIgeT0iMHB4IiB3aWR0aD0iNTEycHgiIGhlaWdodD0iNTEycHgiIHZpZXdCb3g9IjAgMCA1MTIgNTEyIiBlbmFibGUtYmFja2dyb3VuZD0ibmV3IDAgMCA1MTIgNTEyIiB4bWw6c3BhY2U9InByZXNlcnZlIj4NCjxwYXRoIGZpbGw9IiNGRkZGRkYiIGQ9Ik0yOTMuNzUxLDQ1NS44NjhjLTIwLjE4MSwyMC4xNzktNTMuMTY1LDE5LjkxMy03My42NzMtMC41OTVsMCwwYy0yMC41MDgtMjAuNTA4LTIwLjc3My01My40OTMtMC41OTQtNzMuNjcyICBsMTg5Ljk5OS0xOTBjMjAuMTc4LTIwLjE3OCw1My4xNjQtMTkuOTEzLDczLjY3MiwwLjU5NWwwLDBjMjAuNTA4LDIwLjUwOSwyMC43NzIsNTMuNDkyLDAuNTk1LDczLjY3MUwyOTMuNzUxLDQ1NS44Njh6Ii8+DQo8cGF0aCBmaWxsPSIjRkZGRkZGIiBkPSJNMjIwLjI0OSw0NTUuODY4YzIwLjE4LDIwLjE3OSw1My4xNjQsMTkuOTEzLDczLjY3Mi0wLjU5NWwwLDBjMjAuNTA5LTIwLjUwOCwyMC43NzQtNTMuNDkzLDAuNTk2LTczLjY3MiAgbC0xOTAtMTkwYy0yMC4xNzgtMjAuMTc4LTUzLjE2NC0xOS45MTMtNzMuNjcxLDAuNTk1bDAsMGMtMjAuNTA4LDIwLjUwOS0yMC43NzIsNTMuNDkyLTAuNTk1LDczLjY3MUwyMjAuMjQ5LDQ1NS44Njh6Ii8+DQo8L3N2Zz4=);
  background-size: contain;
}

.bounce {
  -moz-animation: bounce 2s infinite;
  -webkit-animation: bounce 2s infinite;
  animation: bounce 2s infinite;
}
 
 </style>
 
    <?php
	
	
}




function rcsixs_countdown_sc($atts)
{
    
    //shortcode
    


    $a = shortcode_atts( array(
        'city' => 'city',
        'country' => 'city',
        'method' => 'method',
        'timezone' => 'timezone'
    ), $atts );
 
echo rcsixs_header_pages();

    ?>
    



<div class="popup_ram">
<h4  class="message" align="center">Time Left for Sehri</h4>
<div class="clock_ram" >

</div>
    <div class="close ns-close"></div>
</div>

    



		<script type="text/javascript">

		function getRamadanTimings(){
$('.popup_ram').hide();

			$.ajax({
			    url : 'http://xpertsol.org/WP_api_ramadhan_countdown/<?php echo 'inc_data_pray_ramadan.php?city='.$a['city'].'&country='.$a['country'].'&method='.$a['method'].'&timezone='.$a['timezone'].'&before='.$a['before']; ?>',
			     headers: {
     'Cache-Control': 'no-cache, no-store, must-revalidate', 
     'Pragma': 'no-cache', 
     'Expires': '0'
   },
			    type : 'GET',
			    success : function (data) {


			    	if(data != '')
			    	{
			    				    	
			    	SplitData = data.split("*");

                                   if(SplitData[0] != 'error')
                                   {
					eventATime = SplitData[0];
					eventName = SplitData[1];
					eventTime = SplitData[2];
					nowTime = SplitData[3];

					showCountdownNow(eventATime , eventName , eventTime , nowTime);
                                   }

if(SplitData[0] == 'error')
{
$('.message').html('Current Time (Lahore, PK)<br><em style="font-size:10px;">API Error! unable to fetch data from xpertsol.org</em>');
simpleClockNow();


}

			    	}
			    	
			    	
			    }      
			});

										

		}


function simpleClockNow(){
	var clock;
$('.popup_ram').show();
$('.popup_ram').css( "left", "20px" );
		
			

				clock = $('.clock_ram').FlipClock({
					clockFace: 'TwentyFourHourClock',
					showSeconds: false
                                       
				});




}


function tConvert (time) {
 
        var hours = time[0] + time[1];
        var min = time[3] + time[4];
        if (hours < 12) {
            return hours + ':' + min + ' AM';
        } else {
            hours=hours - 12;
            hours=(hours.length < 10) ? '0'+hours:hours;
            return hours+ ':' + min + ' PM';
        }
    
}



function showCountdownNow(eventATime, eventName , eventTime , nowTime){


$('.message').html(' <table><tr><td>Now:</td><td> ' + nowTime + " </td></tr><tr><td>Next:<br>" + eventName + ' Prayer</td><td> ' + eventATime +"</td></tr></table>" );

$('.popup_ram').show();
$('.popup_ram').css( "left", "20px" );






		// Instantiate a coutdown FlipClock
		clock = $('.clock_ram').FlipClock(eventTime, {
			clockFace: 'HourlyCounter',
			countdown: true,
			 callbacks: {
			        interval: function () {
			              var $days = $("span.days").nextUntil("span").andSelf();
			              if ($days.length>0) $days.remove();  
			               


			              
						        },
		stop: function() {
			$('.message').html('Its '+ eventName +' Prayer Time' + '<br> ' +  eventATime)
			$('.clock_ram').hide();

	
		}
		
			    }    
		});




				    	
    }



$('.close').click(function(){
$('.popup_ram').hide();
});


getRamadanTimings();


		
		
		</script>   
		
    <?php 
 
}


	
	
	



function rcsixs_footer_pages()
{
	?>
   Email us for support at support@xpertsol.org
	<?php
	
	
}



function rcsixs_tz_list() {
    $zones_array = array();
    $timestamp = time();
    foreach(timezone_identifiers_list() as $key => $zone) {
        date_default_timezone_set($zone);
        $zones_array[$key]['zone'] = $zone;
        // $zones_array[$key]['diff_from_GMT'] = date('P', $timestamp);
    }
    return $zones_array;
}



function rcsixs_about_plugin()
{
	?>
    <h1>About Ramadhan Countdownn</h1>
    For any queries contact us @ support@xpertsol.org<br />
 We would appreciate if you report any bugs or send us improvement suggestions.
<br />
    
    <h2>How to Use ?</h2>
    <p>
<b>    - You can use this shortcode on your posts, pages, and widgets
<br><br>
[rcsixs_ramadhan_countdown city=Lahore country=Pakistan method=1 timezone=Asia/Karachi]</b><br>
    <br><br>
    <b>1. Country and City are required values</b><br>
    
    <ul>
    <li>    "city" (string) - A city name. Example: London</li>
    <li>"country" (string) -
A country name or 2 character alpha ISO 3166 code. Examples: GB or United Kindom
</li>
    </ul>

    
    
    
   <b> 2. Choose Method 0 - 7 (Get timmings according to different Organizations)</b>
    <ul>
    
<li>0 - Shia Ithna-Ashari</li>
<li>1 - University of Islamic Sciences, Karachi</li>
<li>2 - Islamic Society of North America (ISNA)</li>
<li>3 - Muslim World League (MWL)</li>
<li>4 - Umm al-Qura, Makkah</li>
<li>5 - Egyptian General Authority of Survey</li>
<li>7 - Institute of Geophysics, University of Tehran</li>
    </ul>
    
    <b>3. Choose a timzone from the list below</b><br>
 
  <ul>
    <?php foreach(rcsixs_tz_list() as $t) { ?>
      <li>
        <?php print $t['zone'] ?>
      </li>
    <?php } ?>
 </ul>

     </p>
     
     
   
    <div>
</div>

    <?php
	echo rcsixs_footer_pages();
	
}