<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Pastel;

class PastelController extends Controller
{

    private $pastel;

    public function __construct(Pastel $pastel)
    {
        $this->pastel = $pastel;
    }

    public function index(Pastel $pastel)
    {
        $pastel = $pastel->get();

        return response()->json($pastel);
    }

    public function store(Request $request)
    {
        
        $request->validate([
            'nome' =>    'required|max:100',
            'preco' =>   'required'
        ]);

        $pastel = Pastel::create([
            'nome' => $request->input('nome'),
            'preco' => $request->input('preco')
        ]);

        return response()->json($pastel, 201);

    }

    public function show($id)
    {
        if (!$pastel = $this->pastel->find($id))
        return response()->json(['error' => 'Not found'], 404);

    return response()->json($pastel);
    }

    public function update(Request $request, $id)
    {
        $pastel = $this->pastel->find($id);
        
        if(!$pastel)
            return response()->json(['error' => 'Not found'], 404);
        
        $pastel->update($request->all());

        return response()->json($pastel);
    }

    public function softDeleted()
    {
        $pastels = Pastel::onlyTrashed()->get();

        $response = $this->successfulMessage(200, 'Successfully', true, $pastels->count(), $pastels);
        return response($response);
    }

    public function restore($id)
    {

        $pastel = Pastel::onlyTrashed()->find($id);

        if (!is_null($pastel)) {

            $pastel->restore();
            $response = $this->successfulMessage(200, 'Successfully restored', true, $pastel->count(), $pastel);
        }
        return response($response);
    }

    public function permanentDeleteSoftDeleted($id)
    {
        $pastel = Pastel::onlyTrashed()->find($id);

        if (!is_null($pastel)) {

            $pastel->forceDelete();
            $response = $this->successfulMessage(200, 'Successfully deleted', true, 0, $pastel);
        }
        return response($response);
    }

    public function destroy($id)
    {
        //
    }

}
