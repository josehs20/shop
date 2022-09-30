<?php

namespace App\Console\Commands;

use App\Models\Pedido;
use App\Models\PedidoItem;
use App\Models\ProdTamCor;
use App\Models\User;
use App\Repositories\GeralRepositorie;
use App\Services\GeralServices;
use Illuminate\Console\Command;

class CriaPedidoTeste extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'criaPedido:teste';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct(GeralServices $geralS)
    {
        parent::__construct();
        // $this->geralR = $geralR;
        // $this->geralS = $geralS;
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $ptcs = ProdTamCor::take(4)->orderByRaw("RAND()")->get();
        $user = User::with(['enderecos', 'pedidos'])->where('perfil', 'cliente')->first();
        $enderecos = $user->enderecos()->get('id')->map(function ($v){return $v->id;})->toArray();
        
        for ($i=0; $i < 100; $i++) { 
            $status = ['age', 'acm', 'etr', 'pgr'];
            //embralaha status e enderecos
            shuffle($status);
            shuffle($enderecos);
            
            $data = date_create('2022-0'.rand(1, 9).'-'.rand(10, 30));
        
            $pedido = $user->pedidos()->create([
                'valor_total' => 0,
                'status' => $status[0],
                'numero_pedido' =>  $this->geralS->gera_numero_pedido(),
                'data' => $data->format('Y-m-d H:i:s'),//now('America/Sao_Paulo')->format('Y-m-d H:i:s'),
                'endereco_id' => $enderecos[0]
            ]);
    
            foreach ($ptcs as $key => $v) {
                $pedido->pedido_itens()->create(['ptc_id' => $v->id, 'quantidade' => rand(1, 3)]);
            }
            $geralR = new GeralRepositorie();
            $pedido->update(['valor_total' => $geralR->sum_pedido($pedido->id)]);//$this->geralR->sum_pedido($pedido->id)]);
        }

    }
}
