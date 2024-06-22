<?php

namespace App\Http\Controllers;

use App\Http\Resources\RegionResource;
use App\Models\Region;
use Illuminate\Http\Request;

class RegionController extends Controller
{

    public function index()
    {
        $regiones = Region::all();
        return response()->json($regiones);
    }

    public function store(Request $request)
    {
        $maxId = Region::max('id');
        $newId = $maxId ? $maxId + 1 : 1;
        $region = new Region();
        $region->id = $newId;
        $region->nombre = $request->input('nombre');
        $region->save();

        return response()->json($region, 201);
    }

    public function show($id)
    {
        $region = Region::find($id);

        if (!$region) {
            return response()->json(['error' => 'Region not found'], 404);
        }

        return response()->json($region);
    }

    public function update(Request $request, $id)
    {
        $region = Region::find($id);

        if (!$region) {
            return response()->json(['error' => 'Region not found'], 404);
        }

        $region->nombre = $request->input('nombre');
        $region->save();

        return response()->json($region);
    }

    public function destroy($id)
    {
        $region = Region::find($id);

        if (!$region) {
            return response()->json(['error' => 'Region not found'], 404);
        }

        $region->delete();

        return response()->json(['message' => 'Region deleted']);
    }

    public function getProvincias($id)
    {
        $region = Region::find($id);

        if (!$region) {
            return response()->json(['message' => 'Region not found'], 404);
        }

        $provincias = $region->provincia;

        return response()->json($provincias, 200);
    }
}
