<?php

namespace Tine20\DAV\Tree;

use Tine20\DAV;

/**
 * @covers Tine20\DAV\Tree
 * @covers Tine20\DAV\Tree\Filesystem
 * @covers Tine20\DAV\FS\Node
 * @covers Tine20\DAV\FS\File
 * @covers Tine20\DAV\FS\Directory
 */
class FilesystemTest extends \PHPUnit_Framework_TestCase {

    function setUp() {

        \Tine20\TestUtil::clearTempDir();
        file_put_contents(SABRE_TEMPDIR. '/file.txt','Body');
        mkdir(SABRE_TEMPDIR.'/dir');
        file_put_contents(SABRE_TEMPDIR.'/dir/subfile.txt','Body');

    }

    function tearDown() {

        \Tine20\TestUtil::clearTempDir();

    }

    function testGetNodeForPath_File() {

        $fs = new Filesystem(SABRE_TEMPDIR);
        $node = $fs->getNodeForPath('file.txt');
        $this->assertTrue($node instanceof DAV\FS\File);

    }

    /**
     * @expectedException \Tine20\DAV\Exception\NotFound
     */
    function testGetNodeForPath_DoesntExist() {

        $fs = new Filesystem(SABRE_TEMPDIR);
        $node = $fs->getNodeForPath('whoop/file.txt');

    }

    function testGetNodeForPath_Directory() {

        $fs = new Filesystem(SABRE_TEMPDIR);
        $node = $fs->getNodeForPath('dir');
        $this->assertTrue($node instanceof DAV\FS\Directory);
        $this->assertEquals('dir', $node->getName());
        $this->assertInternalType('array', $node->getChildren());

    }

    function testCopy() {

        $fs = new Filesystem(SABRE_TEMPDIR);
        $fs->copy('file.txt','file2.txt');
        $this->assertTrue(file_exists(SABRE_TEMPDIR . '/file2.txt'));
        $this->assertEquals('Body',file_get_contents(SABRE_TEMPDIR . '/file2.txt'));

    }

    function testCopyDir() {

        $fs = new Filesystem(SABRE_TEMPDIR);
        $fs->copy('dir','dir2');
        $this->assertTrue(file_exists(SABRE_TEMPDIR . '/dir2'));
        $this->assertEquals('Body',file_get_contents(SABRE_TEMPDIR . '/dir2/subfile.txt'));

    }

    function testMove() {

        $fs = new Filesystem(SABRE_TEMPDIR);
        $fs->move('file.txt','file2.txt');
        $this->assertTrue(file_exists(SABRE_TEMPDIR . '/file2.txt'));
        $this->assertTrue(!file_exists(SABRE_TEMPDIR . '/file.txt'));
        $this->assertEquals('Body',file_get_contents(SABRE_TEMPDIR . '/file2.txt'));

    }


}
