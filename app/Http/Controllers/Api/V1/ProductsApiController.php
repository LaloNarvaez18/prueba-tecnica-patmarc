<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use App\Models\Product;
use App\Http\Resources\ProductResource;
use App\Models\Category;

class ProductsApiController extends Controller
{
    /**
    * Mostrar listado de todos los productos.
     *
     * @return JsonResponse
     */
    public function index() : JsonResponse
    {
       $products = ProductResource::collection(Product::all());

        if ($products->isEmpty()) {
            return response()->json(['message' => 'No se encontraron productos'], 404);
        }

        return response()->json([
            'results' => $products->count(),
            'products' => $products
        ], 200);
    }

    /**
    * Mostrar un producto específico por ID.
     *
     * @param int $id
     * @return JsonResponse
     */
    public function show(int $id) : JsonResponse
    {
        $product = ProductResource::make(Product::find($id));

        if (!$product) {
            return response()->json(['message' => 'Producto no encontrado'], 404);
        }

        return response()->json([
            'product' => $product
        ], 200);
    }

    /**
    * Mostrar productos filtrados por nombres de categorías
     *
     * @param Request $request
     * @return JsonResponse
     */
    public function byCategories(Request $request) : JsonResponse
    {
        $catNames = collect(explode(',', $request->query('names')))
            ->map('trim')
            ->filter()
            ->all();

        if (empty($catNames)) {
            return response()->json(['message' => 'Debe proporcionar al menos un nombre de categoría'], 400);
        }

        $products = ProductResource::collection(
            Product::with('categories')
            ->whereHas('categories', fn($q) => $q->whereIn('categories.name', $catNames))
            ->get()
        );

        if ($products->isEmpty()) {
            return response()->json(['message' => 'No se encontraron productos para las categorías indicadas'], 404);
        }

        return response()->json([
            'results' => $products->count(),
            'products' => $products
        ], 200);
    }
}
