<?php
	// if (!User::authorize()) die();

	$allowedParams = explode(DELIMITER, REMOVEWIDGET_PARAMS);

	$params = Validation::get($allowedParams);

	if (!$params) die();

	$params[$allowedParams[0]] = substr($params[$allowedParams[0]], 0, MAX_ID_LENGTH);

	$widget = new Widget();

	if ($widget -> delete($params)) http_response_code(OK);

	die();
?>