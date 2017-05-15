<?php
	require_once '../private/initialize.php';

	try
	{
		header('Access-Control-Allow-Origin: *');
		header('Access-Control-Allow-Credentials: true');
		header('Access-Control-Allow-Methods: OPTIONS, GET, POST');
		header('Access-Control-Allow-Headers: Content-Type, User-Agent, Cache-Control');
		header('Access-Control-Allow-Headers: X-Requested-With, Content-Type, Origin, Authorization, Accept, Client-Security-Token, Accept-Encoding');
		header('Content-Type: application/json; charset=' . CHARSET);

		Maintenance::checkIP();

		$allowedParams = explode(DELIMITER, API_PARAMS);

		$get = Validation::get($allowedParams);
		$api = strtoupper($get[$allowedParams[0]]) . API_PREFIX;

		if (!@include_once constant($api)) throw new Exception(API_MSG . ' (' . $api . ')');
	}
	catch (Exception $ex)
	{
		Maintenance::handleExceptions($ex);
	}
?>