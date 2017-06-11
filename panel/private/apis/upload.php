<?php
	if (!User::authorize()) die();

	$allowedParams = explode(DELIMITER, UPLOAD_PARAMS);

	$params = Validation::file($allowedParams);

	if (!$params) die();

	$result = Common::upload($params);

	if ($result)
	{
		echo Common::response($result);

		http_response_code(OK);
	}

	die();
?>