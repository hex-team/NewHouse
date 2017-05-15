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

		public static function upload ($_file)
		{
			$name = self::randomString(16) . basename($_file["file"]["name"]);
			$result = move_uploaded_file($_file["file"]["tmp_name"], UPLOADED_IMAGES_PATH . $name);

			if ($result) return ['name' => $name];
			else return null;
		}
	}
?>