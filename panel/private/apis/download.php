<?php
	$allowedParams = explode(DELIMITER, DOWNLOAD_PARAMS);

	$params = Validation::file($allowedParams);

	if (!$params) die();

	$params[$allowedParams[0]] = substr($params[$allowedParams[0]], 0, MAX_NAME_LENGTH);

	$result = Common::download($params['file']);

	// if ($result)
	// {
	// 	echo Common::response($result);

	// 	http_response_code(OK);
	// }

	// die();
?>