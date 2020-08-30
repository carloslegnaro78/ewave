<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Pedido;

class PedidoController extends Controller
{

    public function index( Pedido $pedido)
    {
        
        $pedido = $pedido->get();

        return response()->json($pedido);

    }


    public function store(Request $request)
    {
        //
    }


    public function show($id)
    {
        //
    }

  

    public function update(Request $request, $id)
    {
        //
    }


    public function destroy($id)
    {
        //
    }
}
