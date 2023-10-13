<?php

namespace Tine20\DAV\Exception;

class PaymentRequiredTest extends \PHPUnit_Framework_TestCase {

    function testGetHTTPCode() {

        $ex = new PaymentRequired();
        $this->assertEquals(402, $ex->getHTTPCode());

    }

}
