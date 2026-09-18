@extends('layouts.app')

@section('title', 'Clientes // Painel')

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
    thead th:nth-child(4) { display: none; }
  }
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
      <a href="{{ route('clientes.index') }}" class="active">Clientes</a>
      <a href="{{ route('pedidos.index') }}">Pedidos</a>
      <form method="POST" action="{{ route('logout') }}" style="display:inline; margin: 0;">
        @csrf
        <button type="submit" class="btn-logout">Sair →</button>
      </form>
    </div>
  </nav>

  <div class="page-head">
    <div>
      <div class="eyebrow">BASE DE CLIENTES</div>
      <h1>Clientes cadastrados</h1>
    </div>
    <a href="{{ route('clientes.create') }}" class="btn btn-primary">+ Novo cliente</a>
  </div>

  @if (session('success'))
    <div class="flash">{{ session('success') }}</div>
  @endif

  <div class="panel">
    <div class="panel-head">
      <span>TABELA: CLIENTES</span>
      <span class="count">{{ $clientes->count() }} REGISTRO(S)</span>
    </div>

    @if ($clientes->count() > 0)
      <table>
        <thead>
          <tr>
            <th>ID</th>
            <th>Nome</th>
            <th>E-mail</th>
            <th>Telefone</th>
            <th></th>
          </tr>
        </thead>
        <tbody>
          @foreach ($clientes as $cliente)
            <tr>
              <td class="id">#{{ str_pad($cliente->id, 3, '0', STR_PAD_LEFT) }}</td>
              <td class="name">{{ $cliente->name }}</td>
              <td class="desc">{{ $cliente->email }}</td>
              <td>{{ $cliente->phone ?: '—' }}</td>
              <td class="actions">
                <a href="{{ route('clientes.edit', $cliente) }}" class="link-edit">editar</a>
                <form action="{{ route('clientes.destroy', $cliente) }}" method="POST" onsubmit="return confirm('Remover este cliente?');">
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
        <div class="ok">&gt; nenhum cliente encontrado</div>
        <div>cadastre o primeiro cliente para começar</div>
      </div>
    @endif
  </div>

  <footer>
    <span>PRODUTOS.SYS © {{ date('Y') }}</span>
    <span>LARAVEL + DOCKER</span>
  </footer>
</div>
@endsection