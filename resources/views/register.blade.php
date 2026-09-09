<!DOCTYPE html>
<html lang="pt-BR">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Cadastro // Painel</title>
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
    margin: 0; background: var(--ink); color: var(--paper);
    font-family: 'IBM Plex Sans', sans-serif; -webkit-font-smoothing: antialiased;
    background-image: linear-gradient(var(--panel-line) 1px, transparent 1px), linear-gradient(90deg, var(--panel-line) 1px, transparent 1px);
    background-size: 48px 48px; min-height: 100vh;
    display: flex; align-items: center; justify-content: center;
  }
  a { color: inherit; }
  :focus-visible { outline: 2px solid var(--amber); outline-offset: 3px; }

  .card { width: 100%; max-width: 420px; padding: 24px; }
  .brand {
    display: flex; align-items: center; gap: 10px; justify-content: center;
    font-family: 'IBM Plex Mono', monospace; font-weight: 600; letter-spacing: 0.08em; font-size: 15px;
    text-decoration: none; color: var(--paper); margin-bottom: 30px;
  }
  .brand-mark { width: 22px; height: 22px; border: 1.5px solid var(--amber); position: relative; flex-shrink: 0; }
  .brand-mark::before, .brand-mark::after { content: ''; position: absolute; background: var(--amber); }
  .brand-mark::before { top: 50%; left: 3px; right: 3px; height: 1.5px; transform: translateY(-50%); }
  .brand-mark::after { left: 50%; top: 3px; bottom: 3px; width: 1.5px; transform: translateX(-50%); }

  .panel { border: 1px solid var(--panel-line); background: var(--panel); }
  .panel-head { padding: 10px 18px; border-bottom: 1px solid var(--panel-line); font-family: 'IBM Plex Mono', monospace; font-size: 11px; letter-spacing: 0.1em; color: var(--paper-dim); }
  .panel-body { padding: 30px 26px; }

  h1 { font-family: 'IBM Plex Mono', monospace; font-size: 20px; margin: 0 0 24px; }

  .field { margin-bottom: 20px; }
  label { display: block; font-family: 'IBM Plex Mono', monospace; font-size: 12px; letter-spacing: 0.08em; color: var(--amber-dim); margin-bottom: 8px; }
  label::before { content: '> '; color: var(--amber); }
  input {
    width: 100%; background: var(--ink); border: 1px solid var(--panel-line); color: var(--paper);
    font-family: 'IBM Plex Sans', sans-serif; font-size: 14px; padding: 12px 14px;
  }
  input:focus { border-color: var(--amber); outline: none; }
  .error { font-family: 'IBM Plex Mono', monospace; font-size: 12px; color: var(--signal); margin-top: 6px; }
  .error::before { content: '! '; }

  .btn-primary {
    width: 100%; background: var(--amber); color: var(--ink); font-weight: 600;
    font-family: 'IBM Plex Mono', monospace; font-size: 13px; letter-spacing: 0.06em;
    padding: 13px 22px; border: none; cursor: pointer; margin-top: 6px;
  }
  .btn-primary:hover { background: #ffc233; }

  .switch { text-align: center; margin-top: 20px; font-size: 13px; color: var(--paper-dim); }
  .switch a { color: var(--amber); text-decoration: none; border-bottom: 1px solid var(--amber-dim); }
</style>
</head>
<body>
  <div class="card">
    <a href="/" class="brand"><span class="brand-mark"></span> PRODUTOS.SYS</a>

    <div class="panel">
      <div class="panel-head">INSERT INTO users</div>
      <div class="panel-body">
        <h1>Criar conta</h1>

        <form action="{{ route('register') }}" method="POST">
          @csrf

          <div class="field">
            <label for="name">nome</label>
            <input type="text" name="name" id="name" value="{{ old('name') }}">
            @error('name') <div class="error">{{ $message }}</div> @enderror
          </div>

          <div class="field">
            <label for="email">email</label>
            <input type="email" name="email" id="email" value="{{ old('email') }}">
            @error('email') <div class="error">{{ $message }}</div> @enderror
          </div>

          <div class="field">
            <label for="password">senha</label>
            <input type="password" name="password" id="password">
            @error('password') <div class="error">{{ $message }}</div> @enderror
          </div>

          <div class="field">
            <label for="password_confirmation">confirmar senha</label>
            <input type="password" name="password_confirmation" id="password_confirmation">
          </div>

          <button type="submit" class="btn-primary">Cadastrar</button>
        </form>

        <div class="switch">Já tem conta? <a href="{{ route('login') }}">Entrar</a></div>
      </div>
    </div>
  </div>
</body>
</html>