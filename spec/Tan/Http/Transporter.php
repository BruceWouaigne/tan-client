<?php

namespace spec\Tan\Http;

use PHPSpec2\ObjectBehavior;

class Transporter extends ObjectBehavior
{
    function it_should_be_initializable()
    {
        $this->shouldHaveType('Tan\Http\Transporter');
    }

    /**
     * @param Guzzle\Http\Message\Request  $request
     * @param Guzzle\Http\Message\Response $response
     */
    function its_send_should_return_response_on_success($request, $response)
    {
        $request->send()->willReturn($response);
        $this->send($request)->shouldReturnAnInstanceOf('Guzzle\Http\Message\Response');
    }

    /**
     * @param Guzzle\Http\Message\Request  $request
     * @param Guzzle\Http\Message\Response $response
     */
    function its_send_should_throw_an_exception_on_failure($request, $response)
    {
        $request->send()->willThrow(new \Exception('plop'));

        $this->shouldThrow(new \Exception('An error occured: plop'))->duringSend($request);
    }
}
