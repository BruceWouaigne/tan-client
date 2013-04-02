<?php

namespace spec\Tan\Hydrator;

use PHPSpec2\ObjectBehavior;

class ObjectHydrator extends ObjectBehavior
{
    function it_should_be_initializable()
    {
        $this->shouldHaveType('Tan\Hydrator\ObjectHydrator');
    }

    /**
     * @param Guzzle\Http\Message\Response $response
     */
    function its_hydrateFromResponse_should_return_an_array($response)
    {
        $response->getContentType()->willReturn('application/json');
        $response->json()->willReturn(array());

        $this->hydrateFromResponse($response)->shouldReturn(array());
    }

    /**
     * @param Guzzle\Http\Message\Response $response
     */
    function its_hydrateFromResponse_should_throw_an_exception_on_error($response)
    {
        $response->getContentType()->willReturn('text/html');
        $response->getBody()->willReturn('plop');

        $this->shouldThrow(new \Tan\Exception\HydratorException('plop'));

        $response->getContentType()->willReturn('application/json');
        $response->json()->willThrow(new \RuntimeException('plop'));

        $this->shouldThrow(new \Tan\Exception\HydratorException('Unable to parse result: plop'));
    }
}
