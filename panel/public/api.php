<?php
	require_once '../private/initialize.php';

	try
	{
		header('Content-Type: application/json; charset=' . CHARSET);
		header('Access-Control-Allow-Methods: GET, POST, OPTIONS');
		header('Access-Control-Allow-Origin: *');

		$allowedParams = explode(DELIMITER, API_PARAMS);
		$err = Validation::requiredOnPost($allowedParams);

		if (!empty($err)) throw new Exception(API_PARAMETERS_MSG . ' (' . implode(DELIMITER, $err) . ')');

		$post = Validation::post($allowedParams);
		$api = strtoupper($post[$allowedParams[0]]) . API_PREFIX;

		if (!@include_once constant($api)) throw new Exception(API_MSG . ' (' . $api . ')');
	}
	catch (Exception $ex)
	{
		Maintenance::handleApiErrors($ex);
	}
?>