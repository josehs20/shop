<?php

namespace App\Console\Commands;

use App\Models\Pedido;
use App\Services\Correios;
use Illuminate\Console\Command;

class AtualizaStatusCorreioCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'atualiza-status:pedido';

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
        Pedido::whereNotNull('codRastreio')->get()->map(function ($p){
            $response = Correios::rastreio($p->codRastreio);
            print_r($response['objetos'][0]);
            if (count($response['objetos'][0]['eventos']) > 0) {
               $p->update(['status'=> 'acm']);
            }
        });
       
    }
}
