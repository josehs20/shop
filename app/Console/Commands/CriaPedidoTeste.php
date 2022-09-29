<?php

namespace App\Console\Commands;

use App\Models\Pedido;
use App\Models\PedidoItem;
use App\Models\ProdTamCor;
use App\Models\User;
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
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $ptcs = ProdTamCor::take(5)->orderByRaw("RAND()")->get();
        $user = User::with(['enderecos', 'pedidos'])->where('perfil', 'cliente')->first();

        $pedido = $user->pedidos()->create([
            'valor_total' => 0,
            'status' => 'in',
            'data' => now('America/Sao_Paulo')->format('Y-m-d H:i:m'),
            'endereco_id' => $user->enderecos[0]->id
        ]);

        foreach ($ptcs as $key => $v) {
            $pedido->pedido_itens()->create(['ptc_id' => $v->id, 'quantidade' => rand(1, 5)]);
        }
        $itens = PedidoItem::with('ptc')->where('pedido_id', $pedido->id)->get();
        echo $itens;
    }
}
