<!DOCTYPE html>
<html lang="pt-BR">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Produtos // Painel</title>
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=IBM+Plex+Mono:wght@400;500;600&family=IBM+Plex+Sans:wght@400;500;600&display=swap" rel="stylesheet">
<style>
  :root {
    --ink: #0a0c0e;
    --panel: #14171a;
    --panel-line: rgba(255, 176, 0, 0.14);
    --amber: #ffb000;
    --amber-dim: rgba(255, 176, 0, 0.55);
    --signal: #ff6b35;
    --paper: #d9d6ce;
    --paper-dim: #8b8a83;
  }
  * { box-sizing: border-box; }
  body {
    margin: 0;
    background: var(--ink);
    color: var(--paper);
    font-family: 'IBM Plex Sans', sans-serif;
    -webkit-font-smoothing: antialiased;
    background-image:
      linear-gradient(var(--panel-line) 1px, transparent 1px),
      linear-gradient(90deg, var(--panel-line) 1px, transparent 1px);
    background-size: 48px 48px;
    min-height: 100vh;
  }
  a { color: inherit; }
  :focus-visible { outline: 2px solid var(--amber); outline-offset: 3px; }
  .mono { font-family: 'IBM Plex Mono', monospace; }
  .wrap { max-width: 1180px; margin: 0 auto; padding: 0 28px; }
  nav {
    display: flex;
    align-items: center;
    justify-content: space-between;
    padding: 28px 0;
    border-bottom: 1px solid var(--panel-line);
  }
  .brand {
    display: flex; align-items: center; gap: 10px;
    font-family: 'IBM Plex Mono', monospace;
    font-weight: 600; letter-spacing: 0.08em; font-size: 15px;
    text-decoration: none; color: var(--paper);
  }
  .brand-mark { width: 22px; height: 22px; border: 1.5px solid var(--amber); position: relative; flex-shrink: 0; }
  .brand-mark::before, .brand-mark::after { content: ''; position: absolute; background: var(--amber); }
  .brand-mark::before { top: 50%; left: 3px; right: 3px; height: 1.5px; transform: translateY(-50%); }
  .brand-mark::after { left: 50%; top: 3px; bottom: 3px; width: 1.5px; transform: translateX(-50%); }
  .navlinks { display: flex; gap: 32px; font-family: 'IBM Plex Mono', monospace; font-size: 12px; letter-spacing: 0.12em; text-transform: uppercase; }
  .navlinks a { text-decoration: none; color: var(--paper-dim); transition: color 0.15s ease; }
  .navlinks a:hover, .navlinks a.active { color: var(--amber); }
  .page-head {
    display: flex; align-items: flex-end; justify-content: space-between;
    padding: 44px 0 26px; flex-wrap: wrap; gap: 18px;
  }
  .eyebrow {
    display: inline-flex; align-items: center; gap: 10px;
    font-family: 'IBM Plex Mono', monospace; font-size: 12px; letter-spacing: 0.16em;
    color: var(--amber); margin-bottom: 12px;
  }
  .eyebrow::before {
    content: ''; width: 7px; height: 7px; background: var(--amber);
    box-shadow: 0 0 8px 1px var(--amber); animation: blink 1.6s steps(2, jump-none) infinite;
  }
  @keyframes blink { 50% { opacity: 0.25; } }
  h1 { font-family: 'IBM Plex Mono', monospace; font-weight: 600; font-size: clamp(26px, 3vw, 34px); margin: 0; }
  .btn {
    font-family: 'IBM Plex Mono', monospace; font-size: 13px; letter-spacing: 0.06em;
    text-decoration: none; padding: 12px 20px; display: inline-flex; align-items: center; gap: 8px;
    border: 1px solid transparent; cursor: pointer; transition: all 0.15s ease;
  }
  .btn-primary { background: var(--amber); color: var(--ink); font-weight: 600; }
  .btn-primary:hover { background: #ffc233; }
  .btn-ghost { border-color: var(--panel-line); color: var(--paper); background: transparent; }
  .btn-ghost:hover { border-color: var(--amber-dim); color: var(--amber); }
  .btn-danger { border-color: rgba(255,107,53,0.35); color: var(--signal); background: transparent; font-size: 12px; padding: 9px 14px; }
  .btn-danger:hover { border-color: var(--signal); background: rgba(255,107,53,0.08); }
  .btn-logout {
    font-family: 'IBM Plex Mono', monospace;
    font-size: 12px;
    letter-spacing: 0.1em;
    text-transform: uppercase;
    background: transparent;
    border: none;
    color: var(--paper-dim);
    cursor: pointer;
    padding: 0;
    transition: color 0.15s ease;
  }
  .btn-logout:hover { color: var(--amber); }
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
  footer {
    border-top: 1px solid var(--panel-line); padding: 26px 0 40px;
    display: flex; justify-content: space-between; align-items: center;
    font-family: 'IBM Plex Mono', monospace; font-size: 11px; letter-spacing: 0.08em; color: var(--paper-dim);
    flex-wrap: wrap; gap: 10px;
  }
  @media (max-width: 780px) {
    .navlinks { display: none; }
    td.desc { display: none; }
    thead th:nth-child(3) { display: none; }
  }
  @media (prefers-reduced-motion: reduce) {
    .eyebrow::before { animation: none; }
  }
</style>
</head>
<body>

  <div class="wrap">
    <nav>
      <a href="{{ route('produtos.index') }}" class="brand">
        <span class="brand-mark"></span>
        PRODUTOS.SYS
      </a>
            <div class="navlinks" style="align-items: center;">
        <a href="/">Início</a>
        <a href="{{ route('produtos.index') }}" class="active">Produtos</a>
        <form method="POST" action="{{ route('logout') }}" style="display:inline; margin: 0;">
          @csrf
          <button type="submit" class="btn-logout">Sair →</button>
        </form>
      </div>
    </nav>

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

</body>
</html>
