<?php

namespace Tine20\DAVACL\Property;

use Tine20\DAV;
use Tine20\HTTP;

class ACLRestrictionsTest extends \PHPUnit_Framework_TestCase {

    function testConstruct() {

        $prop = new AclRestrictions();

    }

    function testSerializeEmpty() {

        $dom = new \DOMDocument('1.0');
        $root = $dom->createElementNS('DAV:','d:root');

        $dom->appendChild($root);

        $acl = new AclRestrictions();
        $acl->serialize(new DAV\Server(), $root);

        $xml = $dom->saveXML();
        $expected = '<?xml version="1.0"?>
<d:root xmlns:d="DAV:"><d:grant-only/><d:no-invert/></d:root>
';
        $this->assertEquals($expected, $xml);

    }


}
