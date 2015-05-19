<?php
require 'Slim/Slim.php';
\Slim\Slim::registerAutoloader();

require 'Slim/Middleware/jsonP.php';
require 'Slim/Middleware/bitConvert.php';
require 'Slim/Extras/Middleware/HttpBasicAuthRoute.php';

session_cache_limiter(false);

$app = new \Slim\Slim(array(
	'debug' => true
));

//includes for configurations
require_once 'includes/db_config.php';
require_once 'includes/errorCodes.php';

//include the routes
require_once 'routes/site.php';
require_once 'routes/functions.php';

//run slim
$app->add(new \Slim\Middleware\JSONPMiddleware());
$app->add(new \Slim\Middleware\BitConvertMiddleware());
$app->contentType('application/json');
$app->run();
?>
