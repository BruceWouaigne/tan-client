<?php

namespace spec\Tan;

use PHPSpec2\ObjectBehavior;

class ApiClient extends ObjectBehavior
{
    /**
     * @param Tan\Hydrator\ObjectHydrator $hydrator
     * @param Tan\Http\Transporter        $transporter
     * @param Guzzle\Message\Request      $request
     * @param Guzzle\Message\Response     $response
     */
    function let($httpClient, $hydrator, $transporter, $request, $response)
    {
        $this->beConstructedWith($httpClient, $hydrator, $transporter);

        $httpClient->get(ANY_ARGUMENTS)->willReturn($request);
        $transporter->send(ANY_ARGUMENT)->willReturn($response);
    }

    function it_should_be_initializable()
    {
        $this->shouldHaveType('Tan\ApiClient');
    }

    function its_getStopList_should_return_an_array($hydrator)
    {
        $stop = array(
            'codeLieu' => 'commerce',
            'libelle'  => 'Commerce',
            'distance' => null,
            'ligne'    => array(
                array('numLigne' => '51'),
                array('numLigne' => '54')
            )
        );

        $hydrator->hydrateFromResponse(ANY_ARGUMENT)->willReturn(array($stop));

        $this->getStopList()->shouldReturn($stop);
    }
}
