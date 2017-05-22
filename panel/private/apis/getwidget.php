<?php
	// if (!User::authorize()) die();

	$allowedParams = explode(DELIMITER, GETWIDGET_PARAMS);

	$params = Validation::get($allowedParams);

	if (!$params) die();

	$params[$allowedParams[0]] = substr($params[$allowedParams[0]], 0, MAX_NAME_LENGTH);

	$widget = new Widget();

	$result = $widget -> get($params);

	if ($result)
	{
		http_response_code(OK);

		echo Common::response($result);
	}

	die();
?>