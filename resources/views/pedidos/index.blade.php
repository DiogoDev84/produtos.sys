@extends('layouts.app')

@section('title', 'Pedidos // Painel')

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
  td.price { font-family: 'IBM Plex Mono', monospace; color: var(--amber); white-space: nowrap; }
  td.actions { text-align: right; white-space: nowrap; }
  td.actions form { display: inline; }
  .link-view {
    font-family: 'IBM Plex Mono', monospace; font-size: 12px; text-decoration: none;
    color: var(--paper); border-bottom: 1px solid var(--panel-line); padding-bottom: 1px; margin-right: 16px;
  }
  .link-view:hover { color: var(--amber); border-color: var(--amber-dim); }
  .badge {
    font-family: 'IBM Plex Mono', monospace; font-size: 11px; letter-spacing: 0.06em;
    padding: 4px 10px; display: inline-block; text-transform: uppercase;
  }
  .badge-pendente { color: var(--paper-dim); border: 1px solid var(--panel-line); }
  .badge-assinado { color: var(--amber); border: 1px solid var(--amber-dim); }
  .empty { padding: 60px 18px; text-align: center; font-family: 'IBM Plex Mono', monospace; color: var(--paper-dim); font-size: 13px; }
  .empty .ok { color: var(--amber); }

  @media (max-width: 780px) {
    .navlinks { display: none; }
  }
</style>
@endpush

@section('content')
<div class="wrap">
  @include('partials.nav')

  <div class="page-head">
    <div>
      <div class="eyebrow">CONTROLE DE VENDAS</div>
      <h1>Pedidos</h1>
    </div>
    <a href="{{ route('pedidos.create') }}" class="btn btn-primary">+ Novo pedido</a>
  </div>

  @if (session('success'))
    <div class="flash">{{ session('success') }}</div>
  @endif

  <div class="panel">
    <div class="panel-head">
      <span>TABELA: PEDIDOS</span>
      <span class="count">{{ $pedidos->count() }} REGISTRO(S)</span>
    </div>

    @if ($pedidos->count() > 0)
      <table>
        <thead>
          <tr>
            <th>ID</th>
            <th>Cliente</th>
            <th>Produto</th>
            <th>Valor</th>
            <th>Status</th>
            <th></th>
          </tr>
        </thead>
        <tbody>
          @foreach ($pedidos as $pedido)
            <tr>
              <td class="id">#{{ str_pad($pedido->id, 3, '0', STR_PAD_LEFT) }}</td>
              <td class="name">{{ $pedido->cliente->name }}</td>
              <td>{{ $pedido->produto->name }}</td>
              <td class="price">R$ {{ number_format($pedido->valor_total, 2, ',', '.') }}</td>
              <td>
                @if ($pedido->status === 'assinado')
                  <span class="badge badge-assinado">assinado</span>
                @else
                  <span class="badge badge-pendente">pendente</span>
                @endif
              </td>
              <td class="actions">
                <a href="{{ route('pedidos.show', $pedido) }}" class="link-view">ver</a>
                <form action="{{ route('pedidos.destroy', $pedido) }}" method="POST" onsubmit="return confirm('Remover este pedido?');">
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
        <div class="ok">&gt; nenhum pedido encontrado</div>
        <div>crie o primeiro pedido para começar</div>
      </div>
    @endif
  </div>

  <footer>
    <span>PRODUTOS.SYS © {{ date('Y') }}</span>
    <span>LARAVEL + DOCKER</span>
  </footer>
</div>
@endsection