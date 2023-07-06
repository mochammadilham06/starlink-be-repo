<?php

namespace App\Http\Controllers;

use App\Models\Artist;
use Illuminate\Http\Request;

class ArtistController extends Controller
{
    public function index()
    {
        $artist = Artist::all();
         return response()->json([
        'status' => 'success',
        'message' => 'Artists retrieved successfully',
        'data' => ['artist' => $artist]
    ], 200);
    }

    public function store(Request $request){
        $artist = Artist::create($request->all());
        return response()->json([
        'status' => 'success',
        'message' => 'Artist created successfully',
        'data' => ['artist' => $artist]
    ], 201);
    }
    public function update(Request $request, $id){
        $artist = Artist::find($id);

       if (!$artist) {
        return response()->json([
            'status' => 'error',
            'message' => 'Artist not found',
            'data' => null
        ], 404);
    }

    $artist->update($request->all());

    return response()->json([
        'status' => 'success',
        'message' => 'Artist updated successfully',
        'data' => ['artist'=>$artist]
    ], 200);
    }
    public function destroy($id){
        $artist = Artist::find($id);
      if (!$artist) {
        return response()->json([
            'status' => 'error',
            'message' => 'Artist not found',
            'data' => null
        ], 404);
    }

    $artist->delete();

    return response()->json([
        'status' => 'success',
        'message' => 'Artist deleted successfully',
        'data' => null
    ], 200);
    }

}
