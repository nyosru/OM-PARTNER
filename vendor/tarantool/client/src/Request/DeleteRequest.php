<?php

namespace Tarantool\Request;

use Tarantool\IProto;

class DeleteRequest implements Request
{
    private $spaceId;
    private $indexId;
    private $key;

    public function __construct($spaceId, $indexId, array $key)
    {
        $this->spaceId = $spaceId;
        $this->indexId = $indexId;
        $this->key = $key;
    }

    public function getType()
    {
        return self::TYPE_DELETE;
    }

    public function getBody()
    {
        return [
            IProto::SPACE_ID => $this->spaceId,
            IProto::INDEX_ID => $this->indexId,
            IProto::KEY => $this->key,
        ];
    }
}
