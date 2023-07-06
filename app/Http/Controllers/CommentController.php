<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response;
class CommentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
    try {
        $perPage = $request->input('per_page', 10);
        $search = $request->input('search', ''); 

        $comments = Comment::where('username', 'LIKE', "%$search%")
            ->orWhere('comment', 'LIKE', "%$search%")
            ->paginate($perPage);

        $data = [
            'comments' => $comments->items(),
            'current_page' => $comments->currentPage(),
            'last_page' => $comments->lastPage(),
            'total' => $comments->total(),
        ];

        $response = [
            'success' => true,
            'message' => 'Comments retrieved successfully.',
            'data' => $data,
        ];

        return Response::json($response, 200);
    } catch (\Exception $e) {
        $response = [
            'success' => false,
            'message' => 'Failed to retrieve comments.',
            'error' => $e->getMessage(),
        ];

        return Response::json($response, 500);
    }
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
