<?php

namespace Tine20\DAV\Locks\Backend;

require_once 'Sabre/TestUtil.php';

class FileTest extends AbstractTest {

    function getBackend() {

        \Tine20\TestUtil::clearTempDir();
        $backend = new File(SABRE_TEMPDIR . '/lockdb');
        return $backend;

    }


    function tearDown() {

        \Tine20\TestUtil::clearTempDir();

    }

}
