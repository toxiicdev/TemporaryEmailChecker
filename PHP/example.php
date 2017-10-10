<?php

/* Temporary Email Checker

Written by: toxiicdev.net
Language: PHP

*/

require_once("TMC.php");

if(isset($_POST['email']))
{
	$responseCode = TMC::IsDisposableEmail($_POST['email']);
	
	switch($responseCode)
	{
		case TMCResponseCodes::NotDisposable:
		{
			echo "Email is not disposable";
			break;
		}
		case TMCResponseCodes::Disposable:
		{
			echo "Email is disposable";
			break;
		}
		default:
		{
			echo "Email is valid";
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
			<form method="POST">
				<input type="email" name="email" id="email" placeholder="Insert your email here" />
				<button type="submti">Check</button>
			</form>
		</center>
	</body>
</html>