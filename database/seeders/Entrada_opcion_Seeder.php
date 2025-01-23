<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Entrada_opcion;

class Entrada_opcion_Seeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $opc = new Entrada_opcion();
        $opc->opcion =  'Salario';
        $opc->id_user =  1;
        $opc->save();

        $opc1 = new Entrada_opcion();
        $opc1->opcion =  'Salario Osi';
        $opc1->id_user =  1;
        $opc1->save();

        $opc2 = new Entrada_opcion();
        $opc2->opcion =  'Ingreso Ocasional';
        $opc2->id_user =  1;
        $opc2->save();

        $opc3 = new Entrada_opcion();
        $opc3->opcion =  'Venta de Activo';
        $opc3->id_user =  1;
        $opc3->save();

        
    }
}
