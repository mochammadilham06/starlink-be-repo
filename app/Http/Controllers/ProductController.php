<?php

namespace App\Http\Controllers;

use App\Models\Products;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
       try {
        $perPage = $request->input('per_page', 10);
        $search = $request->input('search', ''); 

        $products = Products::where('name', 'LIKE', "%$search%")
            ->orWhere('purchase_price', 'LIKE', "%$search%")
            ->paginate($perPage);

        $data = [
            'products' => $products->items(),
            'current_page' => $products->currentPage(),
            'last_page' => $products->lastPage(),
            'total' => $products->total(),
        ];

        $response = [
            'success' => true,
            'message' => 'Products retrieved successfully.',
            'data' => $data,
        ];

        return Response::json($response, 200);
    } catch (\Exception $e) {
        $response = [
            'success' => false,
            'message' => 'Failed to retrieve products.',
            'error' => $e->getMessage(),
        ];

        return Response::json($response, 500);
    }
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        try {
            $validator = Validator::make($request->all(),[
                'name'=>'required|unique:products',
                'images'=>'required',
                'purchase_price' => 'required|numeric',
            'selling_price' => 'required|numeric',
            'stock' => 'required|integer',
            ]);

            //IF VALIDATOR FAILS
            if ($validator->fails()) {
                $response= [
                    'success'=>false,
                    'message'=>'Failed to create Products',
                    'errors'=> $validator->errors()
                ];

                return Response::json($response, 422);
            }

            $product = new Products();
            $product->name = $request->input('name');
            $product->images = $request->input('images');
            $product->purchase_price = $request->input('purchase_price');
            $product->selling_price = $request->input('selling_price');
            $product->stock = $request->input('stock');

            $product->save();

            $response = [
                'success'=>true,
                'message'=>'Product created successfully',
                'data'=> $product
            ];

            return Response::json($response,201);
        } catch (\Throwable $e) {
            $response = [
            'success' => false,
            'message' => 'Failed to create product.',
            'error' => $e->getMessage(),
        ];

        return Response::json($response, 500);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        try {
            $products = Products::findOrFail($id);

            $response = [
                'success' => true,
                'message' => 'Product retrivie successfully',
                'data' => $products,
            ];
            return Response::json($response, 200);
        
        } catch (\Throwable $e) {
            $response = [
                'success' => true,
                'message' => 'Product retrivie successfully',
                'error' => $e->getMessage(),
            ];

            return Response::json($response, 500);
        }
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
         try {
        $product = Products::findOrFail($id);

        $validator = Validator::make($request->all(), [
            'name' => ['required', Rule::unique('products')->ignore($product->id)],
            'images' => 'required',
            'purchase_price' => 'required|numeric',
            'selling_price' => 'required|numeric',
            'stock' => 'required|integer',
        ]);

        if ($validator->fails()) {
            $response = [
                'success' => false,
                'message' => 'Failed to update product.',
                'errors' => $validator->errors(),
            ];
            return Response::json($response, 422);
        }

        $product->name = $request->input('name');
        $product->images = $request->input('images');
        $product->purchase_price = $request->input('purchase_price');
        $product->selling_price = $request->input('selling_price');
        $product->stock = $request->input('stock');

        $product->save();

        $response = [
            'success' => true,
            'message' => 'Product updated successfully.',
            'data' => $product,
        ];

        return Response::json($response, 200);
    } catch (\Exception $e) {
        $response = [
            'success' => false,
            'message' => 'Failed to update product.',
            'error' => $e->getMessage(),
        ];

        return Response::json($response, 500);
    }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
         try {
        $product = Products::findOrFail($id);

        $product->delete();

        $response = [
            'success' => true,
            'message' => 'Product deleted successfully.',
        ];

        return Response::json($response, 200);
    } catch (\Exception $e) {
        $response = [
            'success' => false,
            'message' => 'Failed to delete product.',
            'error' => $e->getMessage(),
        ];

        return Response::json($response, 500);
    }
    }
}
