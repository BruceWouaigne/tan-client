<?php

namespace Tan\Hydrator;

use Tan\Model\Object;
use Tan\Exception\HydratorException;
use Guzzle\Http\Message\Response;

class ObjectHydrator
{
    public function hydrateFromResponse(Response $response)
    {
        if ('text/html' === $response->getContentType()) {
            throw new HydratorException($response->getBody());
        }

        try {
            $datas = $response->json();
        } catch(\RuntimeException $ex) {
            throw new HydratorException('Unable to parse result');
        }

        return $datas;
    }
}
