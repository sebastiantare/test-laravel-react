<?php

namespace App\Http\Controllers;

use App\Http\Resources\CalleResource;
use App\Models\Calle;
use Illuminate\Http\Request;

class CalleController extends Controller
{

    public function index(Request $request)
    {
        $query = $request->input('query');

        if ($query) {
            $calles = Calle::with('ciudad')
                ->whereRaw('LOWER(nombre) LIKE ?', ['%' . strtolower($query) . '%'])
                ->orderBy('updated_at', 'desc')
                ->paginate(20);
        } else {
            $calles = Calle::with('ciudad')->orderBy('updated_at', 'desc')->paginate(20);
        }

        // Return CalleResource collection with nested data
        return CalleResource::collection($calles);
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

        return response()->json($calle, 200);
    }

    public function update(Request $request, $id)
    {
        $calle = Calle::find($id);

        if (!$calle) {
            return response()->json(['error' => 'Calle not found'], 404);
        }

        $calle->nombre = $request->input('nombre');
        $calle->ciudad_id = $request->input('ciudad_id');

        $calle->save();

        return response()->json($calle, 200);
    }

    public function destroy($id)
    {
        $calle = Calle::find($id);

        if (!$calle) {
            return response()->json(['error' => 'Calle not found'], 404);
        }

        $calle->delete();

        return response()->json(['message' => 'Calle deleted'], 204);
    }
}
