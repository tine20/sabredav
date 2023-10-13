<?php

namespace Tine20\CalDAV\Principal;
use Tine20\DAVACL;

class CollectionTest extends \PHPUnit_Framework_TestCase {

    function testGetChildForPrincipal() {

        $back = new DAVACL\PrincipalBackend\Mock();
        $col = new Collection($back);
        $r = $col->getChildForPrincipal(array(
            'uri' => 'principals/admin',
        ));
        $this->assertInstanceOf('Tine20\\CalDAV\\Principal\\User', $r);

    }

}
