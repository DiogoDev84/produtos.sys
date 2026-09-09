<!DOCTYPE html>
<html lang="pt-BR">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Cadastro — PRODUTOS.SYS</title>
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
    --paper: #d9d6ce;
    --paper-dim: #8b8a83;
    --danger: #ff5c5c;
  }
  * { box-sizing: border-box; }
  body {
    margin: 0;
    min-height: 100vh;
    background: var(--ink);
    color: var(--paper);
    font-family: 'IBM Plex Sans', sans-serif;
    -webkit-font-smoothing: antialiased;
    background-image:
      linear-gradient(var(--panel-line) 1px, transparent 1px),
      linear-gradient(90deg, var(--panel-line) 1px, transparent 1px);
    background-size: 48px 48px;
    display: flex;
    align-items: center;
    justify-content: center;
    padding: 24px;
  }
  a { color: inherit; }
  :focus-visible { outline: 2px solid var(--amber); outline-offset: 3px; }
  .brand {
    display: flex; align-items: center; gap: 10px;
    font-family: 'IBM Plex Mono', monospace; font-weight: 600;
    letter-spacing: 0.08em; font-size: 15px; color: var(--paper);
    text-decoration: none; justify-content: center; margin-bottom: 36px;
  }
  .brand-mark { width: 22px; height: 22px; border: 1.5px solid var(--amber); position: relative; flex-shrink: 0; }
  .brand-mark::before, .brand-mark::after { content: ''; position: absolute; background: var(--amber); }
  .brand-mark::before { top: 50%; left: 3px; right: 3px; height: 1.5px; transform: translateY(-50%); }
  .brand-mark::after { left: 50%; top: 3px; bottom: 3px; width: 1.5px; transform: translateX(-50%); }
  .register-box { width: 100%; max-width: 400px; }
  .terminal { background: var(--panel); border: 1px solid var(--panel-line); }
  .terminal-head {
    display: flex; justify-content: space-between; padding: 10px 16px;
    border-bottom: 1px solid var(--panel-line); font-family: 'IBM Plex Mono', monospace;
    font-size: 11px; letter-spacing: 0.1em; color: var(--paper-dim);
  }
  .terminal-body { padding: 32px 28px; }
  .eyebrow {
    display: inline-flex; align-items: center; gap: 10px;
    font-family: 'IBM Plex Mono', monospace; font-size: 12px; letter-spacing: 0.16em;
    color: var(--amber); margin-bottom: 14px;
  }
  .eyebrow::before { content: ''; width: 7px; height: 7px; background: var(--amber); box-shadow: 0 0 8px 1px var(--amber); }
  h1 { font-family: 'IBM Plex Mono', monospace; font-weight: 600; font-size: 24px; margin: 0 0 8px; color: var(--paper); }
  .lede { font-size: 14px; line-height: 1.6; color: var(--paper-dim); margin: 0 0 28px; }
  .field { margin-bottom: 20px; }
  label {
    display: block; font-family: 'IBM Plex Mono', monospace; font-size: 11px;
    letter-spacing: 0.1em; text-transform: uppercase; color: var(--paper-dim); margin-bottom: 8px;
  }
  input[type="text"], input[type="email"], input[type="password"] {
    width: 100%; background: var(--ink); border: 1px solid var(--panel-line); color: var(--paper);
    font-family: 'IBM Plex Mono', monospace; font-size: 14px; padding: 12px 14px;
    transition: border-color 0.15s ease;
  }
  input:focus { border-color: var(--amber-dim); outline: none; }
  .alert {
    font-family: 'IBM Plex Mono', monospace; font-size: 12px; color: var(--danger);
    border: 1px solid rgba(255, 92, 92, 0.3); background: rgba(255, 92, 92, 0.08);
    padding: 10px 14px; margin-bottom: 20px;
  }
  .alert ul { margin: 0; padding-left: 16px; }
  .btn {
    width: 100%; font-family: 'IBM Plex Mono', monospace; font-size: 13px; letter-spacing: 0.06em;
    text-decoration: none; padding: 14px 22px; display: inline-flex; align-items: center;
    justify-content: center; gap: 8px; border: 1px solid transparent; cursor: pointer;
    transition: all 0.15s ease; background: var(--amber); color: var(--ink); font-weight: 600;
  }
  .btn:hover { background: #ffc233; }
  .footer-link {
    text-align: center; margin-top: 22px; font-family: 'IBM Plex Mono', monospace;
    font-size: 12px; color: var(--paper-dim);
  }
  .footer-link a { color: var(--amber); text-decoration: none; }
  .footer-link a:hover { text-decoration: underline; }
</style>
</head>
<body>

  <div class="register-box">
    <a href="/" class="brand">
      <span class="brand-mark"></span>
      PRODUTOS.SYS
    </a>

    <div class="terminal">
      <div class="terminal-head">
        <span>CADASTRO</span>
        <span>STATUS: AGUARDANDO</span>
      </div>
      <div class="terminal-body">
        <div class="eyebrow">NOVA CONTA</div>
        <h1>Criar acesso</h1>
        <p class="lede">Preencha os dados abaixo para se cadastrar no sistema.</p>

        @if ($errors->any())
          <div class="alert">
            <ul>
              @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
              @endforeach
            </ul>
          </div>
        @endif

        <form method="POST" action="{{ route('register') }}">
          @csrf

          <div class="field">
            <label for="name">Nome</label>
            <input type="text" id="name" name="name" value="{{ old('name') }}" required autofocus>
          </div>

          <div class="field">
            <label for="email">E-mail</label>
            <input type="email" id="email" name="email" value="{{ old('email') }}" required>
          </div>

          <div class="field">
            <label for="password">Senha</label>
            <input type="password" id="password" name="password" required>
          </div>

          <div class="field">
            <label for="password_confirmation">Confirmar senha</label>
            <input type="password" id="password_confirmation" name="password_confirmation" required>
          </div>

          <button type="submit" class="btn">Criar conta →</button>
        </form>
      </div>
    </div>

    <div class="footer-link">
      Já tem conta? <a href="{{ route('login') }}">Entrar</a>
    </div>
  </div>

</body>
</html>
