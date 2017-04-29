<?php
	class User
	{
		private $login, $token;

		public function __construct ()
		{
			$this -> user = new TblUsers();
			$this -> token = new Token();
		}

		public function login ($_params)
		{
			$user = $this -> user -> authenticate($_params['username'], $_params['password']);

			if ($user != null)
			{
				if (Token::verify($user['token'])) $token = $user['token'];
				else $token = Token::generate($user['id'], LOGIN_TIMEOUT);
			}

			if ($this -> user -> update($user['id'], ['token' => $token, 'last_login' => NOW])) return ['token' => $token];

			return false;
		}

		public function logout ($_params)
		{
			if (Token::verify($_params['token']))
			{
				$userid = Token::parse($_params['token'])['userid'];

				if ($this -> user -> update($userid, ['token' => null])) return true;
			}

			return false;
		}
	}
?>