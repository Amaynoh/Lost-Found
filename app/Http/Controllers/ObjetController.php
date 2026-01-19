<?php

namespace App\Http\Controllers;

use App\Models\Objets;
use Illuminate\Http\Request;

class ObjetController extends Controller
{
    public function index(Request $request)
    {
        $query = Objets::query();
        if ($request->has('type')) {
            $query->where('type', $request->type);
        }
        if ($request->has('location')) {
            $query->where('location', 'like', '%' . $request->location . '%');
        }
        $objets = $query->get();

        return response()->json($objets);
    }

}
