<?php

	//header("Refresh:0");

	require 'variables.php';
	require 'functions.php';

	if(isset($_POST['answer']) && isset($_POST['level'])){

		$level_answered = $_POST['level'];

		if ($level_answered >= 1 && $level_answered <= $curr_int){
			global $mysql_connect;
			$input_answer = cleanInput($_POST['answer']);
			$actual_answer = $answer[$level_answered-1];
			
/*


*/


			$actual_level = $level_answered+$start-1;
/*			$actual_answer = '';
			$message = '';

			if ($query_run = mysqli_query($mysql_connect, "SELECT answer FROM levels WHERE levelNo = 1")) {
				$query_run = mysqli_query($mysql_connect, "SELECT answer FROM levels WHERE levelNo = 1");
				$query_row = mysqli_fetch_assoc($query_run);
				$actual_answer = $query_row['answer'];
*/

				if (checkMatch($actual_answer,$input_answer)){

					if ($level_answered < $noOfLevels) {
						$nextLevel = $level_answered+1;
					} else {
						$nextLevel = 1; //Change this
					}
					
					if ( ($level_answered+$start-1)== $user_ext){

						$newLevel = $user_ext+1;
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
		//	}
			


		}
		echo $message;
	}


?>

