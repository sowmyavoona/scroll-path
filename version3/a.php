<html>

<head>
	<script type="text/javascript" src="script/lib/prefixfree.min.js"></script>
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.0/jquery.min.js"></script>

<script type="text/javascript">
	function submitForm() {
		alert('hi');
		var answer = 10;
		$.post("b.php", { answer: answer },
			function(data) {
				$("#results").html(data);
				alert(data);
			}
	}

</script>


</head>

<body>

<?php

	require 'c.php';

?>

<form>
<input type="text" id="input_ans">
<input type="button" id="submit-btn" onclick="submitForm()" value="submit">
</form>

<p id="result"></p>

</script>
</body>

</html>