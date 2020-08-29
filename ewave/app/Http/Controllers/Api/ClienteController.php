<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Cliente;

class ClienteController extends Controller
{

    private $cliente;

    public function __construct(Cliente $cliente)
    {

        $this->cliente = $cliente;
    }

    public function index(Cliente  $cliente)
    {
        $clientes = $cliente->get();

        return response()->json($clientes);
    }

    public function store(Request $request)
    {

        $request->validate([
            'nome' =>    'required|max:100',
            'email' =>   'required|max:80'
        ]);

        $cliente = Cliente::create([
            'nome' => $request->input('nome'),
            'email' => $request->input('email')
        ]);

        return response()->json($cliente, 201);
    }

    public function show($id)
    {
        if (!$cliente = $this->cliente->find($id))
            return response()->json(['error' => 'Not found'], 404);

        return response()->json($cliente);
    }

    public function update(Request $request,  $id)
    {
   
        $cliente = $this->cliente->find($id);
        
        if(!$cliente)
            return response()->json(['error' => 'Not found'], 404);
        
        $cliente->update($request->all());

        return response()->json($cliente);

    }

    public function softDeleted()
    {
        $clientes = Cliente::onlyTrashed()->get();

        $response = $this->successfulMessage(200, 'Successfully', true, $clientes->count(), $clientes);
        return response($response);
    }

    public function restore($id)
    {

        $cliente = Cliente::onlyTrashed()->find($id);

        if (!is_null($cliente)) {

            $cliente->restore();
            $response = $this->successfulMessage(200, 'Successfully restored', true, $cliente->count(), $cliente);
        }
        return response($response);
    }

    public function permanentDeleteSoftDeleted($id)
    {
        $note = Cliente::onlyTrashed()->find($id);

        if (!is_null($note)) {

            $note->forceDelete();
            $response = $this->successfulMessage(200, 'Successfully deleted', true, 0, $note);
        }
        return response($response);
    }

    public function destroy($id)
    {
        //
    }
    
}
