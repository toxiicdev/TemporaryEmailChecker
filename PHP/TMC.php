<?php
/* Temporary Email Checker
Written by: toxiicdev.net
Language: PHP
*/
interface TMCResponseCodes
{
	const NotDisposable = 1;
	const Disposable = 2;
	const Invalid = 3;
}
	
class TMC
{	
	public static function IsDisposableEmail($email)
	{
		if(filter_var($email, FILTER_VALIDATE_EMAIL)) // Why dont avoid useless HTTP requests?
		{
			$ch = curl_init(); 
			curl_setopt($ch, CURLOPT_URL, "https://services.toxiicdev.net/tmc/check.php?email=$email"); 
			curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1); 
			curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);
			curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
			$output = curl_exec($ch);
			
			if(!curl_errno($ch)) // If all went fine
			{
				$json = json_decode($output);
				curl_close($ch);
				return $json -> result_code;
			}
			
			curl_close($ch);
		}
		
		return TMCResponseCodes::Invalid;
	}
}
?>
