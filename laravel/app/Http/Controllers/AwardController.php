<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Award;

class AwardController extends Controller
{
    public function index()
    {
        return Award::with('image')->get();
    }

    public function update(Request $request, $id)
    {
        $award = Award::findOrFail($id);
        $award->update($request->all());

        return response()->json(['message' => 'Award updated successfully']);
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required|string',
            'date' => 'required|date',
            'description' => 'required|string'
        ]);

        // Assign the default image when creating an award.
        $validatedData['image_id'] = 9;

        $award = Award::create($validatedData);

        return response()->json(['message' => 'Award created successfully', 'award' => $award]);
    }

    public function destroy($id)
    {
        $member = Award::findOrFail($id);
        $member->delete();

        return response()->json(['message' => 'Award deleted successfully']);
    }
}