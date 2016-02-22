<?php

	//header("Refresh:0");
	

	require 'variables.php';
	require 'functions.php';

	if(isset($_POST['answer']) && isset($_POST['level'])){

		$level_answered = $_POST['level'];
		$curr_int_var = $_POST['currint'];
		$user_ext_var= $_POST['userext'];
		$start_var = $_POST['start'];

		if ($level_answered >= 1 && $level_answered <= $curr_int_var){
			global $mysql_connect;
			$input_answer = cleanInput($_POST['answer']);
			//$actual_answer = $answer[$level_answered-1];
			
/*

$curr_int
$start
$user_ext

*/
			$actual_level = $level_answered+$start_var-1;
			$actual_answer = '';
			$message = '';

			if ($query_run = mysqli_query($mysql_connect, "SELECT answer FROM levels WHERE levelNo = ".$actual_level)) {
				$query_run = mysqli_query($mysql_connect, "SELECT answer FROM levels WHERE levelNo = ".$actual_level);
				$query_row = mysqli_fetch_assoc($query_run);
				$actual_answer = $query_row['answer'];


				if (checkMatch($actual_answer,$input_answer)){

					if ($level_answered < $noOfLevels) {
						$nextLevel = $level_answered+1;
					} else {
						$nextLevel = 1; //Change this
					}
					
					if ( ($level_answered+$start_var-1)== $user_ext_var){

						$newLevel = $user_ext_var+1;
						$userID = $_SESSION['user_id'];

						$query = "UPDATE users SET level = $newLevel, time=NOW() where username = '$userID'";
						
						$query_run = mysqli_query($mysql_connect, $query);
						if($query_run) {
							$message  = $question[$nextLevel-1];
						} else {

						}
						
					} else {
						$message = "Good job";
					}

				} else {
					$message = "Oops try again";
				}
			}
			


		}
		echo $message;
	}


?>

