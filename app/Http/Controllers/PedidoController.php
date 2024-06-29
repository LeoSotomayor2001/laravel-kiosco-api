<?php

namespace App\Http\Controllers;

use App\Http\Resources\PedidoCollection;
use App\Models\Pedido;
use App\Models\PedidoProducto;
use Carbon\Carbon;
use Illuminate\Http\Request;

class PedidoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return new PedidoCollection(Pedido::with('user')->with('productos')->where('estado', 0)->get());
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $pedido= new Pedido;
        $pedido->user_id = auth()->user()->id;
        $pedido->total= $request->total;
        $pedido->save();

        //obtener el id del pedido
       $id=$pedido->id;
       //obtener productos
       $productos=$request->productos;

       $pedidoProducto=[];
       foreach($productos as $producto){
        $pedidoProducto[]= [
            'pedido_id' => $id,
            'producto_id' => $producto['id'],
            'cantidad' => $producto['cantidad'],
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
        ];
       }
       PedidoProducto::insert($pedidoProducto);

        return [
            'message' => 'Pedido realizado',
        ];
    }

    /**
     * Display the specified resource.
     */
    public function show(Pedido $pedido)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Pedido $pedido)
    {   
        $pedido->estado=1;
        $pedido->save();

        return [
            'message' => 'Pedido completado',
        ];
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Pedido $pedido)
    {
        //
    }
}
