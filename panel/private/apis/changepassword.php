<?php
	if (!User::authorize()) die();

	$allowedParams = explode(DELIMITER, CHANGEPASSWORD_PARAMS);

	$params = Validation::post($allowedParams);

	if (!$params) die();

	$params[$allowedParams[0]] = substr($params[$allowedParams[0]], 0, MAX_PASSWORD_LENGTH);
	$params[$allowedParams[1]] = substr($params[$allowedParams[1]], 0, MAX_PASSWORD_LENGTH);

	$user = new User();

	$result = $user -> ChangePassword($params);

	if ($result['token'])
	{
		http_response_code(OK);

		echo Common::response($result);
	}

	die();
?>