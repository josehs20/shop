<?php

if (!function_exists('string')) {

    /**
     * description
     *
     * @param
     * @return
     */
    function formata_status($status)
    {
        switch ($status) {
            case 'crr':
                return 'Carrinho';
                break;
            case 'agp':
                return 'Aguardando pagamento';
                break;
            case 'pgr':
                return 'Pagamento realizado';
                break;
            case 'age':
                return 'Aguardando envio';
                break;
            case 'acm':
                return 'A caminho';
                break;
            case 'etr':
                return 'Entregue';
                break;
            default:
                break;
        }
    }
}
