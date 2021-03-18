<?php

namespace App\Http\Controllers\PayGreenController;


use GuzzleHttp\Client;
use App\Http\Controllers\PayGreenController\Exceptions\NegativeAmountException;
use App\Http\Controllers\PayGreenController\Exceptions\NotSucceedException;
use App\Http\Controllers\PayGreenController\Exceptions\OrderIdMismatchException;
use App\Http\Controllers\PayGreenController\Exceptions\PaymentNotAvailableException;
use GuzzleHttp\Exception\GuzzleException;

class Payment
{
    /**
     * @var Client
     */
    protected Client $client;

    /**
     * @var array
     */
    protected array $paymentTypeAvailable = [];

    /**
     * Payment constructor.
     * @param string $id
     * @param string $secret
     * @param string $base_url
     */
    public function __construct(string $id, string $secret, string $base_url)
    {
        $this->client = new Client([
            "base_uri" => "{$base_url}/api/{$id}/",
            "headers" => [
                "Accept" => "application/json",
                "Content-Type" => "application/json",
                "Authorization" => "Bearer {$secret}",
            ],
        ]);
    }

    protected function fillPaymentTypeAvailable()
    {
        $resp = $this->paymentType();
        foreach ($resp->data as $paymentType) {
            $this->paymentTypeAvailable[] = $paymentType->paymentType;
        }
    }

    /**
     * Get list of available payments
     * @return object
     * @throws GuzzleException
     */
    public function paymentType()
    {
        return \GuzzleHttp\json_decode($this->client->get("paymenttype")->getBody()->getContents());
    }

    /**
     * Create a new instant payment
     * @param string $orderId
     * @param int $amount
     * @param string $paymentType
     * @param string $returned_url
     * @param array $buyer
     * @param string $notified_url
     * @return object
     * @throws NegativeAmountException
     * @throws PaymentNotAvailableException|GuzzleException
     */
    public function createInstantPayment(string $orderId, int $amount, string $paymentType, string $returned_url, array $buyer, string $notified_url)
    {
        if (!in_array($paymentType, $this->getPaymentTypeAvailable())) {
            throw new PaymentNotAvailableException();
        }
        if ($amount <= 0) {
            throw new NegativeAmountException();
        }

        return \GuzzleHttp\json_decode($this->client->post("payins/transaction/cash", [
            "json" => [
                "orderId" => $orderId,
                "amount" => $amount,
                "currency" => "EUR",
                "paymentType" => $paymentType,
                "returned_url" => $returned_url,
                "notified_url" => $notified_url,
                "ttl" => "PT25M",
                "metadata" => [
                    "orderId" => $orderId,
                ],
                "buyer" => $buyer
            ]
        ])->getBody()->getContents());
    }

    /**
     * Confirmed a payment
     * @param string $pid
     * @param bool $isNotification
     * @return object
     * @throws NotSucceedException|GuzzleException
     */
    public function confirmPayment(string $pid, $isNotification = false)
    {
        $resp = \GuzzleHttp\json_decode($this->client->get("payins/transaction/{$pid}")
            ->getBody()->getContents());
        if (!$resp->success) {
            throw new NotSucceedException($resp->message);
        }
        return $resp->data;
    }

    /**
     * @return array
     */
    public function getPaymentTypeAvailable(): array
    {
        if (count($this->paymentTypeAvailable) === 0) {
            $this->fillPaymentTypeAvailable();
        }
        return $this->paymentTypeAvailable;
    }
}

