<?php

namespace Tarantool\Request;

use Tarantool\IProto;

class SelectRequest implements Request
{
    private $spaceId;
    private $indexId;
    private $key;
    private $offset;
    private $limit;
    private $iterator;

    public function __construct($spaceId, $indexId, array $key, $offset, $limit, $iterator)
    {
        $this->spaceId = $spaceId;
        $this->indexId = $indexId;
        $this->key = $key;
        $this->offset = $offset;
        $this->limit = $limit;
        $this->iterator = $iterator;
    }

    public function getType()
    {
        return self::TYPE_SELECT;
    }

    public function getBody()
    {
        return [
            IProto::KEY => $this->key,
            IProto::SPACE_ID => $this->spaceId,
            IProto::INDEX_ID => $this->indexId,
            IProto::LIMIT => $this->limit,
            IProto::OFFSET => $this->offset,
            IProto::ITERATOR => $this->iterator,
        ];
    }
}
