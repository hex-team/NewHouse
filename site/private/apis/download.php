<?php
	http_response_code(BAD_REQUEST);

	$allowedParams = explode(DELIMITER, DOWNLOAD_PARAMS);

	$params = Validation::get($allowedParams);

	if (!$params) die();

	$params[$allowedParams[0]] = substr($params[$allowedParams[0]], 0, MAX_NAME_LENGTH);

	Common::download($params['file']);

	die();
?>