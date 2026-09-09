<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProdutoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {

        $produtos = Product::all();

        return view('produtos.index', compact('produtos'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('produtos.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' =>['required','string'],
            'description' =>['nullable', 'string'],
            'price' =>['required', 'numeric', 'min:0'],
            'category' => ['nullable', 'string','max:255'],
        ]);

        Product::create($validated);
        return redirect()->route('produtos.index')->with('success', 'Produto criado com sucesso!');
        
        
       
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Product $produto)
    {
        return view('produtos.edit', compact('produto'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Product $produto)
    {
        $validated = $request->validate([

            'name' =>['required','string'],
            'description' =>['nullable', 'string'],
            'price' =>['required', 'numeric', 'min:0'],
            'category' => ['nullable', 'string','max:255'],
        ]);
        $produto->update($validated);
        return redirect()->route('produtos.index')->with('success', 'Produto atualizado com sucesso!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Product $produto)
    {
        $produto->delete();
        return redirect()->route('produtos.index');
    }
}
