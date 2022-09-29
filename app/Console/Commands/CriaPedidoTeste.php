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
    public function __construct(GeralRepositorie $geralR, GeralServices $geralS)
    {
        parent::__construct();
        $this->geralR = $geralR;
        $this->geralS = $geralS;
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $ptcs = ProdTamCor::take(3)->orderByRaw("RAND()")->get();
        $user = User::with(['enderecos', 'pedidos'])->where('perfil', 'cliente')->first();
dd($this->geralS->gera_numero_pedido());
        $pedido = $user->pedidos()->create([
            'valor_total' => 0,
            'status' => 'in',
            'numero_pedido' =>  $this->geralS->gera_numero_pedido(),
            'data' => now('America/Sao_Paulo')->format('Y-m-d H:i:s'),
            'endereco_id' => $user->enderecos[0]->id
        ]);

        foreach ($ptcs as $key => $v) {
            $pedido->pedido_itens()->create(['ptc_id' => $v->id, 'quantidade' => rand(1, 3)]);
        }
        $pedido->update(['valor_total' => $this->geralR->sum_pedido($pedido->id)]);
    }
}
