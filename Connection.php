<?php
	function getKeys($service) {
		if ($service == "LastFM") {
			return "fc1050e05183655cf3bf6a91ec654691";
		}
		if ($service == "Songkick") {
			return "QlQALOTCwC35QozG";
		}
	}

	function connectToDatabase() {
		$host = "localhost";
		$user = "website";
		$pass = "aPassword4website!";
		$data = "ShowScoutDB";

		$connection = mysql_connect($host, $user, $pass, $data);
		if (!$connection) {
			die ("Connection error: ".mysql_error());
		}

		$db_used = mysql_select_db($data, $connection);
		if (!$db_used){
			die ("Couldn't Use Database: ".mysql_error());
		}

		else return $connection;
	}

	function getUserConcerts($uid, $sortBy) {
		connectToDatabase();
		$DB_table = "Concerts";
		mysql_query("UPDATE $DB_table SET flag='1' WHERE username='$uid'");

		$query = "SELECT artist, cdate, location, venue, concert, url, image FROM $DB_table WHERE username='$uid' ORDER BY $sortBy ";
		if ($sortBy == "popularity") {
			$query.= "DESC ";
		}
		$query.= "LIMIT 10";
		$result = mysql_query($query);

		if (!$result) {
			mysql_close($mysql);
			die ("Query Failed: ".mysql_error());
		}
		else {
			return $result;
		}
	}

	function insertConcert($uid, $artist, $cdate, $location, $distance,
			$venue, $concert, $popularity, $url, $imageURL) {
		$mysql = connectToDatabase();
		$DB_table = "Concerts";
		mysql_query("DELETE FROM $DB_table WHERE username='$uid' AND flag='1'");

		$query = "INSERT INTO $DB_table (username, artist, cdate, location, distance, venue, concert, popularity, url, image) VALUES (\"".
			$uid."\", \"".$artist."\", \"".$cdate."\", \"".$location."\", \"".$distance."\", \"".$venue."\", \"".
			$concert."\", \"".$popularity."\", \"".$url."\", \"".$imageURL."\")";
		$result = mysql_query($query);

		if (!$result) {
			$message = "Invalid query: ".mysql_error()."\n";
			$message.= "Whole query: ".$query;
			die($message);
		}
	}
?>
