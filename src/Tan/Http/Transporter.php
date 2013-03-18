<?php

namespace Tan\Http;

use Guzzle\Http\Message\Request;
use Tan\Exception\TransportException;

class Transporter
{
    public function send(Request $request)
    {
        try {
            return $request->send();
        } catch (\Exception $ex) {
            throw new TransportException(sprintf('An error occured: %s', $ex->getMessage()));
        }
    }
}
