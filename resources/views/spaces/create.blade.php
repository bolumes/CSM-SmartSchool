@extends('layouts.app')

@section('content')
<div class="container mx-auto p-4">
    <h1 class="text-2xl font-bold mb-4">Criar Novo Espaço</h1>

    <form action="{{ route('spaces.store') }}" method="POST">
        @csrf
        <div class="mb-4">
            <label class="block mb-1 font-semibold">Nome do Espaço</label>
            <input type="text" name="name" class="w-full p-2 border rounded" required>
        </div>

        <div class="mb-4">
            <label class="block mb-1 font-semibold">Descrição (opcional)</label>
            <textarea name="description" class="w-full p-2 border rounded"></textarea>
        </div>

        <button type="submit" class="px-4 py-2 bg-blue-600 text-white rounded">Criar Espaço</button>
    </form>
</div>
@endsection
