<?php 
namespace App\Services;

use App\Models\User;

require_once 'vendor/autoload.php';

class Pagamentos 
{
    private $acess_token;
    public function __construct()
    {
        $this->acess_token = User::find(auth()->user()->id)->access_token;
        MercadoPago\SDK::setAccessToken();
    }

    public function integracao_pagamento()
    {
        MercadoPago\SDK::setAccessToken($this->acess_token);

        $prefence = new MercadoPago\Preference();

    }
}