<?php

/* Temporary Email Checker

Written by: toxiicdev.net
Language: PHP

*/

require_once("TMC.php");

if(isset($_POST['email']))
{
	$responseCode = TMC::IsDisposableEmail($_POST['email']);
	
	$result = "Email is invalid";
	
	switch($responseCode)
	{
		case TMCResponseCodes::NotDisposable:
		{
			$result = "Email is not disposable";
			break;
		}
		case TMCResponseCodes::Disposable:
		{
			$result = "Email is disposable";
			break;
		}
	}
}

?>

<html>
	<head>
		<title>TMC PHP Example</title>
	</head>

	<body style="margin-top: 20%">
		<center>
			<?php if(isset($result)) echo $result . "<br/>"; ?>
			<form method="POST">
				<input type="email" name="email" id="email" placeholder="Insert your email here" />
				<button type="submti">Check</button>
			</form>
		</center>
	</body>
</html>