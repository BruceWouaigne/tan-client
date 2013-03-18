<?php

namespace Tan;

use Guzzle\Http\Client;
use Tan\Hydrator\ObjectHydrator;
use Tan\Http\Transporter;

class ApiClient
{
    protected $httpClient;
    protected $hydrator;
    protected $transporter;

    public function __construct(Client $httpClient = null, ObjectHydrator $hydrator = null, Transporter $transporter = null)
    {
        if (null === $httpClient) {
            $this->httpClient = new Client('https://open.tan.fr/ewp');
        } else {
            $this->httpClient = $httpClient;
        }

        if (null === $hydrator) {
            $this->hydrator = new ObjectHydrator;
        } else {
            $this->hydrator = $hydrator;
        }

        if (null === $transporter) {
            $this->transporter = new Transporter;
        } else {
            $this->transporter = $transporter;
        }
    }

    public function getStopList($lon = null, $lat = null)
    {
        $url = 'arrets.json';

        if (null !== $lon && null !== $lat) {
            $url = sprintf('%s/%s/%s', $url, $lon, $lat);
        }

        $request  = $this->httpClient->get($url);
        $response = $this->transporter->send($request);

        return $this->hydrator->hydrateFromResponse($response);
    }

    public function getWaitingTime($locationCode)
    {
        $request  = $this->httpClient->get(sprintf('tempsattente.json/%s', $locationCode));
        $response = $this->transporter->send($request);

        return $this->hydrator->hydrateFromResponse($response);
    }

    public function getWaitingTimeAtStop($locationCode, $lineCode, $direction)
    {
        $url      = sprintf('horairesarret.json/%s/%s/%d', $locationCode, $lineCode, $direction);
        $request  = $this->httpClient->get($url);
        $response = $this->transporter->send($request);

        return $this->hydrator->hydrateFromResponse($response, false);
    }
}
