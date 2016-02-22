<!DOCTYPE html>
<html lang="en">
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=UTF-8"> 


		<link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.0/jquery.min.js"></script>
		<script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>

		<link href="http://fonts.googleapis.com/css?family=Terminal+Dosis&subset=latin" rel="stylesheet" type="text/css">
		<script type="text/javascript" src="script/lib/prefixfree.min.js"></script>
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.0/jquery.min.js"></script>
		<!--[if lt IE 9]>
			<script src="//html5shiv.googlecode.com/svn/trunk/html5.js"></script>
		<![endif]-->
		<meta name="description" content="The plugin that lets you define custom scroll paths" /> 
		<title>jQuery Scroll Path</title>
		<link rel="stylesheet" type="text/css" href="style/style.css" /> 
		<link rel="stylesheet" type="text/css" href="style/scrollpath.css" /> 

		<script type="text/javascript" src="submit.js"></script>
	</head>
	<body>
		
		<?php
			require 'variables.php';

			if(loggedin()) {

			?>
	

<nav class="navbar navbar-inverse">
  <div class="container-fluid">
    <div class="navbar-header">
      <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#myNavbar">
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>                        
      </button>
      <a class="navbar-brand" href="#">Treasure Hunt</a>
    </div>
    <div class="collapse navbar-collapse" id="myNavbar">
      <ul class="nav navbar-nav">
        <li class="dropdown">
          <a class="dropdown-toggle" data-toggle="dropdown" href="#">Rounds<span class="caret"></span></a>
          <ul class="dropdown-menu">

			<?php
				for($j=1; $j<=$userRound; $j++) {
					echo '<li><a href="index.php?currRound='.$j.'"> Round '.$j.'</a></li>';
				}
			?>

          </ul>
        </li>
        <li><a href="#">Leaderboard</a></li>
        <li><a href="#">Instructions</a></li>
      </ul>
      <ul class="nav navbar-nav navbar-right">
        <li><a href="www.csequest.com">Visit us at www.csequest.com</a></li>
        <li><a href="#"><span class="glyphicon glyphicon-user"></span> <?php echo 'Welcome '.ucwords($username); ?></a></li>
        <li><a href="logout.php"><span class="glyphicon glyphicon-log-out"></span> Logout</a></li>
      </ul>
    </div>
  </div>
</nav>

			<?php
				for($j=1; $j<=$userRound; $j++) {
					echo '<li><a href="index.php?currRound='.$j.'"> Round '.$j.'</a></li>';
				}
			?>

	<nav class="levelList">
		<ul>
		<?php	
					echo '<li class="round-title">ROUND:'.$currRound.'</li>';
					global $curr_int;
					for($i=1; $i<=$curr_int; $i++) {
						echo '<script>updateLevel('.$i.');</script>';
					}
		?>
		</ul>
	</nav>

	<div class="wrapper">
			<?php 
				
				for($i=1;$i<=$curr_int;$i++){
					$ques = $question[$i-1];

					echo '<script>updateQuestion('.$i.', \''.$ques.'\', '.$curr_int.', '.$user_ext.', '.$start.');</script>';
				
//					echo '<script>updateQuestion('.$i.',\''.$ques.'\');</script>';
				}

				//<button type="button" class="next-level" onclick="alert('Hello world!')">Click Me!</button>
			?>

			<a href="index.php" id="next-round" class="big next-round">Go to the next round.</a>
		</div>
			

		<script type="text/javascript" src="http://code.jquery.com/jquery-latest.pack.js"></script>
		<script type="text/javascript" src="script/lib/jquery.easing.js"></script>
		<script type="text/javascript" src="script/jquery.scrollpath.js"></script>
		<script type="text/javascript" src="script/demo.js"></script>

		<?php

			} else {
				include 'loginform.inc.php';
			}

		?>

	</body>
</html>
