<?php
set_include_path(get_include_path() . PATH_SEPARATOR . "./libraries");

error_reporting(E_ALL);

// Our Settings file matters most!
require_once 'settings.php';

// External Libraries
require_once 'Slim/Slim/Slim.php';
require_once 'idiorm/idiorm.php';
require_once 'Paris/paris.php';
require 'Views/TwigView.php';

// Library configuration
TwigView::$twigDirectory = __DIR__ . '/libraries/Twig/lib/Twig/';

ORM::configure("mysql:host=$HOST;dbname=$DATABASE");
ORM::configure('username', $USERNAME);
ORM::configure('password', $PASSWORD);

// Our code
// @TODO: move functionality to the authentication controller
require_once './scripts/sessions.php';


function redirect( $destination ){
	$GLOBALS['app']->redirect($GLOBALS['web_root'] . $destination);
}

// System Home
$app = new Slim(array(
	'view' => new TwigView
));

// Login
$app->get('/', function() use ($app) {					
	return $app->render('login.html');		
});

// Register
$app->get('/register', function() use ($app) {					
	return $app->render('register.html');		
});

// View Portfolio
$app->get('/view_portfolio', function() use ($app) {					
	return $app->render('view_portfolio.html');		
});

// Add Project
$app->get('/add_project', function() use ($app) {					
	return $app->render('add_project.html');		
});

// Edit Project
$app->get('/edit_project', function() use ($app) {					
	return $app->render('edit_project.html');		
});

// Review Portfolio
$app->get('/review_portfolio', function() use ($app) {					
	return $app->render('review_portfolio.html');		
});

// Log Out
$app->get('/logout', function() use ($app) {					
	return $app->render('logout.html');		
});

$app->run();
?>