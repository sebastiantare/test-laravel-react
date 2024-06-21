<?php

namespace App\Http\Controllers;

use App\Models\Calle;
use Illuminate\Http\Request;

class CalleController extends Controller
{

    public function index()
    {
        $callees = Calle::all();
        return response()->json($callees);
    }

    public function store(Request $request)
    {
        $request->validate([
            'nombre' => 'required|string|max:255',
            'ciudad_id' => 'required|exists:ciudades,id'
        ]);

        $maxId = Calle::max('id');
        $newId = $maxId ? $maxId + 1 : 1;

        $calle = new Calle();
        $calle->id = $newId;
        $calle->nombre = $request->input('nombre');
        $calle->ciudad_id = $request->input('ciudad_id');
        $calle->save();

        return response()->json($calle, 201);
    }

    public function show($id)
    {
        $calle = Calle::find($id);

        if (!$calle) {
            return response()->json(['error' => 'Calle not found'], 404);
        }

        return response()->json($calle);
    }

    public function update(Request $request, $id)
    {
        $calle = Calle::find($id);

        if (!$calle) {
            return response()->json(['error' => 'Calle not found'], 404);
        }

        $calle->nombre = $request->input('nombre');
        $calle->save();

        return response()->json($calle);
    }

    public function destroy($id)
    {
        $calle = Calle::find($id);

        if (!$calle) {
            return response()->json(['error' => 'Calle not found'], 404);
        }

        $calle->delete();

        return response()->json(['message' => 'Calle deleted']);
    }
}
