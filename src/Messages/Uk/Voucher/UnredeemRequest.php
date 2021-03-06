<?php

namespace DigiTickets\TescoClubcard\Messages\Uk\Voucher;

use DigiTickets\TescoClubcard\Messages\AbstractMessage;
use DigiTickets\TescoClubcard\Messages\Uk\Common\AbstractUkApiRequest;
use DigiTickets\TescoClubcard\Messages\Uk\Messages\UnredeemMessage;
use DigiTickets\TescoClubcard\Messages\Uk\Voucher\AbstractResponse;
use DigiTickets\TescoClubcard\Messages\Uk\Voucher\UnredeemResponse;

class UnredeemRequest extends AbstractUkApiRequest
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
