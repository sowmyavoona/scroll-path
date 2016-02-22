<?php
	require 'connect.inc.php';
	require 'core.inc.php';

	$username = getuserfield("username");
	$curr_ext = $user_ext = getuserfield("level");
	$noOfLevels = 7;
	$totalLevels = getNumberOfQuestions();
	
	$userRound = $currRound = floor(($user_ext-1)/7)+1;
	if($user_ext>$totalLevels){
		 $userRound = $currRound = $currRound-1;
	}
	$start = (7*($currRound-1))+1;
	$user_int = $curr_int = ($user_ext-$start)+1;



	if(isset($_GET['currRound'])){
		if($_GET['currRound']<$userRound){
			$currRound = $_GET['currRound'];
			$start = (7*($currRound-1))+1;
			$curr_int = 7;
			$curr_ext = $curr_int+$start-1;
		}

	}

	getLevels($question, $answer, $currRound, $noOfLevels);


?>