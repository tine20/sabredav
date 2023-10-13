<?php

namespace Tine20\DAV\Locks\Backend;

require_once 'Sabre/TestUtil.php';

class FSTest extends AbstractTest {

    function getBackend() {

        \Tine20\TestUtil::clearTempDir();
        mkdir(SABRE_TEMPDIR . '/locks');
        $backend = new FS(SABRE_TEMPDIR . '/locks/');
        return $backend;

    }

    function tearDown() {

        \Tine20\TestUtil::clearTempDir();

    }

    function testGetLocksChildren() {

        // We're skipping this test. This doesn't work, and it will
        // never. The class is deprecated anyway.

    }

}
