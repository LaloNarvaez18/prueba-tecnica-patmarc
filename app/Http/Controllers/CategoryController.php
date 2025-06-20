<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;
use App\Http\Resources\CategoryResource;
use App\Http\Requests\StoreCategoryRequest;

class CategoryController extends Controller
{
    /**
    * Muestra una lista de los categorias.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $categories = CategoryResource::collection(Category::paginate(10));

        return inertia('Categories/Index', [
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
        return inertia('Categories/Create');
    }

    /**
    * Almacena un nuevo producto en la base de datos.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreCategoryRequest $request)
    {
        $category = Category::create($request->validated());

        return redirect()->route('categories.index')
            ->with('message', 'Categoria creada exitosamente.');
    }

    /**
    * Muestra la categoria especificada.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(int $id)
    {
        // TO-DO
    }

    /**
    * Muestra el formulario para editar la categoría especificada.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(int $id)
    {
        $category = CategoryResource::make(Category::find($id));

        return inertia('Categories/Edit', [
            'category' => $category
        ]);
    }

    /**
    * Actualiza el producto especificado en la base de datos.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(StoreCategoryRequest $request, int $id)
    {
        $category = Category::findOrFail($id);
        $category->update($request->validated());

        return redirect()->route('categories.index')
            ->with('message', 'Categoria actualizada exitosamente.');
    }

    /**
    * Elimina el producto especificado de la base de datos.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(int $id)
    {
        $category = Category::findOrFail($id);
        $category->products()->detach();
        $category->delete();

        return redirect()->route('categories.index')
            ->with('message', 'Producto eliminado exitosamente.');
    }
}
