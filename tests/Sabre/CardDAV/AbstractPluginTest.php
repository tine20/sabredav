<?php

namespace Tine20\CardDAV;

use Tine20\DAV;
use Tine20\DAVACL;

abstract class AbstractPluginTest extends \PHPUnit_Framework_TestCase {

    /**
     * @var Tine20\CardDAV\Plugin
     */
    protected $plugin;
    /**
     * @var Tine20\DAV\Server
     */
    protected $server;
    /**
     * @var Tine20\CardDAV\Backend\Mock;
     */
    protected $backend;

    function setUp() {

        $this->backend = new Backend\Mock();
        $principalBackend = new DAVACL\PrincipalBackend\Mock();

        $tree = array(
            new AddressBookRoot($principalBackend, $this->backend),
            new DAVACL\PrincipalCollection($principalBackend)
        );

        $this->plugin = new Plugin();
        $this->plugin->directories = array('directory');
        $this->server = new DAV\Server($tree);
        $this->server->addPlugin($this->plugin);
        $this->server->debugExceptions = true;

    }

}
