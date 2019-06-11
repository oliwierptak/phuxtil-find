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
        $optionProcessor = $this->factory->createFormatOptionProcessor();

        $output = $optionProcessor->process($input);

        $this->assertDirectoryOutput($output[0]);
        $this->assertLinkOutput($output[1]);
        $this->assertFileOutput($output[2]);
    }

    protected function assertDirectoryOutput($output)
    {
        $this->assertEquals('0755', $output['permissions']);
        $this->assertEquals('root', $output['user']);
        $this->assertEquals('root', $output['group']);
        $this->assertEquals(0, $output['uid']);
        $this->assertEquals(0, $output['gid']);
        $this->assertEquals('directory', $output['type']);
        $this->assertEquals(9979987, $output['inode']);
        $this->assertEquals(0, $output['blocks']);
        $this->assertEquals(128, $output['size']);
        $this->assertEquals(4, $output['links']);
        $this->assertEquals('remote_fs/', $output['filename']);
        $this->assertEquals('/tmp/remote_fs/', $output['filepath']);
        $this->assertEquals('/tmp', $output['path']);
        $this->assertEquals('remote_fs', $output['basename']);
        $this->assertEquals('', $output['extension']);
        $this->assertEquals('/tmp/remote_fs/', $output['realPath']);
        $this->assertEquals(1560119039, $output['aTime']);
        $this->assertEquals(1560110696, $output['mTime']);
        $this->assertEquals(1560110696, $output['cTime']);
        $this->assertFalse($output['file']);
        $this->assertTrue($output['dir']);
        $this->assertFalse($output['link']);
        $this->assertTrue($output['readable']);
        $this->assertTrue($output['writable']);
        $this->assertTrue($output['executable']);
    }

    protected function assertLinkOutput($output)
    {
        $this->assertEquals('0777', $output['permissions']);
        $this->assertEquals('root', $output['user']);
        $this->assertEquals('root', $output['group']);
        $this->assertEquals(0, $output['uid']);
        $this->assertEquals(0, $output['gid']);
        $this->assertEquals('link', $output['type']);
        $this->assertEquals(10004910, $output['inode']);
        $this->assertEquals(0, $output['blocks']);
        $this->assertEquals(8, $output['size']);
        $this->assertEquals(1, $output['links']);
        $this->assertEquals('foo.txt', $output['filename']);
        $this->assertEquals('/tmp/remote_fs/foo.txt', $output['filepath']);
        $this->assertEquals('/tmp/remote_fs', $output['path']);
        $this->assertEquals('foo.txt', $output['basename']);
        $this->assertEquals('txt', $output['extension']);
        $this->assertEquals('/tmp/remote_fs/foo.txt', $output['realPath']);
        $this->assertEquals(1560110696, $output['aTime']);
        $this->assertEquals(1560110696, $output['mTime']);
        $this->assertEquals(1560110696, $output['cTime']);
        $this->assertFalse($output['file']);
        $this->assertFalse($output['dir']);
        $this->assertTrue($output['link']);
        $this->assertTrue($output['readable']);
        $this->assertTrue($output['writable']);
        $this->assertTrue($output['executable']);
    }

    protected function assertFileOutput($output)
    {
        $this->assertEquals('0644', $output['permissions']);
        $this->assertEquals('root', $output['user']);
        $this->assertEquals('root', $output['group']);
        $this->assertEquals(0, $output['uid']);
        $this->assertEquals(0, $output['gid']);
        $this->assertEquals('file', $output['type']);
        $this->assertEquals(10001592, $output['inode']);
        $this->assertEquals(8, $output['blocks']);
        $this->assertEquals(60, $output['size']);
        $this->assertEquals(1, $output['links']);
        $this->assertEquals('test.txt', $output['filename']);
        $this->assertEquals('/tmp/remote_fs/test.txt', $output['filepath']);
        $this->assertEquals('/tmp/remote_fs', $output['path']);
        $this->assertEquals('test.txt', $output['basename']);
        $this->assertEquals('txt', $output['extension']);
        $this->assertEquals('/tmp/remote_fs/test.txt', $output['realPath']);
        $this->assertEquals(1560103169, $output['aTime']);
        $this->assertEquals(1560103177, $output['mTime']);
        $this->assertEquals(1560103177, $output['cTime']);
        $this->assertTrue($output['file']);
        $this->assertFalse($output['dir']);
        $this->assertFalse($output['link']);
        $this->assertTrue($output['readable']);
        $this->assertTrue($output['writable']);
        $this->assertFalse($output['executable']);
    }
}
