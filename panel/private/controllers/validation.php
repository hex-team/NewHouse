<?php
	class Validation
	{
		public static function request ($_allowedParams = [], $_sanitize = true)
		{
			$allowedParams = [];

			foreach ($_allowedParams as $param) if (isset($_REQUEST[$param]))
			{
				if ($_sanitize) $allowedParams[$param] = self::sanitizeValue($_REQUEST[$param]);
				else $allowedParams[$param] = $_REQUEST[$param];
			}

			return $allowedParams;
		}

		public static function post ($_allowedParams = [], $_sanitize = true)
		{
			$allowedParams = [];

			foreach ($_allowedParams as $param) if (isset($_POST[$param]))
			{
				if ($_sanitize) $allowedParams[$param] = self::sanitizeValue($_POST[$param]);
				else $allowedParams[$param] = $_POST[$param];
			}

			return $allowedParams;
		}

		public static function get ($_allowedParams = [], $_sanitize = true)
		{
			$allowedParams = [];

			foreach ($_allowedParams as $param) if (isset($_GET[$param]))
			{
				if ($_sanitize) $allowedParams[$param] = self::sanitizeValue($_GET[$param]);
				else $allowedParams[$param] = $_GET[$param];
			}

			return $allowedParams;
		}

		public static function header ($_allowedParams = [], $_sanitize = true)
		{
			$allowedParams = [];
			$headers = !function_exists('getallheaders') ? getallheaders() : Common::getallheaders();

			foreach ($_allowedParams as $param) if (isset($headers[$param]))
			{
				if ($_sanitize) $allowedParams[$param] = self::sanitizeValue($headers[$param]);
				else $allowedParams[$param] = $headers[$param];
			}

			return $allowedParams;
		}

		public static function requiredOnRequest ($_requiredFields)
		{
			$errors = [];

			foreach ($_requiredFields as $field) if (!isset($_REQUEST[$field]) || trim($_REQUEST[$field]) === '') $errors[$field] = $field . ' ' . BLANK_FIELD_MSG;

			return $errors;
		}

		public static function requiredOnPost ($_requiredFields)
		{
			$errors = [];

			foreach ($_requiredFields as $field) if (!isset($_POST[$field]) || trim($_POST[$field]) === '') $errors[$field] = $field . ' ' . BLANK_FIELD_MSG;

			return $errors;
		}

		public static function requiredOnGet ($_requiredFields)
		{
			$errors = [];

			foreach ($_requiredFields as $field) if (!isset($_GET[$field]) || trim($_GET[$field]) === '') $errors[$field] = $field . ' ' . BLANK_FIELD_MSG;

			return $errors;
		}

		public static function requiredOnHeader ($_requiredFields)
		{
			$errors = [];
			$headers = !function_exists('getallheaders') ? getallheaders() : Common::getallheaders();

			foreach ($_requiredFields as $field) if (!isset($headers[$field]) || trim($headers[$field]) === '') $errors[$field] = $field . ' ' . BLANK_FIELD_MSG;

			return $errors;
		}

		public static function checkLength ($_value, $_options = [])
		{
			if (isset($_options['max']) && (strlen($_value) > (int) $_options['max'])) return false;
			if (isset($_options['min']) && (strlen($_value) < (int) $_options['min'])) return false;
			if (isset($_options['exact']) && (strlen($_value) != (int) $_options['exact'])) return false;

			return true;
		}

		public static function checkFormatting ($_value, $_regex = '//', $_sanitize = true)
		{
			if ($_sanitize) return (bool) preg_match($_regex, self::sanitizeValue($_value));
			else return (bool) preg_match($_regex, $_value);
		}

		public static function isEmail ($_value)
		{
			return (bool) self::checkFormatting($_value, EMAIL_VALIDATOR, false);
		}

		public static function isNumber ($_value, $_options = [])
		{
			if (!is_numeric($_value)) return false;
			if (isset($_options['max']) && ($_value > (int) $_options['max'])) return false;
			if (isset($_options['min']) && ($_value < (int) $_options['min'])) return false;

			return true;
		}

		public static function sanitizeValue ($_value, $_stripSlashes = false)
		{
			$sanitizedValue = strip_tags(htmlspecialchars(trim($_value)));

			if ($_stripSlashes) return stripcslashes($sanitizedValue);
			else return $sanitizedValue;
		}
	}
?>
