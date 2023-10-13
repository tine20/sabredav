<?php

namespace Tine20\CardDAV;

use Tine20\DAV;

class IDirectoryTest extends \PHPUnit_Framework_TestCase {

    function testResourceType() {

        $tree = array(
            new DirectoryMock('directory')
        );

        $server = new DAV\Server($tree);
        $plugin = new Plugin();
        $server->addPlugin($plugin);

        $props = $server->getProperties('directory', array('{DAV:}resourcetype'));
        $this->assertTrue($props['{DAV:}resourcetype']->is('{' . Plugin::NS_CARDDAV . '}directory'));

    }

}

class DirectoryMock extends DAV\SimpleCollection implements IDirectory {



}
