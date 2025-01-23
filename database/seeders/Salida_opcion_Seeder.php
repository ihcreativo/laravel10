<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Salida_opcion;

class Salida_opcion_Seeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $opc = new Salida_opcion();
        $opc->opcion =  'Mercado casa';
        $opc->id_user =  1;
        $opc->save();

        $opc1 = new Salida_opcion();
        $opc1->opcion =  'Comida x fuera';
        $opc1->id_user =  1;
        $opc1->save();

        $opc2 = new Salida_opcion();
        $opc2->opcion =  'Articulo';
        $opc2->id_user =  1;
        $opc2->save();

        $opc3 = new Salida_opcion();
        $opc3->opcion =  'Meriendas';
        $opc3->id_user =  1;
        $opc3->save();

        
    }
}
