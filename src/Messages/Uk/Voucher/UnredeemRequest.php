<?php

namespace DigiTickets\TescoClubcard\Messages\Uk\Voucher;

use DigiTickets\TescoClubcard\Messages\AbstractMessage;
use DigiTickets\TescoClubcard\Messages\Uk\Common\AbstractApiRequest;
use DigiTickets\TescoClubcard\Messages\Uk\Voucher\AbstractResponse;
use DigiTickets\TescoClubcard\Messages\Uk\Voucher\UnredeemResponse;
use DigiTickets\TescoClubcard\Messages\UnredeemMessage;

class UnredeemRequest extends AbstractApiRequest
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

    protected function getListenerAction(): string
    {
        return 'UnredeemRequestSend';
    }
}