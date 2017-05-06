<?php
	if (!User::authorize()) die();

	$allowedParams = explode(DELIMITER, GETWIDGET_PARAMS);

	$post = Validation::post($allowedParams);

	if (!$post) die();

	$post[$allowedParams[0]] = substr($post[$allowedParams[0]], 0, MAX_NAME_LENGTH);

	$widget = new Widget();

	$result = $widget -> get($post);

	if ($result)
	{
		http_response_code(OK);

		echo Common::response($result);
	}

	die();
?>