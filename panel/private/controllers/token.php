<?php
	class Token
	{
		private $user;

		public static function verify ($_userid, $_token, $_secret)
		{
			$user = new TblUsers();
			$userData = $user -> get($_userid)[0];

			if ($userData == null) return false;
			if ($userData['token'] == null) return false;

			$zeros = substr($_token, strlen($_token) - 1, 1);

			$useridLen = 10 - $zeros;

			if (strlen($_token) > 129 + $useridLen)
			{
				$origin = substr($_token, strlen($_token) - $useridLen - 65, 64);

				if ($origin != hash('sha256', $_SERVER['REMOTE_ADDR'] . $_SERVER['HTTP_USER_AGENT'] . $_secret)) return false;
				if ($_userid != substr($_token, strlen($_token) - $useridLen - 1, $useridLen)) return false;
			}
			else if (strlen($_token) > 139 + $useridLen)
			{
				$origin = substr($_token, strlen($_token) - 74, 64);

				if ($origin != hash('sha256', $_SERVER['REMOTE_ADDR'] . $_SERVER['HTTP_USER_AGENT'] . $_secret)) return false;
				if ($_userid != substr($_token, strlen($_token) - 139, $useridLen)) return false;
				if (time() > substr($_token, strlen($_token) - $useridLen - 75)) return false;
			}
			else return false;

			return true;
		}

		public static function generate ($_userid, $_secret, $_expiration = null)
		{
			$salt = hash('sha256', Common::randomString(LOGIN_TOKEN_LENGTH));
			$origin = hash('sha256', $_SERVER['REMOTE_ADDR'] . $_SERVER['HTTP_USER_AGENT'] . $_secret);

			if ($_expiration != null) $_expiration = time() + $_expiration;

			$zeros = 10 - strlen($_userid);
			$token = $salt . $_expiration . $origin . $_userid . $zeros;

			return $token;
		}
	}
?>