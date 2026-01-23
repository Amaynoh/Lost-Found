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
        return response()->json(['success' => true, 'data' => Objets::all()], 200);
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

        return response()->json(['success' => true, 'data' => $query->get()], 200);
    }

    public function store(StoreObjetRequest $request)
    {
        $this->authorize('create', Objets::class);

        $imagePath = $request->hasFile('image')
            ? $request->file('image')->store('images', 'public')
            : null;

        $objet = Objets::create([
            ...$request->validated(),
            'image' => $imagePath,
            'user_id' => $request->user()->id,
        ]);

        return response()->json([
            'success' => true,
            'message' => 'Objet créé avec succès.',
            'data' => $objet
        ], 201);
    }

    public function show($id)
    {
        $objet = Objets::findOrFail($id);
        return response()->json(['success' => true, 'data' => $objet], 200);
    }

    public function update(UpdateObjetRequest $request, $id)
    {
        $objet = Objets::findOrFail($id);
        $this->authorize('update', $objet);

        if ($request->hasFile('image')) {
            if ($objet->image) Storage::disk('public')->delete($objet->image);
            $objet->image = $request->file('image')->store('images', 'public');
        }

        $objet->fill($request->validated());
        $objet->save();

        return response()->json([
            'success' => true,
            'message' => 'Objet mis à jour avec succès.',
            'data' => $objet
        ], 200);
    }

    public function destroy($id)
    {
        $objet = Objets::findOrFail($id);
        $this->authorize('delete', $objet);

        if ($objet->image) Storage::disk('public')->delete($objet->image);
        $objet->delete();

        return response()->json([
            'success' => true,
            'message' => 'Objet supprimé avec succès.'
        ], 200);
    }

    public function myObjects(Request $request)
    {
        return response()->json([
            'success' => true,
            'data' => $request->user()->objets
        ], 200);
    }
}
