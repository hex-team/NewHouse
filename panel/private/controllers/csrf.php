<?php
	class CSRF
	{
		public static function verify ($_key, $_origin, $_timespan = null)
		{
			if (!isset($_SESSION['CSRF_' . $_key])) return false;
			if (!isset($_origin[$_key])) return false;

			$hash = $_SESSION['CSRF_' . $_key];
			$_SESSION['CSRF_' . $_key] = null;

			if (hash('sha256', $_SERVER['REMOTE_ADDR'] . $_SERVER['HTTP_USER_AGENT']) != substr(base64_decode($hash), 10, 40)) return false;
			if ($_origin[$_key] != $hash) return false;
			if ($_timespan != null && is_int($_timespan) && intval(substr(base64_decode($hash), 0, 10)) + $_timespan < time()) return false;

			return true;
		}

		public static function generate ($_key)
		{
			$extra = hash('sha256', $_SERVER['REMOTE_ADDR'] . $_SERVER['HTTP_USER_AGENT']);
			$token = base64_encode(time() . $extra . Common::randomString(CSRF_TOKEN_LENGTH));
			$_SESSION['CSRF_' . $_key] = $token;

			return $token;
		}
	}
?>