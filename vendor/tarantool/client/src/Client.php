<?php

namespace Tarantool;

use Tarantool\Connection\Connection;
use Tarantool\Exception\Exception;
use Tarantool\Packer\Packer;
use Tarantool\Packer\PeclPacker;
use Tarantool\Request\AuthenticateRequest;
use Tarantool\Request\CallRequest;
use Tarantool\Request\EvaluateRequest;
use Tarantool\Request\PingRequest;
use Tarantool\Request\Request;
use Tarantool\Schema\Index;
use Tarantool\Schema\Space;

class Client
{
    private $connection;
    private $packer;
    private $salt;
    private $username;
    private $password;
    private $spaces = [];

    /**
     * @param Connection  $connection
     * @param Packer|null $packer
     */
    public function __construct(Connection $connection, Packer $packer = null)
    {
        $this->connection = $connection;
        $this->packer = $packer ?: new PeclPacker();
    }

    public function getConnection()
    {
        return $this->connection;
    }

    public function connect()
    {
        $this->salt = $this->connection->open();

        if ($this->username) {
            $this->authenticate($this->username, $this->password);
        }
    }

    public function disconnect()
    {
        $this->connection->close();
        $this->salt = null;
    }

    public function isDisconnected()
    {
        return $this->connection->isClosed() || !$this->salt;
    }

    public function authenticate($username, $password = null)
    {
        if ($this->isDisconnected()) {
            $this->salt = $this->connection->open();
        }

        $request = new AuthenticateRequest($this->salt, $username, $password);
        $response = $this->sendRequest($request);

        $this->username = $username;
        $this->password = $password;

        $this->flushSpaces();

        return $response;
    }

    public function ping()
    {
        $request = new PingRequest();

        return $this->sendRequest($request);
    }

    /**
     * @param string|int $space
     *
     * @return Space
     */
    public function getSpace($space)
    {
        if (isset($this->spaces[$space])) {
            return $this->spaces[$space];
        }

        if (!is_string($space)) {
            return $this->spaces[$space] = new Space($this, $space);
        }

        $spaceId = $this->getSpaceIdByName($space);

        return $this->spaces[$space] = $this->spaces[$spaceId] = new Space($this, $spaceId);
    }

    public function call($funcName, array $args = [])
    {
        $request = new CallRequest($funcName, $args);

        return $this->sendRequest($request);
    }

    public function evaluate($expr, array $args = [])
    {
        $request = new EvaluateRequest($expr, $args);

        return $this->sendRequest($request);
    }

    public function flushSpaces()
    {
        $this->spaces = [];
    }

    public function sendRequest(Request $request)
    {
        if ($this->connection->isClosed()) {
            $this->connect();
        }

        $data = $this->packer->pack($request);
        $data = $this->connection->send($data);

        return $this->packer->unpack($data);
    }

    private function getSpaceIdByName($spaceName)
    {
        $schema = new Space($this, Space::VSPACE);
        $response = $schema->select([$spaceName], Index::SPACE_NAME);
        $data = $response->getData();

        if (empty($data)) {
            throw new Exception("Space '$spaceName' does not exist");
        }

        return $data[0][0];
    }
}
