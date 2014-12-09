<!DOCTYPE HTML>
<html>

<head>
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />

	<title>ShowScout | by Karan Khatter &amp; Ricardo Zavala</title>

	<link rel="stylesheet" href="main.css">
	<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>

    <?php
		require ("Connection.php");

		function getTopArtists() {
				$lastFMkey = getKeys("LastFM");
				$url = "http://ws.audioscrobbler.com/2.0/?method=chart.gettopartists&api_key=".
					$lastFMkey."&format=json";
				$str = file_get_contents($url);
				$json = json_decode($str, true);
				$json = $json["artists"]["artist"];

				$artists = array();
				$json = array_slice($json, 0, 6);
				for ($x = 0; $x <= 5; $x++) {
					$anArtist = $json[$x];
					$artists[$anArtist["name"]] = $anArtist["image"][sizeof($anArtist["image"])-1]["#text"];
				}
				return $artists;
		}

		function getArtistNames($artists) {
			$artistNames = "";
			foreach ($artists as $artistName => $artistImg) {
				$artistNames .= $artistName;
				$artistNames .= '", "';
			}
			return substr($artistNames, 0, (sizeof($artistNames)-5));
		}

		function getArtistTuples($artists) {
			$artistTuples = '';
			foreach ($artists as $artistName => $artistImg) {
				$artistTuples .= '["';
				$artistTuples .= $artistName;
				$artistTuples .= '", "';
				$artistTuples .= $artistImg;
				$artistTuples .= '"],';
			}
			return substr($artistTuples, 0, (sizeof($artistTuples)-2));
		}

		$topArtistsArray = getTopArtists();
		
		$topArtists = getArtistNames($topArtistsArray);
		$cookies = getArtistTuples($topArtistsArray);

	?>
	<script>
		var top6Artists = ["<?php echo $topArtists ?>"];
		var top6ArtistsWURL = [<?php echo $cookies ?>];

		$(document).ready(function() {
			if(navigator.geolocation) {
				navigator.geolocation.getCurrentPosition(showPosition);
			}
		}); 

		$(document).ready(function() {
			if(top6Artists.length == 6) {
				for(var i = 1; i <= top6Artists.length; i++) {
					var checkBoxName = "#artist" + i.toString()+"Name";
					$(checkBoxName).html(top6Artists[i - 1]);
				}
			}
		});

		function setCookies() {
			for(var i = 0; i < top6ArtistsWURL.length; i++) {
				var name = top6ArtistsWURL[i][0].replace(/ /g, "-");
				document.cookie= name + "=" + top6ArtistsWURL[i][1];
			}
		}

		function showPosition(position) {
			document.cookie="lat=" + position.coords.latitude;
			document.cookie="lng=" + position.coords.longitude;
		}

		$(document).ready(function() {
			$("#button").prop('disabled', true);
			$("#button").fadeTo("fast", .1);
		});

		$(document).ready(function() {
			$("#user").bind("change paste keyup", function() {
				if( $("#user").val() != "" || $(".css-checkbox:checked").length > 0) {
					$("#button").prop('disabled', false);
					$("#button").fadeTo("fast", 1);
				}
				else {
					$("#button").prop('disabled', true);
					$("#button").fadeTo("fast", .1);
				}
			});
		});

		$(document).ready(function() {
			$(".css-checkbox").change(function() {
				if($(".css-checkbox:checked").length > 0 || $("#user").val() != "") {
					$("#button").prop('disabled', false);
					$("#button").fadeTo("fast", 1);
				}
				else {
					$("#button").prop('disabled', true);
					$("#button").fadeTo("fast", .1);
				}
			});
		});

		function setDatabase(_url) {
			return $.ajax({
				url: _url,
				type: 'GET'
			});
		}

		function loading() {
			// add the overlay with loading image to the page
			setCookies();
			var artistChecked = true;
			var over = '<div id="overlay">' +
				'<img id="loading" src="Images/loading4.gif">'
				+ '<p id="loadingText" class="regularText" style="color: powderblue;top: 50%;left: 46%;position: fixed;">Loading...</p>'
				+ '</div>';
			$(over).appendTo('body');
			var _url = 'DistanceResults.php?';
			var name = $('input:text[name=textUserName]').val();

			if(name != "") {
				document.cookie="id=" + name;
				_url += 'id=' + name;
				artistChecked = false;
			}
			else{
				var defaultName = "~~";
				var possible = "ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789";

				for( var i=0; i < 5; i++ ) {
					defaultName += possible.charAt(Math.floor(Math.random() * possible.length));
				}
				document.cookie="id=" + defaultName;
				_url += 'id=' + defaultName;
				artistChecked = false;
			}

			if($('#artist1').prop('checked')) {
				if(!artistChecked) { _url += "&"; artistChecked = true; }
				_url+= "artist=" + $('#artist1Name').html().replace(/ /g, "-") + "_";
			}

			if($('#artist2').prop('checked')) {
				if(!artistChecked) { _url += "&"; artistChecked = true; }
				_url+= "artist=" + $('#artist2Name').html().replace(/ /g, "-") + "_";
			}

			if($('#artist3').prop('checked')) {
				if(!artistChecked) { _url += "&"; artistChecked = true; }
				_url+= "artist=" + $('#artist3Name').html().replace(/ /g, "-") + "_";
			}

			if($('#artist4').prop('checked')) {
				if(!artistChecked) { _url += "&"; artistChecked = true; }
				_url+= "artist=" + $('#artist4Name').html().replace(/ /g, "-") + "_";
			}

			if($('#artist5').prop('checked')) {
				if(!artistChecked) { _url += "&"; artistChecked = true; }
				_url+= "artist=" + $('#artist5Name').html().replace(/ /g, "-") + "_";
			}

			if($('#artist6').prop('checked')) {
				if(!artistChecked) { _url += "&"; artistChecked = true; }
				_url+= "artist=" + $('#artist6Name').html().replace(/ /g, "-") + "_";
			}

			$.get(_url,function(data,status) {
				window.location.href='DistanceResults.php';
			});
		};
	</script>
</head>

<body>
	<img id="banner" class="banner" src="Images/ShowScoutFull.png" alt="Banner Icon" />
	<img id="bannerImg" class="bannerImg" src="Images/FrontBanner.png" alt="Banner Image" />
	
	<p class="userName" > Please enter your Last.fm username: </p>
	<input id="user" name="textUserName" class="textbox" type="text">

	<p class="regularText" id="artist" style="position:fixed; top:50%; left:38%" >Or choose artist(s) below</p>
	<table class="ArtistOptions">
		<tr>
			<td>
				<input type="checkbox" name="artist1" id="artist1" class="css-checkbox" value="option1" />
				<label for="artist1" id="artist1Name" class="css-label">Option 1</label>
			</td>
			<td>
				<input type="checkbox" name="artist2" id="artist2" class="css-checkbox" />
				<label for="artist2" id="artist2Name" class="css-label">Option 2</label>
			</td>
			<td>
				<input type="checkbox" name="artist3" id="artist3" class="css-checkbox" />
				<label for="artist3" id="artist3Name" class="css-label">Option 3</label>
			</td>
			<td>
				<input type="checkbox" name="artist4" id="artist4" class="css-checkbox" />
				<label for="artist4" id="artist4Name" class="css-label">Option 4</label>
			</td>
			<td>
				<input type="checkbox" name="artist5" id="artist5" class="css-checkbox" />
				<label for="artist5" id="artist5Name" class="css-label">Option 5</label>
			</td>
			<td>
				<input type="checkbox" name="artist6" id="artist6" class="css-checkbox" />
				<label for="artist6" id="artist6Name" class="css-label">Option 6</label>
			</td>
		</tr>
	</table>

	<input type="button" class="myButton" id="button" value="Search" onClick="loading()" style="position:fixed; top: 75%; left: 65%; height:50px; width:100px"/>
</body>
</html>
