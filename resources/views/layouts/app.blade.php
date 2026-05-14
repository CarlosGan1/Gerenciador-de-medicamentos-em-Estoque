<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="/css/dashboard.css">
    @stack('styles')
    <title>@yield('title', 'Gerenciador de Medicamentos')</title>
</head>
<body>
    <nav class="sidebar">
        <div class="sidebar-header">
            <img src="/img/Imagem1.png" alt="Logo do Instituto" class="humaniza-logo">
        </div>

        <div class="user-info">
            @auth
            <div class="user-avatar">
                {{ strtoupper(substr(auth()->user()->name, 0, 1)) }}
            </div>
            <div class="user-details">
                <span class="user-name">{{ auth()->user()->name }} {{ auth()->user()->last_name ?? '' }}</span>
                <span class="user-role">{{ auth()->user()->role ?? 'Usuário' }}</span>
            </div>
            @endauth
        </div>

        <hr>

        <div class="sidebar-menu">
            <a href="{{ route('dashboard') }}" class="{{ request()->routeIs('dashboard') ? 'active' : '' }}">Dashboard</a>
            <a href="{{ route('inventory.index') }}" class="{{ request()->routeIs('inventory.index') ? 'active' : '' }}">Inventário</a>
            <a href="{{ route('relatorio.index') }}" class="{{ request()->routeIs('relatorio.index') ? 'active' : '' }}">Relatório</a>

            {{-- Dropdown Cadastrar --}}
            <div class="sidebar-dropdown {{ request()->routeIs('register') || request()->routeIs('inventory.create') ? 'open' : '' }}">
                <button class="sidebar-dropdown-btn {{ request()->routeIs('register') || request()->routeIs('inventory.create') ? 'active' : '' }}"
                        onclick="toggleDropdown(this)">
                    Cadastrar
                    <span class="dropdown-arrow">▾</span>
                </button>
                <div class="sidebar-dropdown-menu">
                    <a href="{{ route('register') }}" class="{{ request()->routeIs('register') ? 'active' : '' }}">
                         Funcionário
                    </a>

                    <a href="{{ route('inventory.create') }}" class="{{ request()->routeIs('inventory.create') ? 'active' : '' }}">
                         Medicamento
                    </a>
                </div>
            </div>
        </div>
    </nav>

    <main class="main-content">
        @yield('content')
    </main>

    <script src="/js/dashboard.js" defer></script>
    <script>
        function toggleDropdown(btn) {
            const dropdown = btn.closest('.sidebar-dropdown');
            dropdown.classList.toggle('open');
        }
    </script>
    @stack('scripts')
</body>
</html>