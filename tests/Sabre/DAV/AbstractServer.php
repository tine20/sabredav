<?php

namespace Tine20\DAV;

use Tine20\HTTP;

require_once 'Sabre/HTTP/ResponseMock.php';

abstract class AbstractServer extends \PHPUnit_Framework_TestCase {

    /**
     * @var Tine20\HTTP\ResponseMock
     */
    protected $response;
    protected $request;
    /**
     * @var Tine20\DAV\Server
     */
    protected $server;
    protected $tempDir = SABRE_TEMPDIR;

    function setUp() {

        $this->response = new HTTP\ResponseMock();
        $this->server = new Server($this->getRootNode());
        $this->server->httpResponse = $this->response;
        $this->server->debugExceptions = true;
        $this->deleteTree(SABRE_TEMPDIR,false);
        file_put_contents(SABRE_TEMPDIR . '/test.txt', 'Test contents');
        mkdir(SABRE_TEMPDIR . '/dir');
        file_put_contents(SABRE_TEMPDIR . '/dir/child.txt', 'Child contents');


    }

    function tearDown() {

        $this->deleteTree(SABRE_TEMPDIR,false);

    }

    protected function getRootNode() {

        return new FS\Directory(SABRE_TEMPDIR);

    }

    private function deleteTree($path,$deleteRoot = true) {

        foreach(scandir($path) as $node) {

            if ($node=='.' || $node=='.svn' || $node=='..') continue;
            $myPath = $path.'/'. $node;
            if (is_file($myPath)) {
                unlink($myPath);
            } else {
                $this->deleteTree($myPath);
            }

        }
        if ($deleteRoot) rmdir($path);

    }

}
