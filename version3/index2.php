<?php 
require 'core.inc.php';
require 'connect.inc.php';

if(loggedin()) {

	$fullname = getuserfield('fullname');
	echo 'Welcome '.ucwords($fullname).'!<br/>';
	echo '<a href="logout.php">Log Out</a>';

} else {
	include 'loginform.inc.php';
}	

?>