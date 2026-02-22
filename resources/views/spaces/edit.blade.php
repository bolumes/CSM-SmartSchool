@extends('layouts.app')

@section('content')
<div class="container mx-auto p-4">
    <h1 class="text-2xl font-bold mb-4">Editar Espaço</h1>

    <form action="{{ route('spaces.update', $space->id) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="mb-4">
            <label class="block mb-1 font-semibold">Nome do Espaço</label>
            <input type="text" name="name" class="w-full p-2 border rounded" value="{{ $space->name }}" required>
        </div>

        <div class="mb-4">
            <label class="block mb-1 font-semibold">Descrição</label>
            <textarea name="description" class="w-full p-2 border rounded">{{ $space->description }}</textarea>
        </div>

        <button type="submit" class="px-4 py-2 bg-green-600 text-white rounded">Salvar Alterações</button>
    </form>
</div>
@endsection
