@extends('layouts.app')

@section('title', 'Painel de Produtos')

@push('styles')
<style>
  .hero {
    padding: 88px 0 72px; display: grid;
    grid-template-columns: 1.1fr 0.9fr; gap: 56px; align-items: center;
  }
  h1 {
    font-family: 'IBM Plex Mono', monospace; font-weight: 600;
    font-size: clamp(34px, 4.4vw, 56px); line-height: 1.08;
    letter-spacing: -0.01em; margin: 0 0 22px; color: var(--paper);
  }
  h1 span { color: var(--amber); }
  .lede { font-size: 17px; line-height: 1.65; color: var(--paper-dim); max-width: 46ch; margin: 0 0 34px; }
  .cta-row { display: flex; gap: 14px; flex-wrap: wrap; }
  .terminal-body { padding: 20px 18px; min-height: 168px; font-family: 'IBM Plex Mono', monospace; font-size: 13px; line-height: 1.9; }
  .terminal-body .ok { color: var(--amber); }
  .terminal-body .muted { color: var(--paper-dim); }
  .caret {
    display: inline-block; width: 7px; height: 14px; background: var(--amber);
    vertical-align: middle; margin-left: 2px; animation: blink 1s steps(2, jump-none) infinite;
  }
  .scan-frame {
    margin-top: 22px; position: relative; border: 1px solid var(--panel-line);
    background: var(--panel); padding: 26px; overflow: hidden;
  }
  .scan-frame svg { display: block; width: 100%; height: auto; }
  .scan-line {
    position: absolute; left: 0; right: 0; height: 2px;
    background: linear-gradient(90deg, transparent, var(--amber), transparent);
    box-shadow: 0 0 14px 2px var(--amber-dim); animation: sweep 3.2s ease-in-out infinite;
  }
  @keyframes sweep { 0%, 100% { top: 8%; } 50% { top: 88%; } }
  .scan-label {
    position: absolute; bottom: 10px; left: 14px;
    font-family: 'IBM Plex Mono', monospace; font-size: 10px;
    letter-spacing: 0.14em; color: var(--amber-dim);
  }
  .caps {
    border-top: 1px solid var(--panel-line); padding: 60px 0;
    display: grid; grid-template-columns: repeat(3, 1fr); gap: 1px; background: var(--panel-line);
  }
  .cap { background: var(--ink); padding: 30px 26px; }
  .cap-tag { font-family: 'IBM Plex Mono', monospace; font-size: 11px; letter-spacing: 0.12em; color: var(--amber); margin-bottom: 14px; display: block; }
  .cap h3 { font-size: 17px; margin: 0 0 10px; font-weight: 600; }
  .cap p { font-size: 14px; line-height: 1.6; color: var(--paper-dim); margin: 0; }

  @media (max-width: 860px) {
    .hero { grid-template-columns: 1fr; padding: 56px 0; }
    .caps { grid-template-columns: 1fr; }
    .navlinks { display: none; }
  }
</style>
@endpush

@section('content')
<div class="wrap">
  <nav>
    <a href="/" class="brand">
      <span class="brand-mark"></span>
      PRODUTOS.SYS
    </a>
    <div class="navlinks" style="align-items: center;">
      <a href="#painel">Painel</a>
      <a href="#capacidades">Capacidades</a>
      <a href="{{ route('produtos.index') }}">Produtos</a>
      <a href="{{ route('clientes.index') }}">Clientes</a>
      @auth
        <form method="POST" action="{{ route('logout') }}" style="display:inline; margin: 0;">
          @csrf
          <button type="submit" class="btn-logout">Sair →</button>
        </form>
      @else
        <a href="{{ route('login') }}">Entrar</a>
      @endauth
    </div>
  </nav>

  <section class="hero">
    <div>
      <div class="eyebrow">CONECTADO AO BANCO DE DADOS</div>
      <h1>Cada produto do seu estoque,<br><span>rastreado em tempo real.</span></h1>
      <p class="lede">Um painel direto ao ponto para cadastrar, editar e acompanhar seu catálogo — sem telas confusas, sem cliques a mais.</p>
      <div class="cta-row">
        <a href="{{ route('produtos.index') }}" class="btn btn-primary">Abrir painel de produtos →</a>
        <a href="#capacidades" class="btn btn-ghost">Ver capacidades</a>
      </div>
    </div>

    <div id="painel">
      <div class="terminal">
        <div class="terminal-head">
          <span>TERMINAL</span>
          <span>STATUS: ATIVO</span>
        </div>
        <div class="terminal-body">
          <div class="muted">&gt; conectando ao banco de dados...</div>
          <div class="ok">&gt; conexão estabelecida (mysql)</div>
          <div class="muted">&gt; carregando tabela produtos...</div>
          <div class="ok">&gt; catálogo pronto para uso<span class="caret"></span></div>
        </div>
      </div>

      <div class="scan-frame">
        <div class="scan-line"></div>
        <svg viewBox="0 0 300 170" fill="none" xmlns="http://www.w3.org/2000/svg">
          <path d="M60 45 L150 20 L240 45 L240 130 L150 155 L60 130 Z" stroke="#ffb000" stroke-width="1.2" opacity="0.9"/>
          <path d="M60 45 L150 70 L240 45" stroke="#ffb000" stroke-width="1" opacity="0.5"/>
          <line x1="150" y1="70" x2="150" y2="155" stroke="#ffb000" stroke-width="1" opacity="0.5"/>
          <line x1="24" y1="24" x2="44" y2="24" stroke="#ffb000" stroke-width="1.4"/>
          <line x1="24" y1="24" x2="24" y2="44" stroke="#ffb000" stroke-width="1.4"/>
          <line x1="276" y1="24" x2="256" y2="24" stroke="#ffb000" stroke-width="1.4"/>
          <line x1="276" y1="24" x2="276" y2="44" stroke="#ffb000" stroke-width="1.4"/>
          <line x1="24" y1="146" x2="44" y2="146" stroke="#ffb000" stroke-width="1.4"/>
          <line x1="24" y1="146" x2="24" y2="126" stroke="#ffb000" stroke-width="1.4"/>
          <line x1="276" y1="146" x2="256" y2="146" stroke="#ffb000" stroke-width="1.4"/>
          <line x1="276" y1="146" x2="276" y2="126" stroke="#ffb000" stroke-width="1.4"/>
        </svg>
        <span class="scan-label">ESCANEANDO ITEM · SKU #0042</span>
      </div>
    </div>
  </section>
</div>

<div class="caps" id="capacidades">
  <div class="wrap" style="display:contents;">
    <div class="cap">
      <span class="cap-tag">CADASTRO</span>
      <h3>Adicione produtos em segundos</h3>
      <p>Nome, descrição e preço — só o essencial, sem formulário burocrático.</p>
    </div>
    <div class="cap">
      <span class="cap-tag">EDIÇÃO</span>
      <h3>Atualize sem perder o histórico</h3>
      <p>Ajuste preços e informações a qualquer momento, direto na listagem.</p>
    </div>
    <div class="cap">
      <span class="cap-tag">CONTROLE</span>
      <h3>Veja tudo em um só lugar</h3>
      <p>Catálogo completo, sempre visível, sempre atualizado com o banco.</p>
    </div>
  </div>
</div>

<div class="wrap">
  <footer>
    <span>PRODUTOS.SYS © {{ date('Y') }}</span>
    <span>LARAVEL + DOCKER</span>
  </footer>
</div>
@endsection