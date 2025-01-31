<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Cajas;
use App\Models\Movimiento_opcion;
use App\Models\Movimiento;
use Auth;
use DB;

class MovimientoController extends Controller
{
    public function Cajas(){
        $fts = [];
        $fts[] = ['id_user', '=', auth()->user()->id];
        $qry = Cajas::select('caja','id_user','id');
        //$datos = Cajas::all();
        if(!empty($fts)){
            $qry->where($fts);
        }
        // // $qry->groupBy("ano");
        $qry->orderBy("caja","ASC");
        $datos = $qry->get();
        // print('isaias------------herazo');
        return $datos;
    }

    public function Movimientos(){
        $datos = Movimiento::select('movimiento.id','movimiento.movimiento','movimiento.detalle','movimiento.tipo','cajas.caja','movimiento.id_opcion','movimiento.id_caja','movimiento_opcion.opcion','movimiento.created_at', DB::raw("SUBSTRING(movimiento.created_at, 1, 10) as fecha"),  DB::raw("SUBSTRING(movimiento.created_at, 11, 9) as hora"))
                ->join('movimiento_opcion', 'movimiento.id_opcion', '=', 'movimiento_opcion.id')
                ->join('cajas', 'movimiento.id_caja', '=', 'cajas.id')
                ->where("movimiento.id_user", "=",  auth()->user()->id)
                ->orderBy("movimiento.created_at","DESC")
                ->get();
        return $datos;
    }
    public function saldoCajas(){
        $datos = Movimiento::select('movimiento.tipo','movimiento.id_caja','cajas.caja',DB::raw("sum(`movimiento`.`movimiento`) as movimiento"))
                ->join('cajas', 'movimiento.id_caja', '=', 'cajas.id')
                ->where("movimiento.id_user", "=", auth()->user()->id)
                ->groupBy("movimiento.id_caja", "movimiento.tipo")
                ->get();
        return $datos;
    }

    public function MovimientoOpcion(){
        $fts = [];
        $fts[] = ['id_user', '=', auth()->user()->id];
        $qry = Movimiento_opcion::select('opcion','tipo','id_user','id');
        //$datos = Cajas::all();
        if(!empty($fts)){
            $qry->where($fts);
        }
        // // $qry->groupBy("ano");
        $qry->orderBy("opcion","ASC");
        $datos = $qry->get();
        // print('isaias------------herazo');
        return $datos;
    }

    public function registrarMovimiento(Request $request){
        $this->validate(request(),[
            'movimiento' => 'required',
            'detalle' => 'required|max:100',
        ]);
        $opc =  new Movimiento();
        $opc->movimiento =  $request->movimiento;
        $opc->detalle =  $request->detalle;
        $opc->tipo =  $request->tipo;
        $opc->id_caja =  $request->id_caja;
        $opc->id_opcion =  $request->id_opcion;
        $opc->id_user =  auth()->user()->id;
        $opc->save();
        return response()->json(['name' => 'add', 'state' => 'ok']);   
    }

    public function agregar_caja(Request $request){
        $this->validate(request(),[
            'caja' => 'required'
        ]);
        $opc =  new Cajas();
        $opc->caja =  $request->caja;
        $opc->id_user =  auth()->user()->id;
        $opc->save();
        return response()->json(['name' => 'add', 'state' => 'ok']);
    }

    public function eliminar_caja(Request $request){
        $idU = auth()->user()->id;
        $opc = Cajas::findOrFail($request->id);
        $opc->delete();
        return response()->json(['name' => 'add', 'state' => 'ok']);
    }

    public function agregar_opcion(Request $request){
        $this->validate(request(),[
            'opcion' => 'required',
            'tipo' => 'required'
        ]);
        $opc =  new Movimiento_opcion();
        $opc->opcion =  $request->opcion;
        $opc->tipo =  $request->tipo;
        $opc->id_user =  auth()->user()->id;
        $opc->save();
        return response()->json(['name' => 'add', 'state' => 'ok']);
    }

    public function eliminar_opcion(Request $request){
        $idU = auth()->user()->id;
        $opc = Movimiento_opcion::findOrFail($request->id);
        $opc->delete();
        return response()->json(['name' => 'add', 'state' => 'ok']);
    }

    public function eliminar_movimiento(Request $request){
        $idU = auth()->user()->id;
        $opc = Movimiento::findOrFail($request->id);
        $opc->delete();
        return response()->json(['name' => 'add', 'state' => 'ok']);
    }

}
