@extends('layouts.app')

@section('title', 'Cadastrar Usuário')

@push('styles')
    <link rel="stylesheet" href="/css/register.css">
@endpush

@section('content')

<header class="header-greeting">
    <div class="header">
        <span class="icon" id="greeting-icon">☀️</span>
        <span class="text" id="greeting-text">Bom dia</span>
    </div>
    <div class="date-time">
        <span id="current-date"></span> •
        <span id="current-time"></span>
    </div>
</header>

<hr class="divider">

<div class="dashboard-header">
    <h1>Cadastrar Novo Usuário</h1>
    <p>Preencha os dados para registrar um novo funcionário</p>
</div>

@if(session('success'))
    <div class="alert-success">
        ✅ {{ session('success') }}
    </div>
@endif

@if($errors->any())
    <div class="alert-error">
        <ul>
            @foreach($errors->all() as $error)
                <li>❌ {{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

<div class="register-container">
    <form method="POST" action="{{ route('register') }}">
        @csrf
        <div class="form-grid">

            <div class="form-row">
                <div class="input-group half-width">
                    <label for="name">Nome</label>
                    <input type="text" id="name" name="name" value="{{ old('name') }}" required autofocus>
                </div>
                <div class="input-group half-width">
                    <label for="last_name">Sobrenome</label>
                    <input type="text" id="last_name" name="last_name" value="{{ old('last_name') }}" required>
                </div>
            </div>

            <div class="form-row">
                <div class="input-group half-width">
                    <label for="email">E-mail</label>
                    <input type="email" id="email" name="email" value="{{ old('email') }}" required>
                </div>
                <div class="input-group half-width">
                    <label for="role">Cargo</label>
                    <select id="role" name="role" required>
                        <option value="" disabled selected>Selecione um cargo</option>
                        <option value="Farmaceutico" {{ old('role') == 'Farmaceutico' ? 'selected' : '' }}>Farmacêutico</option>
                        <option value="Coordenador" {{ old('role') == 'Coordenador' ? 'selected' : '' }}>Coordenador(a)</option>
                    </select>
                </div>
            </div>

            <div class="form-row">
                <div class="input-group half-width">
                    <label for="password">Senha</label>
                    <input type="password" id="password" name="password" required>
                </div>
                <div class="input-group half-width">
                    <label for="password_confirmation">Confirmar Senha</label>
                    <input type="password" id="password_confirmation" name="password_confirmation" required>
                </div>
            </div>

        </div>
        <button type="submit" class="btn">Registrar</button>
    </form>
</div>

@endsection