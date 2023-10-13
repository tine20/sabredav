<?php

namespace Tine20\DAV\Auth\Backend;

use Tine20\DAV;

abstract class AbstractPDOTest extends \PHPUnit_Framework_TestCase {

    abstract function getPDO();

    function testConstruct() {

        $pdo = $this->getPDO();
        $backend = new PDO($pdo);
        $this->assertTrue($backend instanceof PDO);

    }

    /**
     * @depends testConstruct
     */
    function testUserInfo() {

        $pdo = $this->getPDO();
        $backend = new PDO($pdo);

        $this->assertNull($backend->getDigestHash('realm','blabla'));

        $expected = 'hash';

        $this->assertEquals($expected, $backend->getDigestHash('realm','user'));

    }

}
