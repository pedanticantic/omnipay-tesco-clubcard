<?php

namespace DigiTickets\TescoClubcard;

use DigiTickets\TescoClubcard\Messages\Ireland\Omnipay\AuthorizeRequest;
use DigiTickets\TescoClubcard\Messages\Ireland\Omnipay\PurchaseRequest;
use DigiTickets\TescoClubcard\Messages\Ireland\Omnipay\RefundRequest;
use DigiTickets\TescoClubcard\Messages\Ireland\Voucher\RedeemRequest;
use DigiTickets\TescoClubcard\Messages\Ireland\Voucher\UnredeemRequest;
use DigiTickets\TescoClubcard\Messages\Ireland\Voucher\ValidateRequest;
use Omnipay\Common\Message\AbstractRequest;

class IrelandGateway extends AbstractTescoClubcardGateway
{
    public function getName()
    {
        return 'Tesco Clubcard Boost';
    }

    public function authorize(array $parameters = array())
    {
error_log('Generating an authorize request');
        $parameters['validateRequest'] = $this->validate($parameters);
        return $this->createRequest(AuthorizeRequest::class, $parameters);
    }

    public function purchase(array $parameters = array())
    {
        $parameters['validateRequest'] = $this->validate($parameters);
        $parameters['redeemRequest'] = $this->redeem($parameters);
        return $this->createRequest(PurchaseRequest::class, $parameters);
    }

    public function refund(array $parameters = array())
    {
        $parameters['unredeemRequest'] = $this->unredeem($parameters);
        return $this->createRequest(RefundRequest::class, $parameters);
    }

    /**
     * @param array $parameters
     * @return AbstractRequest
     */
    public function validate(array $parameters = array())
    {
error_log('Generating a validate request');
        $parameters['gateway'] = $this;
        return $this->createRequest(ValidateRequest::class, $parameters);
    }

    /**
     * @param array $parameters
     * @return AbstractRequest
     */
    public function redeem(array $parameters = array())
    {
        $parameters['gateway'] = $this;
        return $this->createRequest(RedeemRequest::class, $parameters);
    }

    /**
     * @param array $parameters
     * @return AbstractRequest
     */
    public function unredeem(array $parameters = array())
    {
        $parameters['gateway'] = $this;
        return $this->createRequest(UnredeemRequest::class, $parameters);
    }
}
