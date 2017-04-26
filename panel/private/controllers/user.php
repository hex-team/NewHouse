<?php
	class User
	{
		private $login, $token;

		public function __construct ()
		{
			$this -> login = new TblUsers();
			$this -> token = new Token();
		}

		public function login ($_params)
		{
			$user = $this -> login -> authenticate($_params['username'], $_params['password']);

			if ($user != null) $result = self::authorize($user);

			return ['token' => $token];
		}

		public static function authorize ($_user)
		{
			if ($_user['token'] != null && Token::verify($_user['id'], $_user['token'], TOKEN_SECRET)) $token = $_user['token'];
			else $token = Token::generate($_user['id'], TOKEN_SECRET, LOGIN_TIMEOUT);

			if ($this -> login -> update($_user['id'], ['token' => $token])) return $token;

			return false;
		}
	}
?>