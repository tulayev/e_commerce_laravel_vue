<?php

namespace App\Http\Controllers\Api;

use App\Classes\ImageHandler;
use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProductController extends Controller
{

    private $validated = [
        'name' => 'required',
        'brand' => 'required|max:25',
        'category' => 'required|max:25',
        'price' => 'required',
        'user_id' => 'required',
    ];

    public function index() : JsonResponse
    {
        return response()->json([
            'products' => Product::all(),
        ]);
    }

    public function store(Request $request) : JsonResponse
    {
        if ($request->user()->cannot('create', Product::class)) {
            return response()->json([
                'message' => 'Access denied',
            ]);
        }

        $this->validate($request, $this->validated);

        Product::create([
            'name' => $request['name'],
            'brand' => $request['brand'],
            'category' => $request['category'],
            'price' => $request['price'],
            'user_id' => $request->user()->id,
            'image' => ImageHandler::handleUpload($request, 'image'),
            'images' => ImageHandler::handleMultipleUpload($request, 'images')
        ]);

        return response()->json([
            'message' => 'Product created',
        ], 201);
    }

    public function show($id) : JsonResponse
    {
        $product = Product::find($id);

        if ($product) {
            return response()->json([
                'product' => $product,
            ]);
        }

        return response()->json([]);
    }

    public function update(Request $request, $id) : JsonResponse
    {
        $product = Product::find($id);

        if ($product) {

            if ($request->user()->cannot('update', $product)) {
                return response()->json([
                    'message' => 'Access denied',
                ]);
            }

            $this->validate($request, $this->validated);

            $product->name = $request['name'];
            $product->brand = $request['brand'];
            $product->category = $request['category'];
            $product->price = $request['price'];
            $product->user_id = $request->user()->id;
            $product->image = ImageHandler::handleUpload($request, 'image',$product->image);
            $product->images = ImageHandler::handleMultipleUpload($request, 'images',$product->images);
            $product->save();
        } else {
            return response()->json([
                'message' => 'Product not found',
            ]);
        }

        return response()->json([
            'message' => 'Saved successfully',
        ]);
    }

    public function destroy($id) : JsonResponse
    {
        $product = Product::find($id);
        // Hello
        if ($product) {
            if (Auth::user()->cannot('delete', $product)) {
                return response()->json([
                    'message' => 'Access denied',
                ]);
            }

            if ($product->image) {
                ImageHandler::handleDelete($product->image);
            }

            if ($product->images) {
                ImageHandler::handleMultipleDelete($product->images);
            }
            $product->delete();
        }

        return response()->json([
            'message' => 'Product deleted',
        ]);
    }
}
