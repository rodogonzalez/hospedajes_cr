<?php

namespace App\Console\Commands;

use Customer;
use Illuminate\Console\Command;
use Order;
use Product;

class Woocomerce extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'woo:oh';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $productos = [
            ['nombre' => 'Leche', 'categoria' => "l\xc3\xa1cteos", 'precio' => 2.50],
            ['nombre' => 'Pan', 'categoria' => "panader\xc3\xada", 'precio' => 1.20],
            ['nombre' => 'Huevos', 'categoria' => "l\xc3\xa1cteos", 'precio' => 3.00],
            ['nombre' => 'Carne', 'categoria' => 'carnes', 'precio' => 8.50],
            ['nombre' => 'Pescado', 'categoria' => 'pescados', 'precio' => 10.00],
            ['nombre' => 'Frutas', 'categoria' => 'frutas', 'precio' => 4.50],
            ['nombre' => 'Verduras', 'categoria' => 'verduras', 'precio' => 3.00],
            ['nombre' => 'Arroz', 'categoria' => 'granos', 'precio' => 2.00],
            ['nombre' => 'Pasta', 'categoria' => 'granos', 'precio' => 2.50],
            ['nombre' => 'Aceite de oliva', 'categoria' => 'aceites', 'precio' => 6.50],
            ['nombre' => 'Aceite vegetal', 'categoria' => 'aceites', 'precio' => 3.50],
            ['nombre' => 'Mantequilla', 'categoria' => "l\xc3\xa1cteos", 'precio' => 3.20],
            ['nombre' => 'Queso', 'categoria' => "l\xc3\xa1cteos", 'precio' => 5.50],
            ['nombre' => 'Yogur', 'categoria' => "l\xc3\xa1cteos", 'precio' => 2.80],
            ['nombre' => 'Cereales', 'categoria' => 'cereales', 'precio' => 4.00],
            ['nombre' => 'Miel', 'categoria' => 'endulzantes', 'precio' => 6.00],
            ['nombre' => 'Mermelada', 'categoria' => 'endulzantes', 'precio' => 3.50],
            ['nombre' => "T\xc3\xa9", 'categoria' => 'bebidas', 'precio' => 4.00],
            ['nombre' => "Caf\xc3\xa9", 'categoria' => 'bebidas', 'precio' => 6.00],
            ['nombre' => "Az\xc3\xbacar", 'categoria' => 'endulzantes', 'precio' => 2.50],
            ['nombre' => 'Sal', 'categoria' => 'condimentos', 'precio' => 1.50],
            ['nombre' => 'Especias', 'categoria' => 'condimentos', 'precio' => 2.50],
            ['nombre' => 'Salsa de tomate', 'categoria' => 'salsas', 'precio' => 2.80],
            ['nombre' => 'Salsa de soja', 'categoria' => 'salsas', 'precio' => 3.50],
            ['nombre' => 'Vinagre', 'categoria' => 'condimentos', 'precio' => 2.00]
        ];

        foreach ($productos as $product) {
            $data = [
                'name'              => $product['nombre'],
                'type'              => 'simple',
                'regular_price'     => "{$product['precio']}",
                'description'       => '.',
                'short_description' => '.',
                'categories'        => [['id' => 1]],
            ];

            $product = Product::create($data);
        }

        $products = Product::all();

        foreach ($products as $product) {
            echo $product->permalink . "\n";
        }
        dd($product->store);

        echo ':)';

        return Command::SUCCESS;
    }
}
