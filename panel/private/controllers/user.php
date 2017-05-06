<?php
	class User
	{
		private $user;

		public function __construct ()
		{
			$this -> user = new TblUsers();
		}

		public function login ($_params)
		{
			$userData = $this -> user -> authenticate($_params['username'], $_params['password']);

			if ($userData != null)
			{
				if (Token::verify($userData['token'])) $token = $userData['token'];
				else $token = Token::generate($userData['id'], LOGIN_TIMEOUT);
			}

			if ($this -> user -> update($userData['id'], ['token' => $token, 'last_login' => NOW])) return ['token' => $token];
		}

		public function logout ($_token)
		{
			$userid = Token::parse($_token)['userid'];

			if ($this -> user -> update($userid, ['token' => null])) return true;
		}

		public static function authorize()
		{
			http_response_code(BAD_REQUEST);

			$token = Validation::header(['Authorization'])['Authorization'];

			if (!$token) return false;
			if (!Token::verify($token))
			{
				http_response_code(UNAUTHORIZED);

				return false;
			}

			return true;
		}
	}
?>