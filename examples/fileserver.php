<?php

/*

This is the best starting point if you're just interested in setting up a fileserver.

Make sure that the 'public' and 'tmpdata' exists, with write permissions
for your server.

*/

// settings
date_default_timezone_set('Canada/Eastern');
$publicDir = 'public';
$tmpDir = 'tmpdata';

// If you want to run the SabreDAV server in a custom location (using mod_rewrite for instance)
// You can override the baseUri here.
// $baseUri = '/';


// Files we need
require_once 'vendor/autoload.php';

// Create the root node
$root = new \Tine20\DAV\FS\Directory($publicDir);

// The rootnode needs in turn to be passed to the server class
$server = new \Tine20\DAV\Server($root);

if (isset($baseUri))
    $server->setBaseUri($baseUri);

// Support for LOCK and UNLOCK
$lockBackend = new \Tine20\DAV\Locks\Backend\File($tmpDir . '/locksdb');
$lockPlugin = new \Tine20\DAV\Locks\Plugin($lockBackend);
$server->addPlugin($lockPlugin);

// Support for html frontend
$browser = new \Tine20\DAV\Browser\Plugin();
$server->addPlugin($browser);

// Automatically guess (some) contenttypes, based on extesion
$server->addPlugin(new \Tine20\DAV\Browser\GuessContentType());

// Authentication backend
$authBackend = new \Tine20\DAV\Auth\Backend\File('.htdigest');
$auth = new \Tine20\DAV\Auth\Plugin($authBackend,'SabreDAV');
$server->addPlugin($auth);

// Temporary file filter
$tempFF = new \Tine20\DAV\TemporaryFileFilterPlugin($tmpDir);
$server->addPlugin($tempFF);

// And off we go!
$server->exec();
