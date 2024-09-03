<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Tpa;  // Pastikan Anda memiliki model Tpa

class TpaController extends Controller
{
    // GET /tpas
    public function index()
    {
        return Tpa::all();
    }

    // POST /tpas
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required|max:255',
            'latitude' => 'required',
            'longitude' => 'required',
            'details' => 'sometimes',
        ]);

        $tpa = Tpa::create($validatedData);
        return response()->json($tpa, 201);
    }

    // GET /tpas/{id}
    public function show($id)
    {
        return Tpa::findOrFail($id);
    }

    // PUT/PATCH /tpas/{id}
    public function update(Request $request, $id)
    {
        $tpa = Tpa::findOrFail($id);
        $tpa->update($request->all());
        return response()->json($tpa, 200);
    }

    // DELETE /tpas/{id}
    public function destroy($id)
    {
        Tpa::destroy($id);
        return response()->json(null, 204);
    }
}
