<?php
	$allowedParams = explode(DELIMITER, LOGOUT_PARAMS);
	$err = Validation::requiredOnHeader($allowedParams);

	if (!empty($err)) throw new Exception(API_PARAMETERS_MSG . ' (' . implode(DELIMITER, $err) . ')');

	$header = Validation::header($allowedParams);

	$header[$allowedParams[0]] = substr($header[$allowedParams[0]], 0, MAX_TOKEN_LENGTH);

	$authorization = Token::verify($header['token']);

	if (!$authorization)
	{
		http_response_code(UNAUTHORIZED);

		Maintenance::handleApiActions(REQUEST_MSG, $authorization);
	}

	$obj = new User();

	$result = $obj -> logout($header);

	if (!$result) http_response_code(Bad_REQUEST);
	else http_response_code(OK);

	Maintenance::handleApiActions((empty($result) ? REQUEST_MSG : REQUEST_SUCCESSFULL_MSG), $result);
?>