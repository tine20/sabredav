<?php

/*

CalendarServer example

This server features CalDAV support

*/

// settings
date_default_timezone_set('Canada/Eastern');

// If you want to run the SabreDAV server in a custom location (using mod_rewrite for instance)
// You can override the baseUri here.
// $baseUri = '/';

/* Database */
$pdo = new \PDO('sqlite:data/db.sqlite');
$pdo->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);

//Mapping PHP errors to exceptions
function exception_error_handler($errno, $errstr, $errfile, $errline ) {
    throw new \ErrorException($errstr, 0, $errno, $errfile, $errline);
}
set_error_handler("exception_error_handler");

// Files we need
require_once 'vendor/autoload.php';

// Backends
$authBackend = new \Tine20\DAV\Auth\Backend\PDO($pdo);
$calendarBackend = new \Tine20\CalDAV\Backend\PDO($pdo);
$principalBackend = new \Tine20\DAVACL\PrincipalBackend\PDO($pdo);

// Directory structure 
$tree = array(
    new \Tine20\CalDAV\Principal\Collection($principalBackend),
    new \Tine20\CalDAV\CalendarRootNode($principalBackend, $calendarBackend),
);

$server = new \Tine20\DAV\Server($tree);

if (isset($baseUri))
    $server->setBaseUri($baseUri);

/* Server Plugins */
$authPlugin = new \Tine20\DAV\Auth\Plugin($authBackend,'SabreDAV');
$server->addPlugin($authPlugin);

$aclPlugin = new \Tine20\DAVACL\Plugin();
$server->addPlugin($aclPlugin);

$caldavPlugin = new \Tine20\CalDAV\Plugin();
$server->addPlugin($caldavPlugin);

// Support for html frontend
$browser = new \Tine20\DAV\Browser\Plugin();
$server->addPlugin($browser);

// And off we go!
$server->exec();
