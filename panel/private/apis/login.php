<?php
	$allowedParams = explode(DELIMITER, LOGIN_PARAMS);
	$err = Validation::requiredOnPost($allowedParams);

	if (!empty($err)) throw new Exception(API_PARAMETERS_MSG . ' (' . implode(DELIMITER, $err) . ')');

	$post = Validation::post($allowedParams);

	$post[$allowedParams[0]] = substr($post[$allowedParams[0]], 0, MAX_USERNAME_LENGTH);
	$post[$allowedParams[1]] = substr($post[$allowedParams[1]], 0, MAX_PASSWORD_LENGTH);
	$obj = new User();

	$result = $obj -> login($post);

	Maintenance::handleApiActions((empty($result['token']) ? REQUEST_MSG : REQUEST_SUCCESSFULL_MSG), $result);
?>