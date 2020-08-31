<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Pedido;

class PedidoController extends Controller
{

    private $pedido;

    public function __construct(Pedido $pedido)
    {

        $this->pedido = $pedido;
    }

    public function index(Pedido $pedido)
    {

        $pedido = $pedido->get();

        return response()->json($pedido);
    }


    public function store(Request $request)
    {
        $request->validate([
            'cliente_id' =>    'required',
            'pastel_id' =>   'required'
        ]);

        $pedido = Pedido::create([
            'cliente_id' => $request->input('cliente_id'),
            'pastel_id' => $request->input('pastel_id')
        ]);

        return response()->json($pedido, 201);
    }


    public function show($id)
    {
        if (!$pedido = $this->pedido->find($id))
            return response()->json(['error' => 'Not found'], 404);

        return response()->json($pedido);
    }



    public function update(Request $request, $id)
    {
        $pedido = $this->pedido->find($id);

        if (!$pedido)
            return response()->json(['error' => 'Not found'], 404);

        $pedido->update($request->all());

        return response()->json($pedido);
    }


    public function softDeleted()
    {
        $pedido = Pedido::onlyTrashed()->get();

        $response = $this->successfulMessage(200, 'Successfully', true, $pedido->count(), $pedido);
        return response($response);
    }

    public function restore($id)
    {

        $pedido = Pedido::onlyTrashed()->find($id);

        if (!is_null($pedido)) {

            $pedido->restore();
            $response = $this->successfulMessage(200, 'Successfully restored', true, $pedido->count(), $pedido);
        }
        return response($response);
    }

    public function permanentDeleteSoftDeleted($id)
    {
        $pedido = Pedido::onlyTrashed()->find($id);

        if (!is_null($pedido)) {

            $pedido->forceDelete();
            $response = $this->successfulMessage(200, 'Successfully deleted', true, 0, $pedido);
        }
        return response($response);
    }

    public function destroy($id)
    {
        //
    }
}
