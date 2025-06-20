<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Http\Resources\ProductResource;
use App\Models\Category;
use App\Http\Resources\CategoryResource;
use App\Http\Requests\StoreProductRequest;

class ProductController extends Controller
{
    /**
    * Muestra una lista de los productos.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $products = ProductResource::collection(Product::paginate(10));
        $categories = CategoryResource::collection(Category::all());

        return inertia('Products/Index', [
            'products' => $products,
            'categories' => $categories,
        ]);
    }

    /**
    * Muestra el formulario para crear un nuevo producto.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = CategoryResource::collection(Category::all());

        return inertia('Products/Create', [
            'categories' => $categories,
        ]);
    }

    /**
    * Almacena un nuevo producto en la base de datos.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreProductRequest $request)
    {
        $product = Product::create($request->validated());

        if ($request->has('categories')) {
            $ids = collect($request->categories)->pluck('id');
            $product->categories()->sync($ids);
        }

        return redirect()->route('products.index')
            ->with('message', 'Producto creado exitosamente.');
    }

    /**
    * Muestra el producto especificado.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(int $id)
    {
        // TO-DO
    }

    /**
    * Muestra el formulario para editar el producto especificado.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(int $id)
    {
        $categories = CategoryResource::collection(Category::all());
        $product = ProductResource::make(Product::find($id));

        return inertia('Products/Edit', [
            'product' => $product,
            'categories' => $categories
        ]);
    }

    /**
    * Actualiza el producto especificado en la base de datos.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(StoreProductRequest $request, int $id)
    {
        $product = Product::findOrFail($id);
        $product->update($request->validated());

        if ($request->has('categories')) {
            $ids = collect($request->categories)->pluck('id');
            $product->categories()->sync($ids);
        }

        return redirect()->route('products.index')
            ->with('message', 'Producto actualizado exitosamente.');
    }

    /**
    * Elimina el producto especificado de la base de datos.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(int $id)
    {
        $product = Product::findOrFail($id);
        $product->categories()->detach();
        $product->delete();

        return redirect()->route('products.index')
            ->with('message', 'Producto eliminado exitosamente.');
    }
}
