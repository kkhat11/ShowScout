<!DOCTYPE html>
<html>
<head>
	<?php
		require ("Connection.php");

		function getConcerts($username) {
			$concerts = getUserConcerts($username, "popularity");
			$returnString = '';
			while ($row = mysql_fetch_assoc($concerts)) {
				$returnString .= '[';
				foreach ($row as $cname => $cvalue) {
					$returnString .= '"';
					$returnString .= $cvalue;
					$returnString .= '",';
				}
				$returnString = substr($returnString, 0, (sizeof($returnString)-2));
				$returnString .= '],';
			}
			return substr($returnString, 0, (sizeof($returnString)-2));
		}

		$id = $_COOKIE["id"];

		$topConcerts = getConcerts($id);

		?>
    <link rel="stylesheet" href="main.css">
<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
<script id="scripts">
var items = [<?php echo $topConcerts ?>];
/*
var url; 
$(document).ready(function(){
    if(document.URL.indexOf("?") > -1){
    url = document.URL.split('?')[1];
    var post = url.split('&');
    var q = post[0];
    var w = post[1];
    var artistsRaw = w.split('_');
    var artists = [];
    for(var i = 0; i < artistsRaw.length - 1; i++)
    {
        artists[i] = artistsRaw[i].split('=')[1];
    }
    var username = q.split('=')[1];
    window.alert(username);
    window.alert(artists);
    }
});
*/ 
$(document).ready(function(){
  $("#Artist1").click(function(){
    $("#Artist1_information").slideToggle("slow");
  });
});
    
$(document).ready(function(){
  $("#Artist2").click(function(){
    $("#Artist2_information").slideToggle("slow");
  });
});
    
$(document).ready(function(){
  $("#Artist3").click(function(){
    $("#Artist3_information").slideToggle("slow");
  });
});
    
$(document).ready(function(){
  $("#Artist4").click(function(){
    $("#Artist4_information").slideToggle("slow");
  });
});
  
$(document).ready(function(){
  $("#Artist5").click(function(){
    $("#Artist5_information").slideToggle("slow");
  });
});
    
$(document).ready(function(){
  $("#Artist6").click(function(){
    $("#Artist6_information").slideToggle("slow");
  });
});
    
$(document).ready(function(){
  $("#Artist7").click(function(){
    $("#Artist7_information").slideToggle("slow");
  });
});

$(document).ready(function(){
  $("#Artist8").click(function(){
    $("#Artist8_information").slideToggle("slow");
  });
});
    
$(document).ready(function(){
  $("#Artist9").click(function(){
    $("#Artist9_information").slideToggle("slow");
  });
});
    
$(document).ready(function(){
  $("#Artist10").click(function(){
    $("#Artist10_information").slideToggle("slow");
  });
});
$(document).ready(function(){
    var divNumber = 1;
    for(var i = 0; i < items.length; i++){
        var divBlock = "#artist"+divNumber.toString()+"block";
        var divName = "#Artist"+divNumber.toString();
        var panelName = "#Artist" + divNumber.toString()+"_information";
        var url = items[i][6].replace(/ /g, "%20");
        $(divName).css("background-image", "url("+url+")");
        $(divBlock).css("display", "block");
        var concertInformationDisplay = "<b>Artist:</b> " + items[i][0].replace(/-/g, " ")  + "<br />"
                                        + "<b>Concert Name:</b> " + items[i][4] + "<br />"
                                        + "<b>Venue:</b> " + items[i][3] + "<br />"
                                        + "<b>Date:</b> " + items[i][1] + "<br />"
                                        + "<b>Location:</b> " + items[i][2] + "<br /> <br />";
        $(panelName).html(concertInformationDisplay);
        var purchase = "<input type=\"submit\" id=\"searchAgain\" class=\"myButton\" value=\"Purchase\" onClick=\"location.href='" + items[i][5] + "'\" />"
        $(panelName).append(purchase);
       divNumber++; 
    }
});
</script>
</head>
    <body>
    <img id="banner" class="banner" src="./Images/ShowScoutFull.png" alt="Banner Icon"/>
    <img id="bannerImg" class="bannerImg" src="./Images/FrontBanner.png" alt="Banner Image" />
    <p id="distance" class="resultSection">Popularity</p>
    <p id="Click Image" class="regularText" style="position:absolute;top:25%">Click image for more information...</p> 
    <div id="artistRow" class="row">
    <div id="artist1block" class="block" style="display:none"> 
        <p class="regularText" style="font-size:200%;">1.</p>
        <div id="Artist1" class="flip" style="background-image: url(http://images.gs-cdn.net/static/artists/120_213.jpg);position:relative;background-size: contain;background-repeat:no-repeat;"></div>
        <div id="Artist1_information" class="panel">Yessir</div>
         </div>
   <div id="artist2block" class="block" style="display:none"> 
        <p class="regularText" style="font-size:200%;">2.</p>
        <div id="Artist2" class="flip" style="background-image: url(http://images.gs-cdn.net/static/artists/120_213.jpg);position:relative;background-size: contain;background-repeat:no-repeat;"></div>
        <div id="Artist2_information" class="panel">Yessir</div>
         </div>
   <div id="artist3block" class="block" style="display:none"> 
        <p class="regularText" style="font-size:200%;">3.</p>
        <div id="Artist3" class="flip" style="background-image: url(http://images.gs-cdn.net/static/artists/120_213.jpg);position:relative;background-size: contain;background-repeat:no-repeat;"></div>
        <div id="Artist3_information" class="panel">Yessir</div>
         </div>
    <div id="artist4block" class="block" style="display:none"> 
        <p class="regularText" style="font-size:200%;">4.</p>
        <div id="Artist4" class="flip" style="background-image: url(http://images.gs-cdn.net/static/artists/120_213.jpg);position:relative;background-size: contain;background-repeat:no-repeat;"></div>
        <div id="Artist4_information" class="panel">Yessir</div>
         </div>
    <div id="artist5block" class="block" style="display:none"> 
        <p class="regularText" style="font-size:200%;">5.</p>
        <div id="Artist5" class="flip" style="background-image: url(http://images.gs-cdn.net/static/artists/120_213.jpg);position:relative;background-size: contain;background-repeat:no-repeat;"></div>
        <div id="Artist5_information" class="panel">Yessir</div>
         </div>
    <div id="artist6block" class="block" style="display:none"> 
        <p class="regularText" style="font-size:200%;">6.</p>
        <div id="Artist6" class="flip" style="background-image: url(http://images.gs-cdn.net/static/artists/120_213.jpg);position:relative;background-size: contain;background-repeat:no-repeat;"></div>
        <div id="Artist6_information" class="panel">Yessir</div>
         </div>
    <div id="artist7block" class="block" style="display:none"> 
        <p class="regularText" style="font-size:200%;">7.</p>
        <div id="Artist7" class="flip" style="background-image: url(http://images.gs-cdn.net/static/artists/120_213.jpg);position:relative;background-size: contain;background-repeat:no-repeat;"></div>
        <div id="Artist7_information" class="panel">Yessir</div>
         </div>
    <div id="artist8block" class="block" style="display:none">
        <p class="regularText" style="font-size:200%;">8.</p>
        <div id="Artist8" class="flip" style="background-image: url(http://images.gs-cdn.net/static/artists/120_213.jpg);position:relative;background-size: contain;background-repeat:no-repeat;"></div>
        <div id="Artist8_information" class="panel">Yessir</div>
         </div>
    <div id="artist9block" class="block" style="display:none"> 
        <p class="regularText" style="font-size:200%;">9.</p>
        <div id="Artist9" class="flip" style="background-image: url(http://images.gs-cdn.net/static/artists/120_213.jpg);position:relative;background-size: contain;background-repeat:no-repeat;"></div>
        <div id="Artist9_information" class="panel">Yessir</div>
         </div>
    <div id="artist10block" class="block" style="display:none"> 
        <p class="regularText" style="font-size:200%;">10.</p>
        <div id="Artist10" class="flip" style="background-image: url(http://images.gs-cdn.net/static/artists/120_213.jpg);position:relative;background-size: contain;background-repeat:no-repeat;"></div>
        <div id="Artist10_information" class="panel">Yessir</div>
         </div>
        
    </div>  
    <input type="submit" id="distanceButton" class="myButton" value="Distance" onClick="window.location.href='DistanceResults.php'" style="position:absolute; top:15%; left:75%; height:80px; width:150px"/>
    <input type="submit" id="upcomingButton" class="myButton" value="Upcoming" onClick="window.location.href='UpcomingResults.php'" style="position:absolute; top:15%; left:85%; height:80px; width:150px"/>
        
    <input type="submit" id="searchAgain" class="myButton" value="[Search Again]" onClick="window.location.href='Index.php'" style="position:absolute; top:37%; left:88%; height:50px; width:200px"/>
</html>
