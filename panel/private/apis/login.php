<?php
	$allowedParams = explode(DELIMITER, LOGIN_PARAMS);
	$err = Validation::requiredOnGet($allowedParams);

	if (!empty($err)) throw new Exception(API_PARAMETERS_MSG . ' (' . implode(DELIMITER, $err) . ')');

	$get = Validation::get($allowedParams);
	$get[$allowedParams[0]] = substr($get[$allowedParams[0]], 0, MAX_USERNAME_LENGTH);
	$get[$allowedParams[1]] = substr($get[$allowedParams[1]], 0, MAX_PASSWORD_LENGTH);

	$obj = new User();

	$result = $obj -> login($get);

	Maintenance::handleApiActions((empty($result['token']) ? REQUEST_MSG : REQUEST_SUCCESSFULL_MSG), $result);
?>