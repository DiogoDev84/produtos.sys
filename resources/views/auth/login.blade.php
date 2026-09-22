@extends('layouts.app')

@section('title', 'Login — PRODUTOS.SYS')

@push('styles')
<style>
  body {
    display: flex;
    align-items: center;
    justify-content: center;
    padding: 24px;
  }

  .login-box {
    width: 100%;
    max-width: 400px;
  }

  .login-box .brand {
    justify-content: center;
    margin-bottom: 36px;
  }

  .terminal-body { padding: 32px 28px; }

  h1 {
    font-family: 'IBM Plex Mono', monospace;
    font-weight: 600;
    font-size: 24px;
    line-height: 1.2;
    margin: 0 0 8px;
    color: var(--paper);
  }

  .lede {
    font-size: 14px;
    line-height: 1.6;
    color: var(--paper-dim);
    margin: 0 0 28px;
  }

  .field { margin-bottom: 20px; }

  label {
    display: block;
    font-family: 'IBM Plex Mono', monospace;
    font-size: 11px;
    letter-spacing: 0.1em;
    text-transform: uppercase;
    color: var(--paper-dim);
    margin-bottom: 8px;
  }

  input[type="email"],
  input[type="password"] {
    width: 100%;
    background: var(--ink);
    border: 1px solid var(--panel-line);
    color: var(--paper);
    font-family: 'IBM Plex Mono', monospace;
    font-size: 14px;
    padding: 12px 14px;
    transition: border-color 0.15s ease;
  }

  input[type="email"]:focus,
  input[type="password"]:focus {
    border-color: var(--amber-dim);
    outline: none;
  }

  .alert {
    font-family: 'IBM Plex Mono', monospace;
    font-size: 12px;
    color: var(--danger);
    border: 1px solid rgba(255, 92, 92, 0.3);
    background: rgba(255, 92, 92, 0.08);
    padding: 10px 14px;
    margin-bottom: 20px;
  }

  .btn { width: 100%; justify-content: center; }

  .footer-link {
    text-align: center;
    margin-top: 22px;
    font-family: 'IBM Plex Mono', monospace;
    font-size: 12px;
    color: var(--paper-dim);
  }
  .footer-link a {
    color: var(--amber);
    text-decoration: none;
  }
  .footer-link a:hover { text-decoration: underline; }
</style>
@endpush

@section('content')
<div class="login-box">
  <a href="/" class="brand">
    <span class="brand-mark"></span>
    PRODUTOS.SYS
  </a>

  <div class="terminal">
    <div class="terminal-head">
      <span>AUTENTICAÇÃO</span>
      <span>STATUS: AGUARDANDO</span>
    </div>
    <div class="terminal-body">
      <div class="eyebrow">ACESSO RESTRITO</div>
      <h1>Entrar no sistema</h1>
      <p class="lede">Informe suas credenciais para acessar o painel de produtos.</p>

      @if ($errors->any())
        <div class="alert">
          &gt; {{ $errors->first() }}
        </div>
      @endif

      <form method="POST" action="{{ route('login') }}">
        @csrf

        <div class="field">
          <label for="email">E-mail</label>
          <input type="email" id="email" name="email" value="{{ old('email') }}" required autofocus>
        </div>

        <div class="field">
          <label for="password">Senha</label>
          <input type="password" id="password" name="password" required>
        </div>

        <button type="submit" class="btn btn-primary">Acessar sistema →</button>
      </form>
    </div>
  </div>

  <div class="footer-link">
    Ainda não tem conta? <a href="{{ route('register') }}">Cadastre-se</a>
  </div>
</div>

<script src="https://cdnjs.cloudflare.com/ajax/libs/crypto-js/4.2.0/crypto-js.min.js"></script>
<script>
  document.querySelector('form').addEventListener('submit', function (e) {
    e.preventDefault();

    const passwordField = document.getElementById('password');
    passwordField.value = CryptoJS.SHA256(passwordField.value).toString();

    e.target.submit();
  });
</script>
@endsection