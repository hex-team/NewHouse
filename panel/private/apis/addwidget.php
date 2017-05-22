<?php
	// if (!User::authorize()) die();

	$allowedParams = explode(DELIMITER, ADDWIDGET_PARAMS);

	$params = Validation::post($allowedParams, false);

	if (!$params) die();

	$params[$allowedParams[0]] = substr($params[$allowedParams[0]], 0, MAX_NAME_LENGTH);

	$widget = new Widget();

	if ($widget -> add($params)) http_response_code(OK);

	die();
?>