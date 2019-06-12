<?php

namespace PhuxtilTests\Functional\Find;

use PHPUnit\Framework\TestCase;
use Phuxtil\Find\FindFactory;

class FindFacadeTest extends TestCase
{
    const FIND_OUTPUT = \TESTS_FIXTURE_DIR . 'list.txt';

    /**
     * @var \Phuxtil\Find\FindFactory
     */
    protected $factory;

    protected function setUp()
    {
        $this->factory = new FindFactory();
    }

    public function test_process()
    {
        $input = \file_get_contents(static::FIND_OUTPUT);
        $processor = $this->factory->createFormatOptionProcessor();

        $output = $processor->process($input);

        $this->assertDirectoryOutput($output[0]);
        $this->assertLinkOutput($output[1]);
        $this->assertFileOutput($output[2]);
    }

    protected function assertDirectoryOutput(\SplFileInfo $info)
    {
        $this->assertEquals('0755', $info->getPerms());
        $this->assertEquals(0, $info->getOwner());
        $this->assertEquals(0, $info->getGroup());
        $this->assertEquals('directory', $info->getType());
        $this->assertEquals(9979987, $info->getInode());
        $this->assertEquals(128, $info->getSize());
        $this->assertEquals('remote_fs', $info->getFilename());
        $this->assertEquals('/tmp/remote_fs', $info->getPathname());
        $this->assertEquals('/tmp', $info->getPath());
        $this->assertEquals('remote_fs', $info->getBasename());
        $this->assertEquals('', $info->getExtension());
        $this->assertEquals('/tmp/remote_fs', $info->getRealPath());
        $this->assertEquals(1560119039, $info->getATime());
        $this->assertEquals(1560110696, $info->getMTime());
        $this->assertEquals(1560110696, $info->getCTime());
        $this->assertFalse($info->isFile());
        $this->assertTrue($info->isDir());
        $this->assertFalse($info->isLink());
        $this->assertTrue($info->isReadable());
        $this->assertTrue($info->isWritable());
        $this->assertTrue($info->isExecutable());
    }

    protected function assertLinkOutput(\SplFileInfo $info)
    {
        $this->assertEquals('0777', $info->getPerms());
        $this->assertEquals(0, $info->getOwner());
        $this->assertEquals(0, $info->getGroup());
        $this->assertEquals('link', $info->getType());
        $this->assertEquals(10004910, $info->getInode());
        $this->assertEquals(8, $info->getSize());
        $this->assertEquals('foo.txt', $info->getFilename());
        $this->assertEquals('/tmp/remote_fs/foo.txt', $info->getPathname());
        $this->assertEquals('/tmp/remote_fs', $info->getPath());
        $this->assertEquals('foo.txt', $info->getBasename());
        $this->assertEquals('txt', $info->getExtension());
        $this->assertEquals('/tmp/remote_fs/test.txt', $info->getRealPath());
        $this->assertEquals(1560110696, $info->getATime());
        $this->assertEquals(1560110696, $info->getMTime());
        $this->assertEquals(1560110696, $info->getCTime());
        $this->assertFalse($info->isFile());
        $this->assertFalse($info->isDir());
        $this->assertTrue($info->isLink());
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
        $this->assertEquals(10001592, $info->getInode());
        $this->assertEquals(60, $info->getSize());
        $this->assertEquals('test.txt', $info->getFilename());
        $this->assertEquals('/tmp/remote_fs/test.txt', $info->getPathname());
        $this->assertEquals('/tmp/remote_fs', $info->getPath());
        $this->assertEquals('test.txt', $info->getBasename());
        $this->assertEquals('txt', $info->getExtension());
        $this->assertEquals('/tmp/remote_fs/test.txt', $info->getRealPath());
        $this->assertEquals(1560103169, $info->getATime());
        $this->assertEquals(1560103177, $info->getMTime());
        $this->assertEquals(1560103177, $info->getCTime());
        $this->assertTrue($info->isFile());
        $this->assertFalse($info->isDir());
        $this->assertFalse($info->isLink());
        $this->assertTrue($info->isReadable());
        $this->assertTrue($info->isWritable());
        $this->assertFalse($info->isExecutable());
    }
}
