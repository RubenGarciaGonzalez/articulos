<?php

use Illuminate\Database\Seeder;
use App\Articulo;
use Illuminate\Support\Facades\DB;

class ArticuloSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        Articulo::create([
            'nombre'=>'Xiaomi Mi 9T',
            'categoria'=>'Electrónica',
            'precio'=>'245',
            'stock'=>'15'
        ]);

        Articulo::create([
            'nombre'=>'Silla Madera',
            'categoria'=>'Hogar',
            'precio'=>'45',
            'stock'=>'159'
        ]);

        Articulo::create([
            'nombre'=>'Crema Solar Nivea',
            'categoria'=>'Bazar',
            'precio'=>'8',
            'stock'=>'21'
        ]);

        Articulo::create([
            'nombre'=>'Portatil Mac 13´',
            'categoria'=>'Electrónica',
            'precio'=>'1300',
            'stock'=>'3'
        ]);

        Articulo::create([
            'nombre'=>'Mesa Moderna',
            'categoria'=>'Hogar',
            'precio'=>'120',
            'stock'=>'23'
        ]);

        Articulo::create([
            'nombre'=>'Pelota de playa',
            'categoria'=>'Bazar',
            'precio'=>'2',
            'stock'=>'1'
        ]);

        Articulo::create([
            'nombre'=>'Samsung Galaxy Watch',
            'categoria'=>'Electrónica',
            'precio'=>'250',
            'stock'=>'18'
        ]);

        Articulo::create([
            'nombre'=>'Lavadora Siemens',
            'categoria'=>'Hogar',
            'precio'=>'450',
            'stock'=>'56'
        ]);

        Articulo::create([
            'nombre'=>'Cafetera Nespresso',
            'categoria'=>'Bazar',
            'precio'=>'90',
            'stock'=>'69'
        ]);

    }
}
