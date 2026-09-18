<?php

namespace App\Http\Controllers;

use App\Models\Pedido;
use App\Models\Cliente;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class PedidoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $pedidos = Pedido::with(['cliente', 'produto'])->latest()->get();
        return view('pedidos.index', compact('pedidos'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $clientes = Cliente::all();
        $produtos = Product::all();
        return view('pedidos.create', compact('clientes', 'produtos'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'cliente_id' => ['required', 'exists:clientes,id'],
            'produto_id' => ['required', 'exists:products,id'],
            'quantidade' => ['required', 'integer', 'min:1'],
        ]);

        $produto = Product::findOrFail($validated['produto_id']);
        $validated['valor_total'] = $produto->price * $validated['quantidade'];
        $validated['status'] = 'pendente';

        $pedido = Pedido::create($validated);

        return redirect()->route('pedidos.show', $pedido)->with('success', 'Pedido criado com sucesso');
    }

    /**
     * Display the specified resource.
     */
    public function show(Pedido $pedido)
    {
        $pedido->load(['cliente', 'produto']);
        return view('pedidos.show', compact('pedido'));
    }
        // Salva a assinatura e marca o pedido como assinado
    public function assinar (Request $request, Pedido $pedido) 
    {
        $validated = $request->validate([
            'assinatura' => ['required', 'string'],
        ]);

        // A assinatura vem como uma imagem em base64 (texto), vamos salvar como arquivo
            $imagemBase64 = str_replace('data:image/png;base64,', '', $validated['assinatura']);
            $imagemBase64 = str_replace(' ', '+', $imagemBase64);
            $nomeArquivo = 'assinatura/pedido_' . $pedido->id . '_' . time() . '.png';
            Storage::disk('public')->put($nomeArquivo, base64_decode($imagemBase64));

            $pedido->update([
                'assinatura' => $nomeArquivo,
                'status' => 'assinado',
                'signed_at' => now(),
            ]);

            return redirect()->route('pedidos.show', $pedido)->with('success', 'Pedido assinado com sucesso!');
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
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Pedido $pedido)
    {
        $pedido->delete();
        return redirect()->route('pedido.index')->with('success', 'Pedido removido com sucesso!');
    }
}
