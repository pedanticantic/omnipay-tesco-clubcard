<?php

namespace DigiTickets\TescoClubcard\Messages\Ireland\Omnipay;

use DigiTickets\TescoClubcard\Messages\Ireland\Omnipay\PurchaseResponse;
use DigiTickets\TescoClubcard\Messages\Ireland\Voucher\RedeemResponse;

/**
 * Purchase request does everything that AuthorizeRequest does, plus if it's successful, it actually
 * redeems the vouchers.
 */
class PurchaseRequestOld extends AuthorizeRequestZzz
{
    /**
     * @var RedeemRequest
     */
    private $redeemRequest;

    /**
     * Store the instance of the redeem request, which we'll use to redeem each voucher.
     * @param $redeemRequest
     */
    public function setRedeemRequest($redeemRequest)
    {
        $this->redeemRequest = $redeemRequest;
    }

    public function sendData($data)
    {
        // Do all the authorisation stuff.
        $authorizeResponse = parent::sendData($data);

error_log('We are now in pruch request...');
        // If authorisation was successful, actually redeem the vouchers.
        if (!$authorizeResponse->isSuccessful()) {
            return new PurchaseResponse($this, 'Authorization failed: '.$authorizeResponse->getMessage());
        }

        foreach ($data as $voucherCode) {
            $redeemRequest = clone $this->redeemRequest;
            $redeemRequest->setVoucherCode($voucherCode);
//            /** @var RedeemResponse $response */
//            $response = $redeemRequest->send();
//            if (!$response->success()) {
                return new PurchaseResponse($this, 'Failed to redeem all the vouchers');
//            }
        }

        $purchaseResponse = new PurchaseResponse($this, $authorizeResponse->getData());

        return $purchaseResponse;
    }
}
