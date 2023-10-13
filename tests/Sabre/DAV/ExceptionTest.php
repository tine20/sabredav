<?php

namespace Tine20\DAV;

class ExceptionTest extends \PHPUnit_Framework_TestCase {

    function testStatus() {

        $e = new Exception();
        $this->assertEquals(500,$e->getHTTPCode());

    }

    function testExceptionStatuses() {

        $c = array(
            'Tine20\\DAV\\Exception\\NotAuthenticated'    => 401,
            'Tine20\\DAV\\Exception\\InsufficientStorage' => 507,
        );

        foreach($c as $class=>$status) {

            $obj = new $class();
            $this->assertEquals($status, $obj->getHTTPCode());

        }

    }

}
