<?php
set_include_path(get_include_path() . PATH_SEPARATOR . "./libraries");

error_reporting(E_ALL);

// Our Settings file matters most!
require_once 'settings.php';

// External Libraries
require_once 'Slim/Slim/Slim.php';
require_once 'idiorm/idiorm.php';
require_once 'Paris/paris.php';

// Library configuration
$app = new Slim( array() );

ORM::configure("mysql:host=$HOST;dbname=$DATABASE");
ORM::configure('username', $USERNAME);
ORM::configure('password', $PASSWORD);

// Our code
// @TODO: move functionality to the authentication controller
require_once './scripts/sessions.php';


function redirect( $destination ){
	$GLOBALS['app']->redirect($GLOBALS['web_root'] . $destination);
}

/** System Home */
$app->get('/', function() use ($app) {
	echo "Home Page!";
});


/** Include Controllers */
require_once 'controllers/assignments.php';
require_once 'controllers/authentication.php';
require_once 'controllers/class.php';
require_once 'controllers/content.php';
require_once 'controllers/evaluation.php';
require_once 'controllers/group.php';
require_once 'controllers/portfolio.php';
require_once 'controllers/project.php';
require_once 'controllers/user.php';


$app->run();

