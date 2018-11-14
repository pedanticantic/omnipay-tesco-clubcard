<?php

namespace DigiTickets\TescoClubcard\Messages\Ireland\Omnipay;

use DigiTickets\TescoClubcard\Messages\Interfaces\AuthorizeResponseInterface;
use Omnipay\Common\Message\AbstractResponse;
use Omnipay\Common\Message\RequestInterface;

class AuthorizeResponseOld extends AbstractResponse implements AuthorizeResponseInterface
{
    /**
     * @var bool
     */
    private $successful = false;
    /**
     * @var string|null
     */
    protected $message = null;
    /**
     * @var string|null
     */
    protected $responseCode = null;
    /**
     * @var array
     */
    private $extraData = [];

    /**
     * Constructor
     *
     * @param RequestInterface $request the initiating request.
     * @param mixed $data
     * @param array $extraData
     */
    public function __construct(RequestInterface $request, $data, $extraData = [])
    {
        parent::__construct($request, $data);

        // If $data is a string, it means there's been an error; if it's an array, it's an array of voucher codes.
        $this->successful = is_array($this->data);
        if ($this->successful) {
            $this->data = $data; // An array of voucher codes and their values.
            $this->responseCode = 'Authorised';
            $this->message = $this->responseCode;
        } else {
            $this->data = [];
            $this->message = $data;
            $this->extraData = $extraData;
        }
    }

    /**
     * Is the response successful?
     *
     * @return boolean
     */
    public function isSuccessful()
    {
        return $this->successful;
    }

    /**
     * Response Message
     *
     * @return null|string A response message from the payment gateway
     */
    public function getMessage()
    {
        return $this->message;
    }

    /**
     * Response code
     *
     * @return null|string A response code from the payment gateway
     */
    public function getCode()
    {
        return $this->responseCode;
    }

    /**
     * Gateway Reference
     *
     * @return null|string A reference provided by the gateway to represent this transaction
     */
    public function getTransactionReference()
    {
        return json_encode($this->data);
    }

    public function getOversubscriptionData()
    {
        return $this->extraData;
    }
}
