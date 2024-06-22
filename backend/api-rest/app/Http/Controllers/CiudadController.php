<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Ciudad;

class CiudadController extends Controller
{

    public function index()
    {
        $ciudades = Ciudad::all();
        return response()->json($ciudades);
    }

    public function store(Request $request)
    {
        $request->validate([
            'nombre' => 'required|string',
            'provincia_id' => 'required|exists:provincias,id'
        ]);

        $maxId = Ciudad::max('id');
        $newId = $maxId ? $maxId + 1 : 1;

        $ciudad = new Ciudad();
        $ciudad->id = $newId;
        $ciudad->nombre = $request->input('nombre');
        $ciudad->provincia_id = $request->input('provincia_id');
        $ciudad->save();

        return response()->json($ciudad, 201);
    }

    public function show($id)
    {
        $ciudad = Ciudad::find($id);

        if (!$ciudad) {
            return response()->json(['error' => 'Ciudad not found'], 404);
        }

        return response()->json($ciudad);
    }

    public function update(Request $request, $id)
    {
        $ciudad = Ciudad::find($id);

        if (!$ciudad) {
            return response()->json(['error' => 'Ciudad not found'], 404);
        }

        $ciudad->nombre = $request->input('nombre');
        $ciudad->save();

        return response()->json($ciudad);
    }

    public function destroy($id)
    {
        $ciudad = Ciudad::find($id);

        if (!$ciudad) {
            return response()->json(['error' => 'Ciudad not found'], 404);
        }

        $ciudad->delete();

        return response()->json(['message' => 'Ciudad deleted']);
    }

    public function getCalles($id)
    {
        $ciudad = Ciudad::find($id);

        if (!$ciudad) {
            return response()->json(['message' => 'Ciudad not found'], 404);
        }

        $calles = $ciudad->calle;

        return response()->json($calles, 200);
    }
}
