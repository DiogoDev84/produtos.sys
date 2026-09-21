@extends('layouts.app')

@section('title', 'Novo cliente // Painel')

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
  input[type="text"], input[type="email"] {
    width: 100%; background: var(--ink); border: 1px solid var(--panel-line); color: var(--paper);
    font-family: 'IBM Plex Sans', sans-serif; font-size: 14px; padding: 12px 14px;
    transition: border-color 0.15s ease;
  }
  input:focus { border-color: var(--amber); outline: none; }
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

  <div class="eyebrow">NOVO REGISTRO</div>
  <h1>Cadastrar cliente</h1>

  <div class="panel">
    <div class="panel-head">INSERT INTO clientes</div>
    <div class="panel-body">
      <form action="{{ route('clientes.store') }}" method="POST">
        @csrf

        <div class="field">
          <label for="name">nome</label>
          <input type="text" name="name" id="name" value="{{ old('name') }}" placeholder="ex: João da Silva">
          @error('name') <div class="error">{{ $message }}</div> @enderror
        </div>

        <div class="field">
          <label for="email">e-mail</label>
          <input type="email" name="email" id="email" value="{{ old('email') }}" placeholder="ex: joao@email.com">
          @error('email') <div class="error">{{ $message }}</div> @enderror
        </div>

        <div class="field">
          <label for="phone">telefone</label>
          <input type="text" name="phone" id="phone" value="{{ old('phone') }}" placeholder="ex: (11) 99999-9999" maxlength="15">
          @error('phone') <div class="error">{{ $message }}</div> @enderror
        </div>

        <div class="field">
          <label for="address">endereço</label>
          <input type="text" name="address" id="address" value="{{ old('address') }}" placeholder="ex: Rua das Flores, 123">
          @error('address') <div class="error">{{ $message }}</div> @enderror
        </div>

        <div class="actions">
          <button type="submit" class="btn btn-primary">Salvar cliente</button>
          <a href="{{ route('clientes.index') }}" class="cancel-link">cancelar</a>
        </div>
      </form>
    </div>
  </div>

  <footer>
    <span>PRODUTOS.SYS © {{ date('Y') }}</span>
    <span>LARAVEL + DOCKER</span>
  </footer>
</div>
<script>
  const phoneInput = document.getElementById('phone');

  phoneInput.addEventListener ('input', function(e){
    let digits = e.target.value.replace(/\D/g, ''); // remove tudo que não é número
    digits = digits.substring(0, 11);  // limita a 11 dígitos (DDD + 9 dígitos)

    let formatted = '';
    
   if (digits.length > 0) {
      formatted += '(' + digits.substring(0, 2); // abre parêntese + DDD
    }
    if (digits.length > 2) {
      formatted += ') ' + digits.substring(2, 7); // fecha parêntese + espaço + primeiros dígitos
    }
    if (digits.length > 7) {
      formatted += '-' + digits.substring(7, 11); // traço + últimos dígitos
    }
    e.target.value = formatted;
  });

</script>
@endsection