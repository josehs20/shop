<?php

namespace App\Services;

use App\Models\User;
use Illuminate\Http\Request;

require_once 'vendor/autoload.php';

class Pagamentos
{
    private $access_token;
    public function __construct()
    {
        $this->access_token = User::find(auth()->user()->id)->access_token;
    }

    public function integracao_pagamento(Request $request)
    {
        MercadoPago\SDK::setAccessToken($this->access_token);

        $payment = new MercadoPago\Payment();
        $payment->transaction_amount = (float)$_POST['transactionAmount'];
        $payment->token = $request->token;
        $payment->description = $request->description;
        $payment->installments = (int)$request->installments;
        $payment->payment_method_id = $request->paymentMethodId;
        $payment->issuer_id = (int)$request->issuer;

        $payer = new MercadoPago\Payer();
        $payer->email = $request->email;
        $payer->identification = array(
            "type" => $request->identificationType,
            "number" => $request->identificationNumber
        );
        $payment->payer = $payer;

        $payment->save();

        $response = array(
            'status' => $payment->status,
            'status_detail' => $payment->status_detail,
            'id' => $payment->id
        );

        echo json_encode($response);
    }
}
