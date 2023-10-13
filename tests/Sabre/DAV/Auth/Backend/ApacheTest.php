<?php

namespace Tine20\DAV\Auth\Backend;

use Tine20\DAV;
use Tine20\HTTP;

class ApacheTest extends \PHPUnit_Framework_TestCase {

    function testConstruct() {

        $backend = new Apache();

    }

    /**
     * @expectedException Tine20\DAV\Exception
     */
    function testNoHeader() {

        $server = new DAV\Server();
        $backend = new Apache();
        $backend->authenticate($server,'Realm');

    }

    function testRemoteUser() {

        $backend = new Apache();

        $server = new DAV\Server();
        $request = new HTTP\Request(array(
            'REMOTE_USER' => 'username',
        ));
        $server->httpRequest = $request;

        $this->assertTrue($backend->authenticate($server, 'Realm'));

        $userInfo = 'username';

        $this->assertEquals($userInfo, $backend->getCurrentUser());

    }

}
