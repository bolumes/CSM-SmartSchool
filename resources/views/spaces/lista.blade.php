@extends('layouts.app')

@section('content')
<div class="container mx-auto p-4">
    <h1 class="text-2xl font-bold mb-4">Lista de Espaços</h1>

    <a href="{{ route('spaces.create') }}" class="inline-block mb-4 px-4 py-2 bg-blue-600 text-white rounded">Criar Novo Espaço</a>

    <ul class="space-y-4">
        @foreach($spaces as $space)
        <li class="p-4 border rounded flex justify-between items-center">
            <div>
                <a href="{{ route('spaces.show', $space->id) }}" class="text-lg font-semibold text-blue-700">
                    {{ $space->name }}
                </a>
                <p class="text-gray-600">{{ $space->description }}</p>
            </div>
            <div class="space-x-2">
                <a href="{{ route('spaces.edit', $space->id) }}" class="px-3 py-1 bg-yellow-500 text-white rounded">Editar</a>
                <form action="{{ route('spaces.destroy', $space->id) }}" method="POST" class="inline">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="px-3 py-1 bg-red-600 text-white rounded">Apagar</button>
                </form>
            </div>
        </li>s
        @endforeach
    </ul>
</div>
@endsection
