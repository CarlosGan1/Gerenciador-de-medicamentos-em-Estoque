@extends('layouts.app')

@section('title', 'Cadastrar Medicamento')

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
    <h1>Cadastrar Medicamento</h1>
    <p>Preencha os dados para adicionar um novo medicamento ao inventário</p>
</div>

@if(session('success'))
    <div class="alert-success">✅ {{ session('success') }}</div>
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
    <form action="{{ route('inventory.store') }}" method="POST">
        @csrf
        <div class="form-grid">

            <div class="form-row">
                <div class="input-group half-width">
                    <label for="name">Nome do Medicamento</label>
                    <input type="text" id="name" name="name" value="{{ old('name') }}" required>
                </div>
                <div class="input-group half-width">
                    <label for="medication_id">ID do Medicamento</label>
                    <input type="text" id="medication_id" name="medication_id" value="{{ old('medication_id') }}" required>
                </div>
            </div>

            <div class="form-row">
                <div class="input-group half-width">
                    <label for="type">Tipo</label>
                    <select id="type" name="type" required>
                        <option value="" disabled selected>Selecione o tipo</option>
                        <option value="Antibiótico"        {{ old('type') == 'Antibiótico' ? 'selected' : '' }}>Antibiótico</option>
                        <option value="Analgésico"         {{ old('type') == 'Analgésico' ? 'selected' : '' }}>Analgésico</option>
                        <option value="Anti-inflamatório"  {{ old('type') == 'Anti-inflamatório' ? 'selected' : '' }}>Anti-inflamatório</option>
                        <option value="Antihipertensivo"   {{ old('type') == 'Antihipertensivo' ? 'selected' : '' }}>Anti-Hipertensivos</option>
                        <option value="Antialérgico"       {{ old('type') == 'Antialérgico' ? 'selected' : '' }}>Antialérgicos</option>
                        <option value="Corticoide"         {{ old('type') == 'Corticoide' ? 'selected' : '' }}>Corticoides</option>
                        <option value="Solução"            {{ old('type') == 'Solução' ? 'selected' : '' }}>Soluções</option>
                        <option value="Soro"               {{ old('type') == 'Soro' ? 'selected' : '' }}>Soros</option>
                    </select>
                </div>
                <div class="input-group half-width">
                    <label for="group">Grupo</label>
                    <select id="group" name="group" required>
                        <option value="" disabled selected>Selecione o grupo</option>
                        <option value="Comum"           {{ old('group') == 'Comum' ? 'selected' : '' }}>Comum</option>
                        <option value="Controlado"      {{ old('group') == 'Controlado' ? 'selected' : '' }}>Controlado</option>
                        <option value="Receita Especial"{{ old('group') == 'Receita Especial' ? 'selected' : '' }}>Receita Especial</option>
                    </select>
                </div>
            </div>

            <div class="form-row">
                <div class="input-group half-width">
                    <label for="expiration_date">Data de Validade</label>
                    <input type="date" id="expiration_date" name="expiration_date" value="{{ old('expiration_date') }}">
                </div>
                <div class="input-group half-width">
                    <label for="quantity">Quantidade</label>
                    <input type="number" id="quantity" name="quantity" value="{{ old('quantity') }}" min="0" required>
                </div>
            </div>

            <div class="form-row">
                <div class="input-group half-width">
                    <label for="ideal_quantity">Quantidade Ideal</label>
                    <input type="number" id="ideal_quantity" name="ideal_quantity" value="{{ old('ideal_quantity') }}" min="0" required>
                </div>
                <div class="input-group half-width">
                    <label for="minimum_quantity">Quantidade Mínima</label>
                    <input type="number" id="minimum_quantity" name="minimum_quantity" value="{{ old('minimum_quantity') }}" min="0" required>
                </div>
            </div>

        </div>

        <div class="form-actions">
            <button type="submit" class="btn">Salvar Medicamento</button>
            <a href="{{ route('inventory.index') }}" class="btn btn-secondary">← Voltar</a>
        </div>
    </form>
</div>

@endsection