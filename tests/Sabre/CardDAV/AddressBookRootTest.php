<?php

namespace Tine20\CardDAV;

use Tine20\DAVACL;

class AddressBookRootTest extends \PHPUnit_Framework_TestCase {

    function testGetName() {

        $pBackend = new DAVACL\PrincipalBackend\Mock();
        $cBackend = new Backend\Mock();
        $root = new AddressBookRoot($pBackend, $cBackend);
        $this->assertEquals('addressbooks', $root->getName());

    }

    function testGetChildForPrincipal() {

        $pBackend = new DAVACL\PrincipalBackend\Mock();
        $cBackend = new Backend\Mock();
        $root = new AddressBookRoot($pBackend, $cBackend);

        $children = $root->getChildren();
        $this->assertEquals(3, count($children));

        $this->assertInstanceOf('Tine20\\CardDAV\\UserAddressBooks', $children[0]);
        $this->assertEquals('user1', $children[0]->getName());

    }
}
