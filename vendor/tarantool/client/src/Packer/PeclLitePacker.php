<?php

namespace Tarantool\Packer;

use Tarantool\Exception\Exception;
use Tarantool\IProto;
use Tarantool\Request\Request;
use Tarantool\Response;

class PeclLitePacker implements Packer
{
    /**
     * {@inheritdoc}
     */
    public function pack(Request $request, $sync = null)
    {
        // @see https://github.com/msgpack/msgpack-php/issues/45
        $content = pack('C*', 0x82, IProto::CODE, $request->getType(), IProto::SYNC);
        $content .= msgpack_pack((int) $sync);

        if (null !== $body = $request->getBody()) {
            $content .= msgpack_pack($body);
        }

        return PackUtils::packLength(strlen($content)).$content;
    }

    /**
     * {@inheritdoc}
     */
    public function unpack($data)
    {
        $headerSize = PackUtils::getHeaderSize($data);

        if (!$header = substr($data, 0, $headerSize)) {
            throw new Exception('Unable to unpack data.');
        }

        $header = msgpack_unpack($header);
        if (!is_array($header)) {
            throw new Exception('Unable to unpack data.');
        }

        $code = $header[IProto::CODE];

        $body = substr($data, $headerSize);
        $body = msgpack_unpack($body);

        if ($code >= Request::TYPE_ERROR) {
            throw new Exception($body[IProto::ERROR], $code & (Request::TYPE_ERROR - 1));
        }

        return new Response($header[IProto::SYNC], $body ? $body[IProto::DATA] : null);
    }
}
