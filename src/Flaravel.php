<?php

namespace Shadracnicholas\Flaravel;

use Illuminate\Support\Facades\Http;
use Shadracnicholas\Flaravel\Helpers\Banks;
use Shadracnicholas\Flaravel\Helpers\Beneficiary;
use Shadracnicholas\Flaravel\Helpers\Payments;
use Shadracnicholas\Flaravel\Helpers\Transfers;
use Shadracnicholas\Flaravel\Helpers\Verification;
use Shadracnicholas\Flaravel\Helpers\Subaccount;

class Flaravel
{
    protected $publicKey;
    protected $secretKey;
    protected $baseUrl;

    /**
     * Construct
     */
    function __construct()
    {

        $this->publicKey = config('flaravel.publicKey');
        $this->secretKey = config('flaravel.secretKey');
        $this->secretHash = config('flaravel.secretHash');
        $this->encryptionKey = config('flaravel.encryptionKey');
        $this->baseUrl = 'https://api.flutterwave.com/v3';
    }


    /**
     * Generates a unique reference
     * @param $transactionPrefix
     * @return string
     */

    public function generateReference(String $transactionPrefix = NULL)
    {
        if ($transactionPrefix) {
            return $transactionPrefix . '_' . uniqid(time());
        }
        return 'flw_' . uniqid(time());
    }

    /**
     * Reaches out to Flutterwave to initialize a payment
     * @param $data
     * @return object
     */
    public function initializePayment(array $data)
    {

        $payment = Http::withToken($this->secretKey)->post(
            $this->baseUrl . '/payments',
            $data
        )->json();

        return $payment;
    }


    /**
     * Gets a transaction ID depending on the redirect structure
     * @return string
     */
    public function getTransactionIDFromCallback()
    {
        $transactionID = request()->transaction_id;

        if (!$transactionID) {
            $transactionID = json_decode(request()->resp)->data->id;
        }

        return $transactionID;
    }

    /**
     * Reaches out to Flutterwave to validate a charge
     * @param $data
     * @return object
     */
    public function validateCharge(array $data)
    {

        $payment = Http::withToken($this->secretKey)->post(
            $this->baseUrl . '/validate-charge',
            $data
        )->json();

        return $payment;
    }

    /**
     * Reaches out to Flutterwave to verify a transaction
     * @param $id
     * @return object
     */
    public function verifyTransaction($id)
    {
        $data =  Http::withToken($this->secretKey)->get($this->baseUrl . "/transactions/" . $id . '/verify')->json();
        return $data;
    }

    /**
     * Confirms webhook `verifi-hash` is the same as the environment variable
     * @param $data
     * @return boolean
     */
    public function verifyWebhook()
    {
        // Process Webhook https://developer.flutterwave.com/reference#webhook
        if (request()->header('verif-hash')) {
            // get input and verify paystack signature
            $flutterwaveSignature = request()->header('verif-hash');

            // confirm the signature is right
            if ($flutterwaveSignature == $this->secretHash) {
                return true;
            }
        }
        return false;
    }

    /**
     * Payments
     * @return Payments
     */
    public function payments()
    {
        $payments = new Payments($this->publicKey, $this->secretKey, $this->baseUrl, $this->encryptionKey);
        return $payments;
    }

    /**
     * Banks
     * @return Banks
     */
    public function banks()
    {
        $banks = new Banks($this->publicKey, $this->secretKey, $this->baseUrl);
        return $banks;
    }

    /**
     * Transfers
     * @return Transfers
     */
    public function transfers()
    {
        $transfers = new Transfers($this->publicKey, $this->secretKey, $this->baseUrl);
        return $transfers;
    }

    /**
     * Beneficiary
     * @return Beneficiary
     */
    public function beneficiaries()
    {
        $beneficiary = new Beneficiary($this->publicKey, $this->secretKey, $this->baseUrl);
        return $beneficiary;
    }

      /**
     * Verification
     * @return Verification
     */
    public function verification()
    {
        $verification = new Verification($this->publicKey, $this->secretKey, $this->baseUrl);
        return $verification;
    }

    /**
     * Subaccounts
     * @return Subaccount
     */
    public function subaccounts()
    {
        $subaccount = new Subaccount($this->publicKey, $this->secretKey, $this->baseUrl);
        return $subaccount;
    }
}
