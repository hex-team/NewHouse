<?php
	require_once '../private/initialize.php';
ob_flush();
	try
	{
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