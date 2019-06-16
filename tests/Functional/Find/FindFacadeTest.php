<?php

namespace PhuxtilTests\Functional\Find;

use PHPUnit\Framework\TestCase;
use Phuxtil\Find\DefinesInterface;
use Phuxtil\Find\FindConfigurator;
use Phuxtil\Find\FindFacade;

class FindFacadeTest extends TestCase
{
    const FIND_OUTPUT = \TESTS_FIXTURE_DIR . 'find_output.txt';

    /**
     * @var \Phuxtil\Find\FindConfigurator
     */
    protected $configurator;

    protected function setUp()
    {
        $output = \file_get_contents(static::FIND_OUTPUT);

        $this->configurator = (new FindConfigurator())
            ->setFormat(DefinesInterface::DEFAULT_FORMAT)
            ->setFormatDelimiter(DefinesInterface::DEFAULT_FORMAT_DELIMITER)
            ->setLineDelimiter("\n")
            ->setFindOutput($output);
    }

    public function test_process()
    {
        $facade = new FindFacade();

        $results = $facade->process($this->configurator);

        $this->assertDirectoryOutput($results[0]);
        $this->assertFileOutput($results[1]);
        $this->assertLinkResolvedFileOutput($results[2]);
    }

    protected function assertDirectoryOutput(\SplFileInfo $info)
    {
        $this->assertEquals('0755', $info->getPerms());
        $this->assertEquals(0, $info->getOwner());
        $this->assertEquals(0, $info->getGroup());
        $this->assertEquals('dir', $info->getType());
        $this->assertEquals(10245134, $info->getInode());
        $this->assertEquals(160, $info->getSize());
        $this->assertEquals('remote_fs', $info->getFilename());
        $this->assertEquals('/tmp/remote_fs', $info->getPathname());
        $this->assertEquals('/tmp', $info->getPath());
        $this->assertEquals('remote_fs', $info->getBasename());
        $this->assertEquals('', $info->getExtension());
        $this->assertEquals('/tmp/remote_fs', $info->getRealPath());
        $this->assertEquals(-1, $info->getLinkTarget());
        $this->assertEquals(1560682188, $info->getATime());
        $this->assertEquals(1560682181, $info->getMTime());
        $this->assertEquals(1560682181, $info->getCTime());
        $this->assertFalse($info->isFile());
        $this->assertTrue($info->isDir());
        $this->assertFalse($info->isLink());
        $this->assertTrue($info->isReadable());
        $this->assertTrue($info->isWritable());
        $this->assertTrue($info->isExecutable());
    }

    protected function assertFileOutput(\SplFileInfo $info)
    {
        $this->assertEquals('0644', $info->getPerms());
        $this->assertEquals(0, $info->getOwner());
        $this->assertEquals(0, $info->getGroup());
        $this->assertEquals('file', $info->getType());
        $this->assertEquals(10269956, $info->getInode());
        $this->assertEquals(1210, $info->getSize());
        $this->assertEquals('test.txt', $info->getFilename());
        $this->assertEquals('/tmp/remote_fs/test.txt', $info->getPathname());
        $this->assertEquals('/tmp/remote_fs', $info->getPath());
        $this->assertEquals('test.txt', $info->getBasename());
        $this->assertEquals('txt', $info->getExtension());
        $this->assertEquals('/tmp/remote_fs/test.txt', $info->getRealPath());
        $this->assertEquals(-1, $info->getLinkTarget());
        $this->assertEquals(1560682162, $info->getATime());
        $this->assertEquals(1560682181, $info->getMTime());
        $this->assertEquals(1560682181, $info->getCTime());
        $this->assertTrue($info->isFile());
        $this->assertFalse($info->isDir());
        $this->assertFalse($info->isLink());
        $this->assertTrue($info->isReadable());
        $this->assertTrue($info->isWritable());
        $this->assertFalse($info->isExecutable());
    }

    protected function assertLinkResolvedFileOutput(\SplFileInfo $info)
    {
        $this->assertEquals('0644', $info->getPerms());
        $this->assertEquals(0, $info->getOwner());
        $this->assertEquals(0, $info->getGroup());
        $this->assertEquals('file', $info->getType());
        $this->assertEquals(10269956, $info->getInode());
        $this->assertEquals(1210, $info->getSize());
        $this->assertEquals('test_link.txt', $info->getFilename());
        $this->assertEquals('/tmp/remote_fs/test_link.txt', $info->getPathname());
        $this->assertEquals('/tmp/remote_fs', $info->getPath());
        $this->assertEquals('test_link.txt', $info->getBasename());
        $this->assertEquals('txt', $info->getExtension());
        $this->assertEquals('/tmp/remote_fs/test_link.txt', $info->getRealPath());
        $this->assertEquals(-1, $info->getLinkTarget());
        $this->assertEquals(1560682162, $info->getATime());
        $this->assertEquals(1560682181, $info->getMTime());
        $this->assertEquals(1560682181, $info->getCTime());
        $this->assertTrue($info->isFile());
        $this->assertFalse($info->isDir());
        $this->assertFalse($info->isLink());
        $this->assertTrue($info->isReadable());
        $this->assertTrue($info->isWritable());
        $this->assertFalse($info->isExecutable());
    }
}
