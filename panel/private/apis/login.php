<?php
	http_response_code(BAD_REQUEST);

	$allowedParams = explode(DELIMITER, LOGIN_PARAMS);

	$post = Validation::post($allowedParams);

	if (!$post) die();

	$post[$allowedParams[0]] = substr($post[$allowedParams[0]], 0, MAX_USERNAME_LENGTH);
	$post[$allowedParams[1]] = substr($post[$allowedParams[1]], 0, MAX_PASSWORD_LENGTH);

	$user = new User();

	$result = $user -> login($post);

	if ($result['token'])
	{
		http_response_code(OK);

		echo Common::response($result);
	}

	die();
?>