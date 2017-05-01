<?php
	class Maintenance
	{
		public static function handleApiErrors ($_exception)
		{
			if (!MAINTENANCE_MODE || (MAINTENANCE_MODE && LOG_ERRORS))
			{
				$log = new Log();

				$log -> error(__file__, __function__, __line__, $_exception);
			}

			if (!MAINTENANCE_MODE) die(Common::formatResponse(REQUEST_MSG));
			else if (MAINTENANCE_MODE && in_array($_SESSION['IP_ADDRESS'], explode(DELIMITER, VALID_IP_ADDRESS))) die(Common::formatResponse($_exception -> getmessage()));
			else die(Common::formatResponse(MAINTENANCE_MSG));
		}

		public static function handleApiActions ($_message, $_value)
		{
			if (!MAINTENANCE_MODE || (MAINTENANCE_MODE && LOG_ACTIONS))
			{
				$log = new Log();

				$log -> action(__file__, __function__, __line__, $_message);
			}

			if (!MAINTENANCE_MODE) die(Common::formatResponse(null, $_value));
			if (MAINTENANCE_MODE && in_array($_SESSION['IP_ADDRESS'], explode(DELIMITER, VALID_IP_ADDRESS))) die(Common::formatResponse($_message, $_value));

			die(Common::formatResponse(MAINTENANCE_MSG));
		}

		public static function handleExceptions ($_exception, $_logLocation = DB)
		{
			http_response_code(SERVER_ERROR);

			if (!MAINTENANCE_MODE || (MAINTENANCE_MODE && LOG_ERRORS))
			{
				$log = new Log();

				$log -> error(__file__, __function__, __line__, $_exception, $_logLocation);
			}

			if (MAINTENANCE_MODE && in_array($_SESSION['IP_ADDRESS'], explode(DELIMITER, VALID_IP_ADDRESS))) die(Common::formatResponse($_exception -> getmessage()));

			die(Common::formatResponse(SERVER_ERROR_MSG));
		}

		public static function getViewOutput ($_view)
		{
			if (MAINTENANCE_MODE && !in_array($_SESSION['IP_ADDRESS'], explode(DELIMITER, VALID_IP_ADDRESS))) return MAINTENANCE_VIEW;
			else return $_view;
		}
	}
