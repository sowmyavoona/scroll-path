<?php
require 'connect.inc.php';

ob_start();
session_start(); 

$current_file = $_SERVER['SCRIPT_NAME'];

if(isset($_SERVER['HTTP_REFERER']) && !empty($_SERVER['HTTP_REFERER'])) {
	$http_referer = $_SERVER['HTTP_REFERER'];
}

function loggedin() {
	if(isset($_SESSION['user_id']) && !empty($_SESSION['user_id'])) {
		return true;
	} else {
		return false;
	}
}

function getuserfield($field) {
	global $mysql_connect;
	$query = "SELECT ".$field." FROM users WHERE username='".$_SESSION['user_id']."'";
	
	if($query_run = mysqli_query($mysql_connect, $query)) {
		$query_run = mysqli_query($mysql_connect, $query);
		$query_row = mysqli_fetch_assoc($query_run);
		$return_field = $query_row[$field];
		return $return_field;
		
	}	
}

function getLevels(&$question, &$answer, $round , $noOfLevels) {
	global $mysql_connect;
	$to = $round * $noOfLevels;
	$from = $to - $noOfLevels + 1;
	$query = "SELECT question, answer FROM levels WHERE levelNo >= $from AND levelNo <= $to ORDER BY levelNo ASC";

	if($query_run = mysqli_query($mysql_connect, $query)) {
		$query_run = mysqli_query($mysql_connect, $query);
		$i = 0;
		while($row = $query_run->fetch_assoc()) {
			$question[$i] = $row["question"];
			$answer[$i] = $row["answer"];
			$i++;
		}
		$query_run->free();
		$query_run->close();
	} else {
	}
}


function getNumberOfQuestions() {
	global $mysql_connect;
	$query = "SELECT COUNT(*) AS count FROM levels";
	
	if($query_run = mysqli_query($mysql_connect, $query)) {
		$query_run = mysqli_query($mysql_connect, $query);
		$query_row = mysqli_fetch_assoc($query_run);
		$return_field = $query_row['count'];
		return $return_field;
		
	}	
}

?>
