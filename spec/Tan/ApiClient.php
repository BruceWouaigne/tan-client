<?php

namespace spec\Tan;

use PHPSpec2\ObjectBehavior;

class ApiClient extends ObjectBehavior
{
    /**
     * @param Tan\Hydrator\ObjectHydrator  $hydrator
     * @param Tan\Http\Transporter         $transporter
     * @param Guzzle\Http\Message\Request  $request
     * @param Guzzle\Http\Message\Response $response
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

    function its_getStopList_should_return_an_array($hydrator, $response)
    {
        $stops = array(array(
            'codeLieu' => 'commerce',
            'libelle'  => 'Commerce',
            'distance' => null,
            'ligne'    => array(
                array('numLigne' => '51'),
                array('numLigne' => '54')
            )
        ));

        $hydrator->hydrateFromResponse($response)->willReturn($stops);

        $this->getStopList()->shouldReturn($stops);
    }

    function its_getWaitingTime_should_return_an_array($hydrator, $response)
    {
        $times = array(array(
            'sens'       => 1,
            'terminus'   => 'Orvault Grandval',
            'infotrafic' => false,
            'temps'      => '3\'',
            'ligne'      => array(
                'numLigne'  => '2',
                'typeLigne' => 1
            ),
            'arret'      => array(
                'codeArret' => 'recteurshmidt'
            )
        ));

        $hydrator->hydrateFromResponse($response)->willReturn($times);

        $this->getWaitingTime(ANY_ARGUMENT)->shouldReturn($times);
    }
}
