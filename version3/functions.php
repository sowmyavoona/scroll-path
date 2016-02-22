<?php

	require 'connect.inc.php';

	function cleanInput($string){
		global $mysql_connect;
		$string = mysqli_real_escape_string($mysql_connect,$string);
		$string = str_replace(' ', '', $string);
		$string = trim($string);
		$string = preg_replace('/[^A-Za-z0-9\-]/', '', $string);
		
		return $string;
	}

	function checkMatch($actual_answer,$input_answer){
		$delimiter = '*';
		$answerArr = explode($delimiter,$actual_answer);
		$arrCount = count($answerArr);

		for($i=0;$i<$arrCount;$i++){
			$answerArr[$i] = str_replace(' ', '', $answerArr[$i]);
			$answerArr[$i] = trim($answerArr[$i]);
			$answerArr[$i] = preg_replace('/[^A-Za-z0-9\-]/', '', $answerArr[$i]);
		}
		
		for($i=0;$i<$arrCount;$i++){
			if(strcasecmp($input_answer,$answerArr[$i])==0) {
				return true;
			}
		}
		return false;
	}


?>