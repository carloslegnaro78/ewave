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
