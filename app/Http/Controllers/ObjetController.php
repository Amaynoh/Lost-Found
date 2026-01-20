<?php

namespace App\Http\Controllers;

use App\Models\Objets;
use Illuminate\Http\Request;

use App\Http\Requests\StoreObjetRequest;
use App\Http\Requests\UpdateObjetRequest;

class ObjetController extends Controller
{
    public function index(Request $request)
    {
        $query = Objets::query();

        if ($request->type) {
            $query->where('type', $request->type);
        }

        if ($request->location) {
            $query->where('location', 'like', '%' . $request->location . '%');
        }

        return response()->json($query->get());
    }
    public function store(StoreObjetRequest $request)
    {
        $objet = Objets::create([
            'title'       => $request->title,
            'description' => $request->description,
            'type'        => $request->type,
            'location'    => $request->location,
            'date'        => $request->date,
            'image'       => $request->image,
            'user_id'     => $request->user()->id,
        ]);

        return response()->json($objet, 201);
    }
    public function show($id)
    {
        return Objets::findOrFail($id);
    }
    public function update(UpdateObjetRequest $request, $id)
    {
        $objet = Objets::findOrFail($id);
        $user  = $request->user();
        if ($objet->user_id !== $user->id && $user->role !== 'admin') {
            return response()->json(['message' => 'Seul l’admin peut modifier le statut'], 403);
        }
        if ($request->has('status')) {
            if ($user->role !== 'admin') {
                return response()->json([
                    'message' => 'Seul l’admin peut modifier le statut'
                ], 403);
            }

            $objet->status = $request->status;
        }
        $objet->update($request->except('status'));

        return response()->json($objet);
    }
    public function destroy(Request $request, $id)
    {
        $objet = Objets::findOrFail($id);
        $user  = $request->user();

        if ($objet->user_id !== $user->id && $user->role !== 'admin') {
            return response()->json(['message' => 'Non autorisé'], 403);
        }

        $objet->delete();

        return response()->json(['message' => 'Objet supprimé']);
    }
}
