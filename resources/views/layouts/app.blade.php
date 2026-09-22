<!DOCTYPE html>
<html lang="pt-BR">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>@yield('title', 'PRODUTOS.SYS')</title>
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
    --danger: #ff5c5c;
  }

  * { box-sizing: border-box; }
  html { scroll-behavior: smooth; }

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
    background-position: center top;
  }

  a { color: inherit; }
  :focus-visible { outline: 2px solid var(--amber); outline-offset: 3px; }
  .mono { font-family: 'IBM Plex Mono', monospace; }
  .wrap { max-width: 1180px; margin: 0 auto; padding: 0 28px; }

  /* BRAND */
  .brand {
    display: flex; align-items: center; gap: 10px;
    font-family: 'IBM Plex Mono', monospace;
    font-weight: 600; letter-spacing: 0.08em; font-size: 15px;
    color: var(--paper); text-decoration: none;
  }
  .brand-mark { width: 22px; height: 22px; border: 1.5px solid var(--amber); position: relative; flex-shrink: 0; }
  .brand-mark::before, .brand-mark::after { content: ''; position: absolute; background: var(--amber); }
  .brand-mark::before { top: 50%; left: 3px; right: 3px; height: 1.5px; transform: translateY(-50%); }
  .brand-mark::after { left: 50%; top: 3px; bottom: 3px; width: 1.5px; transform: translateX(-50%); }

  /* NAV */
  nav {
    display: flex; align-items: center; justify-content: space-between;
    padding: 28px 0; border-bottom: 1px solid var(--panel-line);
  }
  .navlinks {
    display: flex; gap: 32px;
    font-family: 'IBM Plex Mono', monospace; font-size: 12px;
    letter-spacing: 0.12em; text-transform: uppercase;
  }
  .navlinks a { text-decoration: none; color: var(--paper-dim); transition: color 0.15s ease; }
  .navlinks a:hover, .navlinks a.active { color: var(--amber); }
  .btn-logout {
    font-family: 'IBM Plex Mono', monospace; font-size: 12px; letter-spacing: 0.1em;
    text-transform: uppercase; background: transparent; border: none;
    color: var(--paper-dim); cursor: pointer; padding: 0; transition: color 0.15s ease;
  }
  .btn-logout:hover { color: var(--amber); }

  /* EYEBROW */
  .eyebrow {
    display: inline-flex; align-items: center; gap: 10px;
    font-family: 'IBM Plex Mono', monospace; font-size: 12px;
    letter-spacing: 0.16em; color: var(--amber); margin-bottom: 14px;
  }
  .eyebrow::before {
    content: ''; width: 7px; height: 7px; background: var(--amber);
    box-shadow: 0 0 8px 1px var(--amber); animation: blink 1.6s steps(2, jump-none) infinite;
  }
  @keyframes blink { 50% { opacity: 0.25; } }

  /* BUTTONS */
  .btn {
    font-family: 'IBM Plex Mono', monospace; font-size: 13px; letter-spacing: 0.06em;
    text-decoration: none; padding: 14px 22px; display: inline-flex; align-items: center;
    gap: 8px; border: 1px solid transparent; cursor: pointer; transition: all 0.15s ease;
  }
  .btn-primary { background: var(--amber); color: var(--ink); font-weight: 600; }
  .btn-primary:hover { background: #ffc233; }
  .btn-ghost { border-color: var(--panel-line); color: var(--paper); background: transparent; }
  .btn-ghost:hover { border-color: var(--amber-dim); color: var(--amber); }

  /* TERMINAL */
  .terminal { background: var(--panel); border: 1px solid var(--panel-line); }
  .terminal-head {
    display: flex; justify-content: space-between; padding: 10px 16px;
    border-bottom: 1px solid var(--panel-line); font-family: 'IBM Plex Mono', monospace;
    font-size: 11px; letter-spacing: 0.1em; color: var(--paper-dim);
  }

  /* FOOTER */
  footer {
    border-top: 1px solid var(--panel-line); padding: 26px 0 40px;
    display: flex; justify-content: space-between; align-items: center;
    font-family: 'IBM Plex Mono', monospace; font-size: 11px; letter-spacing: 0.08em;
    color: var(--paper-dim); flex-wrap: wrap; gap: 10px;
  }

  @media (prefers-reduced-motion: reduce) {
    .eyebrow::before, .scan-line, .caret { animation: none; }
  }
</style>

{{-- Cada página pode empilhar seu próprio bloco de estilo aqui --}}
@stack('styles')
</head>
<body>

@yield('content')

</body>
</html>