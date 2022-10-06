<?php

namespace App\Services;

use App\Models\User;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Fluent;

class Correios
{

    const SERVICO_SEDEX = '40010';
    const SERVICO_PAC = '41106';
    const CAIXA_PACOTE = '1';

    const URL_BASE = 'http://ws.correios.com.br/calculador/CalcPrecoPrazo.aspx?';

    /**
     * @param array $codServicos
     * @param string $cepDestino
     * @param integer $formato
     * @param array $medidas
     * @param boolean $maoPropia
     * @param integer $valorDeclarado
     * @param integer $avisoRecebimento
     * @return object

     */

    static function calcular_frete($pedido)
    {
        $cepOrigem = User::find(1)->enderecos()->first()->cep;
        $parans = self::parans_calculo_frete($pedido);

        $paransUrl = [
            'sCepOrigem' => $cepOrigem,
            'sCepDestino' => $parans['cepDestino'],
            'nCdFormato' => $parans['formato'],
            'nVlPeso' => $parans['medidas']['peso'],
            'nVlAltura' => $parans['medidas']['altura'],
            'nVlLargura' => $parans['medidas']['largura'],
            'nVlComprimento' => $parans['medidas']['comprimento'],
            'sCdMaoPropria' => 'n',
            'nVlValorDeclarado' => 0,
            'sCdAvisoRecebimento' => 'n',
            'nVlDiametro' => 0,
            'StrRetorno' => 'xml',
            // 'nIndicaCalculo' => '3'
        ];
        $paransUrlSedex = $paransUrl;
        $paransUrlPac = $paransUrl;

        $paransUrlSedex['nCdServico'] = $parans['codServicos']['sedex'];
        $paransUrlPac['nCdServico'] = $parans['codServicos']['pac'];
        $paransUrl = ['sedex' => $paransUrlSedex, 'pac' => $paransUrlPac];
        //INICIA O CURL
        $curl = curl_init();
        //faz a consulta para pc e sedex
        foreach ($paransUrl as $key => $parans) {
            //FORMATA URL
            $url = self::URL_BASE . http_build_query($parans);
            //CONFIGURA O CURL
            curl_setopt_array($curl, [
                CURLOPT_URL => $url,
                CURLOPT_RETURNTRANSFER => true,
                CURLOPT_CUSTOMREQUEST => 'GET'
            ]);
            //EXECUTA A CONSULTA E RETORNA UM OBJETO DO XML
            $response[$key] = curl_exec($curl);
            $response[$key] = strlen($response[$key]) ? simplexml_load_string($response[$key])->cServico : null;
        }
        //FECHA A CONEXAO DOC URL
        curl_close($curl);
        return $response;
    }

    public function parans_calculo_frete($pedido)
    {
        $codServicos = ['pac' => Correios::SERVICO_PAC, 'sedex' => Correios::SERVICO_SEDEX];
        $formato = Correios::CAIXA_PACOTE;
        $cepDestino = $pedido->endereco->cep;
        $altura = 0;
        $largura = 0;
        $comprimento = 0;
        $peso = 0;
        if ($pedido->pedido_itens) {
            foreach ($pedido->pedido_itens as $key => $item) {
                $altura += $item->ptc->produto->categoriaProduto->altura;
                $largura = $largura < $item->ptc->produto->categoriaProduto->largura ? $item->ptc->produto->categoriaProduto->largura : $largura;
                $comprimento = $comprimento < $item->ptc->produto->categoriaProduto->comprimento ? $item->ptc->produto->categoriaProduto->comprimento : $comprimento;
                $peso += $item->ptc->produto->categoriaProduto->peso;
            }
        }
        $medidas = ['altura' => $altura, 'largura' => (float) $largura, 'comprimento' => (float) $comprimento, 'peso' => $peso];
        return [
            'codServicos' => $codServicos,
            'formato' => $formato,
            'cepDestino' => $cepDestino,
            'medidas' => $medidas
        ];
    }
}
