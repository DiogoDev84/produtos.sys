@extends('layouts.app')

@section('title', 'Cadastro // Painel')

@push('styles')
<style>
  body { display: flex; align-items: center; justify-content: center; }
  .card { width: 100%; max-width: 420px; padding: 24px; }
  .card .brand { justify-content: center; margin-bottom: 30px; }
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
@endpush

@section('content')
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

@endsection