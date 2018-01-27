<?php

namespace DigiTickets\TescoClubcard\Messages\Ireland\Requests;

use DigiTickets\TescoClubcard\Messages\AbstractMessage;
use DigiTickets\TescoClubcard\Messages\Ireland\Responses\AbstractResponse;
use DigiTickets\TescoClubcard\Messages\Ireland\Responses\UnredeemResponse;
use DigiTickets\TescoClubcard\Messages\UnredeemMessage;

class UnredeemRequest extends AbstractRemoteRequest
{
    /**
     * @return AbstractMessage
     */
    protected function buildMessage()
    {
        return new UnredeemMessage($this->getVoucherCode());
    }

    /**
     * @param RequestInterface $request
     * @param mixed $response
     * @return AbstractResponse
     */
    protected function buildResponse($request, $response)
    {
        return new UnredeemResponse($request, $response);
    }
}