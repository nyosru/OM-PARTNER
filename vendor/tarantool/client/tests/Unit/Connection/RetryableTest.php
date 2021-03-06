<?php

namespace Tarantool\Tests\Unit\Connection;

use Tarantool\Connection\Retryable;

class RetryableTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @var \Tarantool\Connection\Connection|\PHPUnit_Framework_MockObject_MockObject
     */
    private $wrappedConnection;

    /**
     * @var Retryable
     */
    private $connection;

    protected function setUp()
    {
        $this->wrappedConnection = $this->getMock('Tarantool\Connection\Connection');
        $this->connection = new Retryable($this->wrappedConnection);
    }

    public function testOpen()
    {
        $this->wrappedConnection->expects($this->once())->method('open')
            ->will($this->returnValue('salt'));

        $this->assertSame('salt', $this->connection->open());
    }

    public function testClose()
    {
        $this->wrappedConnection->expects($this->once())->method('close');

        $this->connection->close();
    }

    public function testIsClosed()
    {
        $this->wrappedConnection->expects($this->exactly(2))->method('isClosed')
            ->will($this->onConsecutiveCalls(false, true));

        $this->assertFalse($this->connection->isClosed());
        $this->assertTrue($this->connection->isClosed());
    }

    public function testSend()
    {
        $this->wrappedConnection->expects($this->once())->method('send')
            ->with('request')
            ->will($this->returnValue('response'));

        $this->assertSame('response', $this->connection->send('request'));
    }

    public function testSuccessRetry()
    {
        $exception = $this->getMock('Tarantool\Exception\ConnectionException', ['getMessage']);

        $this->wrappedConnection->expects($this->exactly(3))->method('open')
            ->will($this->onConsecutiveCalls(
                $this->throwException($exception),
                $this->throwException($exception),
                'salt'
            ));

        $connection = new Retryable($this->wrappedConnection, 3);
        $this->assertSame('salt', $connection->open());
    }

    /**
     * @expectedException \Tarantool\Exception\ConnectionException
     */
    public function testThrowConnectionException()
    {
        $exception = $this->getMock('Tarantool\Exception\ConnectionException', ['getMessage']);

        $this->wrappedConnection->expects($this->exactly(3))->method('open')
            ->will($this->onConsecutiveCalls(
                $this->throwException($exception),
                $this->throwException($exception),
                $this->throwException($exception)
            ));

        $connection = new Retryable($this->wrappedConnection, 3);
        $connection->open();
    }

    /**
     * @expectedException \Exception
     * @expectedExceptionMessage foo
     */
    public function testThrowException()
    {
        $exception = new \Exception('foo');

        $this->wrappedConnection->expects($this->atLeastOnce())->method('open')
            ->will($this->onConsecutiveCalls(
                $this->throwException($exception),
                'salt'
            ));

        $connection = new Retryable($this->wrappedConnection, 2);
        $connection->open();
    }
}
