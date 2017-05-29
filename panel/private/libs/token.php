<?php
	class Token
	{
		private $user;

		public static function verify ($_token)
		{
			$token = self::parse($_token);

			if (!$token) return false; //throw new Exception(OBJECT_ERROR_MSG);

			$user = new TblUsers();
			$userData = $user -> get($token['userid']);

			try
			{
				if (!isset($userData['token']) || $userData['token'] != $_token) return false; //throw new Exception(INVALID_TOKEN_ERROR);
				if ($token['origin'] != hash('sha256', $_SERVER['REMOTE_ADDR'] . $_SERVER['HTTP_USER_AGENT'] . TOKEN_SECRET)) return false; //throw new Exception(ORIGIN_ERROR);
				if ($token['expiration'] != null && time() > $token['expiration']) return false; //throw new Exception(TOKEN_EXPIRATION_ERROR);

				return true;
			}
			catch (Exception $ex)
			{
				Maintenance::handleExceptions($ex);
			}
		}

		public static function generate ($_userid, $_expiration = null)
		{
			$salt = hash('sha256', Common::randomString(LOGIN_TOKEN_LENGTH));
			$origin = hash('sha256', $_SERVER['REMOTE_ADDR'] . $_SERVER['HTTP_USER_AGENT'] . TOKEN_SECRET);

			if ($_expiration != null) $_expiration = time() + $_expiration;

			$zeros = 9 - strlen($_userid);
			$token = $salt . $_expiration . $origin . $_userid . $zeros;

			return $token;
		}

		public static function parse ($_token)
		{
			if (!Validation::checkLength($_token, ['min' => MIN_TOKEN_LENGTH, 'max' => MAX_TOKEN_LENGTH])) return null;

			$zeros = substr($_token, strlen($_token) - 1, 1);
			$useridLen = 9 - $zeros;
			$userid = substr($_token, strlen($_token) - $useridLen - 1, $useridLen);
			$origin = null;
			$expiration = null;

			if (strlen($_token) > 129 + $useridLen) $origin = substr($_token, strlen($_token) - $useridLen - 65, 64);
			else if (strlen($_token) > 139 + $useridLen)
			{
				$origin = substr($_token, strlen($_token) - 74, 64);
				$expiration = substr($_token, strlen($_token) - $useridLen - 75);
			}

			return ['userid' => $userid, 'origin' => $origin, 'expiration' => $expiration];
		}
	}
?>