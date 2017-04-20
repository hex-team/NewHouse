<?php
	// Status
	define('DISABLE', 0);
	define('ENABLE', 1);

	define('SERVER_ERROR', 500);
	define('BAD_REQUEST', 400);
	define('OK', 200);

	define('DENIED', 0);
	define('CONFIRMED', 1);
	define('WAITING', 2);

	define('NOT_SENT', 0);
	define('SENT', 1);

	// Log Types
	define('EXCEPTION', 0);
	define('INFORMATION', 1);

	// Roles
	define('ADMIN', 0);
	define('USER', 1);

	// Log Locations
	define('DB', 0);
	define('FILE', 1);

	// Languages Code
	define('FA_LANG', '0');
	define('EN_LANG', '1');

	// Application Settings
	define('MIN_PAGE', 1);
	define('MAX_PAGE', 100);
	define('MAX_Q_LENGTH', 32);
	define('MAX_TITLE_LENGTH', 32);
	define('MAX_BODY_LENGTH', 384);
	define('MAX_IMAGE_SIZE', 2048);
	define('RESULT_COUNT_PER_REQUEST', 6);
	define('NOW', date('Y/m/d H:i:s'));
	define('EMAIL_VALIDATOR', '/^[\w\.\-]{1,64}\@[\w\.\-]{1,184}\.[a-zA-Z0-9]{1,4}$/');
	define('DELIMITER', ',');
	define('APPLICATION_TITLE', 'Golab');
	define('CSRF_TOKEN_LENGTH', 32);
	define('API_PREFIX', '_API');
	define('CHARSET', 'UTF-8');
	define('TIME_ZONE', 'Asia/Tehran');
	define('MAINTENANCE_MODE', true);
	define('LOG_ERRORS', false);
	define('LOG_ACTIONS', false);
	define('VALID_IP_ADDRESS', '127.0.0.1,::1');

	// Links
	define('ABOUT_LINK', 'localhost');
	define('POLICY_LINK', 'policy');
	define('TWITTER_LINK', '');

	// Paths
	define('APP_ROOT_PATH', dirname(dirname(__dir__)) . '/');
	define('PRIVATE_PATH', APP_ROOT_PATH . 'private/');
	define('PUBLIC_PATH', APP_ROOT_PATH . 'public/');
	define('APIS_PATH', PRIVATE_PATH . 'apis/');
	define('CONTROLLERS_PATH', PRIVATE_PATH . 'controllers/');
	define('MODELS_PATH', PRIVATE_PATH . 'models/');
	define('USER_VIEWS_PATH', PRIVATE_PATH . 'views/');
	define('UPLOADED_IMAGES_PATH', APP_ROOT_PATH . 'uploads/images/');

	// Log Files
	define('E_LOG_FILE', APP_ROOT_PATH . 'e_log.log');
	define('A_LOG_FILE', APP_ROOT_PATH . 'a_log.log');

	// Registered APIs
	define('SEARCH_API', APIS_PATH . 'search.php');
	define('GET_CONTENT_API', APIS_PATH . 'content.php');
	define('SEND_REPORT_API', APIS_PATH . 'report.php');
	define('ADD_CONTENT_API', APIS_PATH . 'add.php');

	// APIs Allowed Parameters
	define('API_PARAMS', 'api');
	define('SEARCH_PARAMS', 'q,page');
	define('GET_CONTENT_PARAMS', 'pid');
	define('SEND_REPORT_PARAMS', 'pid,body,email');
	define('ADD_CONTENT_PARAMS', 'title,body,date,image,tags,reference,email');

	// Messages
	define('DB_CONNECTION_MSG', 'Database Connection Error');
	define('MODULE_MSG', 'File Not Found');
	define('API_MSG', 'API Not Found');
	define('API_PARAMETERS_MSG', 'Wrong API Parameters');
	define('PERMISSION_MSG', 'Permission Denied');
	define('REQUEST_MSG', 'Error Processing Request');
	define('SERVER_ERROR_MSG', 'Server Error');
	define('INVALID_IP_MSG', 'Invalid IP Address');
	define('BLANK_FIELD_MSG', 'Can\'t Be Blank');
	define('NO_RESULT_MSG', 'No Result Found');
	define('REQUEST_SUCCESSFULL_MSG', 'Request Successfully Finished');
	define('MAINTENANCE_MSG', 'Temporarily Unavailable.');

	// Database Identities
	define('DB_HOST', 'localhost');
	define('DB_PORT', 3306);
	define('DB_USERNAME', 'mrpython');
	define('DB_PASSWORD', '123456');
	define('DB_ChARSET', 'utf8');

	// Databases
	define('DB_DATA', '');
	define('DB_LOG', '');

	// Tables
	define('TBL_LOGS', 'tbl_logs');
?>