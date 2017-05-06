<?php
	class Common
	{
		public static function response ($_response = [])
		{
			return json_encode($_response);
		}

		public static function randomString ($_length)
		{
			$seed = 'ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijqlmnopqrtsuvwxyz0123456789_';
			$max = strlen($seed) - 1;
			$string = '';

			for ($i = 0; $i < $_length; ++$i) $string .= $seed[intval(mt_rand(0.0, $max))];

			return $string;
		}
	}
?>