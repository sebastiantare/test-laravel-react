<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Provincia;

class ProvinciaController extends Controller
{

    public function index()
    {
        $provincias = Provincia::all();
        return response()->json($provincias);
    }

    public function store(Request $request)
    {
        $request->validate([
            'nombre' => 'required|string',
            'region_id' => 'required|exists:regiones,id'
        ]);


        $maxId = Provincia::max('id');
        $newId = $maxId ? $maxId + 1 : 1;

        $provincia = new Provincia();
        $provincia->id = $newId;
        $provincia->nombre = $request->input('nombre');
        $provincia->region_id = $request->input('region_id');
        $provincia->save();

        return response()->json($provincia, 201);
    }
    public function show($id)
    {
        $provincia = Provincia::find($id);

        if (!$provincia) {
            return response()->json(['error' => 'Provincia not found'], 404);
        }

        return response()->json($provincia);
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'nombre' => 'required|string',
            'region_id' => 'required|int'
        ]);

        $provincia = Provincia::find($id);

        if (!$provincia) {
            return response()->json(['error' => 'Provincia not found'], 404);
        }

        $provincia->nombre = $request->input('nombre');
        $provincia->region_id = $request->input('region_id');
        $provincia->save();

        return response()->json($provincia);
    }

    public function destroy($id)
    {
        $provincia = Provincia::find($id);

        if (!$provincia) {
            return response()->json(['error' => 'Provincia not found'], 404);
        }

        $provincia->delete();

        return response()->json(['message' => 'Provincia deleted'], 204);
    }

    public function getCiudades($id)
    {
        $provincia = Provincia::find($id);

        if (!$provincia) {
            return response()->json(['message' => 'Provincia not found'], 404);
        }

        $ciudades = $provincia->ciudad;

        return response()->json($ciudades, 200);
    }
}
