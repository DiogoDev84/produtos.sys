@extends('layouts.app')

@section('title', 'Pedido #' . str_pad($pedido->id, 3, '0', STR_PAD_LEFT) . ' // Painel')

@push('styles')
<style>
  .eyebrow { margin: 44px 0 12px; }
  h1 { font-family: 'IBM Plex Mono', monospace; font-weight: 600; font-size: clamp(26px, 3vw, 34px); margin: 0 0 36px; }
  .grid {
    display: grid; grid-template-columns: 1fr 1fr; gap: 24px; margin-bottom: 60px;
  }
  .panel { border: 1px solid var(--panel-line); background: var(--panel); }
  .panel-head {
    padding: 10px 18px; border-bottom: 1px solid var(--panel-line);
    font-family: 'IBM Plex Mono', monospace; font-size: 11px; letter-spacing: 0.1em; color: var(--paper-dim);
  }
  .panel-body { padding: 26px; }

  .detail-row {
    display: flex; justify-content: space-between; padding: 12px 0;
    border-bottom: 1px solid var(--panel-line); font-size: 14px;
  }
  .detail-row:last-child { border-bottom: none; }
  .detail-row .label {
    font-family: 'IBM Plex Mono', monospace; font-size: 11px; letter-spacing: 0.08em;
    text-transform: uppercase; color: var(--paper-dim);
  }
  .detail-row .value { font-weight: 600; text-align: right; }
  .detail-row .value.price { font-family: 'IBM Plex Mono', monospace; color: var(--amber); }

  .badge {
    font-family: 'IBM Plex Mono', monospace; font-size: 11px; letter-spacing: 0.06em;
    padding: 4px 10px; display: inline-block; text-transform: uppercase;
  }
  .badge-pendente { color: var(--paper-dim); border: 1px solid var(--panel-line); }
  .badge-assinado { color: var(--amber); border: 1px solid var(--amber-dim); }

  .signature-wrap {
    border: 1px dashed var(--panel-line); background: var(--ink);
    border-radius: 2px; touch-action: none;
  }
  #signature-pad { display: block; width: 100%; height: 220px; }

  .sig-actions { display: flex; gap: 14px; margin-top: 18px; }

  .btn {
    font-family: 'IBM Plex Mono', monospace; font-size: 13px; letter-spacing: 0.06em;
    text-decoration: none; padding: 13px 22px; display: inline-flex; align-items: center; gap: 8px;
    border: 1px solid transparent; cursor: pointer; transition: all 0.15s ease;
  }
  .btn-primary { background: var(--amber); color: var(--ink); font-weight: 600; }
  .btn-primary:hover { background: #ffc233; }
  .btn-primary:disabled { opacity: 0.4; cursor: not-allowed; }
  .btn-ghost { border-color: var(--panel-line); color: var(--paper); background: transparent; }
  .btn-ghost:hover { border-color: var(--amber-dim); color: var(--amber); }

  .signed-box { text-align: center; }
  .signed-box img {
    max-width: 100%; background: #fff; border: 1px solid var(--panel-line); padding: 12px;
  }
  .signed-meta {
    font-family: 'IBM Plex Mono', monospace; font-size: 12px; color: var(--paper-dim); margin-top: 14px;
  }
  .signed-meta .ok { color: var(--amber); }

  .cancel-link {
    font-family: 'IBM Plex Mono', monospace; font-size: 13px; color: var(--paper-dim); text-decoration: none;
    border-bottom: 1px solid transparent;
  }
  .cancel-link:hover { color: var(--paper); border-color: var(--panel-line); }

  @media (max-width: 860px) {
    .grid { grid-template-columns: 1fr; }
    .navlinks { display: none; }
  }
 
  @media print {
    body { background: #fff !important; color: #000 !important; }
    nav, footer, .cancel-link, #btn-print, .badge, .alert { display: none !important; }
    .grid { grid-template-columns: 1fr !important; gap: 0; }
    .panel { border: 1px solid #ccc !important; background: #fff !important; break-inside: avoid; }
    .panel-head { color: #333 !important; border-color: #ccc !important; }
    .detail-row { border-color: #ddd !important; }
    .detail-row .label { color: #666 !important; }
    .detail-row .value, h1 { color: #000 !important; }
    .signed-box img { border: 1px solid #ccc !important; }
    .eyebrow { color: #000 !important; }
    .eyebrow::before { display: none; }
  }
</style>
@endpush

@section('content')
<div class="wrap">
  @include('partials.nav')

  <div class="eyebrow">
    PEDIDO #{{ str_pad($pedido->id, 3, '0', STR_PAD_LEFT) }}
    @if ($pedido->status === 'assinado')
      <span class="badge badge-assinado">assinado</span>
    @else
      <span class="badge badge-pendente">pendente</span>
    @endif
  </div>
  <h1>Detalhes do pedido</h1>

  @if (session('success'))
    <div class="alert" style="font-family: 'IBM Plex Mono', monospace; font-size: 13px; border: 1px solid var(--amber-dim); color: var(--amber); padding: 12px 16px; margin-bottom: 24px;">
      &gt; {{ session('success') }}
    </div>   
  @endif

 @if (session('error'))
  <div class="alert" style="font-family: 'IBM Plex Mono', monospace; font-size: 13px; border: 1px solid #b33; color: #e55; padding: 12px 16px; margin-bottom: 24px;">
    &gt; {{ session('error') }}
  </div>
@endif

@error('assinatura')
  <div class= "alert" style="font-family: 'IBM Plex Mono', monospace; font-size: 13px; border: 1px solid #b33; color: #e55; padding: 12px 16px; margin-bottom: 24px;">
    &gt; {{ $message }}
  </div>
@enderror

  <div class="grid">
    <div class="panel">
      <div class="panel-head">DADOS DO PEDIDO</div>
      <div class="panel-body">
        <div class="detail-row">
          <span class="label">Cliente</span>
          <span class="value">{{ $pedido->cliente->name }}</span>
        </div>
        <div class="detail-row">
          <span class="label">E-mail</span>
          <span class="value">{{ $pedido->cliente->email }}</span>
        </div>
        <div class="detail-row">
          <span class="label">Produto</span>
          <span class="value">{{ $pedido->produto->name }}</span>
        </div>
        <div class="detail-row">
          <span class="label">Quantidade</span>
          <span class="value">{{ $pedido->quantidade }}</span>
        </div>
        <div class="detail-row">
          <span class="label">Valor total</span>
          <span class="value price">R$ {{ number_format($pedido->valor_total, 2, ',', '.') }}</span>
        </div>
        <div class="detail-row">
          <span class="label">Criado em</span>
          <span class="value">{{ $pedido->created_at->format('d/m/Y H:i') }}</span>
        </div>
      </div>
    </div>

    <div class="panel">
      @if ($pedido->status === 'assinado')
        <div class="panel-head">ASSINATURA REGISTRADA</div>
        <div class="panel-body signed-box">
          <img src="{{ Storage::url($pedido->assinatura) }}" alt="Assinatura do cliente">
          <div class="signed-meta">
            <span class="ok">&gt; assinado em {{ $pedido->signed_at->format('d/m/Y \à\s H:i') }}</span>
          </div><button type="button" id="btn-print" class="btn btn-ghost" style="margin-top: 18px;" onclick="window.print()">imprimir</button>

        </div>
      @else
        <div class="panel-head">ÁREA DE ASSINATURA</div>
        <div class="panel-body">
          <div class="signature-wrap">
            <canvas id="signature-pad"></canvas>
          </div>
          <div class="sig-actions">
            <button type="button" id="btn-clear" class="btn btn-ghost">limpar</button>
            <button type="button" id="btn-save" class="btn btn-primary" disabled>confirmar assinatura</button>
              <form id="form-assinatura" method="POST" action="{{ route('pedidos.assinar', $pedido) }}" style="display:none;">
              @csrf
              <input type="hidden" name="assinatura" id="input-assinatura">
              </form>
          </div>
        </div>
      @endif
    </div>
  </div>

  <a href="{{ route('pedidos.index') }}" class="cancel-link">← voltar para pedidos</a>

  <footer style="margin-top: 60px;">
    <span>PRODUTOS.SYS © {{ date('Y') }}</span>
    <span>LARAVEL + DOCKER</span>
  </footer>
</div>

@if ($pedido->status !== 'assinado')
<script src="https://cdnjs.cloudflare.com/ajax/libs/signature_pad/4.1.6/signature_pad.umd.min.js"></script>
<script>
  const canvas = document.getElementById('signature-pad');
  const wrap = canvas.parentElement;

  function resizeCanvas() {
    const ratio = Math.max(window.devicePixelRatio || 1, 1);
    canvas.width = wrap.clientWidth * ratio;
    canvas.height = wrap.clientHeight * ratio;
    canvas.getContext('2d').scale(ratio, ratio);
  }
  window.addEventListener('resize', resizeCanvas);
  resizeCanvas();

  const signaturePad = new SignaturePad(canvas, {
    backgroundColor: 'rgb(217, 214, 206)',
    penColor: 'rgb(10, 12, 14)'
  });

    const btnClear = document.getElementById('btn-clear');
  const btnSave = document.getElementById('btn-save');

  btnClear.addEventListener('click', () => {
    signaturePad.clear();
    btnSave.disabled = true;
  });

  signaturePad.addEventListener('endStroke', () => {
    btnSave.disabled = signaturePad.isEmpty();
  });

  btnSave.addEventListener('click', () => {
    if (signaturePad.isEmpty()) return;

    btnSave.disabled = true;
    btnSave.textContent = 'salvando...';

    // Coloca a imagem (em texto base64) dentro do campo escondido e envia o formulário
    document.getElementById('input-assinatura').value = signaturePad.toDataURL('image/png');
    document.getElementById('form-assinatura').submit();
  });
</script>
@endif
@endsection