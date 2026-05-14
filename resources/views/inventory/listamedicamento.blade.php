@extends('layouts.app')

@section('title', 'Inventário')

@push('styles')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <link rel="stylesheet" href="/css/listamedicamento.css">
@endpush

@section('content')

<header class="header-greeting">
    <div class="header">
        <span class="icon" id="greeting-icon">☀️</span>
        <span class="text" id="greeting-text">Bom dia</span>
    </div>
    <div class="date-time">
        <span id="current-date"></span> 
        <span id="current-time"></span>
    </div>
</header>

<hr class="divider">

<section class="content-wrapper">
    <div class="section-header">
        <div>
            <h1>Inventário</h1>
            <p class="section-subtitle">Lista de Medicamentos</p>
        </div>
    </div>

    <form action="{{ route('inventory.index') }}" method="GET" class="search-form">
        <input type="text" name="search" placeholder="Pesquise medicamentos..."
               value="{{ request()->input('search') }}">
    </form>

    <table class="table">
        <thead>
            <tr>
                <th>Nome</th>
                <th>ID</th>
                <th>Grupo</th>
                <th>Quantidade</th>
                <th>Validade</th>
                <th>Ações</th>
            </tr>
        </thead>
        <tbody>
            @if($medications->isEmpty())
                <tr>
                    <td colspan="6" class="text-center">Nenhum medicamento encontrado</td>
                </tr>
            @else
                @foreach($medications as $medication)
                <tr>
                    <td>{{ $medication->name }}</td>
                    <td>{{ $medication->medication_id }}</td>
                    <td>{{ $medication->group }}</td>
                    <td>{{ $medication->quantity }}</td>
                    <td>{{ \Carbon\Carbon::parse($medication->expiration_date)->format('d/m/Y') }}</td>
                    <td class="actions-cell">
                        {{-- Ver detalhes --}}
                        <a href="{{ route('inventory.edit', $medication->id) }}"
                           class="btn-action btn-view" title="Ver detalhes">
                            <i class="fas fa-eye"></i>
                        </a>
                        {{-- Editar --}}
                        <a href="{{ route('inventory.edit', $medication->id) }}"
                           class="btn-action btn-edit" title="Editar">
                            <i class="fas fa-pencil-alt"></i>
                        </a>
                        {{-- Excluir --}}
                        <form action="{{ route('inventory.destroy', $medication->id) }}"
                              method="POST" style="display:inline;"
                              onsubmit="return confirm('Tem certeza que deseja excluir este medicamento?')">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn-action btn-delete" title="Excluir">
                                <i class="fas fa-trash-alt"></i>
                            </button>
                        </form>
                    </td>
                </tr>
                @endforeach
            @endif
        </tbody>
    </table>

    <div class="pagination-wrapper">
        {{ $medications->links() }}
    </div>
</section>

<footer class="rodape">
    Instituto de Estudos e Pesquisa - Humaniza &copy; 2024.
</footer>

@endsection