<?php

	class M_token extends CI_Model
	{
		function GetSecretKey ()
		{
			$value = "CodeIgniter by Fadhli";

			$key = base64_encode(base64_encode(base64_encode($value)));

			return $key;
		}
	}

?>