<?php
	if (!User::authorize()) die();

	$allowedParams = explode(DELIMITER, UPLOAD_PARAMS);

	$params = Validation::file($allowedParams);

	if (!$params) die();

	// $params[$allowedParams[0]] = substr($params[$allowedParams[0]], 0, MAX_NAME_LENGTH);

	$result = Common::upload($params);

	if ($result)
	{
		echo Common::response($result);

		http_response_code(OK);
	}

	die();
?>