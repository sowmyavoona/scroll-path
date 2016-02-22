<?php

require 'c.php';

if(isset($_POST['answer'])){
	if($_POST['answer'] == "hi" ) {
		$message = "Hi ".$a;
	} else {
		$message = "No hi ".$a;
	}
}


?>