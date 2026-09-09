<!DOCTYPE html>
<html lang="pt-BR">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Novo produto // Painel</title>
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

  .wrap { max-width: 1180px; margin: 0 auto; padding: 0 28px; }

  nav {
    display: flex; align-items: center; justify-content: space-between;
    padding: 28px 0; border-bottom: 1px solid var(--panel-line);
  }
  .brand {
    display: flex; align-items: center; gap: 10px;
    font-family: 'IBM Plex Mono', monospace; font-weight: 600; letter-spacing: 0.08em; font-size: 15px;
    text-decoration: none; color: var(--paper);
  }
  .brand-mark { width: 22px; height: 22px; border: 1.5px solid var(--amber); position: relative; flex-shrink: 0; }
  .brand-mark::before, .brand-mark::after { content: ''; position: absolute; background: var(--amber); }
  .brand-mark::before { top: 50%; left: 3px; right: 3px; height: 1.5px; transform: translateY(-50%); }
  .brand-mark::after { left: 50%; top: 3px; bottom: 3px; width: 1.5px; transform: translateX(-50%); }
  .navlinks { display: flex; gap: 32px; font-family: 'IBM Plex Mono', monospace; font-size: 12px; letter-spacing: 0.12em; text-transform: uppercase; }
  .navlinks a { text-decoration: none; color: var(--paper-dim); transition: color 0.15s ease; }
  .navlinks a:hover { color: var(--amber); }

  .eyebrow {
    display: inline-flex; align-items: center; gap: 10px;
    font-family: 'IBM Plex Mono', monospace; font-size: 12px; letter-spacing: 0.16em;
    color: var(--amber); margin: 44px 0 12px;
  }
  .eyebrow::before {
    content: ''; width: 7px; height: 7px; background: var(--amber);
    box-shadow: 0 0 8px 1px var(--amber); animation: blink 1.6s steps(2, jump-none) infinite;
  }
  @keyframes blink { 50% { opacity: 0.25; } }
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

  .error {
    font-family: 'IBM Plex Mono', monospace; font-size: 12px; color: var(--signal); margin-top: 6px;
  }
  .error::before { content: '! '; }

  .actions { display: flex; align-items: center; gap: 18px; margin-top: 32px; }
  .btn {
    font-family: 'IBM Plex Mono', monospace; font-size: 13px; letter-spacing: 0.06em;
    text-decoration: none; padding: 13px 22px; display: inline-flex; align-items: center; gap: 8px;
    border: 1px solid transparent; cursor: pointer; transition: all 0.15s ease;
  }
  .btn-primary { background: var(--amber); color: var(--ink); font-weight: 600; }
  .btn-primary:hover { background: #ffc233; }
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

  .cancel-link {
    font-family: 'IBM Plex Mono', monospace; font-size: 13px; color: var(--paper-dim); text-decoration: none;
    border-bottom: 1px solid transparent;
  }
  .cancel-link:hover { color: var(--paper); border-color: var(--panel-line); }

  footer {
    border-top: 1px solid var(--panel-line); padding: 26px 0 40px;
    display: flex; justify-content: space-between; align-items: center;
    font-family: 'IBM Plex Mono', monospace; font-size: 11px; letter-spacing: 0.08em; color: var(--paper-dim);
    flex-wrap: wrap; gap: 10px;
  }

  @media (max-width: 780px) { .navlinks { display: none; } }
  @media (prefers-reduced-motion: reduce) { .eyebrow::before { animation: none; } }
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
        <a href="{{ route('produtos.index') }}">Produtos</a>
        <form method="POST" action="{{ route('logout') }}" style="display:inline; margin: 0;">
          @csrf
          <button type="submit" class="btn-logout">Sair →</button>
        </form>
      </div>
    </nav>

    <div class="eyebrow">NOVO REGISTRO</div>
    <h1>Cadastrar produto</h1>

    <div class="panel">
      <div class="panel-head">INSERT INTO products</div>
      <div class="panel-body">
        <form action="{{ route('produtos.store') }}" method="POST">
          @csrf

          <div class="field">
            <label for="name">nome</label>
            <input type="text" name="name" id="name" value="{{ old('name') }}" placeholder="ex: Teclado mecânico">
            @error('name') <div class="error">{{ $message }}</div> @enderror
          </div>

          <div class="field">
            <label for="description">descrição</label>
            <textarea name="description" id="description" placeholder="detalhes do produto (opcional)">{{ old('description') }}</textarea>
          </div>

          <div class="field">
            <label for="price">preço</label>
            <input type="number" step="0.01" name="price" id="price" value="{{ old('price') }}" placeholder="0.00">
            @error('price') <div class="error">{{ $message }}</div> @enderror
          </div>

          <div class="actions">
            <button type="submit" class="btn btn-primary">Salvar produto</button>
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

</body>
</html>
