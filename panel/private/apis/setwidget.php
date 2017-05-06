<?php
	if (!User::authorize()) die();

	$allowedParams = explode(DELIMITER, SETWIDGET_PARAMS);

	$post = Validation::post($allowedParams);

	if (!$post) die();

	$post[$allowedParams[0]] = substr($post[$allowedParams[0]], 0, MAX_NAME_LENGTH);

	$widget = new Widget();

	if ($widget -> update($post)) http_response_code(OK);

	die();
?>