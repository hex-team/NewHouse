<?php
	$allowedParams = explode(DELIMITER, LOGOUT_PARAMS);
	$err = Validation::requiredOnPost($allowedParams);

	if (!empty($err)) throw new Exception(API_PARAMETERS_MSG . ' (' . implode(DELIMITER, $err) . ')');

	$post = Validation::post($allowedParams);

	$post[$allowedParams[0]] = substr($post[$allowedParams[0]], 0, MAX_TOKEN_LENGTH);
	$obj = new User();

	$result = $obj -> logout($post);

	Maintenance::handleApiActions((empty($result) ? REQUEST_MSG : REQUEST_SUCCESSFULL_MSG), $result);
?>