@extends('layouts.app')

@section('title', 'Editar produto // Painel')

@push('styles')
<style>
  .eyebrow { margin: 44px 0 12px; }
  h1 { font-family: 'IBM Plex Mono', monospace; font-weight: 600; font-size: clamp(26px, 3vw, 34px); margin: 0 0 36px; }
  .panel { border: 1px solid var(--panel-line); background: var(--panel); max-width: 560px; margin-bottom: 60px; }
  .panel-head {
    padding: 10px 18px; border-bottom: 1px solid var(--panel-line);
    font-family: 'IBM Plex Mono', monospace; font-size: 11px; letter-spacing: 0.1em; color: var(--paper-dim);
  }
  .panel-body { padding: 30px 26px; }
  .field { margin-bottom: 24px; }
  .field:last-of-type { margin-bottom: 0; }
  label {
    display: block; font-family: 'IBM Plex Mono', monospace; font-size: 12px;
    letter-spacing: 0.08em; color: var(--amber-dim); margin-bottom: 8px;
  }
  label::before { content: '> '; color: var(--amber); }
  input[type="text"], input[type="number"], textarea {
    width: 100%; background: var(--ink); border: 1px solid var(--panel-line); color: var(--paper);
    font-family: 'IBM Plex Sans', sans-serif; font-size: 14px; padding: 12px 14px;
    transition: border-color 0.15s ease;
  }
  input:focus, textarea:focus { border-color: var(--amber); outline: none; }
  textarea { resize: vertical; min-height: 90px; }
  .error { font-family: 'IBM Plex Mono', monospace; font-size: 12px; color: var(--signal); margin-top: 6px; }
  .error::before { content: '! '; }
  .actions { display: flex; align-items: center; gap: 18px; margin-top: 32px; }
  .cancel-link {
    font-family: 'IBM Plex Mono', monospace; font-size: 13px; color: var(--paper-dim); text-decoration: none;
    border-bottom: 1px solid transparent;
  }
  .cancel-link:hover { color: var(--paper); border-color: var(--panel-line); }

  @media (max-width: 780px) { .navlinks { display: none; } }
</style>
@endpush

@section('content')
<div class="wrap">
  <nav>
    <a href="{{ route('produtos.index') }}" class="brand">
      <span class="brand-mark"></span>
      PRODUTOS.SYS
    </a>
    <div class="navlinks" style="align-items: center;">
      <a href="/">Início</a>
      <a href="{{ route('produtos.index') }}">Produtos</a>
      <a href="{{ route('clientes.index') }}">Clientes</a>
      <a href="{{ route('pedidos.index') }}">Pedidos</a>
      <form method="POST" action="{{ route('logout') }}" style="display:inline; margin: 0;">
        @csrf
        <button type="submit" class="btn-logout">Sair →</button>
      </form>
    </div>
  </nav>

  <div class="eyebrow">REGISTRO #{{ str_pad($produto->id, 3, '0', STR_PAD_LEFT) }}</div>
  <h1>Editar produto</h1>

  <div class="panel">
    <div class="panel-head">UPDATE products WHERE id = {{ $produto->id }}</div>
    <div class="panel-body">
      <form action="{{ route('produtos.update', $produto) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="field">
          <label for="name">nome</label>
          <input type="text" name="name" id="name" value="{{ old('name', $produto->name) }}" placeholder="ex: Teclado mecânico">
          @error('name') <div class="error">{{ $message }}</div> @enderror
        </div>

        <div class="field">
          <label for="description">descrição</label>
          <textarea name="description" id="description" placeholder="detalhes do produto (opcional)">{{ old('description', $produto->description) }}</textarea>
        </div>

        <div class="field">
          <label for="price">preço</label>
          <input type="number" step="0.01" name="price" id="price" value="{{ old('price', $produto->price) }}" placeholder="0.00">
          @error('price') <div class="error">{{ $message }}</div> @enderror
        </div>

        <div class="field">
          <label for="category">categoria</label>
          <input type="text" name="category" id="category" value="{{ old('category', $produto->category) }}" placeholder="ex: Eletrônicos">
          @error('category') <div class="error">{{ $message }}</div> @enderror
        </div>

        <div class="actions">
          <button type="submit" class="btn btn-primary">Atualizar produto</button>
          <a href="{{ route('produtos.index') }}" class="cancel-link">cancelar</a>
        </div>
      </form>
    </div>
  </div>

  <footer>
    <span>PRODUTOS.SYS © {{ date('Y') }}</span>
    <span>LARAVEL + DOCKER</span>
  </footer>
</div>
@endsection