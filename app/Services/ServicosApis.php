<?php

namespace App\Services;

use FlyingLuscas\Correios\Client;
use FlyingLuscas\Correios\Service;

class ServicosApis
{
    private $servicoApi;

    public function __construct(Client $cliente)
    {
        $this->servicoApi = $cliente;
    }

    public function service_calculo_correio()
    {
      return $this->servicoApi->freight()
            ->origin('01001-000') //De onde sai o pedido
            ->destination('87047-230') //Para onde vai
            ->services(Service::SEDEX, Service::PAC)
            ->item(16, 16, 16, .3, 1) // largura, altura, comprimento, peso e quantidade
            ->item(16, 16, 16, .3, 3) // largura, altura, comprimento, peso e quantidade
            ->item(16, 16, 16, .3, 2) // largura, altura, comprimento, peso e quantidade
            ->calculate();
    }
}
