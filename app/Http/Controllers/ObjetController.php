<?php
namespace App\Http\Controllers;

use App\Models\Objets;
use Illuminate\Http\Request;
use App\Http\Requests\StoreObjetRequest;
use App\Http\Requests\UpdateObjetRequest;
use Illuminate\Support\Facades\Storage;

class ObjetController extends Controller
{
    public function index()
    {
        return response()->json(Objets::all());
    }

    public function filter(Request $request)
    {
        $query = Objets::query();

        if ($request->filled('type')) {
            $query->where('type', $request->type);
        }

        if ($request->filled('location')) {
            $query->where('location', 'like', '%' . $request->location . '%');
        }

        return response()->json($query->get());
    }

    public function store(StoreObjetRequest $request)
    {
        $imagePath = null;

        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('images', 'public');
        }

        $objet = Objets::create([
            'title'       => $request->title,
            'description' => $request->description,
            'type'        => $request->type,
            'location'    => $request->location,
            'date'        => $request->date,
            'image'       => $imagePath,  
            'user_id'     => $request->user()->id,
        ]);

        return response()->json($objet, 201);
    }

    public function show($id)
    {
        return response()->json(Objets::findOrFail($id));
    }

    public function update(UpdateObjetRequest $request, $id)
    {
        $objet = Objets::findOrFail($id);
        $user  = $request->user();

        if ($objet->user_id !== $user->id && $user->role !== 'admin') {
            return response()->json(['message' => 'Non autorisé'], 403);
        }

        if ($request->has('status') && $user->role === 'admin') {
            $objet->status = $request->status;
        }

        if ($request->hasFile('image')) {
            if ($objet->image) {
                Storage::disk('public')->delete($objet->image);
            }
            $objet->image = $request->file('image')->store('images', 'public');
        }

        $fields = ['title', 'description', 'type', 'location', 'date'];
        foreach ($fields as $field) {
            if ($request->has($field)) {
                $objet->$field = $request->$field;
            }
        }

        $objet->save();
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

    public function myObjects(Request $request)
    {
        return response()->json($request->user()->objets);
    }
}

