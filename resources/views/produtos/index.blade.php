@extends('layouts.app')

@section('title', 'Produtos // Painel')

@push('styles')
<style>
  .page-head { display: flex; align-items: flex-end; justify-content: space-between; padding: 44px 0 26px; flex-wrap: wrap; gap: 18px; }
  h1 { font-family: 'IBM Plex Mono', monospace; font-weight: 600; font-size: clamp(26px, 3vw, 34px); margin: 0; }
  .btn-danger { border-color: rgba(255,107,53,0.35); color: var(--signal); background: transparent; font-size: 12px; padding: 9px 14px; }
  .btn-danger:hover { border-color: var(--signal); background: rgba(255,107,53,0.08); }
  .flash {
    font-family: 'IBM Plex Mono', monospace; font-size: 13px;
    border: 1px solid var(--amber-dim); color: var(--amber);
    padding: 12px 16px; margin-bottom: 24px; display: flex; align-items: center; gap: 10px;
  }
  .flash::before { content: '>'; opacity: 0.7; }
  .panel { border: 1px solid var(--panel-line); background: var(--panel); margin-bottom: 60px; position: relative; overflow: hidden; }
  .panel-head {
    display: flex; justify-content: space-between; padding: 10px 18px;
    border-bottom: 1px solid var(--panel-line); font-family: 'IBM Plex Mono', monospace;
    font-size: 11px; letter-spacing: 0.1em; color: var(--paper-dim);
  }
  .panel-head .count { color: var(--amber); }
  table { width: 100%; border-collapse: collapse; }
  thead th {
    text-align: left; font-family: 'IBM Plex Mono', monospace; font-size: 11px;
    letter-spacing: 0.1em; text-transform: uppercase; color: var(--paper-dim);
    padding: 14px 18px; border-bottom: 1px solid var(--panel-line); font-weight: 500;
  }
  tbody td { padding: 16px 18px; border-bottom: 1px solid var(--panel-line); font-size: 14px; vertical-align: middle; }
  tbody tr:last-child td { border-bottom: none; }
  tbody tr { transition: background 0.15s ease; }
  tbody tr:hover { background: rgba(255,176,0,0.04); }
  td.id { font-family: 'IBM Plex Mono', monospace; color: var(--amber-dim); font-size: 13px; }
  td.name { font-weight: 600; }
  td.desc { color: var(--paper-dim); max-width: 320px; }
  td.price { font-family: 'IBM Plex Mono', monospace; color: var(--amber); white-space: nowrap; }
  td.actions { text-align: right; white-space: nowrap; }
  td.actions form { display: inline; }
  .link-edit {
    font-family: 'IBM Plex Mono', monospace; font-size: 12px; text-decoration: none;
    color: var(--paper); border-bottom: 1px solid var(--panel-line); padding-bottom: 1px; margin-right: 16px;
  }
  .link-edit:hover { color: var(--amber); border-color: var(--amber-dim); }
  .empty { padding: 60px 18px; text-align: center; font-family: 'IBM Plex Mono', monospace; color: var(--paper-dim); font-size: 13px; }
  .empty .ok { color: var(--amber); }

  @media (max-width: 780px) {
    .navlinks { display: none; }
    td.desc { display: none; }
    thead th:nth-child(3) { display: none; }
  }
</style>
@endpush

@section('content')
<div class="wrap">
  @include('partials.nav')
 

  <div class="page-head">
    <div>
      <div class="eyebrow">CATÁLOGO CARREGADO</div>
      <h1>Produtos cadastrados</h1>
    </div>
    <a href="{{ route('produtos.create') }}" class="btn btn-primary">+ Novo produto</a>
  </div>

  @if (session('success'))
    <div class="flash">{{ session('success') }}</div>
  @endif

  <div class="panel">
    <div class="panel-head">
      <span>TABELA: PRODUCTS</span>
      <span class="count">{{ $produtos->count() }} REGISTRO(S)</span>
    </div>

    @if ($produtos->count() > 0)
      <table>
        <thead>
          <tr>
            <th>ID</th>
            <th>Nome</th>
            <th>Descrição</th>
            <th>Preço</th>
            <th>categoria</th>
            <th></th>
          </tr>
        </thead>
        <tbody>
          @foreach ($produtos as $produto)
            <tr>
              <td class="id">#{{ str_pad($produto->id, 3, '0', STR_PAD_LEFT) }}</td>
              <td class="name">{{ $produto->name }}</td>
              <td class="desc">{{ $produto->description ?: '—' }}</td>
              <td class="price">R$ {{ number_format($produto->price, 2, ',', '.') }}</td>
              <td class="category">{{ $produto->category ?: '—' }}</td>
              <td class="actions">
                <a href="{{ route('produtos.edit', $produto) }}" class="link-edit">editar</a>
                <form action="{{ route('produtos.destroy', $produto) }}" method="POST" onsubmit="return confirm('Remover este produto?');">
                  @csrf
                  @method('DELETE')
                  <button type="submit" class="btn btn-danger">excluir</button>
                </form>
              </td>
            </tr>
          @endforeach
        </tbody>
      </table>
    @else
      <div class="empty">
        <div class="ok">&gt; nenhum produto encontrado</div>
        <div>cadastre o primeiro item para começar a rastrear seu estoque</div>
      </div>
    @endif
  </div>

  <footer>
    <span>PRODUTOS.SYS © {{ date('Y') }}</span>
    <span>LARAVEL + DOCKER</span>
  </footer>
</div>
@endsection