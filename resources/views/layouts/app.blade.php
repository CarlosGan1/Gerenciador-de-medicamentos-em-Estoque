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
            <a href="{{ route('inventory.index') }}" class="{{ request()->routeIs('inventory.*') ? 'active' : '' }}">Inventário</a>
            <a href="{{ route('relatorio.index') }}" class="{{ request()->routeIs('relatorio.*') ? 'active' : '' }}">Relatório</a>
            <a href="{{ route('register') }}" class="{{ request()->routeIs('register') ? 'active' : '' }}">Cadastrar</a>
        </div>
    </nav>

    <main class="main-content">
        @yield('content')
    </main>

    <script src="/js/dashboard.js" defer></script>
    @stack('scripts')
</body>
</html>