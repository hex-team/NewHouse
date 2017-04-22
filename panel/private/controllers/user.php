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
			$result = $this -> login -> get($_params['username'])[0];

			if ($result['token'] != null && Token::verify($result['id'], $result['token'], TOKEN_SECRET)) $token = $result['token'];
			else $token = Token::generate($result['id'], TOKEN_SECRET, LOGIN_TIMEOUT);

			if ($this -> login -> update($result['id'], ['token' => $token])) return ['token' => $token, 'userId' => $result['id']];

			return false;
		}
	}
?>