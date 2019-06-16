<?php

namespace PhuxtilTests\Functional\Find;

use PHPUnit\Framework\TestCase;
use Phuxtil\Find\FindConfigurator;
use Phuxtil\Find\FindFactory;
use Phuxtil\SplFileInfo\VirtualSplFileInfo;

class FindFacadeTest extends TestCase
{
    const FIND_OUTPUT = \TESTS_FIXTURE_DIR . 'list.txt';

    /**
     * @var \Phuxtil\Find\FindConfigurator
     */
    protected $configurator;

    /**
     * @var \Phuxtil\Find\FindFactory
     */
    protected $factory;

    protected function setUp()
    {
        $this->configurator = (new FindConfigurator())
            ->setLineDelimiter("\n");

        $this->factory = new FindFactory();
    }

    public function test_process()
    {
        $output = \file_get_contents(static::FIND_OUTPUT);
        $this->configurator->setFindOutput($output);
        $processor = $this->factory->createFormatOptionProcessor();

        $output = $processor->process($this->configurator);

        $dir = (new VirtualSplFileInfo($output[0]['pathname']))
            ->fromArray($output[0]);
        $file = (new VirtualSplFileInfo($output[1]['pathname']))
            ->fromArray($output[1]);
        $linkResolvedToFile = (new VirtualSplFileInfo($output[2]['pathname']))
            ->fromArray($output[2]);

        $this->assertDirectoryOutput($dir);
        $this->assertFileOutput($file);
        $this->assertLinkResolvedFileOutput($linkResolvedToFile);
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
