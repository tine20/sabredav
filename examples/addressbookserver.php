<?php

/*

Addressbook/CardDAV server example

This server features CardDAV support

*/

// settings
date_default_timezone_set('Canada/Eastern');

// Make sure this setting is turned on and reflect the root url for your WebDAV server.
// This can be for example the root / or a complete path to your server script
$baseUri = '/';

/* Database */
$pdo = new PDO('sqlite:data/db.sqlite');
$pdo->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);

//Mapping PHP errors to exceptions
function exception_error_handler($errno, $errstr, $errfile, $errline ) {
    throw new ErrorException($errstr, 0, $errno, $errfile, $errline);
}
set_error_handler("exception_error_handler");

// Autoloader
require_once 'vendor/autoload.php';

// Backends
$authBackend      = new Tine20\DAV\Auth\Backend\PDO($pdo);
$principalBackend = new Tine20\DAVACL\PrincipalBackend\PDO($pdo);
$carddavBackend   = new Tine20\CardDAV\Backend\PDO($pdo);
//$caldavBackend    = new Tine20\CalDAV\Backend\PDO($pdo);

// Setting up the directory tree //
$nodes = array(
    new Tine20\DAVACL\PrincipalCollection($principalBackend),
//    new Tine20\CalDAV\CalendarRootNode($authBackend, $caldavBackend),
    new Tine20\CardDAV\AddressBookRoot($principalBackend, $carddavBackend),
);

// The object tree needs in turn to be passed to the server class
$server = new Tine20\DAV\Server($nodes);
$server->setBaseUri($baseUri);

// Plugins
$server->addPlugin(new Tine20\DAV\Auth\Plugin($authBackend,'SabreDAV'));
$server->addPlugin(new Tine20\DAV\Browser\Plugin());
//$server->addPlugin(new Tine20\CalDAV\Plugin());
$server->addPlugin(new Tine20\CardDAV\Plugin());
$server->addPlugin(new Tine20\DAVACL\Plugin());

// And off we go!
$server->exec();
