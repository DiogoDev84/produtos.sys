<nav>
  <a href="{{ route('produtos.index') }}" class="brand">
    <span class="brand-mark"></span>
    PRODUTOS.SYS
  </a>
  <div class="navlinks" style="align-items: center;">
    <a href="/">Início</a>
    <a href="{{ route('produtos.index') }}" class="{{ request()->routeIs('produtos.*') ? 'active' : '' }}">Produtos</a>
    <a href="{{ route('clientes.index') }}" class="{{ request()->routeIs('clientes.*') ? 'active' : '' }}">Clientes</a>
    <a href="{{ route('pedidos.index') }}" class="{{ request()->routeIs('pedidos.*') ? 'active' : '' }}">Pedidos</a>
    <form method="POST" action="{{ route('logout') }}" style="display:inline; margin: 0;">
      @csrf
      <button type="submit" class="btn-logout">Sair →</button>
    </form>
  </div>
</nav>
