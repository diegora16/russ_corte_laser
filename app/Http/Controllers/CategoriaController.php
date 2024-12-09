<?php

namespace App\Http\Controllers;
use App\Models\Categoria;
use Illuminate\Http\Request;

class CategoriaController extends Controller
{
    public function index()
    {
        // Obtener todas las categorías
        $categorias = Categoria::all();

        // Retornar la vista y pasar las categorías
        return view('auth.categorias.index', compact('categorias'));
    }

    public function create()
    {
        return view('auth.categorias.index');
    }

    public function store(Request $request)
    {
            $categoriaa = new Categoria;
            $categoriaa->nombre = $request->input('nombre');
            $categoriaa->save();
            return redirect()->route('categorias');
    }

    public function edit(Categoria $categoria){
        
        return view('auth.categorias.edit', ['categoria'=>$categoria]);
    }

    public function update(Request $request, Categoria $categoria){

            $categoria->nombre = $request->input('nombre');
            $categoria->save();
            return redirect()->route('categorias');
    }

    public function destroy(Categoria $categoria){

            $categoria->delete();

            return to_route('categorias');
    }

}
