<?php
	require_once '../initialize.php';

	try
	{
		header('Access-Control-Allow-Origin: *');
		header('Access-Control-Allow-Credentials: true');
		header('Access-Control-Allow-Methods: OPTIONS, GET, POST');
		header('Access-Control-Allow-Headers: Content-Type, User-Agent, Cache-Control');
		header('Content-Type: application/json; charset=' . CHARSET);

		$allowedParams = explode(DELIMITER, API_PARAMS);
		$err = Validation::requiredOnGet($allowedParams);

		if (!empty($err)) throw new Exception(API_PARAMETERS_MSG . ' (' . implode(DELIMITER, $err) . ')');

		$get = Validation::get($allowedParams);
		$api = strtoupper($get[$allowedParams[0]]) . API_PREFIX;

		if (!@include_once constant($api)) throw new Exception(API_MSG . ' (' . $api . ')');
	}
	catch (Exception $ex)
	{
		http_response_code(BAD_REQUEST);

		Maintenance::handleApiErrors($ex);
	}
?>