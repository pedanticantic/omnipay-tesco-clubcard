<?php

namespace DigiTickets\Integration\TescoClubcard\Api\Responses\Rewards;

use DigiTickets\Integration\TescoClubcard\Api\Responses\Interfaces\RedeemResponseInterface;

class RedeemResponse extends AbstractResponse implements RedeemResponseInterface
{
    protected function getSuccessStatusCode(): string
    {
        return ''; // @TODO: Finish this.
    }

    public function success(): bool
    {
        return false; // @TODO: Needs finishing
    }

    /**
     * @return string|null
     */
    public function getErrorMessage()
    {
        return 'Has not been implemented yet';
    }
}
